<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentHistory
 *
 * @package App
*/
class PaymentHistory extends Model
{
    protected $table = 'payment_history';
    protected $fillable = ['amount', 'real_amount', 'user_id', 'user_name', 'created_by', 'payment_address', 'comment', 'state', 'create_date'];
}
