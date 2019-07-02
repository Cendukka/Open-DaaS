@extends('layouts.macrolocation')
@section('content')
    <div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name')
    </div>
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Inventory Receipts </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="from-date">From Date: </label>
                        <input type="date" class="form-control datepicker-autoclose" id="from-date" name="from-date" value="{{date('Y-m-d', strtotime("-12 months", strtotime(date('Y-m-d'))))}}">
                    </div>
                    <div class="col-sm-6">
                        <label for="to-date">To Date: </label>
                        <input type="date" class="form-control datepicker-autoclose" id="to-date" name="to-date" value="{{date('Y-m-d')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8">
                        <label for="search">Search: </label>
                        <input type="text" class="form-controller" id="search" name="search" placeholder="Search">
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>To Location</th>
                        <th>From Type</th>
                        <th>From Name</th>
                        <th>Material</th>
                        <th>Weight (kg)</th>
                        <th>Distance (km)</th>
                        <th>EWC Code</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <form action="{{url('companies/'.$company->company_id.'/manage/receipts/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Add Receipt</button>
                </form>
            </div>
        </div>
    </div>
    @include('includes.search_script')
@endsection