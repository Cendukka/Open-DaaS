@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Materials </h3>
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
                        <th>Material Name</th>
                    </tr>
                    @php
                        $materials = DB::table('material_names')->get();
                    @endphp
                    @foreach ($materials as $material)
                        <tr>
                            <td><a href="{{url('/materials/'.$material->material_id.'/edit')}}">{{title_case($material->material_name)}}</a></td>
                        </tr>
                    @endforeach
                </table>
                <br>
                <a href="{{url('/materials/create')}}">+ Add Material</a>
            </div>
        </div>
    </div>
@endsection