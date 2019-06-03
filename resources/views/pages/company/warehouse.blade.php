@extends('layouts.macrolocation')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    @php
                        #$user = DB::table('microlocations')->join('microlocation_types', 'Microlocation_type_ID', '=', 'microlocation_types.ID')->get();
                        #$user = DB::table('pre_sorting')->get();
                        #dd($user);
                        $fractions = DB::table('textile_inventory')->distinct()->select('fraction')->get();
                    @endphp

                    <table style="width:100%">
                        <tr>
                            <th>ID</th>
                            @foreach ($fractions as $fraction)
                                <th>{{title_case($fraction->fraction)}}</th>
                            @endforeach
                        </tr>
                        @php
                            $microlocations = DB::table('microlocations')
                                                ->where('company_id',$company->company_id)
                                                ->get();

                            $inventory = [];
                            foreach($microlocations as $microlocation){
                                array_push($inventory, $microlocation->microlocation_id =
                                    DB::table('textile_inventory')
                                        ->where('textile_inventory.microlocation_id', '=', $microlocation->microlocation_id)
                                        ->orderBy('textile_inventory.microlocation_id')
                                        ->orderBy('textile_inventory.fraction')
                                        ->where('textile_inventory.weight_kg','>','-1')
                                        ->get());
                            }
                        @endphp

                        @foreach ($inventory as $inv_item)
                            <tr>
                                <td>{{title_case($inv_item[0]->microlocation_id)}}</td>
                                @foreach ($inv_item as $inv)
                                    <td>{{title_case($inv->weight_KG)}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection