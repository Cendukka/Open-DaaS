@extends('layouts.macrolocation')
@section('content')
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Manage Issues </h3>
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
                    <thead>
                    <tr>
                        <th>Issue ID</th>
                        <th>Date</th>
                        <th>Status Type</th>
                        <th>From ID</th>
                        <th>To ID</th>
                        <th>User</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $microlocations = DB::table('microlocations')
                                ->where('microlocation_company_id','=',$company->company_id)
                                ->select('microlocation_id')
                                ->orderBy('microlocation_id')
                                ->get();

                        $microlocation_ids = [];
                        foreach ($microlocations as $microlocation){
                            array_push($microlocation_ids, $microlocation->microlocation_id);
                        }

                        $issues = DB::table('inventory_issue')
                                    ->whereIn('issue_from_microlocation_id',$microlocation_ids)
                                    ->join('microlocations as from_microlocations','issue_from_microlocation_id','=','from_microlocations.microlocation_id')
                                    ->join('microlocations as to_microlocations','issue_to_microlocation_id','=','to_microlocations.microlocation_id')
                                    ->join('issue_types', 'inventory_issue.issue_type_id', '=','issue_types.issue_type_id')
                                    ->join('inventory_issue_details', 'inventory_issue.issue_id', '=','inventory_issue_details.detail_issue_id')
					                ->join('material_names','material_names.material_id','=','inventory_issue_details.detail_material_id')
					                ->join('users','users.user_id','=','inventory_issue.issue_user_id')
                                    ->orderBy('issue_date','DESC')
                                    ->select('issue_id','issue_date','from_microlocations.microlocation_name as from_microlocation','to_microlocations.microlocation_name as to_microlocation','users.username','issue_typename')
                                    ->get();
                        $lastId = 0;
                    @endphp
                    @foreach ($issues as $issue)
                        @if($issue->issue_id == $lastId)
                            @continue;
                        @endif
                        <tr>
                            <td><a href="{{url(url()->current().'/'.$issue->issue_id.'/edit')}}">{{title_case($issue->issue_id)}}</a></td>
                            <td>{{title_case(date("Y-m-d",strtotime($issue->issue_date)))}}</td>
                            <td>{{title_case($issue->issue_typename)}}</td>
                            <td>{{title_case($issue->from_microlocation)}}</td>
                            <td>{{title_case($issue->to_microlocation)}}</td>
                            <td>{{title_case($issue->username)}}</td>
                        </tr>
                        @php
                            $lastId = $issue->issue_id;
                        @endphp
                    @endforeach
                    </tbody>
                </table>
                <br>
                <a href="{{url(url()->current().'/create')}}">+ Add issue</a>
            </div>
        </div>
    </div>
@endsection