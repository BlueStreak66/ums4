<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentHistory
 *
 * @package App
*/
class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['post_title', 'post_content'];
}
