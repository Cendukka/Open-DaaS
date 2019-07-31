@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Hallitse microlokaatioita </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <table class="table table-bordeless table-hover">
                    <thead>
                    <tr>
                        <th>Tyyppi</th>
                        <th>Nimi</th>
                        <th>Osoite</th>
                        <th>Postinumero</th>
                        <th>Kaupunki</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $microlocations = DB::table('microlocations')
                                            ->where('microlocation_company_id','=',$company->company_id)
                                            ->join('microlocation_types', 'microlocations.microlocation_type_id', '=','microlocation_types.microlocation_type_id')
                                            ->get();

                    @endphp
                    @foreach ($microlocations as $ml)
                        <tr class="text-left">
                            <td>{{title_case($ml->microlocation_typename)}}</td>
                            <td>{{title_case($ml->microlocation_name)}}</td>
                            <td>{{title_case($ml->microlocation_street_address)}}</td>
                            <td>{{title_case($ml->microlocation_postal_code)}}</td>
                            <td>{{title_case($ml->microlocation_city)}}</td>
                            <td><a href="{{url('/companies/'.$company->company_id.'/manage/microlocations/'.$ml->microlocation_id.'/edit')}}"> <span class="glyphicon glyphicon-pencil"></span></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    <form action="{{url(url()->current().'/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Lisää microlokaatio</button>
                </form>
            </div>
        </div>
    </div>
@endsection
