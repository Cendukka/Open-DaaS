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
                            <td>Botniarosk </td>
                            <td>+358 40 594 5121</td>
                            <td></td>
                            <td> <a href="https://www.botniarosk.fi/" target="_blank">www.botniarosk.fi</a></td>
                            <td>Raatihuoneenkatu 1 
                                64101 Kristiinankaupunki</td>
                        </tr>
                        <tr>
                            <td>Ekokymppi</td>
                            <td>08 636 611 </td>
                            <td>info@ekokymppi.fi</td>
                            <td> <a href="https://www.ekokymppi.fi/" target="_blank">www.ekokymppi.fi</a></td>
                            <td>Viestitie 2, 87700 Kajaani</td>
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
