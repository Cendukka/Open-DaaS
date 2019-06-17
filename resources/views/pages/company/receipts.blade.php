@extends('layouts.macrolocation')
@section('content')
    <div id="macrolocation_name" class="row">
        @include('includes.macrolocation_name')
    </div>
    <div id="content" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Inventory Receipts </h3>
            </div>
            <div class="panel-body">
{{--                @php--}}
{{--                    $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : date('Y-m-d', strtotime("-12 months", strtotime(date('Y-m-d'))));--}}
{{--                    $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : date('Y-m-d') ;--}}
{{--                @endphp--}}
{{--                <form action={{"/companies/".$company->company_id."/receipts"}}>--}}
{{--                    From date:<br>--}}
{{--                    <input type="text" name="from_date" value={{$from_date}}><br>--}}
{{--                    To date:<br>--}}
{{--                    <input type="text" name="to_date" value={{$to_date}}>--}}
{{--                    <input type="submit" value="Tarkenna Hakua">--}}
{{--                </form>--}}
{{--                @php--}}
{{--                    $microlocations = DB::table('microlocations')--}}
{{--                                        ->where('microlocation_company_id','=',$company->company_id)--}}
{{--                                        ->get();--}}

{{--                    $microlocation_ids = [];--}}
{{--                    foreach ($microlocations as $microlocation){--}}
{{--                        array_push($microlocation_ids, $microlocation->microlocation_id);--}}
{{--                    }--}}

{{--                    $inventory = DB::table('inventory_receipt')--}}
{{--                                ->whereIn('receipt_to_microlocation_id', $microlocation_ids)--}}
{{--                                ->whereBetween('receipt_date', [$from_date, $to_date])--}}
{{--                                ->join('material_names','receipt_material_id','=','material_id')--}}
{{--                                ->orderBy('receipt_to_microlocation_id')--}}
{{--                                ->orderBy('receipt_date')--}}
{{--                                ->get();--}}
{{--                @endphp--}}
{{--                @if (count($inventory)>0)--}}
                    <div class="form-group">
                        <input type="text" class="form-controller" id="search" name="search">
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>From ID</th>
                            <th>Date</th>
                            <th>Material</th>
                            <th>Weight (kg)</th>
                            <th>Distance (km)</th>
                            <th>EWC Code</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>


{{--                    <table>--}}
{{--                        <tr>--}}
{{--                            <th>ID</th>--}}
{{--                            <th>From ID</th>--}}
{{--                            <th>Date</th>--}}
{{--                            <th>Material</th>--}}
{{--                            <th>Weight (kg)</th>--}}
{{--                            <th>Distance (km)</th>--}}
{{--                            <th>EWC Code</th>--}}
{{--                        </tr>--}}
{{--                        @foreach ($inventory as $inv_item)--}}
{{--                            <tr>--}}
{{--                                @php--}}
{{--                                    $fromid =  ($inv_item->from_company_id ? 'Company '.$inv_item->from_company_id :--}}
{{--                                               ($inv_item->from_community_id ? 'Community '.$inv_item->from_community_id :--}}
{{--                                               ($inv_item->from_supplier_id ? 'Supplier '.$inv_item->from_supplier_id :--}}
{{--                                                'Microlocation '.$inv_item->receipt_from_microlocation_id)));--}}
{{--                                @endphp--}}
{{--                                <td>{{title_case($inv_item->receipt_to_microlocation_id)}}</td>--}}
{{--                                <td>{{$fromid}}</td>--}}
{{--                                <td>{{title_case($inv_item->receipt_date)}}</td>--}}
{{--                                <td>{{title_case($inv_item->material_name)}}</td>--}}
{{--                                <td>{{title_case($inv_item->receipt_weight)}}</td>--}}
{{--                                <td>{{title_case($inv_item->distance_km)}}</td>--}}
{{--                                <td>{{title_case($inv_item->receipt_ewc_code)}}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        @php--}}
{{--                            $totalWeight = 0;--}}
{{--                            foreach ($inventory as $inv_item){--}}
{{--                                $totalWeight += $inv_item->receipt_weight;--}}
{{--                            }--}}
{{--                        @endphp--}}
{{--                        <tr>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td>Total:</td>--}}
{{--                            <td>{{$totalWeight}}</td>--}}
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