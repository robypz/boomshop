<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

}
