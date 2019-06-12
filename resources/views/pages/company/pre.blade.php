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
                        # Read and verify $_GET values (filters)
                        $location = isset($_GET['location']) ? $_GET['location'] : '';
                        $from_date = isset($_GET['from_date']) ? date("Y-m-d", strtotime($_GET['from_date'])) : date('Y-m-d', strtotime("-12 months", strtotime(date('Y-m-d'))));
                        $to_date = isset($_GET['to_date']) ? date("Y-m-d", strtotime($_GET['to_date'])) : date('Y-m-d');
                        $order_by = (isset($_GET['order']) && $_GET['order'] == 'desc' ? 'desc' : 'asc');

                        $sort_by = 0;
                        $sort_list = ['inventory_receipt.receipt_to_microlocation_id','pre_sorting.pre_sorting_date','pre_sorting.pre_sorting_weight','presorted_material.presorted_material_name','users.last_name'];
                        if(isset($_GET['sort_by']) && ($_GET['sort_by'] < count($sort_list)) && ($_GET['sort_by'] >= 0)){
                            $sort_by = $_GET['sort_by'];
                        }

                        # String to be added to links to keep filters
                        $get_string = 'location='.$location.'&from_date='.$from_date.'&to_date='.$to_date;

                        $microlocations = DB::table('microlocations')
                                            ->where('microlocation_company_id','=',$company->company_id)
                                            ->get();
                    @endphp

                    <form action={{"/companies/".$company->company_id."/pre"}}>
                        Microlocation ID:<br>
                        <select name="location">
                            <option selected="selected" value=""></option>
                            @foreach ($microlocations as $ml)
                                <option {{$ml->microlocation_id == $location ? 'selected="selected"' : ""}} value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>
                            @endforeach
                        </select><br>
                        From date:<br>
                        <input type="text" name="from_date" value={{$from_date}}><br>
                        To date:<br>
                        <input type="text" name="to_date" value={{$to_date}}>
                        <input type="submit" value="Tarkenna Hakua">
                    </form>
                    <table>
                        <tr>
                            <th><a href="?{{$get_string}}&sort_by=0&order={{$order_by == 'asc' && $sort_by == 0 ? 'desc' : 'asc'}}">Location ID</a></th>
                            <th><a href="?{{$get_string}}&sort_by=1&order={{$order_by == 'asc' && $sort_by == 1 ? 'desc' : 'asc'}}">Date</a></th>
                            <th><a href="?{{$get_string}}&sort_by=2&order={{$order_by == 'asc' && $sort_by == 2 ? 'desc' : 'asc'}}">Weight (KG)</a></th>
                            <th><a href="?{{$get_string}}&sort_by=3&order={{$order_by == 'asc' && $sort_by == 3 ? 'desc' : 'asc'}}">Material</a></th>
                            <th><a href="?{{$get_string}}&sort_by=4&order={{$order_by == 'asc' && $sort_by == 4 ? 'desc' : 'asc'}}">User</a></th>
                            <th>Material Origin</th>
                        </tr>
                        @php
                            $microlocation_ids = [];
                            foreach ($microlocations as $microlocation){
                                array_push($microlocation_ids, $microlocation->microlocation_id);
                            }
                            $inventory = DB::table('pre_sorting')
                                        ->join('inventory_receipt','pre_sorting.pre_sorting_receipt_id','=','inventory_receipt.receipt_id')
                                        ->join('presorted_material','pre_sorting.presorted_material_id','=','presorted_material.presorted_material_id')
                                        ->join('users','pre_sorting.pre_sorting_user_id','=','users.user_id')
                                        ->whereIn('inventory_receipt.receipt_to_microlocation_id', $microlocation_ids)
                                        ->when($location, function ($query, $location) {
                                            return $query->where('inventory_receipt.receipt_to_microlocation_id', '=', $location);
                                        })
                                        ->whereBetween('pre_sorting_date', [$from_date, $to_date])
                                        ->orderBy($sort_list[$sort_by],$order_by)
                                        ->orderBy($sort_list[$sort_by == 0],$order_by) # Sort secondary by date if we are sorting by id, else by id.
                                        ->orderBy($sort_list[1]) # Sort by date lastly.
                                        ->get();

                        @endphp
                        @foreach ($inventory as $inv_item)
                            <tr>
                                <td>{{title_case($inv_item->receipt_to_microlocation_id)}}</td>
                                <td>{{title_case($inv_item->pre_sorting_date)}}</td>
                                <td>{{title_case($inv_item->pre_sorting_weight)}}</td>
                                <td>{{title_case($inv_item->presorted_material_name)}}</td>
                                <td>{{title_case($inv_item->last_name).' '.title_case($inv_item->first_name)}}</td>
                                <td>{{title_case($inv_item->receipt_id)}}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection