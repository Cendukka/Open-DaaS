
{{--Front page of the selected company--}}

@extends('layouts.macrolocation')
@section ('title', $company->company_name)
@section('content')
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Organisaation hallinnan kotisivut: {{$company->company_name}}</h3>
            </div>
            <div class="panel-body">
                <h4>Mahdollisesti yleisnäkymää organisaation toiminnasta tjms.</h4>
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <div class="row">
                    <div id="pieChartCompany"></div>
                </div>
{{--                Script for creating the piechart, used Goodle Charts--}}
                <script type="text/javascript">
                    google.charts.load('current', {packages: ['corechart', 'line']});
                    google.charts.setOnLoadCallback(drawCompanyWarehouse);

                    function drawCompanyWarehouse(){
                        var inventoryData = new google.visualization.DataTable();
                        inventoryData.addColumn('string', 'Name');
                        inventoryData.addColumn('number', 'Weight');
                        @foreach(DB::table('material_names')->whereIn('material_type',['refined','raw waste','textile'])->get() as $mat)

                        inventoryData.addRow(['{{$mat->material_name}}', {{max(0, DB::table('inventory')
                                                                            ->join('microlocations','microlocation_id','inventory_microlocation_id')
                                                                            ->where('inventory_material_id',$mat->material_id)
                                                                            ->where('microlocation_company_id',$company->company_id)
                                                                            ->sum('inventory_weight'))}}]);
                            @endforeach
                        var wholeOptions = {'title': 'Organisaatio - Varaston sisältö yhteensä: {{DB::table('inventory')
                                                                                        ->join('material_names','material_id','inventory_material_id')
                                                                                        ->join('microlocations','microlocation_id','inventory_microlocation_id')
                                                                                        ->whereIn('material_type',['textile','refined','raw waste'])
                                                                                        ->where('microlocation_company_id',$company->company_id)
                                                                                        ->sum('inventory_weight')}} Kg','is3D': true, 'width': 700, 'height': 500, 'backgroundColor': 'transparent'};
                        var wholeChart = new google.visualization.PieChart(document.getElementById('pieChartCompany'));
                        wholeChart.draw(inventoryData, wholeOptions);
                    }
                </script>
            </div>
        </div>
    </div>
@endsection
