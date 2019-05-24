@extends('layouts.default')
@section('title', 'Location')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <table style="width:100%">
                        <tr>
                            <th>ID</th>
                            <th>City</th>
                            <th>Address</th>
                        </tr>
                        @foreach ($allMicrolocations as $microlocation)
                            <tr>

                                <td>{{title_case($microlocation->ID)}}</td>
                                <td>{{title_case($microlocation->City)}}</td>
                                <td>{{title_case($microlocation->Street_address)}}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection