@extends('layouts.macrolocation')
@section('content')
    <div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name',['no_navbar' => true])
    </div>
    <div id="content" class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Postcode</th>
                            <th>City</th>
                        </tr>
                        @php
                            $microlocations = DB::table('microlocations')
                                                ->where('microlocation_company_id','=',$company->company_id)
                                                ->join('microlocation_types', 'microlocations.microlocation_type_id', '=','microlocation_types.microlocation_type_id')
                                                ->get();

                        @endphp
                        @foreach ($microlocations as $ml)
                            <tr>
                                <td><a href="microlocations/{{$ml->microlocation_id}}/edit">{{title_case($ml->microlocation_id)}}</a></td>
                                <td>{{title_case($ml->microlocation_typename)}}</td>
                                <td>{{title_case($ml->microlocation_name)}}</td>
                                <td>{{title_case($ml->microlocation_street_address)}}</td>
                                <td>{{title_case($ml->microlocation_postal_code)}}</td>
                                <td>{{title_case($ml->microlocation_city)}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <br>
                    <a href="microlocations/create">+ Add microlocation</a>
                </div>
            </div>
        </div>
    </div>
@endsection