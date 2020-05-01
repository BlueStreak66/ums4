@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.dashboard.post')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.posts.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('post_title', 'Post Title*', ['class' => 'control-label']) !!}
                    {!! Form::text('post_title', old('post_title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    {!! Form::label('post_content', 'Post Content', ['class' => 'control-label']) !!}
                    {!! Form::textarea('post_content', old('post_content'), ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop