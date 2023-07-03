<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valuation extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }
}
