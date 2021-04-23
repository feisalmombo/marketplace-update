<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function loan_type(){

        return $this->hasMany(LoanRate::class,'product_id');
    }
}
