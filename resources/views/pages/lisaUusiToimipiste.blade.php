@extends('layouts.default')
@section('content')
<div class="container">

  <div> <h3 class="title" >IS THIS FILE EVEN BEING USED ANYWHERE?</h3> </div>


  <div class="form-horizontal" >
        @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
            <form method="post" action="company-store">
                @csrf
            <div class="form-group">
                <label for="companyName" class="col-sm-3 control-label">Company Name</label>
                <div class="col-sm-9">
                    <input type="text" name="name" placeholder="Company Name" class="form-control" autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="companyAdd" class="col-sm-3 control-label">Company street address</label>
                <div class="col-sm-9">
                    <input type="text" name="address" placeholder="Company street address" class="form-control" autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="companyPostalCode" class="col-sm-3 control-label">Company postal code</label>
                <div class="col-sm-9">
                    <input  type="text" name="postal_code" placeholder="Company postal code" class="form-control" >
                </div>
            </div>

            <div class="form-group">
                <label for="companyCity" class="col-sm-3 control-label">Company city</label>
                <div class="col-sm-9">
                    <input type="password" name="city" placeholder="Company city" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
        </div>
    </div>


@endsection