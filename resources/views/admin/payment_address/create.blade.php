@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.accounts.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.payment_address.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('account', 'Account*', ['class' => 'control-label']) !!}
                    {!! Form::text('account', old('account'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('account') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row"> 
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', 'Payment Address*', ['class' => 'control-label']) !!}
                    {!! Form::text('email', old('address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('account') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

