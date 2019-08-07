@extends('layouts.default')
@section('title', 'EWC Koodit')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>EWC Koodit</h3>
                </div>
                 <div class="panel-body">
                     @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                     <div class="form-group">
                         <input type="text" class="form-controller" id="search" name="search">
                     </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>EWC-koodi</th>
                            <th>Kuvaus</th>
                        </tr>
                        </thead>
                        <tbody id="searchtable">
                        </tbody>
                    </table>
                    <form action="{{url(url()->current().'/create')}}">
                        <button type="submit" class="btn btn-secondary">+ Lisää EWC-koodi</button>
                    </form>
                 </div>
            </div>
        </div>
    </div>
    @include('includes.search_script')
@endsection
@section ('title')
    EWC-Koodit
@stop
