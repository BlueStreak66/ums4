@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.payment_histories.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.payment_history.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('amount', 'Amount*', ['class' => 'control-label']) !!}
                    {!! Form::text('amount', old('amount'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    {!! Form::label('user_id', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    {!! Form::label('payment_address', 'Payment Address*', ['class' => 'control-label']) !!}
                    <div>
                        @if(Gate::check('payment_address_create'))
                        <div class="col-sm-11">
                            <a>{!! Form::select('payment_address', $accounts, old('id'), ['class' => 'form-control']) !!}</a>
                        </div>
                        <div class="col-sm-1">
                        <p>
                            <a href="{{ route('admin.payment_address.index') }}" class="btn btn-success">@lang('global.app_add_new')</a>
                        </p>
                        </div>
                        @else
                        <div>
                            <a>{!! Form::select('payment_address', $accounts, old('id'), ['class' => 'form-control']) !!}</a>
                        </div>
                        @endif
                    </div>
                    <p class="help-block"></p>
                    {!! Form::label('comment', 'Comment*', ['class' => 'control-label']) !!}
                    {!! Form::text('comment', old('comment'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    {!! Form::label('create_date', 'Date*', ['class' => 'control-label']) !!}
                    {!! Form::date('create_date', old('create_date'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

