@extends('layouts.welcomepage')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>contact lists</h3>
                </div>
                 <div class="panel-body">
                     <div class="form-group">
                         <input type="text" class="form-controller" id="search" name="search">
                     </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Address</th>
                        </tr>
                        <tr>
                            <td>Botniarosk</td>
                            <td>+358 40 594 5121</td>
                            <td></td>
                            <td> <a href="https://www.botniarosk.fi/" target="_blank">www.botniarosk.fi</a></td>
                            <td>Raatihuoneenkatu 164101 Kristiinankaupunki</td>
                        </tr>
                        <tr>
                            <td>Ekokymppi</td>
                            <td>08 636 611 </td>
                            <td>info@ekokymppi.fi</td>
                            <td> <a href="https://www.ekokymppi.fi/" target="_blank">www.ekokymppi.fi</a></td>
                            <td>Viestitie 2, 87700 Kajaani</td>
                        </tr>
                        <tr>
                            <td>Ab Ekorosk Oy</td>
                            <td> (06) 781 4500</td>
                            <td></td>
                            <td> <a href="https://www.ekorosk.fi/" target="_blank">www.ekorosk.fi</a></td>
                            <td>Launisaarentie 9068600 PIETARSAARI</td>
                        </tr>
                        <tr>
                            <td>Etelä-Karjalan Jätehuolto Oy</td>
                            <td>0108411818</td>
                            <td>asiakaspalvelu@ekjh.fi</td>
                            <td> <a href="https://www.ekjh.fi/" target="_blank">www.ekjh.fi</a></td>
                            <td>Viestitie 2, 87700 Kajaani</td>
                        </tr>
                        <tr>
                            <td>HSY</td>
                            <td>09 1561 2110</td>
                            <td></td>
                            <td> <a href="https://www.hsy.fi/" target="_blank">www.hsy.fi</a></td>
                            <td>Ilmalantori 1, 00240 Helsinki</td>
                        </tr>
                        <tr>
                            <td>Jätekukko</td>
                            <td>+358 17 368 0152 </td>
                            <td>service@jatekukko.fi</td>
                            <td> <a href="https://www.jatekukko.fi/" target="_blank">www.jatekukko.fi</a></td>
                            <td>Microkatu 1, Kuopio</td>
                        </tr>
                        <tr>
                            <td>Kiertokaari</td>
                            <td> (08) 5584 0010</td>
                            <td> jatehuolto@kiertokaari.fi</td>
                            <td> <a href="https://kiertokaari.fi/" target="_blank">kiertokaari.fi</a></td>
                            <td>Kiertokaari Oy Ruskonniityntie 1090620 Oulu</td>
                        </tr>
                        <tr>
                            <td>Kiertokapula</td>
                            <td> 075 753 0000</td>
                            <td></td>
                            <td> <a href="https://www.kiertokapula.fi/" target="_blank">www.kiertokapula.fi</a></td>
                            <td>Kiertokapula OY Vankanlähde 7, 13100 Hämeenlinna </td>
                        </tr>
                        <tr>
                            <td>Kymenlaakson Jäte Oy</td>
                            <td>(05) 744 3400</td>
                            <td></td>
                            <td> <a href="https://www.kymenlaaksonjate.fi/" target="_blank">www.kymenlaaksonjate.fi</a></td>
                            <td>Kymenlaakson Jäte Oy Ecocycle 5046860 Yellow fabric</td>
                        </tr>
                        <tr>
                            <td>Kiertokapula</td>
                            <td> 075 753 0000</td>
                            <td></td>
                            <td> <a href="" target="_blank"></a></td>
                            <td>Kiertokapula OY Vankanlähde 7, 13100 Hämeenlinna </td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
    @include('includes.search_script')
@endsection
@section ('title')
    Contact lists
@stop
