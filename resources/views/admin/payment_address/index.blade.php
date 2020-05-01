@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.accounts.title')</h3>
    @can('payment_address_create')
    <p>
        <a href="{{ route('admin.payment_address.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($accounts) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('global.app_number')</th>
                        <th>@lang('global.accounts.fields.account')</th>
                        <th>@lang('global.accounts.fields.email')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($accounts) > 0)
                        @foreach ($accounts as $key => $account)
                            <tr data-entry-id="{{ $account->id }}">
                                <td>{{ count($accounts) - $key }}</td>
                                <td>{{ $account->account }}</td>
                                <td>{{ $account->email }}</td>
                                <td>
                                    @can('payment_address_edit')
                                    <a href="{{ route('admin.payment_address.edit',[$account->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('payment_address_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payment_address.destroy', $account->id])) !!}
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