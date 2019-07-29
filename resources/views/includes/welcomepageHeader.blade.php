<div class="wrapper">

    <!-- Sidebar Holder -->
    <nav id="sidebar">

        <div class="sidebar-header">
            <a href="/"><h4>TEHA TEkstiilikierrätyksen HAllintajärjestelmä</h4></a>
        </div>

        <div class="finland-map">
            <h4 class="form-text-align-padd">Suomen jätelaitokset ja niiden sijainnit</h4>
            <img class="Responsive"
                 src="https://trello-attachments.s3.amazonaws.com/5cf4b117381b0a775d886f47/1000x2251/97da9a74ec1fd74650c8955ab34c0e1c/fi.png"
                 width="250" height="563" class="img-fluid" alt="Responsive image">
        </div>

                {{--<ul class="list-unstyled CTAs">
                    <li><a href="/" class="back">Back</a></li>
                </ul>--}}

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
                </div>


                <div class="navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav navbar-right">
                        <a id="contact" href="/contactLists"  class="btn btn-info btn-lg logout">Yhteystiedot</a>
                        <a id="home"    href="/" class="btn btn-info btn-lg logout" style="display: none;">Takaisin etusivulle</a>
                            <script type="text/javascript">

                                    if (window.location.href === "{{route('ContactList')}}") {
                                    document.getElementById("contact").style.display = "none";
                                    document.getElementById("home").style.display = "";
                                    }
                            </script>


                <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">


                            <a id="contact" href="/contactLists"  class="btn btn-info btn-lg logout" >Yhteystiedot</a>
                            <a id="home"    href="/" class="btn btn-info btn-lg logout" style="display: none">Etusivu</a>
                                <script type="text/javascript">
                                    {
                                        if (window.location.href === "http://127.0.0.1:8000/contactLists") {
                                        document.getElementById("contact").style.display = "none";
                                        document.getElementById("home").style.display = "";
                                        }

                                     }
                                </script>



                        @guest
                            <a href="{{ route('login') }}" class="btn btn-info btn-lg logout">Kirjaudu sisään</a>

                        <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->


                        @else
                            @if(Auth::user()->user_type_id == 1)

                                <a href="/home" class="btn btn-info btn-lg logout">Hallinta</a>
                            @elseif(Auth::user()->user_type_id == 2)
                                <a href="/companies/{{Auth::user()->user_company_id}}" class="btn btn-info btn-lg logout">Hallinta</a>
                            @elseif(Auth::user()->user_type_id == 3)
                                <a href="/companies/{{Auth::user()->user_company_id}}/manage/microlocations/{{Auth::user()->user_microlocation_id}}" class="btn btn-info btn-lg logout">Hallinta</a>

                                <a href="/home" class="btn btn-info btn-lg logout" >Hallinta</a>
                            @elseif(Auth::user()->user_type_id == 2)
                                <a href="/companies/{{Auth::user()->user_company_id}}" class="btn btn-info btn-lg logout" >Hallinta</a>
                            @elseif(Auth::user()->user_type_id == 3)
                                <a href="/companies/{{Auth::user()->user_company_id}}/manage/microlocations/{{Auth::user()->user_microlocation_id}}" class="btn btn-info btn-lg logout" >Hallinta</a>

                            @endif

                            <a href="{{route('logout') }}" class="btn btn-info btn-lg logout">Kirjaudu ulos</a>
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
