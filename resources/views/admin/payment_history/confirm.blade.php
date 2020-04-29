@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.payment_histories.title')</h3>
    {!! Form::model($payment_history, ['method' => 'Post', 'route' => ['admin.payment_history.confirm', 'history_id' => $payment_history->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('amount', 'Amount*', ['class' => 'control-label']) !!}
                    {!! Form::text('amount', old('amount'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly' => '']) !!}
                    <p class="help-block"></p>
                    {!! Form::label('real_amount', 'Real Amount*', ['class' => 'control-label']) !!}
                    {!! Form::text('real_amount', old('real_amount'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    {!! Form::label('user_name', 'Amount*', ['class' => 'control-label']) !!}
                    {!! Form::text('user_name', old('user_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly' => '']) !!}
                    <p class="help-block"></p>
                    {!! Form::label('payment_address', 'Payment Address*', ['class' => 'control-label']) !!}
                    {!! Form::text('payment_address', old('payment_address'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly' => '']) !!}
                    <p class="help-block"></p>
                    {!! Form::label('comment', 'Comment*', ['class' => 'control-label']) !!}
                    {!! Form::text('comment', old('comment'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly' => '']) !!}
                    <p class="help-block"></p>
                    {!! Form::label('create_date', 'Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('create_date', old('create_date'), ['class' => 'form-control', 'placeholder' => '', 'required' => '', 'readonly' => '']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_confirm'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@stop

