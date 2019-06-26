@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Manage Microlocations </h3>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <table class="table table-bordered table-hover">
                    <thread>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Postcode</th>
                        <th>City</th>
                    </tr>
                    </thread>
                    <tbody>
                    @php
                        $microlocations = DB::table('microlocations')
                                            ->where('microlocation_company_id','=',$company->company_id)
                                            ->join('microlocation_types', 'microlocations.microlocation_type_id', '=','microlocation_types.microlocation_type_id')
                                            ->get();

                    @endphp
                    @foreach ($microlocations as $ml)
                        <tr>
                            <td><a href="{{url('/companies/'.$company->company_id.'/manage/microlocations/'.$ml->microlocation_id.'/edit')}}">{{title_case($ml->microlocation_id)}}</a></td>
                            <td>{{title_case($ml->microlocation_typename)}}</td>
                            <td>{{title_case($ml->microlocation_name)}}</td>
                            <td>{{title_case($ml->microlocation_street_address)}}</td>
                            <td>{{title_case($ml->microlocation_postal_code)}}</td>
                            <td>{{title_case($ml->microlocation_city)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br>
                <a href="{{url('/companies/'.$company->company_id.'/manage/microlocations/create')}}">+ Add microlocation</a>
            </div>
        </div>
    </div>
@endsection
