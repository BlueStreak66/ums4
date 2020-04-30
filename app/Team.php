<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Team
 *
 * @package App
 * @property string $team_name
*/
class Team extends Model
{
    protected $table = 'teams';
    protected $fillable = ['team_name', 'team_leader', 'team_plan'];

    public function members()
    {
        return $this->hasMany('App\TeamMembers', 'team_id');
    }
    public function leader()
    {
        return $this->belongsTo('App\User', 'team_leader');
    }
}
