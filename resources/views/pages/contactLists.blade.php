@extends('layouts.welcomepage')
@section('content')
    <!-- <div class="row">
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
                            <td>+358 10 841 1818</td>
                            <td>asiakaspalvelu@ekjh.fi</td>
                            <td> <a href="https://www.ekjh.fi/" target="_blank">www.ekjh.fi</a></td>
                            <td>Hulkonmäentie 130, 54190 Konnunsuo</td>
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
                            <td>Ekokaari 5046860 Keltakangas</td>
                        </tr>
                        <tr>
                            <td>Lakeuden Etappi</td>
                            <td>(06) 421 4900</td>
                            <td></td>
                            <td> <a href="https://www.etappi.com/fi" target="_blank">www.etappi.com</a></td>
                            <td>Laskunmäentie 15 FI-60760 Pojanluoma</td>
                        </tr>
                        <tr>
                            <td>Lapin jätehuolto kuntayhtymä</td>
                            <td>040 3511 771</td>
                            <td>asiakaspalvelu@lapeco.fi</td>
                            <td> <a href="https://lapeco.fi/" target="_blank">www.lapeco.fi</a></td>
                            <td>Inari </td>
                        </tr>
                        <tr>
                            <td>Loimi-Hämeen Jätehuolto</td>
                            <td>0440 242 700</td>
                            <td>info@lhj.fi</td>
                            <td> <a href="http://www.lhj.fi/" target="_blank">www.lhj.fi</a></td>
                            <td>Kiimassuontie 127, 30420 Forssa </td>
                        </tr>
                        <tr>
                            <td>Loimi-Hämeen Jätehuolto</td>
                            <td>0200 47470</td>
                            <td>asiakaspalvelu@lsjh.fi</td>
                            <td> <a href="https://www.lsjh.fi" target="_blank">www.lsjh.fi</a></td>
                            <td>Kuormakatu 17, 20380 Turku</td>
                        </tr>
                        <tr>
                            <td>Metsäsairila Oy </td>
                            <td>044 722 2300</td>
                            <td>jatehuolto@metsasairila.fi</td>
                            <td> <a href="https://www.metsasairila.fi/" target="_blank">www.metsasairila.fi</a></td>
                            <td>Metsä-Sairilantie 18, 50800 Mikkeli </td>
                        </tr>
                        <tr>
                            <td>Millespakka Oy </td>
                            <td>(06) 557 8400</td>
                            <td>toimisto@millespakka.fi</td>
                            <td> <a href="https://www.millespakka.fi/" target="_blank">www.millespakka.fi</a></td>
                            <td>Kyyjärventie 1054 62900 Alajärvi</td>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div> -->
    
    <div class="container-flex" >
       <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">hfghfghcvgcfg</div>
                    <div class="panel-body">Content here -- div with no footer</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">hfghfghcvgcfg</div>
                    <div class="panel-body">Content here -- div with no footer</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">hfghfghcvgcfg</div>
                    <div class="panel-body">Content here -- div with no footer</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">hfghfghcvgcfg</div>
                    <div class="panel-body">Content here -- div with no footer</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">hfghfghcvgcfg</div>
                    <div class="panel-body">Content here -- div with no footer</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">hfghfghcvgcfg</div>
                    <div class="panel-body">Content here -- div with no footer</div>
                </div>
            </div>
        </div>
    </div>
    

    @include('includes.search_script')
@endsection
@section ('title')
    Contact lists
@stop
