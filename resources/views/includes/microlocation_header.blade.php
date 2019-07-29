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
            <a href="/companies/{{$company->company_id}}/manage/microlocations/{{$microlocation->microlocation_id}}"><h3>JALOSTUSLAITOS</h3>{{$microlocation->microlocation_name}}</a>
        </div>
        <ul class="list-unstyled components">

            <li>

                <a href="#reportsSubmenu" data-toggle="collapse" aria-expanded="false">Raportit</a>
                <ul class="collapse list-unstyled" id="reportsSubmenu">
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/microlocation/'.$microlocation->microlocation_id.'/warehouse'}}">    Varasto</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/microlocation/'.$microlocation->microlocation_id.'/receipts'}}">     Saapuneet</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/microlocation/'.$microlocation->microlocation_id.'/issues'}}">       Lähteneet</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/microlocation/'.$microlocation->microlocation_id.'/pre'}}">          Esilajiteltu</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/microlocation/'.$microlocation->microlocation_id.'/refined'}}">      Hienolajiteltu</a></li>
                </ul>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Hallinnoi</a>

                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/receipts/create'}}">Lisää vastaanotto</a></li>
                    <li><a href="#">Lisää lähetys</a></li>
                    <li><a href="{{'/companies/'.$company->company_id.'/manage/users'}}">Käyttäjät</a></li>
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
                        <span>Piilota ja näytä sivupalkki</span>
                    </button>
                    <span><h4>Käyttäjä: {{ Auth::user()->first_name }}</h4></span>
                </div>

                <div class="navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::user()->user_type_id=='1')
                            <a href="/home" class="btn btn-info btn-lg logout">Admin Etusivu</a>
                        @elseif(Auth::user()->user_type_id=='2')
                            <a href="/companies/{{$company->company_id}}" class="btn btn-info btn-lg logout">Koordinaattori Etusivu</a>
                        @endif
                        <a href="/" class="btn btn-info btn-lg logout">Julkinen sivu</a>
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-info btn-lg logout">KIRJAUDU SISÄÄN</a>

                        <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->


                        @else

                            <a href="{{route('logout') }}" class="btn btn-info btn-lg logout">KIRJAUDU ULOS</a></li>

                        <!-- <li><a href="{{route('logout') }}">Logout</a></li> -->

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
        <button onclick="topFunction()" class="btn btn-default btn-sm" id="toTop" title="Go to top"><span class="glyphicon glyphicon-arrow-up"></span> UP</button>

    </div>

</div>
