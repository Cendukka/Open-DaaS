@extends('layouts.default')
@section('content')
    <div id="content2" class="row">
        <div class="card">
            <div class="card-header">
                <h3>Materiaalit </h3>
            </div>
            <div class="card-body">
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
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr><th style="text-align: left">{{title_case($type)}}</th></tr>
                        </thead>
                        <tbody>
                        <div>
                            <ul>
                                @foreach (DB::table('material_names')->where('material_type','=',$type)->get() as $material)
                                    <tr>
                                        <td class="text-left">
                                            <a style="color: black;">{{title_case($material->material_name)}}</a>
                                            <a style="padding-left: 100px;" href="{{url('/materials/'.$material->material_id.'/edit')}}">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </ul>
                        </div>

                        </tbody>
                    </table>
                @endforeach
                <form action="{{url(url()->current().'/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Lisää materiaali</button>
                </form>
            </div>
        </div>
    </div>
@endsection
