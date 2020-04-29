<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamMembers
 *
 * @package App
 * @property string $team_id
 * @property string $user_id
*/
class TeamMembers extends Model
{
    protected $table = 'team_members';
    protected $fillable = ['team_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
