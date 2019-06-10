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
                        $orderBy = (isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC');

                        $get_string = 'location='.$location.'from_date='.$from_date.'&to_date='.$to_date;

                        $sortBy = 'inventory_receipt.receipt_to_microlocation_id';

                        if(isset($_GET['sortBy'])){
                            switch ($_GET['sortBy']){
                            case 'id':
                                $sortBy = 'inventory_receipt.receipt_to_microlocation_id';
                                break;
                            case 'date':
                                $sortBy = 'pre_sorting.pre_sorting_date';
                                break;
                            case 'weight':
                                $sortBy = 'pre_sorting.pre_sorting_weight';
                                break;
                            case 'material':
                                $sortBy = 'presorted_material.presorted_material_name';
                                break;
                            case 'user':
                                $sortBy = 'pre_sorting.pre_sorting_user_id';
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
                            <th><a href="?{{$get_string}}&sortBy=id&order={{$orderBy == 'ASC' && $sortBy == 'inventory_receipt.receipt_to_microlocation_id' ? 'desc' : 'asc'}}">Location ID</a></th>
                            <th><a href="?{{$get_string}}&sortBy=date&order={{$orderBy == 'ASC' && $sortBy == 'pre_sorting.pre_sorting_date' ? 'desc' : 'asc'}}">Date</a></th>
                            <th><a href="?{{$get_string}}&sortBy=weight&order={{$orderBy == 'ASC' && $sortBy == 'pre_sorting.pre_sorting_weight' ? 'desc' : 'asc'}}">Weight (KG)</a></th>
                            <th><a href="?{{$get_string}}&sortBy=material&order={{$orderBy == 'ASC' && $sortBy == 'presorted_material.presorted_material_name' ? 'desc' : 'asc'}}">Material</a></th>
                            <th><a href="?{{$get_string}}&sortBy=user&order={{$orderBy == 'ASC' && $sortBy == 'pre_sorting.pre_sorting_user_id' ? 'desc' : 'asc'}}">User ID</a></th>
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
                                        ->whereIn('inventory_receipt.receipt_to_microlocation_id', $microlocation_ids)
                                        ->where('pre_sorting.pre_sorting_status_id','=','2')
                                        ->when($location, function ($query, $location) {
                                            return $query->where('inventory_receipt.receipt_to_microlocation_id', '=', $location);
                                        })
                                        ->whereBetween('receipt_date', [$from_date, $to_date])
                                        ->orderBy($sortBy,$orderBy)
                                        ->get();

                        @endphp
                        @foreach ($inventory as $inv_item)
                            <tr>
                                <td>{{title_case($inv_item->receipt_to_microlocation_id)}}</td>
                                <td>{{title_case($inv_item->pre_sorting_date)}}</td>
                                <td>{{title_case($inv_item->pre_sorting_weight)}}</td>
                                <td>{{title_case($inv_item->presorted_material_name)}}</td>
                                <td>{{title_case($inv_item->pre_sorting_user_id)}}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection