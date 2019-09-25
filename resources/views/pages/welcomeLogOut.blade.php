@extends('layouts.welcomepage')
@section('title', 'Etusivu')
@section('content')
    <div class="row">
        <div class="col-md-12">
{{--            public page's infoparagraph--}}
            <div class="jumbotron">
                <p></p>
            </div>
                    <br>

{{--                        piechartWhole: Chart to represent recycled sorted textiles--}}
{{--                        chart_div: Chart to visualize received receipts and issues--}}

                    <div class="row">
                        <div id="piechartWhole" class="col-md-12"></div>
                    </div>
                    <div class="row">
                        <a href="exportOpenDataMaterials" class="btn btn-info btn-sm">Lataa ja tallenna CSV-muotoon</a>
                    </div>
                    <div class="row">
                        <div id="chart_div" class="col-md-12" style="width: 900px; height: 500px"></div>
                    </div>

                    <script type="text/javascript">

                        google.charts.load('current', {packages: ['corechart', 'line']});
                        google.charts.setOnLoadCallback(drawCurveTypes);
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {

                            var inventoryData = new google.visualization.DataTable();
                            inventoryData.addColumn('string', 'Name');
                            inventoryData.addColumn('number', 'Weight');
                            @foreach(DB::table('material_names')->where('material_type','textile')->get() as $mat)
                                inventoryData.addRow(['{{$mat->material_name}}', {{max(0, DB::table('inventory')->where('inventory_material_id',$mat->material_id)->sum('inventory_weight'))}}]);
                            @endforeach
                            var wholeOptions = {'title': 'Koko Suomi - Kierrätetyt yhteensä: {{DB::table('inventory')->join('material_names','material_id','inventory_material_id')->where('material_type','textile')->sum('inventory_weight')}} Kg','is3D': true, 'width': 800, 'height': 600, 'backgroundColor': 'transparent'};
                            var wholeChart = new google.visualization.PieChart(document.getElementById('piechartWhole'));
                            wholeChart.draw(inventoryData, wholeOptions);
                        }
                        function drawCurveTypes() {
                            var data = new google.visualization.DataTable();
                            data.addColumn('date', 'Time');
                            data.addColumn('number', 'Receipts');
                            data.addColumn('number', 'Myynti');
                            data.addColumn('number', 'Hyväntekeväisyys');
                             // data.addColumn('number', 'Poltto');

                            @php
                                # value = timevalue of Y-m
                                # $values[0][0] = Year
                                # $values[0][1] = Month
                                # $values[1] = Receipt Weight
                                # $values[2] = Energiaan
                                # $values[3] = Uusiokäyttöön
                                # $values[4] = Jatkokierrätykseen

                                $values = collect([]);
                                foreach(DB::table('inventory_receipt')->orderBy('receipt_date','ASC')->select('receipt_date','receipt_weight')
                                    ->whereBetween('receipt_date', [date("Y-m-d",strtotime('-36 months')), date("Y-m-d H:i:s",strtotime('tomorrow'))])->get() as $receipt){
                                    $date = date('Y-m', strtotime($receipt->receipt_date));
                                    if($values->has(strtotime($date))){
                                        $values->put(strtotime($date),[explode('-',$date), $values[strtotime($date)][1]+$receipt->receipt_weight, 0, 0, 0]);
                                    }
                                    else{
                                        $values->put(strtotime($date),[explode('-',$date), $receipt->receipt_weight, 0, 0, 0]);
                                    }
                                }

                                $issueQuery = DB::table('inventory_issue')
                                    ->join('issue_types','inventory_issue.issue_type_id','=','issue_types.issue_type_id')
                                    ->orderBy('issue_date','ASC')
                                    ->joinSub(DB::table('inventory_issue_details')
                                    ->select('detail_issue_id',DB::raw('SUM(detail_weight) as sumweight'))
                                    ->groupBy('detail_issue_id'),'details', function ($join) {
                                        $join->on('detail_issue_id', '=', 'issue_id');
                                    })
                                    ->whereBetween('issue_date', [date("Y-m-d",strtotime('-36 months')), date("Y-m-d H:i:s",strtotime('tomorrow'))])
                                    ->select('issue_date','sumweight','issue_typename');

                                foreach((clone $issueQuery)->where('issue_typename','Myynti')->get() as $issue){
                                    $date = date('Y-m', strtotime($issue->issue_date));
                                    if($values->has(strtotime($date))){
                                        $values->put(strtotime($date),[explode('-',$date), $values[strtotime($date)][1], $values[strtotime($date)][2]+$issue->sumweight, 0, 0]);
                                    }
                                    else{
                                        $values->put(strtotime($date),[explode('-',$date), $values[strtotime($date)][1], $issue->sumweight, 0, 0]);
                                    }
                                }

                                foreach((clone $issueQuery)->where('issue_typename','Hyväntekeväisyys')->get() as $issue){
                                    $date = date('Y-m', strtotime($issue->issue_date));
                                    if($values->has(strtotime($date))){
                                        $values->put(strtotime($date),[explode('-',$date), $values[strtotime($date)][1], $values[strtotime($date)][2], $values[strtotime($date)][2]+$issue->sumweight, 0]);
                                    }
                                    else{
                                        $values->put(strtotime($date),[explode('-',$date), $values[strtotime($date)][1], $values[strtotime($date)][2], $issue->sumweight, 0]);
                                    }
                                }

                                /*foreach((clone $issueQuery)->where('issue_typename','Charity')->get() as $issue){
                                    $date = date('Y-m', strtotime($issue->issue_date));
                                    if($values->has(strtotime($date))){
                                        $values->put(strtotime($date),[explode('-',$date), $values[strtotime($date)][1], $values[strtotime($date)][2], $values[strtotime($date)][3], $values[strtotime($date)][2]+$issue->sumweight]);
                                    }
                                    else{
                                        $values->put(strtotime($date),[explode('-',$date), $values[strtotime($date)][1], $values[strtotime($date)][2], $values[strtotime($date)][3], $issue->sumweight]);
                                    }
                                }*/
                            @endphp
                            @foreach($values->sort() as $v)
                                data.addRow([new Date(parseInt('{{$v[0][0]}}'),parseInt('{{$v[0][1]}}')), {{max(0, $v[1])}}, {{max(0, $v[2])}}, {{max(0, $v[3])}}]);
                            @endforeach

                            var options = {
                                    width: 900,
                                    height: 500,
                                    backgroundColor: 'transparent',
                                    hAxis: {
                                        title: 'Aika',
                                        format: 'M/yy',
                                        gridlines: {count: 15}
                                    },
                                    vAxis: {
                                        title: 'Paino',
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
