<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'image'];

    // Relatie: Een klant kan meerdere orders hebben
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

