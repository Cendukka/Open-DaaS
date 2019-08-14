@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Toimipisteet')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Hallitse toimipisteitä </h3>
            </div>
            <div class="panel-body p-4">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                <table class="table table-light table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Tyyppi</th>
                        <th>Nimi</th>
                        <th>Osoite</th>
                        <th>Postinumero</th>
                        <th>Kaupunki</th>
                        <th></th>
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
                        <tr class="text-left" style="{{$ml->is_disabled ? 'color:lightgray;' : ''}}">
                            <td>{{title_case($ml->microlocation_typename)}}</td>
                            <td>{{title_case($ml->microlocation_name)}}</td>
                            <td>{{title_case($ml->microlocation_street_address)}}</td>
                            <td>{{title_case($ml->microlocation_postal_code)}}</td>
                            <td>{{title_case($ml->microlocation_city)}}</td>
                            @if(Auth::user()->user_type_id <= 2)
                                <td><a href="{{url('/companies/'.$company->company_id.'/manage/microlocations/'.$ml->microlocation_id.'/edit')}}"> <i class="material-icons">edit</i></a></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if(Auth::user()->user_type_id <= 2)
                    <form action="{{url(url()->current().'/create')}}">
                        <button type="submit" class="btn btn-secondary">+ Lisää toimipiste</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
