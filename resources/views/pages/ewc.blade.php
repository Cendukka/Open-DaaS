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
                <div class="panel-heading">
                    <h3>EWC Codes</h3>
                </div>
                 <div class="panel-body">
                     <div class="form-group">
                         <input type="text" class="form-controller" id="search" name="search">
                     </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>EWC Code</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
    @include('includes.search_script')
@endsection
@section ('title')
    EWC-Koodit
@stop
