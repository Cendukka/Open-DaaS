@extends('layouts.macrolocation')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Manage Communities </h3>
            </div>
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
                <table class="table table-bordered table-hover">
                    <thread>
                    <tr>
                        <th>City</th>
                    </tr>
                    </thread>
                    <tbody>
                    @php
                        $communities = DB::table('community')
                            ->where('community_company_id','=',$company->company_id)
                            ->select('community_id','community_city')
                            ->get();
                    @endphp
                    @foreach ($communities as $com)
                        <tr>
                            <td>{{title_case($com->community_city)}}</td>
                            <td><a href="{{url('/companies/'.$company->company_id.'/manage/communities/'.$com->community_id.'/edit')}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    <form action="{{url(url()->current().'/create')}}">
                    <button type="submit" class="btn btn-secondary">+ Add community</button>
                </form>
            </div>
        </div>
    </div>
@endsection