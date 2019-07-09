@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>contact person</h3>
                </div>
                 <div class="panel-body">
                     <div class="form-group">
                         <input type="text" class="form-controller" id="search" name="search">
                     </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Address</th>
                        </tr>
                        <tr>
                            <td>Jical Mackson</td>
                            <td>1999</td>
                            <td>gmail@yahoo.com</td>
                            <td>bent street</td>
                        </tr>
                        <tr>
                            <td>Jical Mackson</td>
                            <td>1999</td>
                            <td>gmail@yahoo.com</td>
                            <td>bent street</td>
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
