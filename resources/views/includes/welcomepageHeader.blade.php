<div class="wrapper">

    <!-- Sidebar Holder -->
    <nav id="sidebar">

        <div class="sidebar-header">
{{--            <a href="/"><h4>TEHA TEkstiilikierrätyksen HAllintajärjestelmä</h4></a>--}}
            <a href="/"><h4>Open DaaS</h4></a>
        </div>

        <div class="finland-map">
            <h4 class="form-text-align-padd">Suomen jätelaitokset ja niiden sijainnit</h4>
            <img class="Responsive"
                 src="https://trello-attachments.s3.amazonaws.com/5c73a56e238a60379ca8ebe5/5cf4b117381b0a775d886f47/a05a54bfae188e35e60714f300e40978/map_of_Finland.png"
                 width="250" height="480" class="img-fluid" alt="Finland map" usemap="#location"/>
        </div>

        <map name="location" id="location">

            <area   shape="circle"
                    coords="115,455, 7"
                    title="HELSINKI" />
            <area   shape="circle"
                    coords="98,454, 7"
                    title="LOHJA" />
            <area   shape="circle"
                    coords="61,443, 7"
                    title="TURKU" />
            <area   shape="circle"
                    coords="75,424, 7"
                    title="LOIMAA" />
            <area   shape="circle"
                    coords="111,436, 7"
                    title="HYVINKÄÄ" />
            <area   shape="circle"
                    coords="133,419, 7"
                    title="LAHTI" />
            <area   shape="circle"
                    coords="158,430, 7"
                    title="KOUVOLA" />
            <area   shape="circle"
                    coords="104,418, 7"
                    title="HÄMEELINNA" />
            <area   shape="circle"
                    coords="91,396, 7"
                    title="TAMPERE" />
            <area   shape="circle"
                    coords="45,409, 7"
                    title="RAUMA" />
            <area   shape="circle"
                    coords="51,395, 7"
                    title="PORI" />
            <area   shape="circle"
                    coords="190,417, 7"
                    title="LAPPEENRANTA" />
            <area   shape="circle"
                    coords="165,386, 7"
                    title="MIKKELI" />
            <area   shape="circle"
                    coords="200,378, 7"
                    title="SAVOLINNA" />
            <area   shape="circle"
                    coords="210,342, 7"
                    title="JOENSUU" />
            <area   shape="circle"
                    coords="130,358, 7"
                    title="JYVÄSKYLÄ" />
            <area   shape="circle"
                    coords="47,356, 7"
                    title="KRISTIINAKKAUPUNKI" />
            <area   shape="circle"
                    coords="80,332, 7"
                    title="SEINÄJOKI" />
            <area   shape="circle"
                    coords="76,295, 7"
                    title="PIETARSAARI" />
            <area   shape="circle"
                    coords="97,316, 7"
                    title="ALAJÄRVI" />
            <area   shape="circle"
                    coords="124,333, 7"
                    title="SAARIJÄRVI" />
            <area   shape="circle"
                    coords="174,328, 7"
                    title="KUOPIO" />
            <area   shape="circle"
                    coords="164,293, 7"
                    title="IISALMI" />
            <area   shape="circle"
                    coords="175,265, 7"
                    title="KAJAANI" />
            <area   shape="circle"
                    coords="112,254, 7"
                    title="YLIVISKA" />
            <area   shape="circle"
                    coords="129,228, 7"
                    title="OULU" />
            <area   shape="circle"
                    coords="109,188, 7"
                    title="KEMI" />
            <area   shape="circle"
                    coords="133,157, 7"
                    title="ROVANIEMI" />
            <area   shape="circle"
                    coords="170,55, 7"
                    title="INARI" />
        </map>


    </nav>

    <!-- Page Content Holder -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a href="#" id="sidebarCollapse" class="material-icons btn btn-info btn-lg logout">toggle_on</a>
                <div class="collapse navbar-collapse " id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item p-1">
                            <a id="contact" href="/contactLists"  class="btn btn-info btn-lg logout" >Yhteystiedot</a>
                        </li>
                        <li class="nav-item p-1">
                            <a id="home" href="/" class="btn btn-info btn-lg logout" style="display: none">Etusivu</a>
                            <script type="text/javascript">
                                {
                                    var contactRootUrl = "http://"+window.location.host+"/contactLists";
                                    var loginRootUrl = "http://"+window.location.host+"/login";
                                    console.log(contactRootUrl);
                                    console.log(loginRootUrl);
                                    if (window.location.href === contactRootUrl) {
                                        document.getElementById("contact").style.display = "none";
                                        document.getElementById("home").style.display = "";
                                    }
                                    else if(window.location.href === loginRootUrl){
                                        document.getElementById("home").style.display = "";
                                    }
                                }
                            </script>
                        </li>
                            @guest
                            <li class="nav-item p-1">
                                <a href="{{ route('login') }}" class="btn btn-info btn-lg logout">Kirjaudu sisään</a>
                            </li>
                            <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->


                            @else
                                @if(Auth::user()->user_type_id == 1)
                                <li class="nav-item p-1">
                                    <a href="/home" class="btn btn-info btn-lg logout">Hallinta</a>
                                </li>
                                @elseif(Auth::user()->user_type_id >= 1)
                                <li class="nav-item p-1">
                                    <a href="/companies/{{Auth::user()->user_company_id}}" class="btn btn-info btn-lg logout">Hallinta</a>
                                </li>
                                @endif
                                    <li class="nav-item p-1">
                                <a href="{{route('logout') }}" class="btn btn-info btn-lg logout">Kirjaudu ulos</a>
                                    </li>
                                @csrf
                            @endguest
                    </ul>
                </div>
        </nav>
        <div id="main" class="column">
            @yield('content')
        </div>
    </div>
</div>
