<?php

namespace App\Http\Controllers\Admin;

use App\PaymentAddress;
use App\User;
use App\TeamMembers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PaymentAddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (! Gate::allows('payment_address_access')) {
            return abort(401);
        }
        $accounts = PaymentAddress::all();

        return view('admin.payment_address.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('payment_address_create')) {
            return abort(401);
        }

        return view('admin.payment_address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('payment_address_create')) {
            return abort(401);
        }
        $account = PaymentAddress::create($request->all());

        return redirect()->route('admin.payment_address.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('payment_address_edit')) {
            return abort(401);
        }
        $account = PaymentAddress::findOrFail($id);

        return view('admin.payment_address.edit', compact('account'));
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
        if (! Gate::allows('payment_address_edit')) {
            return abort(401);
        }

        $account = PaymentAddress::findOrFail($id);
        $account->update($request->all());

        return redirect()->route('admin.payment_address.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('payment_address_delete')) {
            return abort(401);
        }
        $account = PaymentAddress::findOrFail($id);
        $account->delete();
    
        return redirect()->route('admin.payment_address.index');
    }
}
