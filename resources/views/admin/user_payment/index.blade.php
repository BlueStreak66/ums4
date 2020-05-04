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
                            <tr data-entry-id="{{ $user->id }}"  data-toggle="modal" data-target="#sample" id="{{ $user->id }}" onclick="click_tr(this.id)">
                                
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

                            <!-- Modal -->

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


    <div class="modal fade" id="sample" role="dialog">
        <div class="modal-dialog">
        
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><b id = "user_name"></b></h4>
                </div>
                <div class="modal-body">
                    <table class = "table table-striped table-bordered">
                        <thead>
                            <th> Date </th>
                            <th> Real_amount </th>
                            <th> Comment </th>
                        </thead>

                        <tbody id = "modal_tbody"> </tbody>
                    </table>
                    <div>
                        <b>Total: </b>
                        <label id = "total_amount"></label>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('javascript')
<script>

    function click_tr(id){
        var payment_histories = [@foreach($payment_histories as $key => $payment_history)
            {
                'user_id': '{{$payment_history->user_id}}',
                'date': '{{$payment_history->create_date}}',
                'real_amount': '{{$payment_history->real_amount}}',
                'comment': '{{$payment_history->comment}}',
                'confirm_state': '{{$payment_history->state}}',
            },
            @endforeach];

        var history = '';
        for(var i=0;i<payment_histories.length;i++){
            if(id == payment_histories[i]['user_id'] && Number(payment_histories[i]['confirm_state']) == 1){
                history += "<tr><td>";
                history += payment_histories[i]['date'];
                history += "</td><td>";
                history += payment_histories[i]['real_amount'];
                history += "</td><td>";
                history += payment_histories[i]['comment'];
                history += "</td></tr>";
            }
        }

        var user_amount = '';
        var user_name = '';
        var sum_histories = [@foreach($sum_history as $key => $user)
            {
                'user_id': '{{$user->id}}',
                'amount': '{{$user->amount}}',
                'user_name': '{{$user->name}}',
            },
            @endforeach];

        for(var i=0;i<sum_histories.length;i++){
            if(id == sum_histories[i]['user_id']){
                user_amount = sum_histories[i]['amount'];
                user_name = sum_histories[i]['user_name'];
            }
        }

        $('#modal_tbody').html(history);
        $('#total_amount').html(user_amount);
        $('#user_name').html(user_name);
    }
</script>
@endsection