@extends('layouts.macrolocation')
@section('content')
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Kunnat </h3>
            </div>
            <div class="panel-body">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])


                    @php
                        $communities = DB::table('community')
                            ->where('community_company_id','=',$company->company_id)
                            ->select('community_id','community_city')
                            ->get();
                    @endphp
                    @foreach ($communities as $com)
                    <div class="form-group row ">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-3 text-left">
                            <label >{{title_case($com->community_city)}}</label>
                        </div>

                        <div class="col-sm-1 text-left">
                            <a href="{{url('/companies/'.$company->company_id.'/manage/communities/'.$com->community_id.'/edit')}}"><span class="glyphicon glyphicon-pencil"></span></a>
                        </div>
                    </div>



                    @endforeach


                    <form action="{{url(url()->current().'/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Lisää kunta</button>
                </form>
            </div>
        </div>
    </div>
@endsection
