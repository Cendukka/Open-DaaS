<div class="wrapper">

    <!-- Sidebar Holder -->
    <nav id="sidebar">

        <div class="sidebar-header">
{{--            <a href="/"><h4>TEHA TEkstiilikierrätyksen HAllintajärjestelmä</h4></a>--}}
            <a href="/"><h5>Open DaaS</h5></a>
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
                    href="/contactLists#Helsinki"
                    title="HELSINKI" />
            <area   shape="circle"
                    coords="98,454, 7"
                    href="/contactLists#Lohja"
                    title="LOHJA" />
            <area   shape="circle"
                    coords="61,443, 7"
                    href="/contactLists#Turku"
                    title="TURKU" />
            <area   shape="circle"
                    coords="75,424, 7"
                    href="/contactLists#Loimaa"
                    title="LOIMAA" />
            <area   shape="circle"
                    coords="111,436, 7"
                    href="/contactLists#Hyvinkää"
                    title="HYVINKÄÄ" />
            <area   shape="circle"
                    coords="133,419, 7"
                    href="/contactLists#Lahti"
                    title="LAHTI" />
            <area   shape="circle"
                    coords="158,430, 7"
                    href="/contactLists#Kouvola"
                    title="KOUVOLA" />
            <area   shape="circle"
                    coords="104,418, 7"
                    href="/contactLists#Hämeenlinna"
                    title="HÄMEELINNA" />
            <area   shape="circle"
                    coords="91,396, 7"
                    href="/contactLists#Tampere"
                    title="TAMPERE" />
            <area   shape="circle"
                    coords="45,409, 7"
                    href="/contactLists#Rauma"
                    title="RAUMA" />
            <area   shape="circle"
                    coords="51,395, 7"
                    href="/contactLists#Pori"
                    title="PORI" />
            <area   shape="circle"
                    coords="190,417, 7"
                    href="/contactLists#Lappeenranta"
                    title="LAPPEENRANTA" />
            <area   shape="circle"
                    coords="165,386, 7"
                    href="/contactLists#Mikkeli"
                    title="MIKKELI" />
            <area   shape="circle"
                    coords="200,378, 7"
                    href="/contactLists#Savonlinna"
                    title="SAVOLINNA" />
            <area   shape="circle"
                    coords="210,342, 7"
                    href="/contactLists#Joensuu"
                    title="JOENSUU" />
            <area   shape="circle"
                    coords="130,358, 7"
                    href="/contactLists#Jyväskylä"
                    title="JYVÄSKYLÄ" />
            <area   shape="circle"
                    coords="47,356, 7"
                    href="/contactLists#Kristiinankaupunki"
                    title="KRISTIINANKAUPUNKI" />
            <area   shape="circle"
                    coords="80,332, 7"
                    href="/contactLists#Seinäjoki"
                    title="SEINÄJOKI" />
            <area   shape="circle"
                    coords="76,295, 7"
                    href="/contactLists#Pietarsaari"
                    title="PIETARSAARI" />
            <area   shape="circle"
                    coords="97,316, 7"
                    href="/contactLists#Alajärvi"
                    title="ALAJÄRVI" />
            <area   shape="circle"
                    coords="124,333, 7"
                    href="/contactLists#Saarijärvi"
                    title="SAARIJÄRVI" />
            <area   shape="circle"
                    coords="174,328, 7"
                    href="/contactLists#Kuopio"
                    title="KUOPIO" />
            <area   shape="circle"
                    coords="164,293, 7"
                    href="/contactLists#Iisalmi"
                    title="IISALMI" />
            <area   shape="circle"
                    coords="175,265, 7"
                    href="/contactLists#Kajaani"
                    title="KAJAANI" />
            <area   shape="circle"
                    coords="112,254, 7"
                    href="/contactLists#Ylivieska"
                    title="YLIVIESKA" />
            <area   shape="circle"
                    coords="129,228, 7"
                    href="/contactLists#Oulu"
                    title="OULU" />
            <area   shape="circle"
                    coords="109,188, 7"
                    href="/contactLists#Kemi"
                    title="KEMI" />
            <area   shape="circle"
                    coords="133,157, 7"
                    href="/contactLists#Rovaniemi"
                    title="ROVANIEMI" />
            <area   shape="circle"
                    coords="170,55, 7"
                    href="/contactLists#Inari"
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
        <!-- Back To The Top Button -->
        <button onclick="topFunction()" class="btn btn-default btn-sm" id="toTop" title="Go to top"><i class="material-icons">arrow_upward</i>Ylös</button>
    </div>
</div>
