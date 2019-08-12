@extends('layouts.default')
@section('title', 'Hallinnoi: Materiaalit')
@section('title', 'Materiaalit')
@section('content')
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Materiaalit </h3>
            </div>
            <div class="panel-body p-4" style="text-align:left;">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                @foreach (DB::table('material_names')->distinct('material_type')->pluck('material_type') as $type)
                    <table class="table table-borderless table-hover" style="max-width: 500px;">
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
                                    <a href="{{url('/materials/'.$material->material_id.'/edit')}}"><i class="material-icons">edit</i></a>
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
