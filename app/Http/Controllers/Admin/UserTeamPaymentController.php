<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTeamPaymentController extends Controller
{
    public function team()
    {
        
        if (! Gate::allows('payment_access')) {
            return abort(401);
        }
		$sum_history = DB::select(DB::raw("SELECT team_table.id, team_table.team_name, sum(team_table.amount) as all_amount, team_table.team_plan, (sum(team_table.amount) * 100 / team_table.team_plan) as team_rate FROM (SELECT total.id, total.name, total.amount, team_members.team_id, teams.team_name, teams.team_plan  FROM (SELECT users.id, users.name,  COALESCE(SUM(payment_history.real_amount),0) as amount FROM users LEFT JOIN  payment_history ON users.id = payment_history.user_id where users.email<>'admin@admin.com' and users.is_active=1 GROUP BY users.id ORDER BY amount desc) as total, teams, team_members where total.id = team_members.user_id and teams.id = team_members.team_id ORDER BY team_members.team_id, total.amount desc) as team_table GROUP BY team_table.team_name"));		
        return view('admin.user_payment.team', compact('sum_history'));
    }
}
