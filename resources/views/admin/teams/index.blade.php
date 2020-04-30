@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.teams.title')</h3>
    @can('team_create')
    <p>
        <a href="{{ route('admin.teams.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($teams) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('global.app_number')</th>
                        <th>@lang('global.teams.fields.team_name')</th>
                        <th>@lang('global.teams.fields.team_leader')</th>
                        <th>@lang('global.teams.fields.team_plan')</th>
                        <th>@lang('global.teams.fields.created_at')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($teams) > 0)
                        @foreach ($teams as $key => $team)
                            <tr data-entry-id="{{ $team->id }}">
                                <td>{{ count($teams) - $key }}</td>
                                <td>{{ $team->team_name }}</td>
                                <td>{{ $team->leader['name'] }}</td>
                                <td>{{ $team->team_plan }}</td>
                                <td>{{ $team->created_at }}</td>
                                <td>
                                    @can('team_edit')
                                    <a href="{{ route('admin.teams.edit',[$team->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('team_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.teams.destroy', $team->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
@endsection