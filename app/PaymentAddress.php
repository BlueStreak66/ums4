<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentAddress extends Model
{
    protected $table = 'accounts';
    protected $fillable = ['id', 'account', 'email'];
}
