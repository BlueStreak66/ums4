<?php

namespace App\Http\Controllers\Admin;

use App\PaymentHistory;
use App\User;
use App\PaymentAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class PaymentHistoryController extends Controller
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
		$payment_histories = PaymentHistory::all()->SortByDesc('id');
        $real_amount = PaymentHistory::all()->sum('real_amount');
        return view('admin.payment_history.index', compact('payment_histories', 'real_amount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('payment_create')) {
            return abort(401);
        }
		if(Gate::check('admin')){
            $users = User::where('is_active', 1)->pluck('name', 'id');
            $accounts = PaymentAddress::select("*", DB::raw("CONCAT(accounts.account,' - ',accounts.email) as full_address"))->pluck('full_address', 'id');
        }
		else{
            $users = User::where(['is_active' => 1, 'id' => auth()->user()->id])->pluck('name', 'id');
            $accounts = PaymentAddress::select("*", DB::raw("CONCAT(accounts.account,' - ',accounts.email) as full_address"))->pluck('full_address', 'id');
        }

        return view('admin.payment_history.create', compact('users', 'accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('payment_create')) {
            return abort(401);
        }
        $data = $request->all();
        $data['user_name'] = User::where('id', $data['user_id'])->first()->name;
        $account_id = $data['payment_address'];
        $data['payment_address'] = PaymentAddress::select("*", DB::raw("CONCAT(accounts.account,' - ',accounts.email) as full_address"))->where('id', $account_id)->first()->full_address;
        $data['created_by'] = auth()->user()->id;
        $payment_history = PaymentHistory::create($data);
        
        return redirect()->route('admin.payment_history.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('payment_edit')) {
            return abort(401);
        }
        $payment_history = PaymentHistory::findOrFail($id);
        $users = User::where('is_active', 1)->pluck('name', 'id');

        return view('admin.payment_history.edit', compact('users', 'payment_history'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('payment_edit')) {
            return abort(401);
        }
        $payment_history = PaymentHistory::findOrFail($id);
        $data = $request->all();
        $data['user_name'] = User::where('id', $data['user_id'])->first()->name;
        $data['created_by'] = auth()->user()->id;
        $payment_history->update($data);
        return redirect()->route('admin.payment_history.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $id = $request->input("history_id");
        if (! Gate::allows('payment_confirm')) {
            return abort(401);
        }
        $payment_history = PaymentHistory::findOrFail($id);
        $users = User::where('is_active', 1)->pluck('name', 'id');

        return view('admin.payment_history.confirm', compact('users', 'payment_history'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmPost(Request $request)
    {
        if (! Gate::allows('payment_confirm')) {
            return abort(401);
        }
        $id = $request->input("history_id");
        $payment_history = PaymentHistory::findOrFail($id);
        $data = array();
        $data['real_amount'] = $request->input("real_amount");
        $data['state'] = 1;
        $payment_history->update($data);
        return redirect()->route('admin.payment_history.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('payment_delete')) {
            return abort(401);
        }
        $payment_history = PaymentHistory::findOrFail($id);
        $payment_history->delete();

        return redirect()->route('admin.payment_history.index');
    }
}
