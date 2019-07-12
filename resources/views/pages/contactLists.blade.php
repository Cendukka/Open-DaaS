@extends('layouts.welcomepage')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>contact lists</h3>
                </div>
                 <div class="panel-body">
                     <div class="form-group">
                         <input type="text" class="form-controller" id="search" name="search">
                     </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Address</th>
                        </tr>
                        <tr>
                            <td>Jupiter</td>
                            <td>1999</td>
                            <td>gmail@yahoo.com</td>
                            <td> <a href="http://www.turkuamk.fi" target="_blank"> turkuamk.fi </a></td>
                            <td>turku</td>
                        </tr>
                        <tr>
                            <td>Mars</td>
                            <td>1999</td>
                            <td>gmail@yahoo.com</td>
                            <td></td>
                            <td>helsinki</td>
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
    Contact lists
@stop
