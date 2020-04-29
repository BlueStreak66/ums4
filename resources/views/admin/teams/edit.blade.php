@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.teams.title')</h3>
    
    {!! Form::model($team, ['method' => 'PUT', 'route' => ['admin.teams.update', $team->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('team_name', 'Team Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('team_name', old('team_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    {!! Form::label('team_leader', 'Team Leader*', ['class' => 'control-label']) !!}
                    {!! Form::select('team_leader', $users, old('team_leader'), ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

