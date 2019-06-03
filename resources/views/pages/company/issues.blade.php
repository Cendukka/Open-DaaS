@extends('layouts.macrolocation')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <table>
                        <tr>
                            <th>From Location ID</th>
                            <th>To Location ID</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>Status Type</th>
                        </tr>
                        @php
                            $microlocations = DB::table('microlocations')
                                                ->where('company_id',$company->company_id)
                                                ->get();

                            $microlocation_ids = [];
                            foreach ($microlocations as $microlocation){
                                array_push($microlocation_ids, $microlocation->microlocation_id);
                            }
                            $inventory = DB::table('inventory_issue')
                                        ->join('issue_types','inventory_issue.issue_type_id','=','issue_types.issue_type_id')
                                        ->whereIn('inventory_issue.from_microlocation_id', $microlocation_ids)
                                        ->orderBy('from_microlocation_id')
                                        ->orderBy('issue_date')
                                        ->get();
                            #dd($inventory);

                        @endphp
                        @foreach ($inventory as $inv_item)
                            <tr>
                                <td>{{title_case($inv_item->from_microlocation_id)}}</td>
                                <td>{{title_case($inv_item->to_microlocation_id)}}</td>
                                <td>{{title_case($inv_item->issue_date)}}</td>
                                <td>{{title_case($inv_item->issue_user_id)}}</td>
                                <td>{{title_case($inv_item->issue_typename)}}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection