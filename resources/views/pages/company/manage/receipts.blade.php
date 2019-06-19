@extends('layouts.macrolocation')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Manage Receipts </h3>
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
                        <th>ID</th>
                        <th>Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Distance (km)</th>
                        <th>Weight (km)</th>
                        <th>EWC Code</th>
                        <th>User ID</th>
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

                        $receipts = DB::table('inventory_receipt')
                                    ->whereIn('receipt_to_microlocation_id',$microlocation_ids)
                                    ->join('material_names', 'inventory_receipt.receipt_material_id', '=','material_names.material_id')
                                    ->orderBy('inventory_receipt.receipt_date')
                                    ->get();
                    @endphp
                    @foreach ($receipts as $receipt)
                        <tr>
                            @php
                            $fromid =  ($receipt->from_company_id ? 'Company '.$receipt->from_company_id :
                                               ($receipt->from_community_id ? 'Community '.$receipt->from_community_id :
                                               ($receipt->from_supplier_id ? 'Supplier '.$receipt->from_supplier_id :
                                                'Microlocation '.$receipt->receipt_from_microlocation_id)));
                            @endphp
                            <td><a href="{{url('/companies/'.$company->company_id.'/manage/receipts/'.$receipt->receipt_id.'/edit')}}">{{title_case($receipt->receipt_id)}}</a></td>
                            <td>{{title_case($receipt->receipt_date)}}</td>
                            <td>{{title_case($fromid)}}</td>
                            <td>{{title_case($receipt->receipt_to_microlocation_id)}}</td>
                            <td>{{title_case($receipt->distance_km)}}</td>
                            <td>{{title_case($receipt->receipt_weight)}}</td>
                            <td>{{title_case($receipt->receipt_ewc_code)}}</td>
                            <td>{{title_case($receipt->receipt_user_id)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br>
                <a href="{{url('/companies/'.$company->company_id.'/manage/receipts/create')}}">+ Add Receipt</a>
            </div>
        </div>
    </div>
@endsection
