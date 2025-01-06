<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id'); // Verwijzing naar de klanten tabel
            $table->string('order_number')->unique();
            $table->decimal('total', 10, 2); // Totale bedrag
            $table->string('status')->default('pending'); // Status van de order
            $table->timestamps();

            // Voeg een foreign key toe om de relatie met customers te behouden
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
