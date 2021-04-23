<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OTPLogin extends Model
{
    protected $fillable = ['phone_number', 'password', 'otp'];
}
