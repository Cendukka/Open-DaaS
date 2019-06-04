@extends('layouts.macrolocation')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <table>
                        <tr>
                            <th>ID</th>
                            @foreach (DB::table('textile_inventory')->distinct()->select('fraction')->get() as $fraction)
                                <th>{{title_case($fraction->fraction)}}</th>
                            @endforeach
                        </tr>
                        @php
                            # Kaikki mikrolokaaitot tässä yrityksessä
                            $microlocations = DB::table('microlocations')
                                                ->where('microlocation_company_id','=',$company->company_id)
                                                ->get();

                            # Kaikkien mikrolokaatioiden tekstiili varastot
                            $inventory = [];
                            foreach($microlocations as $microlocation){
                                array_push($inventory, $microlocation->microlocation_id =
                                    DB::table('textile_inventory')
                                        ->where('textile_inventory.textile_microlocation_id', '=', $microlocation->microlocation_id)
                                        ->orderBy('textile_inventory.textile_microlocation_id')
                                        ->orderBy('textile_inventory.fraction')
                                        ->get());
                            }
                        @endphp
                        @foreach ($inventory as $inv_item)
                            <tr>
                                <td>{{title_case($inv_item[0]->textile_microlocation_id)}}</td>
                                @foreach ($inv_item as $inv)
                                    <td>{{title_case($inv->textile_weight)}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection