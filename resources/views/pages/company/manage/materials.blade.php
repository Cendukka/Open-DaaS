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
                    @foreach (DB::table('material_names')->distinct('material_type')->pluck('material_type') as $type)
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr><th>{{title_case($type)}}</th></tr>
                        </thead>
                        <tbody>
                        @foreach (DB::table('material_names')->where('material_type','=',$type)->get() as $material)
                            <tr>
                                <td><a href="{{url('/materials/'.$material->material_id.'/edit')}}">{{title_case($material->material_name)}}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endforeach
                <form action="{{url(url()->current().'/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Add Material</button>
                </form>
            </div>
        </div>
    </div>
@endsection
