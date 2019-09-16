<!---------------------------------------------------------------------------------------------------------
            This is the navigation page with the privilege button at the top
----------------------------------------------------------------------------------------------------------->
<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="/companies/{{$company->company_id}}">
{{--                <h4>TEKIHA TEkstiiliKIerrätyksen  HAllintajärjestelmä</h4>--}}
                <h5>Open DaaS</h5>
                <br>
                <h6>Organisaatio: {{$company->company_name}}</h6>
                @if(isset(Auth::user()->user_microlocation_id))
                    <h6>Toimipiste: {{\App\microlocation::find(Auth::user()->user_microlocation_id)->microlocation_name}}</h6>
                @endif
            </a>
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
                    @if(Auth::user()->user_type_id <= 2)
                        <li><a href="{{'/companies/'.$company->company_id.'/edit'}}">Organisaation yhteystietojen muokkaus </a></li>
                    @endif
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/microlocations'}}">Toimipisteet</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/communities'}}">Kunnat</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/users'}}">Käyttäjät</a></li>
                </ul>
                <a href="#recordSubmenu" data-toggle="collapse" aria-expanded="false">Materiaalikirjaukset</a>

                <ul class="collapse list-unstyled" id="recordSubmenu">
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/receipts/create'}}">Lisää vastaanotto</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/issues/create'}}">Lisää lähetys</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/pre/create'}}">Lisää esilajittelu</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/refined/create'}}">Lisää hienolajittelu</a></li>
                </ul>
                <a href="{{'/companies/'.$company->company_id.'/instructions'}}">Ohjeet</a>
            </li>
        </ul>
    </nav>
    <!-- Page Content Holder -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="navbar-header">
                <a href="#" id="sidebarCollapse" class="material-icons btn btn-info btn-lg logout">toggle_on</a><br><br>
                <h5>Käyttäjä: {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="navbar-nav ml-auto">
                    @if(!(Auth::user()->user_type_id=='1'))
                        <li class="nav-item p-1">
                            <a href="/companies/{{$company->company_id}}/" class="btn btn-info btn-lg logout">Organisaation Etusivu</a>
                        </li>
                    @else
                        <li class="nav-item p-1">
                            <a href="/home" class="btn btn-info btn-lg logout">Admin Etusivu</a>
                        </li>
                    @endif
                        <li class="nav-item p-1">
                            <a href="/" class="btn btn-info btn-lg logout">Julkinen sivu</a>
                        </li>
                        @guest
                            <li class="nav-item p-1">
                                <a href="{{ route('login') }}" class="btn btn-info btn-lg logout">Kirjaudu sisään</a>
                            </li>
                    @else
                        <li class="nav-item p-1">
                            <a href="{{route('logout') }}" class="btn btn-info btn-lg logout">Kirjaudu ulos</a></li>
                        </li>
                        @csrf
                    @endguest
                </ul>
            </div>
        </nav>
        <!-- Main Page Content Holder -->
        <div id="main" class="column pb-4">
            @yield('content')
        </div>
        <!-- Back To The Top Button -->
        <button onclick="topFunction()" class="btn btn-default btn-sm" id="toTop" title="Go to top"><i class="material-icons">arrow_upward</i>Ylös</button>

    </div>

</div>
