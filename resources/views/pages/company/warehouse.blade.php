@extends( 'layouts.macrolocation')
@section ('title', 'Raportit: Varasto')
@section('content')
    <div id="content2" class="row">
        <div class="panel panel-default" style="margin: 0 !important;">
            <div class="panel-heading">
                <h3>Varasto</h3>
            </div>
            <div class="panel-body">
                @php
                    $microlocations = DB::table('microlocations')
                                        ->where('microlocation_company_id','=',$company->company_id)
                                        ->get();
                    $microlocation_ids = [];
                    foreach ($microlocations as $eachMicrolocation){
                        array_push($microlocation_ids, $eachMicrolocation->microlocation_id);
                    }
                @endphp
                @if (count($microlocation_ids)>0)
                    @foreach ($microlocations as $ml)
                        <div class="col-md-4">

                            <table class="table table-bordered table-hover" style="margin-bottom: 0px;"><th style="text-align: center;">{{$ml->microlocation_name}}</th></table>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Materiaali</th>
                                        <th>Paino (kg)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (DB::table('inventory')->where('inventory_microlocation_id', $ml->microlocation_id)->join('material_names', 'inventory_material_id','=','material_id')->where('material_type', '!=', 'presorted')->orderBy('material_type','ASC')->orderBy('material_name','ASC')->get() as $material)
{{--                                        @if($material->inventory_weight != 0)--}}
                                            <tr>
                                                <td style="text-align:left;{{$material->inventory_weight < 0 ? ' color:red;' : ($material->inventory_weight == 0 ? ' color:lightgray;' : '')}}">{{$material->material_name}}</td>
                                                <td style="text-align:right;{{$material->inventory_weight < 0 ? ' color:red;' : ($material->inventory_weight == 0 ? ' color:lightgray;' : '')}}">{{$material->inventory_weight}}</td>
                                            </tr>
{{--                                        @endif--}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                @else
                    <h4>Haulla ei löytynyt microlocaatiota</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
