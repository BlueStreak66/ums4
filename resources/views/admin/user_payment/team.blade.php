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
                                            <td style="color:blue"><b>{{ $key + 1 }}</b></td>   
                                            <td style="color:blue"><b>{{ $team->team_name }}</b></td>
                                            <td style="color:blue"><b>{{ $team->all_amount }}</b></td>
                                            <td style="color:blue"><b>{{ $team->team_plan }}</b></td>
                                            <td style="color:blue"><b>{{ round($team->team_rate) }}{{ " " }}%</b></td>
                                        @elseif ( $team_rate < 30)
                                            <td style="color:red"><b>{{ $key + 1 }}</b></td>   
                                            <td style="color:red"><b>{{ $team->team_name }}</b></td>
                                            <td style="color:red"><b>{{ $team->all_amount }}</b></td>
                                            <td style="color:red"><b>{{ $team->team_plan }}</b></td>
                                            <td style="color:red"><b>{{ round($team->team_rate) }}{{ " " }}%</b></td>
                                        @else
                                            <td><b>{{ $key + 1 }}</b></td>   
                                            <td><b>{{ $team->team_name }}</b></td>
                                            <td><b>{{ $team->all_amount }}</b></td>
                                            <td><b>{{ $team->team_plan }}</b></td>
                                            <td><b>{{ round($team->team_rate) }}{{ " " }}%</b></td>
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
        <!-- <div class="chart-responsive col-sm-offset-3 col-sm-2">
            <canvas id="chart"></canvas>
        </div> -->
    </div>
@stop
<script>    
    var team_history = <?php echo json_encode($sum_history) ?>;
</script>
@section('javascript') 
<script>
    $('#team_table').dataTable({
        scrollCollapse : true,
        scrollY: 480,
        dom : 'lrtip',
        aLengthMenu: [
            [10, 25, 50, 100, 200, -1],
            [10, 25, 50, 100, 200, "All"]
        ],
        iDisplayLength: 10
    });
</script>
@endsection