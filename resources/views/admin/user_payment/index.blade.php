@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.total_payment.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading amount_desc">
            Total Amount - {{$real_amount}} USD
        </div>
        <div class="chart-responsive col-sm-12" id="individual_chart">
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
                </div>
                
                <div class="modal-footer">
                    <h4>
                        <b>Total: </b>
                        <label id = "total_amount"></label>
                    </h4>
                </div>

            </div>
        </div>
    </div>

@stop

@section('javascript') 
<script>
    var individual_plan_amount = 3000;
    var individual_plan_min_amount = 500;
    var set_max = 2500;
    var individual_chart_color = [];
    var individual_chart_datas = [@foreach($sum_history as $key => $user)
                            {'label' : '{{ $user->name }}',
                             'y' : '{{ $user->amount }}'},
                        @endforeach ];    
    
    for (var i=0; i<individual_chart_datas.length;i++){
        individual_chart_datas[i]['y'] = Number(individual_chart_datas[i]['y']);
        if(individual_chart_datas[i]['y'] > individual_plan_amount && individual_chart_datas[i]['y'] > set_max) set_max = individual_chart_datas[i]['y'];

        if(individual_chart_datas[i]['y'] >= individual_plan_amount) individual_chart_color[i] = "#0000FF";
        else if(individual_chart_datas[i]['y'] < individual_plan_amount && individual_chart_datas[i]['y'] > individual_plan_min_amount) individual_chart_color[i] = "#000000";
        else individual_chart_color[i] = "#FF0000";
    }

    var chart_width = window.innerWidth / (i * 2 + 10);
    CanvasJS.addColorSet("individual_chart_color", individual_chart_color);

    var date = new Date();
    var year = date.getYear() + 1900;
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var old_year = year;
    var old_month = month;
    if(day < 25) {
        if(month == 1) {
            month = 12;
            year = year - 1;
        } else old_month = month - 1;
    }
    
    var chart_title = old_year + "." + old_month + ".26 ~ " + year + "." + month + "." + day;

    var individual_chart = new CanvasJS.Chart("individual_chart", {
        title:{
            text: chart_title,
            fontSize: 20,
        },
        dataPointWidth: chart_width,
        colorSet: "individual_chart_color",
        exportEnabled: true,
        animationEnabled: true,
        axisX:{
            tickLength: 0,
            tickLength: 10,
            tickColor: "write",
            labelFontSize: 14,
        },
        axisY: {
            tickColor: "#000",
            valueFormatString:"#,##0.# USD",
            maximum: set_max + 500,
            labelFontSize: 14,
        },
        toolTip: {
            shared: true,
        },
        legend: {
            cursor: "pointer",
            itemclick: toggleDataSeries,
            labels: {
                fontSize: 12,
            },
        },
        data: [{
            type: "column",
            name: "amount",
            showInLegend: false,      
            yValueFormatString: "#,##0.# USD",
            dataPoints: individual_chart_datas,
        }],
    });
    individual_chart.render();

    function toggleDataSeries(e) {
        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        e.individual_chart.render();
    }
    $('.canvasjs-chart-credit').addClass('hide');
    $('.canvasjs-chart-toolbar').addClass('hide');

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