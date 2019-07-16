@extends('layouts.macrolocation')
@section ('title', $company->company_name)
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Yhtiön hallinnan kotisivut: {{$company->company_name}}</h3>
            </div>
            <div class="panel-body">
                    <h4>Mahdollisesti yleisnäkymää yhtiön toiminnasta tjms.</h4>
                <div class="row">
                    <div id="pieChartCompany"></div>
                </div>
                <script type="javascript">
                    google.charts.load('current', {packages: ['corechart', 'line']});
                    google.charts.setOnLoadCallback(drawCompanyWarehouse);

                    function drawCompanyWarehouse(){
                        var inventoryData = new google.visualization.DataTable();
                        inventoryData.addColumn('string', 'Name');
                        inventoryData.addColumn('number', 'Weight');
                        @foreach(DB::table('material_names')->where('material_type','textile')->get() as $mat)

                        inventoryData.addRow(['{{$mat->material_name}}', {{DB::table('inventory')->where('inventory_material_id',$mat->material_id)->sum('inventory_weight')}}]);
                            @endforeach
                        var wholeOptions = {'title': 'Yhtiö - Kierrätetyt yhteensä: {{DB::table('inventory')->join('material_names','material_id','inventory_material_id')->where('material_type','textile')->sum('inventory_weight')}} Kg', 'width': 600, 'height': 500, 'backgroundColor': 'transparent'};
                        var wholeChart = new google.visualization.PieChart(document.getElementById('pieChartCompany'));
                        wholeChart.draw(inventoryData, wholeOptions);
                    }
                </script>
{{--                    <table>--}}
{{--                        <tr>--}}
{{--                            <th>ID</th>--}}
{{--                            @php--}}
{{--                                $material_names = DB::table('inventory')->distinct()--}}
{{--                                                    ->select('material_names.material_id','material_names.material_name')--}}
{{--                                                    ->join('material_names', 'inventory.inventory_material_id','=','material_names.material_id')--}}
{{--                                                    ->get();--}}
{{--                            @endphp--}}
{{--                            @foreach ($material_names as $material)--}}
{{--                                <th>{{title_case($material->material_name)}}</th>--}}
{{--                            @endforeach--}}
{{--                        </tr>--}}
{{--                        @php--}}
{{--                            $microlocations = DB::table('microlocations')--}}
{{--                                                ->where('microlocation_company_id','=',$company->company_id)--}}
{{--                                                ->get();--}}

{{--                            $inventory = [];--}}
{{--                            foreach($microlocations as $microlocation){--}}
{{--                                array_push($inventory, $microlocation->microlocation_id =--}}
{{--                                    DB::table('inventory')--}}
{{--                                        ->where('inventory.inventory_microlocation_id', '=', $microlocation->microlocation_id)--}}
{{--                                        ->orderBy('inventory.inventory_microlocation_id')--}}
{{--                                        ->orderBy('inventory.inventory_material_id')--}}
{{--                                        ->get());--}}
{{--                            }--}}
{{--                        @endphp--}}
{{--                        @foreach ($inventory as $inv_item)--}}
{{--                            <tr>--}}
{{--                                <td>{{title_case($inv_item[0]->inventory_microlocation_id)}}</td>--}}
{{--                                @foreach ($inv_item as $inv)--}}
{{--                                    <td>{{title_case($inv->inventory_weight)}}</td>--}}
{{--                                @endforeach--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </table>--}}
                
            </div>
        </div>
    </div>
@endsection
