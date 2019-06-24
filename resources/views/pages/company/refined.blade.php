@extends('layouts.macrolocation')
@section('content')
    <!--<div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name')
        </div>-->
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Refined Sorting </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="from-date">From Date: </label>
                        <input type="date" class="form-control datepicker-autoclose" id="from-date" name="from-date" value="{{date('Y-m-d', strtotime("-12 months", strtotime(date('Y-m-d'))))}}">
                    </div>
                    <div class="col-sm-6">
                        <label for="to-date">To Date: </label>
                        <input type="date" class="form-control datepicker-autoclose" id="to-date" name="to-date" value="{{date('Y-m-d')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-8">
                        <label for="search">Search: </label>
                        <input type="text" class="form-controller" id="search" name="search" placeholder="Search">
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Location</th>
                        <th>Date</th>
                        <th>Weight</th>
                        <th>Material</th>
                        <th>User</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
{{--                @php--}}
{{--                    # Read and verify $_GET values (filters)--}}
{{--                    $location = isset($_GET['location']) ? $_GET['location'] : '';--}}
{{--                    $from_date = isset($_GET['from_date']) ? date("Y-m-d", strtotime($_GET['from_date'])) : date('Y-m-d', strtotime("-12 months", strtotime(date('Y-m-d'))));--}}
{{--                    $to_date = isset($_GET['to_date']) ? date("Y-m-d", strtotime($_GET['to_date'])) : date('Y-m-d');--}}
{{--                    $order_by = (isset($_GET['order']) && $_GET['order'] == 'desc' ? 'desc' : 'asc');--}}

{{--                    $sort_by = 0;--}}
{{--                    $sort_list = ['inventory_receipt.receipt_to_microlocation_id','refined_sorting.refined_date','refined_sorting.refined_weight','material_names.material_name','refined_sorting.refined_user_id'];--}}
{{--                    if(isset($_GET['sort_by']) && ($_GET['sort_by'] < count($sort_list)) && ($_GET['sort_by'] >= 0)){--}}
{{--                        $sort_by = $_GET['sort_by'];--}}
{{--                    }--}}

{{--                    # String to be added to links to keep filters--}}
{{--                    $get_string = 'location='.$location.'&from_date='.$from_date.'&to_date='.$to_date;--}}

{{--                    $microlocations = DB::table('microlocations')--}}
{{--                                        ->where('microlocation_company_id','=',$company->company_id)--}}
{{--                                        ->get();--}}
{{--                @endphp--}}
{{--                <form action={{"/companies/".$company->company_id."/refined"}}>--}}
{{--                    Microlocation ID:<br>--}}
{{--                    <select name="location">--}}
{{--                        <option selected="selected" value=""></option>--}}
{{--                        @foreach ($microlocations as $ml)--}}
{{--                            <option {{$ml->microlocation_id == $location ? 'selected="selected"' : ""}} value="{{$ml->microlocation_id}}">{{title_case($ml->microlocation_name)}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select><br>--}}
{{--                    From date:<br>--}}
{{--                    <input type="text" name="from_date" value={{$from_date}}><br>--}}
{{--                    To date:<br>--}}
{{--                    <input type="text" name="to_date" value={{$to_date}}>--}}
{{--                    <input type="submit" value="Tarkenna Hakua">--}}
{{--                </form>--}}
{{--                @php--}}
{{--                    $microlocation_ids = [];--}}
{{--                    foreach ($microlocations as $microlocation){--}}
{{--                        array_push($microlocation_ids, $microlocation->microlocation_id);--}}
{{--                    }--}}
{{--                    $inventory = DB::table('refined_sorting')--}}
{{--                                ->join('inventory_receipt','refined_sorting.refined_receipt_id','=','inventory_receipt.receipt_id')--}}
{{--                                ->join('material_names','refined_sorting.refined_material_id','=','material_names.material_id')--}}
{{--                                ->when($location, function ($query, $location) {--}}
{{--                                    return $query->where('inventory_receipt.receipt_to_microlocation_id', '=', $location);--}}
{{--                                })--}}
{{--                                ->whereIn('inventory_receipt.receipt_to_microlocation_id', $microlocation_ids)--}}
{{--                                ->whereBetween('refined_date', [$from_date, $to_date])--}}
{{--                                ->orderBy($sort_list[$sort_by],$order_by)--}}
{{--                                ->orderBy($sort_list[$sort_by == 0],$order_by) # Sort secondary by date if we are sorting by id, else by id.--}}
{{--                                ->orderBy($sort_list[1]) # Sort by date lastly.--}}
{{--                                ->get();--}}
{{--                @endphp--}}
{{--                @if (count($inventory)>0)--}}
{{--                    <table>--}}
{{--                        <tr>--}}
{{--                            <th><a href="?{{$get_string}}&sort_by=0&order={{$order_by == 'asc' && $sort_by == 0 ? 'desc' : 'asc'}}">Location ID</a></th>--}}
{{--                            <th><a href="?{{$get_string}}&sort_by=1&order={{$order_by == 'asc' && $sort_by == 1 ? 'desc' : 'asc'}}">Date</a></th>--}}
{{--                            <th><a href="?{{$get_string}}&sort_by=2&order={{$order_by == 'asc' && $sort_by == 2 ? 'desc' : 'asc'}}">Weight (KG)</a></th>--}}
{{--                            <th><a href="?{{$get_string}}&sort_by=3&order={{$order_by == 'asc' && $sort_by == 3 ? 'desc' : 'asc'}}">Material</a></th>--}}
{{--                            <th><a href="?{{$get_string}}&sort_by=4&order={{$order_by == 'asc' && $sort_by == 4 ? 'desc' : 'asc'}}">User ID</a></th>--}}
{{--                            <th>Material Origin</th>--}}
{{--                        </tr>--}}

{{--                        @foreach ($inventory as $inv_item)--}}
{{--                            <tr>--}}
{{--                                <td>{{title_case($inv_item->receipt_to_microlocation_id)}}</td>--}}
{{--                                <td>{{title_case($inv_item->refined_date)}}</td>--}}
{{--                                <td>{{title_case($inv_item->refined_weight)}}</td>--}}
{{--                                <td>{{title_case($inv_item->material_name)}}</td>--}}
{{--                                <td>{{title_case($inv_item->refined_user_id)}}</td>--}}
{{--                                <td>{{title_case($inv_item->pre_sorting_id ?: $inv_item->refined_receipt_id)}}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        @php--}}
{{--                            $totalWeight = 0;--}}
{{--                            foreach ($inventory as $inv_item){--}}
{{--                                $totalWeight += $inv_item->refined_weight;--}}
{{--                            }--}}
{{--                        @endphp--}}
{{--                        <tr>--}}
{{--                            <td></td>--}}
{{--                            <td>Total:</td>--}}
{{--                            <td>{{$totalWeight}}</td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                        </tr>--}}
{{--                    </table>--}}
{{--                @else--}}
{{--                    <h4>Unable to find any records</h4>--}}
{{--                @endif--}}
            </div>
        </div>
    </div>
    @include('includes.search_script')
@endsection
