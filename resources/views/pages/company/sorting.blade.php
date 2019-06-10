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
                        $location = isset($_GET['location']) ? $_GET['location'] : '';
                        $from_date = isset($_GET['from_date']) ? date("Y-m-d", strtotime($_GET['from_date'])) : date('Y-m-d', strtotime("-12 months", strtotime(date('Y-m-d'))));
                        $to_date = isset($_GET['to_date']) ? date("Y-m-d", strtotime($_GET['to_date'])) : date('Y-m-d');
                        $order_by = (isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC');

                        $get_string = 'location='.$location.'&from_date='.$from_date.'&to_date='.$to_date;

                        $sort_by = 'inventory_receipt.receipt_to_microlocation_id';

                        if(isset($_GET['sort_by'])){
                            switch ($_GET['sort_by']){
                            case 'id':
                                $sort_by = 'inventory_receipt.receipt_to_microlocation_id';
                                break;
                            case 'date':
                                $sort_by = 'pre_sorting.pre_sorting_date';
                                break;
                            case 'weight':
                                $sort_by = 'pre_sorting.pre_sorting_weight';
                                break;
                            case 'material':
                                $sort_by = 'presorted_material.presorted_material_name';
                                break;
                            case 'user':
                                $sort_by = 'users.last_name';
                            }
                        }
                    @endphp
                    <form action={{"/companies/".$company->company_id."/sorting"}}>
                        Microlocation ID:<br>
                        <input type="text" name="location" value={{$location}}><br>
                        From date:<br>
                        <input type="text" name="from_date" value={{$from_date}}><br>
                        To date:<br>
                        <input type="text" name="to_date" value={{$to_date}}>
                        <input type="submit" value="Tarkenna Hakua">
                    </form>
                    <table>
                        <tr>
                            <th><a href="?{{$get_string}}&sort_by=id&order={{$order_by == 'ASC' && $sort_by == 'inventory_receipt.receipt_to_microlocation_id' ? 'desc' : 'asc'}}">Location ID</a></th>
                            <th><a href="?{{$get_string}}&sort_by=date&order={{$order_by == 'ASC' && $sort_by == 'pre_sorting.pre_sorting_date' ? 'desc' : 'asc'}}">Date</a></th>
                            <th><a href="?{{$get_string}}&sort_by=weight&order={{$order_by == 'ASC' && $sort_by == 'pre_sorting.pre_sorting_weight' ? 'desc' : 'asc'}}">Weight (KG)</a></th>
                            <th><a href="?{{$get_string}}&sort_by=material&order={{$order_by == 'ASC' && $sort_by == 'presorted_material.presorted_material_name' ? 'desc' : 'asc'}}">Material</a></th>
                            <th><a href="?{{$get_string}}&sort_by=user&order={{$order_by == 'ASC' && $sort_by == 'users.last_name' ? 'desc' : 'asc'}}">User</a></th>
                        </tr>
                        @php
                            $microlocations = DB::table('microlocations')
                                                ->where('microlocation_company_id','=',$company->company_id)
                                                ->get();

                            $microlocation_ids = [];
                            foreach ($microlocations as $microlocation){
                                array_push($microlocation_ids, $microlocation->microlocation_id);
                            }

                            $inventory = DB::table('pre_sorting')
                                        ->join('inventory_receipt','pre_sorting.pre_sorting_receipt_id','=','inventory_receipt.receipt_id')
                                        ->join('presorted_material','pre_sorting.presorted_material_id','=','presorted_material.presorted_material_id')
                                        ->join('users','pre_sorting.pre_sorting_user_id','=','users.user_id')
                                        ->whereIn('inventory_receipt.receipt_to_microlocation_id', $microlocation_ids)
                                        ->where('pre_sorting.pre_sorting_status_id','=','2')
                                        ->when($location, function ($query, $location) {
                                            return $query->where('inventory_receipt.receipt_to_microlocation_id', '=', $location);
                                        })
                                        ->whereBetween('receipt_date', [$from_date, $to_date])
                                        ->orderBy($sort_by,$order_by)
                                        ->get();

                        @endphp
                        @foreach ($inventory as $inv_item)
                            <tr>
                                <td>{{title_case($inv_item->receipt_to_microlocation_id)}}</td>
                                <td>{{title_case($inv_item->pre_sorting_date)}}</td>
                                <td>{{title_case($inv_item->pre_sorting_weight)}}</td>
                                <td>{{title_case($inv_item->presorted_material_name)}}</td>
                                <td>{{title_case($inv_item->last_name)}} {{title_case($inv_item->first_name)}}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection