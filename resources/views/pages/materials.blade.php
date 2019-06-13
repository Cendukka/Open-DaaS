@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <table>
                        <tr>
                            <th>Material Name</th>
                        </tr>
                        @php
                            $materials = DB::table('material_names')->get();
                        @endphp
                        @foreach ($materials as $material)
                            <tr>
                                <td><a href="{{$material->material_id}}">{{title_case($material->material_name)}}</a></td>
                            </tr>
                        @endforeach
                    </table>
                    <br>
                    <a href="create">+ Add Material</a>
                </div>
            </div>
        </div>
    </div>
@endsection