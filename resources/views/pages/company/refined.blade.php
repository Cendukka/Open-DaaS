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
                        $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : date('Y-m-d');
                        $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'id';
                        $order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'asc';
                    @endphp
                    <form action={{"/companies/".$company->company_id."/sorted"}}>
                        From date:<br>
                        <input type="text" name="from_date" value={{$from_date}}><br>
                        To date:<br>
                        <input type="text" name="to_date" value={{$to_date}}><br>
                        <select name="sort_by">
                            <option value="id" {{$sort_by=='id' ? 'selected="selected"' : ''}}>ID</option>
                            <option value="date" {{$sort_by=='date' ? 'selected="selected"' : ''}}>Date</option>
                            <option value="weight" {{$sort_by=='weight' ? 'selected="selected"' : ''}}>Weight</option>
                            <option value="material" {{$sort_by=='material' ? 'selected="selected"' : ''}}>Material</option>
                            <option value="user" {{$sort_by=='user' ? 'selected="selected"' : ''}}>User</option>
                        </select>
                        <select name="order_by">
                            <option value="asc" {{$order_by=='asc' ? 'selected="selected"' : ''}}>Ascending</option>
                            <option value="desc" {{$order_by=='desc' ? 'selected="selected"' : ''}}>Descending</option>
                        </select><br>
                        <input type="submit" value="Tarkenna Hakua">
                    </form>
                    <table>
                        <tr>
                            <th>Location ID</th>
                            <th>Date</th>
                            <th>Weight (KG)</th>
                            <th>Material</th>
                            <th>User ID</th>
                        </tr>
                        @php
                            $microlocations = DB::table('microlocations')
                                                ->where('microlocation_company_id','=',$company->company_id)
                                                ->get();

                            $microlocation_ids = [];
                            foreach ($microlocations as $microlocation){
                                array_push($microlocation_ids, $microlocation->microlocation_id);
                            }

                            $sort_by = ($sort_by == 'id' ? 'inventory_receipt.receipt_to_microlocation_id' : (
                                        $sort_by == 'date' ? 'pre_sorting.pre_sorting_date' : (
                                        $sort_by == 'weight' ? 'pre_sorting.pre_sorting_weight' : (
                                        $sort_by == 'material' ? 'presorted_material.presorted_material_name' : 'pre_sorting.pre_sorting_user_id'
                                        ))));

                            $inventory = DB::table('refined_sorting')
                                        ->join('inventory_receipt','refined_sorting.refined_receipt_id','=','inventory_receipt.receipt_id')
                                        ->join('material_names','refined_sorting.refined_material_id','=','material_names.material_id')
                                        ->whereIn('inventory_receipt.receipt_to_microlocation_id', $microlocation_ids)
                                        ->whereBetween('receipt_date', [$from_date, $to_date])
                                        ->orderBy($sort_by,$order_by)
                                        ->get();
                        @endphp
                        @foreach ($inventory as $inv_item)
                            <tr>
                                <td>{{title_case($inv_item->receipt_to_microlocation_id)}}</td>
                                <td>{{title_case($inv_item->refined_date)}}</td>
                                <td>{{title_case($inv_item->refined_weight)}}</td>
                                <td>{{title_case($inv_item->material_name)}}</td>
                                <td>{{title_case($inv_item->refined_user_id)}}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection