@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <table style="text-align: left;">
                        <tr style="text-align: left;">
                            <th style="text-align: left;">EWC Code</th>
                            <th style="text-align: left;">Description</th>
                        </tr>
                        @foreach ($allEwc as $ewc)
                            <tr style="text-align: left;">
                                <td style="text-align: left;">{{title_case($ewc->ewc_code)}}</td>
                                <td style="text-align: left;">{{title_case($ewc->description)}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection