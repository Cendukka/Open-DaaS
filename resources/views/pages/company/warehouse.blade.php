{{--Prints the current contents of each microlocation's inventory--}}

@extends( 'layouts.macrolocation')
@section ('title', 'Raportit: Varasto')
@section('content')
    <div>
        <div class="panel panel-default" style="margin: 0 !important;">
            <div class="panel-heading">
                <h3>Varasto</h3>
            </div>
            <div class="panel-body">
                <div class="form-group row p-3">
                @php
                //  Fetch microlocations that are under the company which the logged user works for and push the IDs into an array.
                    $microlocations = DB::table('microlocations')
                                        ->where('microlocation_company_id','=',$company->company_id)
                                        ->where('is_disabled','!=',1)
                                        ->get();
                    $microlocation_ids = [];
                    foreach ($microlocations as $eachMicrolocation){
                        array_push($microlocation_ids, $eachMicrolocation->microlocation_id);
                    }
                @endphp
{{--Loops through the microlocations ID array and prints the content of the inventory--}}
                @if (count($microlocation_ids)>0)
                        @foreach ($microlocations as $ml)
                            <div class="col-md-4">
                                <table class="table table-bordered" style="margin-bottom: 0px;"><thead class="thead-dark"><th  style="text-align: center;">{{$ml->microlocation_name}}</th></thead></table>
                                <table class="table table-light table-striped table-hover table-bordered">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>Materiaali</th>
                                        <th>Paino (kg)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach (DB::table('inventory')->where('inventory_microlocation_id', $ml->microlocation_id)->join('material_names', 'inventory_material_id','=','material_id')->where('material_type', '!=', 'presorted')->orderBy('material_type','ASC')->orderBy('material_name','ASC')->get() as $material)
                                        <tr>
                                            <td style="text-align:left;{{$material->inventory_weight < 0 ? ' color:red;' : ($material->inventory_weight == 0 ? ' color:lightgray;' : '')}}">{{$material->material_name}}</td>
                                            <td style="text-align:right;{{$material->inventory_weight < 0 ? ' color:red;' : ($material->inventory_weight == 0 ? ' color:lightgray;' : '')}}">{{$material->inventory_weight}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                @else
                    <div class="col-md-12">
                        <h4>Organisaatiolla "{{$company->company_name}}" ei ole mikrolokaatioita</h4>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection
