@extends('layouts.default')
@section('content')
<div id="content2" class="row">
    <div class="panel panel-default">
        <div class="panel-heading" > <h3>Company registration form</h3> </div>

            <div class="panel-body">
            
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                             @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                      </div>
                     @endif

                <div class="form-horizontal" >
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
              
                
               <div class="col-sm-9"> <button type="submit"  class=" btn btn-primary" style="width: 32%" >Register</button> </div>
                    
            </form>
        </div>
        </div>
    </div>
</div>

@endsection