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
                    </div>

                    <script type="text/javascript">

                        google.charts.load('current', {'packages': ['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
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
                    </script>

        </div>
    </div>

@endsection
