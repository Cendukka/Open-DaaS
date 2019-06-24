@extends('layouts.macrolocation')
@section('content')
    <!--<div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name')
    </div>-->
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Warehouse</h3>
            </div>
            <div class="panel-body">
                @php
                    $microlocations = DB::table('microlocations')
                                        ->where('microlocation_company_id','=',$company->company_id)
                                        ->get();
                    $microlocation_ids = [];
                    foreach ($microlocations as $microlocation){
                        array_push($microlocation_ids, $microlocation->microlocation_id);
                    }

                @endphp
                @if (count($microlocation_ids)>0)
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Microlocation Name</th>
                            @php
                                $material_names = DB::table('inventory')->distinct()
                                                    ->join('material_names', 'inventory.inventory_material_id','=','material_names.material_id')
                                                    ->whereIn('inventory.inventory_microlocation_id', $microlocation_ids)
                                                    ->select('material_names.material_id','material_names.material_name')
                                                    ->get();
                            @endphp
                            @foreach ($material_names as $material)
                                <th>{{title_case($material->material_name)}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($microlocations as $ml)
                            <tr>
                                @php
                                    $inventory = DB::table('inventory')
                                                ->join('microlocations', 'inventory.inventory_microlocation_id', '=', 'microlocations.microlocation_id')
                                                ->where('inventory.inventory_microlocation_id', $ml->microlocation_id)
                                                ->orderBy('inventory.inventory_material_id')
                                                ->get();
                                @endphp
                                @if (count($inventory)>0)
                                    <td>{{title_case($inventory[0]->microlocation_name)}}</td>
                                    @foreach ($inventory as $inv)
                                        <td>{{title_case($inv->inventory_weight)}}</td>
                                    @endforeach
                                @else
                                    <td>No records found</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>No microlocations found</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
