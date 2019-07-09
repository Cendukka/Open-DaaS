@extends('layouts.macrolocation')
@section('content')
    <div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name')
    </div>
    <div id="content" class="row">
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
                                $material_names = DB::table('inventory')
                                    ->whereIn('inventory.inventory_microlocation_id', $microlocation_ids)
                                    ->join('material_names', 'inventory_material_id','=','material_id')
                                    ->where('material_type', '!=', 'presorted')
                                    ->orderBy('material_id','DESC')
                                    ->pluck('material_name','material_id');
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
                                        ->whereIn('inventory_material_id', $material_names->keys())
                                        ->orderBy('inventory_material_id','DESC')
                                        ->select('microlocation_name','inventory_material_id','inventory_weight')
                                        ->get();
                                @endphp
                                @if (count($inventory)>0)
                                    <td>{{title_case($inventory->first()->microlocation_name)}}</td>
                                    @foreach ($material_names->keys() as $id)
                                        <td>{{($inventory->contains(function ($value, $key) use ($id) {return $value->inventory_material_id == $id;}) ? $inventory->keyBy('inventory_material_id')[$id]->inventory_weight : 'nil')}}</td>
                                    @endforeach
                                @else
                                    <td>{{$ml->microlocation_name}}</td>
                                    @foreach ($material_names->keys() as $id)
                                        <td>nil</td>
                                    @endforeach
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
