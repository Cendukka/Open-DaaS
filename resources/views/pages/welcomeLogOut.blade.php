@extends('layouts.welcomepage')
@section('title', 'Etusivu')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <p>Lorem ipsum olen jotain, koitan ainakin. Täyttöä diviin, sekä turhanpäiväistä tekstiä käyttäen</p>
            </div>


                    <div class="calender">
                        @php
                        //Set default dates
                        $tdyDate = date("Y-m");

                        //Set max and min for the date input
                        $maxDateFrom = date("Y-m");
                        $minDate = date("Y-m", strtotime(date("Y")."-01"));


                        @endphp
                        <p>From: <input type="month" name="" value="{{$tdyDate}}" min="{{$minDate}}" max="{{$tdyDate}}">
                            To: <input type="month" name="" value="{{$tdyDate}}" min="{{$minDate}}" max="{{$tdyDate}}">
                        </p>

                    </div>
                    <br>
                    <div class="row">
                        <div id="piechartWhole" class="col-md-6"></div>
                        <div id="piechartFraction" class="col-md-6"></div>
                        <div id="chart_div" class="col-md-6" style="width: 900px; height: 500px"></div>
                    </div>

                    <script type="text/javascript">

                        google.charts.load('current', {packages: ['corechart', 'line']});
                        google.charts.setOnLoadCallback(drawCurveTypes);
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            {{--var inventoryData = new google.visualization.DataTable();--}}
                            {{--inventoryData.addColumn('string', 'Name');--}}
                            {{--inventoryData.addColumn('number', 'Weight');--}}
                            {{--@foreach(DB::table('issue_types')->where('issue_typename','!=','transport')->get() as $type)--}}
                            {{--    inventoryData.addRow(['{{$type->issue_typename}}', {{DB::table('inventory_issue')->where('issue_type_id',$type->issue_type_id)->join('inventory_issue_details','detail_issue_id','issue_id')->sum('detail_weight')}}]);--}}
                            {{--@endforeach--}}
                            {{--var wholeOptions = {'title': 'Koko Suomi - Lähteneet yhteensä: {{DB::table('inventory_issue')->join('issue_types','issue_types.issue_type_id','inventory_issue.issue_type_id')->join('inventory_issue_details','detail_issue_id','issue_id')->where('issue_typename','!=','transport')->sum('detail_weight')}} Kg', 'width': 600, 'height': 500, 'backgroundColor': 'transparent'};--}}
                            {{--var wholeChart = new google.visualization.ColumnChart(document.getElementById('piechartFraction'));--}}
                            {{--wholeChart.draw(inventoryData, wholeOptions);--}}

                            var inventoryData = new google.visualization.DataTable();
                            inventoryData.addColumn('string', 'Name');
                            inventoryData.addColumn('number', 'Weight');
                            @foreach(DB::table('material_names')->where('material_type','textile')->get() as $mat)
                                inventoryData.addRow(['{{$mat->material_name}}', {{DB::table('inventory')->where('inventory_material_id',$mat->material_id)->sum('inventory_weight')}}]);
                            @endforeach
                            var wholeOptions = {'title': 'Koko Suomi - Kierrätetyt yhteensä: {{DB::table('inventory')->join('material_names','material_id','inventory_material_id')->where('material_type','textile')->sum('inventory_weight')}} Kg', 'width': 600, 'height': 500, 'backgroundColor': 'transparent'};
                            var wholeChart = new google.visualization.PieChart(document.getElementById('piechartWhole'));
                            wholeChart.draw(inventoryData, wholeOptions);
                        }
                        function drawCurveTypes() {
                            var data = new google.visualization.DataTable();
                            data.addColumn('date', 'Time');
                            data.addColumn('number', 'Weight');

                            @php
                                $values = collect([]);
                                foreach(DB::table('inventory_receipt')->orderBy('receipt_date','ASC')->get() as $receipt){
                                    $date = date('Y-m', strtotime($receipt->receipt_date));
                                    if($values->has(strtotime($date))){
                                        $values->put(strtotime($date),[explode('-',$date), $values[strtotime($date)][1]+$receipt->receipt_weight]);
                                    }
                                    else{
                                        $values->put(strtotime($date),[explode('-',$date), $receipt->receipt_weight]);
                                    }
                                }
                            @endphp
                            @foreach($values as $v)
                                data.addRow([new Date(parseInt('{{$v[0][0]}}'),parseInt('{{$v[0][1]}}')), {{$v[1]}}]);
                            @endforeach

                            var options = {
                                    width: 900,
                                    height: 500,
                                    hAxis: {
                                        title: 'Time',
                                        format: 'M/yy',
                                        gridlines: {count: 15}
                                    },
                                    vAxis: {
                                        title: 'Weight',
                                        gridlines: {color: 'none'},
                                        minValue: 0
                                    },
                                    series: {
                                        1: {curveType: 'function'}
                                    }
                                };

                            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
                            chart.draw(data, options);
                        }
                    </script>

        </div>
    </div>

@endsection
