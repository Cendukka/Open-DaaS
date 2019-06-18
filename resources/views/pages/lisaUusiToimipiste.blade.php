@extends('layouts.default')
@section('content')
    <div class="container">
  <h3 class="register-title" >Company registration form</h3>
  <form action="" class="form-horizontal" role="form" method="">
                <div class="form-group">
                    <label for="companyName" class="col-sm-3 control-label">Company Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="conpanyName" placeholder="Company Name" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="companyAdd" class="col-sm-3 control-label">Company street address</label>
                    <div class="col-sm-9">
                        <input type="text" id="companyAdd" placeholder="Company street address" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="companyPostalCode" class="col-sm-3 control-label">Company postal code</label>
                    <div class="col-sm-9">
                        <input  type="text" id="companyPostalCode" placeholder="Company postal code" class="form-control" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="companyCity" class="col-sm-3 control-label">Company city</label>
                    <div class="col-sm-9">
                        <input type="password" id="companyCity" placeholder="Company city" class="form-control">
                    </div>
                </div>
              
                
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
</div>
@endsection