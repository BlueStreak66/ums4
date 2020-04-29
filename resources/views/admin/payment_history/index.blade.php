@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.payment_histories.title')</h3>
    @can('payment_create')
    <p>
        <a href="{{ route('admin.payment_history.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading amount_desc">
            Total Amount - {{$real_amount}} USD
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($payment_histories) > 0 ? 'datatable' : '' }}" >
                <thead>
                    <tr>
                        <th>@lang('global.app_number')</th>
                        <th>@lang('global.payment_histories.fields.amount')</th>
                        <th>@lang('global.payment_histories.fields.real_amount')</th>
                        <th>@lang('global.payment_histories.fields.name')</th>
                        <th>@lang('global.payment_histories.fields.payment_address')</th>
                        <th>@lang('global.payment_histories.fields.comment')</th>
                        <th>@lang('global.payment_histories.fields.date')</th>
                        <th>@lang('global.payment_histories.fields.actions')</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($payment_histories) > 0)
                        @foreach ($payment_histories as $key => $history)
                            <tr data-entry-id="{{ $history->id }}" class="{{ $history->state ? '' : 'unconfirmed' }}">
                                <td>{{ $key + 1 }}</td>   
                                <td>{{ $history->amount }}</td>
                                <td>{{ $history->real_amount }}</td>
                                <td>{{ $history->user_name }}</td>
                                <td>{{ $history->payment_address }}</td>
                                <td>{{ $history->comment }}</td>
                                <td>{{ $history->create_date }}</td>
                                <td>
                                    @if(Gate::check('admin'))
                                    <a href="{{ route('admin.payment_history.edit',[$history->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @else
                                        @if(Gate::check('payment_edit') && (auth()->user()->id == $history->created_by))
                                        <a href="{{ route('admin.payment_history.edit',[$history->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endif
                                    @endif
                                    @can('payment_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payment_history.destroy', $history->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    @can('payment_confirm')
                                    <a href="{{ route('admin.payment_history.confirm', ['history_id' => $history->id]) }}" class="btn btn-xs btn-success">@lang('global.app_confirm')</a>    
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