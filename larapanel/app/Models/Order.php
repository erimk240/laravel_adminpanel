<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'order_number', 'total', 'status'];

    // Relatie: Een order kan meerdere producten hebben
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity');
    }

    // Relatie: Een order hoort bij één klant
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
