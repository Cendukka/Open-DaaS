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
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Material Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach (DB::table('material_names')->get() as $material)
                        <tr>
                            <td><a href="{{url('/materials/'.$material->material_id.'/edit')}}">{{title_case($material->material_name)}}{{($material->retired ? ' [retired]' : '')}}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <table>
                    <tr>

                    </tr>

                </table>
                    <form action="{{url(url()->current().'/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Add Material</button>
                </form>
            </div>
        </div>
    </div>
@endsection