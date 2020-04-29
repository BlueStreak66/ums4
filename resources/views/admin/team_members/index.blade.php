@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.team-members.title')</h3>

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
                        <th>@lang('global.team-members.title')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($teams) > 0)
                        @foreach ($teams as $key => $team)
                            <tr data-entry-id="{{ $team->id }}">
                                <td>{{ count($teams) - $key }}</td>
                                <td>{{ $team->team_name }}</td>
                                <td>
                                    @foreach ($team->members as $member)
                                        <span class="label label-info label-many">{{ $member->user->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('team_access')
                                    <a href="{{ route('admin.team_members_edit',['team_id' => $team->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop