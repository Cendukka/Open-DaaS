@extends('layouts.macrolocation')
@section('content')
    <div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name')
    </div>
    <div id="content" class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    @php
                        $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : date('Y-m-d', strtotime("-12 months", strtotime(date('Y-m-d'))));
                        $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : date('Y-m-d') ;
                    @endphp
                    <form action={{"/companies/".$company->company_id."/issues"}}>
                        From date:<br>
                        <input type="text" name="from_date" value={{$from_date}}><br>
                        To date:<br>
                        <input type="text" name="to_date" value={{$to_date}}>
                        <input type="submit" value="Tarkenna Hakua">
                    </form>
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
                                                ->where('microlocation_company_id','=',$company->company_id)
                                                ->get();

                            $microlocation_ids = [];
                            foreach ($microlocations as $microlocation){
                                array_push($microlocation_ids, $microlocation->microlocation_id);
                            }
                            $inventory = DB::table('inventory_issue')
                                        ->join('issue_types','inventory_issue.issue_type_id','=','issue_types.issue_type_id')
                                        ->whereIn('inventory_issue.issue_from_microlocation_id', $microlocation_ids)
                                        ->whereBetween('issue_date', [$from_date, $to_date])
                                        ->orderBy('issue_from_microlocation_id')
                                        ->orderBy('issue_date')
                                        ->get();

                        @endphp
                        @foreach ($inventory as $inv_item)
                            <tr>
                                <td>{{title_case($inv_item->issue_from_microlocation_id)}}</td>
                                <td>{{title_case($inv_item->issue_to_microlocation_id)}}</td>
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