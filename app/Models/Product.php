<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function bundles()
    {
        return $this->hasMany(Bundle::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
