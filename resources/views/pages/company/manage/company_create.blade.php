@extends('layouts.default')
@section('content')
<div id="content2" class="row">
    <div class="panel panel-default">
        <div class="panel-heading" > <h3>Yhtiön rekisteröinti lomake</h3> </div>

            <div class="panel-body">
            
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                             @foreach ($errors->all() as $error)
                                <li STYLE="text-align:left;">{{ $error }}</li>
                            @endforeach
                            </ul>
                      </div>
                     @endif

                <div class="form-horizontal" >
                    <form method="post" action="company-store" onsubmit="return confirm('New company is being register. Would you like to proceed?');">
                    @csrf
                <div class="form-group">
                    <label for="companyName" class="col-sm-3 control-label">Yhtiön nimi</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" placeholder="Yhtiön nimi" class="form-control" autofocus>
                    </div>
                </div>
              
                <div class="form-group">
                    <label for="companyAdd" class="col-sm-3 control-label">Katuosoite</label>
                    <div class="col-sm-9">
                        <input type="text" name="address" placeholder="Katuosoite" class="form-control" autofocus>
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="companyPostalCode" class="col-sm-3 control-label">Postinumero</label>
                    <div class="col-sm-9">
                        <input  type="text" name="postal_code" placeholder="Postinumero" class="form-control" >
                    </div>
                </div>
                    
                <div class="form-group">
                    <label for="companyCity" class="col-sm-3 control-label">Kaupunki</label>
                    <div class="col-sm-9">
                        <input type="text" name="city" placeholder="Kaupunki" class="form-control">
                    </div>
                </div>
              
                
               <div class="col-sm-9"> <button type="submit"  class=" btn btn-primary" style="width: 32%" >Rekisteröi</button> </div>
                    
            </form>
        </div>
        </div>
    </div>
</div>

@endsection
