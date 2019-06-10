@extends('layouts.macrolocation')
@section('content')
    <div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name',['no_navbar' => true])
    </div>
    <div id="content" class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Overview page for company</h4>
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
    </div>
@endsection