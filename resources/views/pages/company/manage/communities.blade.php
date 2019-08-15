@extends('layouts.macrolocation')
@section('title', 'Hallinnoi: Kunnat')
@section('content')
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Kunnat </h3>
            </div>
            <div class="panel-body pb-4 pt-3">
                @includeWhen($errors->any(),'includes.forms.errors', ['errors' => $errors])
                    @php
                        $communities = DB::table('community')
                            ->where('community_company_id','=',$company->company_id)
                            ->select('community_id','community_city','is_disabled')
                            ->get();
                    @endphp
                    @if(strlen($communities) <= 2)
                        <div class="form-group row center">
                            <label>Ei kuntia löydetty.</label>
                        </div>
                    @else
                        @foreach ($communities as $com)
                        <div class="form-group row ">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-3 text-left">
                                <a style="{{$com->is_disabled ? 'color:lightgray;' : ''}}">{{title_case($com->community_city)}}</a>
                            </div>
                            @if(Auth::user()->user_type_id <= 2)
                                <div class="col-sm-1 text-left">
                                    <a href="{{url('/companies/'.$company->company_id.'/manage/communities/'.$com->community_id.'/edit')}}"><i class="material-icons">edit</i></a>
                                </div>
                            @endif
                        </div>
                        @endforeach
                    @endif

                @if(Auth::user()->user_type_id <= 2)
                    <form action="{{url(url()->current().'/create')}}">
                        <button type="submit" class="btn btn-secondary">+ Lisää kunta</button>
                    </form>
                @endif
            </div>
        </div>
@endsection
