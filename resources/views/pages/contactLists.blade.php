@extends('layouts.welcomepage')
@section('title', 'Yhteystiedot')
@section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default" style="margin: 0 0 20px 0">
                    <div class="panel-heading" style="background: #d1dec2;">
                        <h3>Yhteystiedot</h3>
                    </div>
                </div>
            </div>
            <br>
            @php
                $companies = collect([
                    [
                    'name' => 'Botniarosk',
                    'phone' => '+358 40 594 5121',
                    'email' => '',
                    'www' => 'www.botniarosk.fi',
                    'address' => 'Raatihuoneenkatu 1, 64101',
                    'city' => 'Kristiinankaupunki',
                    ],[
                    'name' => 'Ekokymppi',
                    'phone' => '+358 08 636 611',
                    'email' => 'info@ekokymppi.fi,',
                    'www' => 'www.ekokymppi.fi',
                    'address' => 'Viestitie 2, 87700',
                    'city' => 'Kajaani',
                    ],[
                    'name' => 'Ab Ekorosk Oy',
                    'phone' => '(06) 781 4500',
                    'email' => '',
                    'www' => 'www.ekorosk.fi',
                    'address' => 'Launisaarentie 90, 68600,',
                    'city' => 'Pietasaari',
                    ],[
                    'name' => 'Etelä-Karjalan Jätehuolto Oy',
                    'phone' => '+358 10 841 1818,',
                    'email' => '',
                    'www' => 'www.ekjh.fi',
                    'address' => 'Hulkonmäentie 130, 54190',
                    'city' => 'Konnunsuo',
                    ],[
                    'name' => 'HSY',
                    'phone' => '+358 09 1561 2110',
                    'email' => '',
                    'www' => 'www.hsy.fi',
                    'address' => 'Ilmalantori 1, 00240',
                    'city' => 'Helsinki',
                    ],[
                    'name' => 'Jätekukko',
                    'phone' => '+358 17 368 0152',
                    'email' => 'asiakaspalvelu@jatekukko.fi',
                    'www' => 'www.jatekukko.fi',
                    'address' => 'Microkatu 1, 70150',
                    'city' => 'Kuopio',
                    ],[
                    'name' => 'Kiertokaari',
                    'phone' => '(08) 5584 0010',
                    'email' => 'jatehuolto@kiertokaari.fi',
                    'www' => 'kiertokaari.fi',
                    'address' => 'Ruskonniityntie 10, 90620',
                    'city' => 'Oulu',
                    ],[
                    'name' => 'Kiertokapula',
                    'phone' => '+358 075 753 0000',
                    'email' => '',
                    'www' => 'www.kiertokapula.fi',
                    'address' => 'Vankanlähde 7, 13100',
                    'city' => 'Hämeenlinna',
                    ],[
                    'name' => 'Kymenlaakson Jäte Oy',
                    'phone' => '(05) 744 3400',
                    'email' => 'asiakaspalvelu@kymenlaaksonjate.fi',
                    'www' => 'www.kymenlaaksonjate.fi',
                    'address' => 'Ekokaari 50, 46860',
                    'city' => 'Keltakangas',
                    ],[
                    'name' => 'Lakeuden Etappi',
                    'phone' => '(06) 421 4900',
                    'email' => '',
                    'www' => 'www.etappi.com',
                    'address' => 'Laskunmäentie 15, 60760',
                    'city' => 'Pojanluoma',
                    ],[
                    'name' => 'Lapin jätehuolto kuntayhtymä',
                    'phone' => '040 3511 771',
                    'email' => 'asiakaspalvelu@lapeco.fi',
                    'www' => 'www.lapeco.fi',
                    'address' => 'Piiskuntie 5 A, 99800',
                    'city' => 'Inari',
                    ],[
                    'name' => 'Loimi-Hämeen Jätehuolto',
                    'phone' => '03 424 2600',
                    'email' => 'neuvonta@lhj.fi',
                    'www' => 'www.lhj.fi',
                    'address' => 'Kiimassuontie 127, 30420',
                    'city' => 'Forssa',
                    ],[
                    'name' => 'Lounais-Suomen Jätehuolto Oy',
                    'phone' => '0200 47470',
                    'email' => 'asiakaspalvelu@lsjh.fi',
                    'www' => 'www.lsjh.fi',
                    'address' => 'Kuormakatu 17, 20380',
                    'city' => 'Turku',
                    ],[
                    'name' => 'Metsäsairila Oy',
                    'phone' => '044 722 2300',
                    'email' => 'jatehuolto@metsasairila.fi',
                    'www' => 'www.metsasairila.fi',
                    'address' => 'Metsä-Sairilantie 18, 50800',
                    'city' => 'Mikkeli',
                    ],[
                    'name' => 'Millespakka Oy',
                    'phone' => '(06) 557 8400',
                    'email' => 'toimisto@millespakka.fi',
                    'www' => 'www.millespakka.fi',
                    'address' => 'Kyyjärventie 1054, 62900',
                    'city' => 'Alajärvi',
                    ],[
                    'name' => 'Mustankorkea',
                    'phone' => '010 325 3900',
                    'email' => 'asiakaspalvelu@mustankorkea.fi',
                    'www' => 'www.mustankorkea.fi',
                    'address' => 'Ronsuntaipaleentie 204, 40500 ',
                    'city' => 'Jyväskylä',
                    ],[
                    'name' => 'Napapiirin residuum',
                    'phone' => '+358 207 120 230',
                    'email' => 'asiakaspalvelu@residuum.fi',
                    'www' => 'www.residuum.fi',
                    'address' => 'Betonitie 3, 96320',
                    'city' => 'Rovaniemi',
                    ],[
                    'name' => 'Päijät-Häme Jätehuolto',
                    'phone' => '03 871 1710',
                    'email' => 'etunimi.sukunimi@phj.fi',
                    'www' => 'www.phj.fi',
                    'address' => 'Sapelikatu 7, 15160',
                    'city' => 'Lahti',
                    ],[
                    'name' => 'Perämeren Jätehuolto',
                    'phone' => '040 710 7373',
                    'email' => 'asiakaspalvelu@pmjh.fi',
                    'www' => 'www.jakala.fi',
                    'address' => 'Kalkkimaantie 614, 95460',
                    'city' => 'Tornio',
                    ],[
                    'name' => 'Pirkanmaan jätehuolto',
                    'phone' => '(03) 240 5110',
                    'email' => '',
                    'www' => 'http://www.pjhoy.fi/',
                    'address' => 'Kelloportinkatu 1, 33100',
                    'city' => 'Tampere',
                    ],[
                    'name' => 'Porin jätehuolto',
                    'phone' => '02 621 1100',
                    'email' => '',
                    'www' => 'www.pori.fi/jateneuvonta',
                    'address' => '',
                    'city' => 'Pori',
                    ],[
                    'name' => 'Puhas',
                    'phone' => '013 318 198',
                    'email' => '',
                    'www' => 'www.puhas.fi',
                    'address' => 'Linnunlahdentie 2, building 4 A, first floor (Science Park) 80110',
                    'city' => 'Joensuu',
                    ],[
                    'name' => 'Rauman Seudun Ympäristöhuolto Oy',
                    'phone' => '02 823 2761',
                    'email' => '',
                    'www' => 'www.rsyh.fi',
                    'address' => 'Teljänkatu 10, 28130',
                    'city' => 'Pori',
                    ],[
                    'name' => "Rosk'n Roll Oy Ab",
                    'phone' => '020 637 7000',
                    'email' => 'asiakaspalvelu@rosknroll.fi',
                    'www' => 'www.rosknroll.fi',
                    'address' => 'Teollisuustie 4, 06150',
                    'city' => 'Porvoo',
                    ],[
                    'name' => 'Sammakkokangas',
                    'phone' => '044 4685 502',
                    'email' => 'info@sammakkokangas.fi',
                    'www' => 'www.sammakkokangas.fi',
                    'address' => 'Kannonkoskentie 1134, 43100',
                    'city' => 'Saarijärvi',
                    ],[
                    'name' => 'Savonlinnan Seudun Jätehuolto Oy',
                    'phone' => '040 714 3350',
                    'email' => '',
                    'www' => 'www.savonlinna.fi/jatehuolto',
                    'address' => 'Nousialantie 11, 57230',
                    'city' => 'Savonlinna',
                    ],[
                    'name' => 'Stormossen',
                    'phone' => '',
                    'email' => 'info@stormossen.fi',
                    'www' => 'www.stormossen.fi',
                    'address' => 'Stormossenintie 56 66 530',
                    'city' => 'Koivulahti',
                    ],[
                    'name' => 'Vestia',
                    'phone' => '044 726 2993',
                    'email' => 'asiakaspalvelu@vestia.fi',
                    'www' => 'www.vestia.fi',
                    'address' => 'Vestianväylä 80, 84100',
                    'city' => 'Ylivieska',
                    ],[
                    'name' => 'Yläsavon Jätehuolto',
                    'phone' => '+358 17 743 379',
                    'email' => '',
                    'www' => 'www.ylasavonjatehuolto.fi',
                    'address' => 'Kierrätyskatu 15, 74140',
                    'city' => 'Iisalmi',
                    ],
                ]);
            @endphp
            @foreach($companies->all() as $company)


{{--            Takes the Company details from above array and linked to image map of finland in welcomepageHeader.blade--}}

            <div class="col-md-4">
                    <div class="panel panel-default" style="margin: 0 0 20px 0">
                        <div class="panel-heading" style="background: #d1dec2;" id="{{$company['city']}}">{{$company['name']}}</div>
                        <div class="panel-body" style="background: #EEEEEE; height:130px">
                            Tel: {{$company['phone']}},<br>
                            @if(isset($company['email']) && $company['email'] != '')
                                {{$company['email']}}
                            @endif
                            <br>
                            <a href="https://{{$company['www']}}" target="_blank" style="color: blue" class="textMark">{{$company['www']}}</a><br>
                            {{$company['address']}},<br>
                            {{$company['city']}}<br>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
@stop
