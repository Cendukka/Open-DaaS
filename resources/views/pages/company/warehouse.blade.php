@extends('layouts.default')
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
                        </tr>
                        @php
                            $records = DB::table('microlocations')
                                        ->where('company_id',$company->company_id)
                                        ->get();
                        @endphp
                        @foreach ($records as $microlocation)
                            <tr>
                                <td>{{title_case($microlocation->microlocation_id)}}</td>
                                <td>{{title_case($microlocation->city)}}</td>
                                <td>{{title_case($microlocation->street_address)}}</td>
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