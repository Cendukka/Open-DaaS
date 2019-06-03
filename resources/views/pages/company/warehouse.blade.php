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
                    @endphp

                    <table style="width:100%">
                        <tr>
                            <th>ID</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Weight (KG)</th>
                        </tr>
                        @php
                            $microlocations = DB::table('microlocations')
                                                ->where('company_id',$company->company_id)
                                                ->get();

                            $inventory      = DB::table('microlocations')
                                                ->where('company_id',$company->company_id)
                                                ->join('textile_inventory', 'textile_inventory.microlocation_id', '=', 'microlocations.microlocation_id')
                                                ->orderBy('textile_inventory.microlocation_id')
                                                ->get();
                            #dd($inventory);
                        @endphp
{{--                        @foreach ($microlocations as $microlocation)--}}
{{--                            <tr>--}}
{{--                                <td>{{title_case($microlocation->microlocation_id)}}</td>--}}
{{--                                <td>{{title_case($microlocation->city)}}</td>--}}
{{--                                <td>{{title_case($microlocation->street_address)}}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}

                        @foreach ($inventory as $record)
                            <tr>
                                <td>{{title_case($record->microlocation_id)}}</td>
                                <td>{{title_case($record->city)}}</td>
                                <td>{{title_case($record->fraction)}}</td>
                                <td>{{title_case($record->weight_KG)}}</td>
                            </tr>
                        @endforeach
                      {{--  @foreach ($company->microlocations as $microlocation)
                            <tr>
                                <td>{{title_case($microlocation->microlocation_id)}}</td>
                                <td>{{title_case($microlocation->city)}}</td>
                                <td>{{title_case($microlocation->street_address)}}</td>
                            </tr>
                        @endforeach--}}
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection