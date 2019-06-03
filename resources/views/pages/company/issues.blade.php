@extends('layouts.macrolocation')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
{{--                    <table>--}}
{{--                        <tr>--}}
{{--                            <th>Location ID</th>--}}
{{--                            <th>Date</th>--}}
{{--                            <th>Weight (KG)</th>--}}
{{--                            <th>Material</th>--}}
{{--                            <th>Status</th>--}}
{{--                        </tr>--}}
{{--                        @php--}}
{{--                            $microlocations = DB::table('microlocations')--}}
{{--                                                ->where('company_id',$company->company_id)--}}
{{--                                                ->get();--}}

{{--                            $microlocation_ids = [];--}}
{{--                            foreach ($microlocations as $microlocation){--}}
{{--                                array_push($microlocation_ids, $microlocation->microlocation_id);--}}
{{--                            }--}}
{{--                            $inventory = DB::table('pre_sorting')--}}
{{--                                        ->join('inventory_receipt','pre_sorting.pre_sorting_inventory_receipt_id','=','inventory_receipt.inventory_receipt_id')--}}
{{--                                        ->join('presorted_material','pre_sorting.presorted_material_id','=','presorted_material.presorted_material_id')--}}
{{--                                        ->whereIn('inventory_receipt.to_microlocation_id', $microlocation_ids)--}}
{{--                                        #->where('pre_sorting.status_id','=','2')--}}
{{--                                        ->orderBy('inventory_receipt.to_microlocation_id')--}}
{{--                                        ->orderBy('pre_sorting.pre_sorting_date')--}}
{{--                                        ->get();--}}
{{--                            #dd($inventory);--}}

{{--                        @endphp--}}
{{--                        @foreach ($inventory as $inv_item)--}}
{{--                            <tr>--}}
{{--                                <td>{{title_case($inv_item->to_microlocation_id)}}</td>--}}
{{--                                <td>{{title_case($inv_item->pre_sorting_date)}}</td>--}}
{{--                                <td>{{title_case($inv_item->pre_sorting_weight)}}</td>--}}
{{--                                <td>{{title_case($inv_item->presorted_material_name)}}</td>--}}
{{--                                <td>{{title_case($inv_item->pre_sorting_status_id-1)}}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </table>--}}

                </div>
            </div>
        </div>
    </div>
@endsection