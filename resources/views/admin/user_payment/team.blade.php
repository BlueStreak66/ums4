@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.total_payment.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading amount_desc">

        </div>
        <div class="panel-body table-responsive" >
            <table class="table table-bordered table-striped {{ count($sum_history) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('global.app_number')</th>
                        <th>@lang('global.teams.fields.team_name')</th>
                        <th>@lang('global.payment_histories.fields.amount')</th>
                        <th>@lang('global.payment_histories.fields.team_plan')</th>
                        <th>@lang('global.payment_histories.fields.percent')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($sum_history) > 0)
                        @foreach ($sum_history as $key => $team)
                            <tr data-entry-id="{{ $team->id }}">
                                        @php $team_rate = $team->all_amount * 100 / $team->team_plan; @endphp
                                        @if ( $team_rate > 90 )
                                            <td style="color:blue">{{ $key + 1 }}</td>   
                                            <td style="color:blue">{{ $team->team_name }}</td>
                                            <td style="color:blue">{{ $team->all_amount }}</td>
                                            <td style="color:blue">{{ $team->team_plan }}</td>
                                            <td style="color:blue">{{ round($team->team_rate) }}{{ " " }}%</td>
                                        @elseif ( $team_rate < 30)
                                            <td style="color:red">{{ $key + 1 }}</td>   
                                            <td style="color:red">{{ $team->team_name }}</td>
                                            <td style="color:red">{{ $team->all_amount }}</td>
                                            <td style="color:red">{{ $team->team_plan }}</td>
                                            <td style="color:red">{{ round($team->team_rate) }}{{ " " }}%</td>
                                        @else
                                            <td>{{ $key + 1 }}</td>   
                                            <td>{{ $team->team_name }}</td>
                                            <td>{{ $team->all_amount }}</td>
                                            <td>{{ $team->team_plan }}</td>
                                            <td>{{ round($team->team_rate) }}{{ " " }}%</td>
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
        <div class="chart-responsive col-sm-12" id="team_chart">
        </div>
    </div>
@stop
@section('javascript') 
<script>
    var team_amount_datas = [@foreach($sum_history as $key => $team)
                            {'label' : '{{ $team->team_name }}',
                             'y' : '{{ $team->all_amount }}'},
                        @endforeach ];
    var team_rate_datas = [@foreach($sum_history as $key => $team)
                            {'label' : '{{ $team->team_name }}',
                             'y' : '{{ $team->team_rate }}'},
                        @endforeach ];
    for (var i=0; i<team_amount_datas.length;i++){
        team_amount_datas[i]['y'] = Number(team_amount_datas[i]['y']);
        team_rate_datas[i]['y'] = Math.round(Number(team_rate_datas[i]['y']) * 10) / 10;
    }

    var team_chart = new CanvasJS.Chart("team_chart", {
        exportEnabled: true,
        animationEnabled: true,
        axisX:{
            tickLength: 0,
            tickLength: 10,
            tickColor: "write",
        },
        axisY: {
            tickColor: "#000",
            valueFormatString:"#,##0.# '%'",
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
        data: [
            {
                type: "column",
                name: "pecent",
                showInLegend: false,
                yValueFormatString: "#,##0.# '%'",
                dataPoints: team_rate_datas,
            },
        ],
    });

    team_chart.render();

    function toggleDataSeries(e) {
        if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        } else {
            e.dataSeries.visible = true;
        }
        e.team_chart.render();
    }
    $('.canvasjs-chart-credit').addClass('hide');
    $('.canvasjs-chart-toolbar').addClass('hide');
</script>
@endsection