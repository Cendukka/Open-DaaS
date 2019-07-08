@extends('layouts.macrolocation')
@section ('title', 'Raportit: Varasto')
@section('content')
    <!--<div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name')
    </div>-->
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Varasto</h3>
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
                            <th>Microlokaation nimi</th>
                            @php
                                $material_names = DB::table('inventory')
                                    ->whereIn('inventory.inventory_microlocation_id', $microlocation_ids)
                                    ->where('inventory_weight','>','0')
                                    ->join('material_names', 'inventory.inventory_material_id','=','material_names.material_id')
                                    ->whereIn('material_type', ['textile','raw waste','refined','retired'])
                                    ->orderBy('material_type','DESC')
                                    ->orderBy('material_name','ASC')
                                    ->distinct('material_name')
                                    ->pluck('material_name');
                            @endphp
                            @foreach ($material_names as $material)
                                <th>{{title_case($material)}}</th>
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
                                        ->join('material_names', 'inventory.inventory_material_id','=','material_names.material_id')
                                        ->whereIn('material_name', $material_names)
                                        ->orderBy('material_type','DESC')
                                        ->orderBy('material_name','ASC')
                                        ->get();
                                @endphp
                                @if (count($inventory)>0)
                                    <td>{{title_case($inventory[0]->microlocation_name)}}</td>
                                    @foreach ($inventory as $inv)
                                        <td>{{title_case($inv->inventory_weight)}}</td>
                                    @endforeach
                                @else
                                    <td>Haulla ei löytynyt tallenteita</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>Haulla ei löytynyt microlocaatiota</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
