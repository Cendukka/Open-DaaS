@extends('layouts.macrolocation')
@section('content')

    <div id="content2" class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Inventory Receipts </h3>
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
                            <th>To Location</th>
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
