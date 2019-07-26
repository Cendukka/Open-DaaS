@extends('layouts.default')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Materiaalit </h3>
            </div>
            <div class="panel-body" style="text-align:left;">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @foreach (DB::table('material_names')->distinct('material_type')->pluck('material_type') as $type)
                    <table class="table table-bordered table-hover" style="max-width: 300px;">
                        <thead>
                        <tr><th style="text-align: left">{{title_case($type)}}</th></tr>
                        </thead>
                        <tbody>
                        @foreach (DB::table('material_names')->where('material_type','=',$type)->get() as $material)
                            <tr>
                                <td>
                                    <a>{{title_case($material->material_name)}}</a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="{{url('/materials/'.$material->material_id.'/edit')}}"><span class="glyphicon glyphicon-pencil"></span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                @endforeach
                <form action="{{url(url()->current().'/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Lisää materiaali</button>
                </form>
            </div>
        </div>
    </div>
@endsection
