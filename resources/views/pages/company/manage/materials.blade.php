@extends('layouts.default')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Materiaalit </h3>
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
                <table>
                    <tr>
                        <th>Materiaalin nimi</th>
                    </tr>
                    @php
                        $materials = DB::table('material_names')->get();
                    @endphp
                    @foreach ($materials as $material)
                        <tr>
                            <td><a class="textMark" href="{{url('/materials/'.$material->material_id.'/edit')}}">{{title_case($material->material_name)}}</a></td>
                        </tr>
                    @endforeach
                </table>
                <br>
                <br>
                <div> <button class="btn btn-primary"> <a href="{{url('/materials/create')}}">+ Lisää materiaali</a> </div>
            </div>
        </div>
    </div>
@endsection
