@extends (Auth::user()->user_type_id == 3 ? 'layouts.microlocation' : 'layouts.macrolocation')
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
                                    ->join('material_names', 'inventory_material_id','=','material_id')
                                    ->where('material_type', '!=', 'presorted')
                                    ->orderBy('material_type','DESC')
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
                                        ->join('material_names', 'inventory_material_id','=','material_id')
                                        ->where('inventory.inventory_microlocation_id', $ml->microlocation_id)
                                        ->whereIn('inventory_material_id', $material_names->keys())
                                        ->orderBy('material_type','DESC')
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
                                    @if($material_names->count()>0)
                                        @foreach ($material_names->keys() as $id)
                                            <td>nil</td>
                                        @endforeach
                                    @else
                                        <td>No inventory records found.</td>
                                    @endif
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
