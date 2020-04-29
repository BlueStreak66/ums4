@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.total_payment.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading amount_desc">
            Total Amount - {{$real_amount}} USD
        </div>

        <div class="panel-body table-responsive" >
            <table class="table table-bordered table-striped {{ count($sum_history) > 0 ? 'datatable' : '' }}" >
                <thead>
                    <tr>
                        <th>@lang('global.app_number')</th>
                        <th>@lang('global.payment_histories.fields.name')</th>
						<th>@lang('global.payment_histories.fields.amount')</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($sum_history) > 0)
                        @foreach ($sum_history as $key => $user)
                            <tr data-entry-id="{{ $user->id }}">
                                
								@if ($user->amount >= 3000)
									<td style="color:blue"><b>{{ $key + 1 }}</b></td>   
									<td style="color:blue"><b>{{ $user->name }}</b></td>
									<td style="color:blue"><b>{{ $user->amount }}</b></td>
								@elseif (!$user->amount)
									<td style="color:red"><b>{{ $key + 1 }} </b></td> 
									<td style="color:red"><b>{{ $user->name }} </b></td>
									<td style="color:red"><b> 0 </b> </td>
								@elseif ($user->amount <= 500)
									<td style="color:red"><b>{{ $key + 1 }}</b></td> 
									<td style="color:red"><b>{{ $user->name }}</b></td>
									<td style="color:red"><b>{{ $user->amount }}</b></td>
								@else
									<td>{{ $key + 1 }}</td> 
									<td>{{ $user->name }}</td>
									<td>{{ $user->amount }}</td>
								@endif
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