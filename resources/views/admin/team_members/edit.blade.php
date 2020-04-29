@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.team-members.edit')</h3>
    
    {!! Form::model($users, ['method' => 'post', 'route' => ['admin.team_members_update']]) !!}

    <div class="row">
        <div class="col-xs-3 form-group">
            @if (count($users) > 0)
                @foreach ($users as $user)
                    <div class="form-control">
                        <div class="col-xs-8">
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="col-xs-4">
                            @if($user->is_selected)
                            {!! Form::checkbox('member_id[]',$user->id,'checked') !!}
                            @else
                            {!! Form::checkbox('member_id[]',$user->id,null) !!}
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    {!! Form::hidden('team_id', $team_id) !!}
    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

