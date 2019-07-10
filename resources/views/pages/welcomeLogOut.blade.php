@extends('layouts.welcomepage')
@section('title', 'Etusivu')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <p>Lorem ium dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                    voluptate
                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident,
                    sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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
                            /*****Store sum of weights of wanted categories in variables for piechartWhole*****/
                            var recycledChart = parseInt("{{(DB::table('inventory')->select('inventory_weight')->where('inventory_material_id', 'NOT LIKE', 1)->sum('inventory_weight'))}}");
                            var unrecycledChart = parseInt("{{(DB::table('inventory')->select('inventory_weight')->where('inventory_material_id', 1)->sum('inventory_weight'))}}");
                            var energyChart = parseInt("{{(DB::table('inventory_issue_details')
                                                ->select('detail_weight')
                                                ->join('inventory_issue', 'inventory_issue_details.detail_issue_id', '=', 'inventory_issue.issue_id')
                                                ->where('issue_type_id', 1)
                                                ->sum('detail_weight')
                                                )}}");
                            var reuseChart = parseInt("{{(DB::table('inventory_issue_details')
                                                ->select('detail_weight')
                                                ->join('inventory_issue', 'inventory_issue_details.detail_issue_id', '=', 'inventory_issue.issue_id')
                                                ->where('issue_type_id', "=", 2)
                                                ->orWhere('issue_type_id',"=", 3)
                                                ->sum('detail_weight')
                                                )}}");
                            /***************************************************************************/

                            /*****Store sum of weights of fractions in variables for piechartFraction*****/
                            var totalSumFractions = parseInt("{{DB::table('inventory')
                                            ->select('inventory_weight')
                                            ->where('inventory_material_id', 'NOT LIKE', 1)
                                            ->orWhere('inventory_material_id', 'NOT LIKE', 2)
                                            ->sum('inventory_weight')
                            }}") ;
                            /***************************************************************************/

                            console.log(totalSumFractions);
                            /*****First Chart*****/
                            var wholeData = new google.visualization.DataTable();
                            wholeData.addColumn('string', 'Weight in Kg');
                            wholeData.addColumn('number', 'Slices');
                            wholeData.addRows([
                                ['Kierrätetty', recycledChart],
                                ['Lajittelematon', unrecycledChart],
                                ['Energia', energyChart],
                                ['Uusiokäyttö', reuseChart]
                            ]);
                            var wholeOptions = {'title': 'Koko Suomi - Yhteensä:'+(recycledChart+unrecycledChart+energyChart+reuseChart)+' Kg', 'width': 600, 'height': 500, 'backgroundColor': 'transparent'};
                            var wholeChart = new google.visualization.PieChart(document.getElementById('piechartWhole'));
                            wholeChart.draw(wholeData, wholeOptions);
                            /**********************/

                            /*****Second Chart*****/
                            var fractionData = new google.visualization.DataTable();
                            fractionData.addColumn('string', 'Weight in Kg');
                            fractionData.addColumn('number', 'Slices');
                            fractionData.addRows([
                                ['Villa', recycledChart],
                                ['Puuvilla', unrecycledChart],
                                ['Nahka', energyChart],
                                ['Pellava', reuseChart]
                            ]);
                            var fractionOptions = {'title': 'Koko Suomi - Yhteensä:'+totalSumFractions+ ' Kg', 'width': 600, 'height': 500, 'backgroundColor': 'transparent'};
                            var fractionChart = new google.visualization.PieChart(document.getElementById('piechartFraction'));
                            fractionChart.draw(fractionData, fractionOptions);
                            /**********************/
                        }//End of drawChart() function
                    </script>

        </div>
    </div>

@endsection

<!--<!DOCTYPE html>
<html lang="en">
<head>
    <title>Big Data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
        .row.content {
            height: 1000px;
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #969696;
            height: 100%;
            text-align: center;
            color: black;

        }

        .finland-map {
            margin-top: 70px;
        }

        .elements {
            margin-left: 190px;
            box-shadow: 10px 10px 5px grey;
            border: .25px lightgrey;
            border-top-style: hidden;
            border-left-style: hidden;
            border-right-style: solid;
            border-bottom-style: solid;
            width: 77%;
            padding: 3%;
        }

        /* This is for login  */

        .login a {
            background-color: #001a48;
            width: auto;
            color: white;
            padding: 14px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            float: right;
            margin-bottom: 20px;

        }

        .col-sm-9 {

        }

        .calender {

        }

        .jumbotron {
            background-color: #ffff99;
            width: 95%;
            height: 150px;
            color: Black;
            font-size: 12px;
            padding-top: 3%;
            padding-bottom: 3%;
        }

        .menu {
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 16px;
            background-color: #E3E3E3;
            width: 114%;
            margin-left: -7%;
        }

        .page {
            background-color: white;
            height: 100%;
            color: black;
        }

        .jalos {
            box-shadow: 10px 10px 5px grey;
            background-color: white;
            padding: 10%;
            font-family: "Courier New", Courier, monospace;
            font-size: 30px;
            width: 114%;
            margin-left: -7%;
        }

        .btn {
            background-color: #485483;
            color: white;
            margin-bottom: 5%;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                text-align: center;

            }
        }


    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row content">
        <nav class="col-sm-3 sidenav">

            <div class="jalos">JALOSTUSLAITOS</div>
            <br>

            <div class="container">
                <h2>Suomi</h2>
            </div>

            <div class="finland-map">
                <img class="Responsive"
                     src="https://trello-attachments.s3.amazonaws.com/5cf4b117381b0a775d886f47/1000x2251/97da9a74ec1fd74650c8955ab34c0e1c/fi.png"
                     width="300" height="600" class="img-fluid" alt="Responsive image">
            </div>
        </nav>

        <div class="col-sm-9 page">
            <nav class="login">
                <a href="# ">KIRJAUDU SISÄÄN</a>
            </nav>

            <div class="container">
                <div class="jumbotron">
                    <p>Lorem ium dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                        ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate
                        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident,
                        sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>


            <div class="elements">

                <div class="calender">
                    <input type="date" name="" value="">
                </div>
                <br>

                <div id="piechart"></div>
                <script type="text/javascript">
                    google.charts.load('current', {'packages': ['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Materials', 'Weight in Kg'],
                            ['Kierrätysenergia', 10000],
                            ['Lajittelematon', 20000],
                            ['Energiahyötykäyttöön', 4000],
                            ['Uusioläyttö', 20000],
                        ]);
                        var options = {'title': 'Valittu alue: Turku', 'width': 750, 'height': 500};
                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                        chart.draw(data, options);
                    }
                </script>
            </div>
        </div>
    </div>
</div>

</body>
</html>-->
