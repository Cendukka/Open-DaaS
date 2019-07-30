<!--<div class="navbar">
    <div class="navbar-inner">
        <a id="logo" href="/">{{$company->company_name}}</a>
        <ul class="nav">
            <li><a href="/companies/{{$company->company_id}}">Oma Toimipiste</a></li>
            <li><a href="/companies/{{$company->company_id}}/warehouse">Raportit</a></li>
            <li><a href="/companies/{{$company->company_id}}/manage">Hallinnoi</a></li>
            <li><a href="/ewc">EWC Codes</a></li>
        </ul>
    </div>
</div>
<br>-->
<div class="wrapper">

    <!-- Sidebar Holder -->
    <nav id="sidebar">

        <div class="sidebar-header">
            <a href="/companies/{{$company->company_id}}"><h4>TEKIHA TEkstiiliKIerrätyksen  HAllintajärjestelmä</h4><br><h5>Organisaatio: {{$company->company_name}}</h5></a>
        </div>
        <ul class="list-unstyled components">
            <li>
                <a href="{{'/companies/'.$company->company_id}}">Etusivu</a>
                <a href="{{'/companies/'.$company->company_id.'/manage/microlocations'}}">Organisaation toimipisteet</a>
                <a href="#reportsSubmenu" data-toggle="collapse" aria-expanded="false">Raportit</a>
                <ul class="collapse list-unstyled" id="reportsSubmenu">
                    <li><a href="{{'/companies/'.$company->company_id.'/warehouse'}}">    Varasto</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/receipts'}}">     Saapuneet</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/issues'}}">       Lähetetyt</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/pre'}}">          Esilajiteltu</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/refined'}}">      Hienolajiteltu</a></li>
                </ul>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Hallinnoi</a>

                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/users'}}">Käyttäjät</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/edit'}}">Organisaation yhteystietojen muokkaus </a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/microlocations'}}">Toimipisteet</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/communities'}}">Kunnat</a></li>
                </ul>
                <a href="#recordSubmenu" data-toggle="collapse" aria-expanded="false">Materiaalikirjaukset</a>

                <ul class="collapse list-unstyled" id="recordSubmenu">
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/receipts/create'}}">Lisää vastaanotto</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/issues/create'}}">Lisää lähetys</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/pre/create'}}">Lisää esilajittelu</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/refined/create'}}">Lisää hienolajittelu</a></li>



                </ul>
               {{-- <a href="/ewc">EWC Codes</a>--}}
            </li>

        </ul>


    </nav>

    <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <div class="navbar-header">

                    <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn toggle">
                        <i class="glyphicon glyphicon-align-left"></i>
                        <span>Piilota tai näytä sivupalkki</span>
                    </button>
                    <span><h4>Käyttäjä: {{ Auth::user()->first_name }}</h4></span>
                </div>

                <div class="navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">
                        @if(!(Auth::user()->user_type_id=='1'))
                            <a href="/companies/{{$company->company_id}}/" class="btn btn-info btn-lg logout">Koordinaattori Etusivu</a>
                        @else
                            <a href="/home" class="btn btn-info btn-lg logout">Admin Etusivu</a>
                        @endif
                            <a href="/" class="btn btn-info btn-lg logout">Julkinen sivu</a>
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-info btn-lg logout">Kirjaudu sisään</a>
                        @else
                            <a href="{{route('logout') }}" class="btn btn-info btn-lg logout">Kirjaudu ulos</a></li>
                            @csrf
                        @endguest
                    </ul>

                </div>

            </div>

        </nav>

        <!-- Main Page Content Holder -->
        <div id="main" class="column">
            @yield('content')
        </div>

        <!-- Back To The Top Button -->
        <button onclick="topFunction()" class="btn btn-default btn-sm" id="toTop" title="Go to top"><span class="glyphicon glyphicon-arrow-up"></span> Ylös</button>

    </div>

</div>
