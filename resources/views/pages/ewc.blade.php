@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <table>
                        <tr>
                            <th>EWC Code</th>
                            <th>Description</th>
                        </tr>
                        @foreach ($allEwc as $ewc)
                            <tr>
                                <td>{{title_case($ewc->ewc_code)}}</td>
                                <td>{{title_case($ewc->description)}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection