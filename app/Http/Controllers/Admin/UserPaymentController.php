<?php

namespace App\Http\Controllers\Admin;

use App\PaymentHistory;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class UserPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('payment_access')) {
            return abort(401);
        }
		$sum_history = DB::select(DB::raw("SELECT users.id, users.name,  COALESCE(SUM(payment_history.real_amount),0) as amount FROM users LEFT JOIN  payment_history ON users.id = payment_history.user_id where users.email<>'admin@admin.com' and users.is_active=1 GROUP BY users.id ORDER BY amount desc"));		
        $real_amount = PaymentHistory::all()->sum('real_amount');
        $payment_histories = PaymentHistory::all()->SortByDesc('create_date');
        return view('admin.user_payment.index', compact('real_amount', 'sum_history', 'payment_histories'));
    }
}
