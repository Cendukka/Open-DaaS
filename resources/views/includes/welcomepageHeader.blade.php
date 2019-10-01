<div class="wrapper">

{{--     Sidebar Holder --}}
    <nav id="sidebar">

        <div class="sidebar-header">

            <a href="/"><h5>Open DaaS</h5></a>
        </div>


{{--                Finland image map, takes the city name as id from contactList page, links and changes --}}
{{--                the title background in contactList when clicked and hover over the city. --}}

        <script type = "text/javascript">

                        function Change(name) {
                            document.getElementById(name).style.background= "#FA9632"
                        }
                        function noChange(name) {
                            document.getElementById(name).style.background= "#d1dec2"
                        }


        </script>


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
                    title="HELSINKI"
                    onMouseOver="Change('Helsinki')"
                    onMouseOut="noChange('Helsinki')"/>
            <area   shape="circle"
                    coords="98,454, 7"
                    href="/contactLists#Lohja"
                    title="LOHJA"
                    onMouseOver="Change('Lohja')"
                    onMouseOut="noChange('Lohja')"/>
            <area   shape="circle"
                    coords="61,443, 7"
                    href="/contactLists#Turku"
                    title="TURKU"
                    onMouseOver="Change('Turku')"
                    onMouseOut="noChange('Turku')"/>
            <area   shape="circle"
                    coords="75,424, 7"
                    href="/contactLists#Loimaa"
                    title="LOIMAA"
                    onMouseOver="Change('Loimaa')"
                    onMouseOut="noChange('Loimaa')" />
            <area   shape="circle"
                    coords="111,436, 7"
                    href="/contactLists#Hyvinkää"
                    title="HYVINKÄÄ"
                    onMouseOver="Change('Hyvinkää')"
                    onMouseOut="noChange('Hyvinkää')"  />
            <area   shape="circle"
                    coords="133,419, 7"
                    href="/contactLists#Lahti"
                    title="LAHTI"
                    onMouseOver="Change('Lahti')"
                    onMouseOut="noChange('Lahti')"  />
            <area   shape="circle"
                    coords="158,430, 7"
                    href="/contactLists#Kouvola"
                    title="KOUVOLA"
                    onMouseOver="Change('Kouvola')"
                    onMouseOut="noChange('Kouvola')"  />
            <area   shape="circle"
                    coords="104,418, 7"
                    href="/contactLists#Hämeenlinna"
                    title="HÄMEELINNA"
                    onMouseOver="Change('Hämeenlinna')"
                    onMouseOut="noChange('Hämeenlinna')" />
            <area   shape="circle"
                    coords="91,396, 7"
                    href="/contactLists#Tampere"
                    title="TAMPERE"
                    onMouseOver="Change('Tampere')"
                    onMouseOut="noChange('Tampere')" />
            <area   shape="circle"
                    coords="45,409, 7"
                    href="/contactLists#Rauma"
                    title="RAUMA"
                    onMouseOver="Change('Rauma')"
                    onMouseOut="noChange('Rauma')" />
            <area   shape="circle"
                    coords="51,395, 7"
                    href="/contactLists#Pori"
                    title="PORI"
                    onMouseOver="Change('Pori')"
                    onMouseOut="noChange('Pori')" />
            <area   shape="circle"
                    coords="190,417, 7"
                    href="/contactLists#Lappeenranta"
                    title="LAPPEENRANTA"
                    onMouseOver="Change('Lappeenranta')"
                    onMouseOut="noChange('Lappeenranta')" />
            <area   shape="circle"
                    coords="165,386, 7"
                    href="/contactLists#Mikkeli"
                    title="MIKKELI"
                    onMouseOver="Change('Mikkeli')"
                    onMouseOut="noChange('Mikkeli')" />
            <area   shape="circle"
                    coords="200,378, 7"
                    href="/contactLists#Savonlinna"
                    title="SAVOLINNA"
                    onMouseOver="Change('Savonlinna')"
                    onMouseOut="noChange('Savonlinna')" />
            <area   shape="circle"
                    coords="210,342, 7"
                    href="/contactLists#Joensuu"
                    title="JOENSUU"
                    onMouseOver="Change('Joensuu')"
                    onMouseOut="noChange('Joensuu')"  />
            <area   shape="circle"
                    coords="130,358, 7"
                    href="/contactLists#Jyväskylä"
                    title="JYVÄSKYLÄ"
                    onMouseOver="Change('Jyväskylä')"
                    onMouseOut="noChange('Jyväskylä')"  />
            <area   shape="circle"
                    coords="47,356, 7"
                    href="/contactLists#Kristiinankaupunki"
                    title="KRISTIINANKAUPUNKI"
                    onMouseOver="Change('Kristiinankaupunki')"
                    onMouseOut="noChange('Kristiinankaupunki')" />
            <area   shape="circle"
                    coords="80,332, 7"
                    href="/contactLists#Seinäjoki"
                    title="SEINÄJOKI"
                    onMouseOver="Change('Seinäjoki')"
                    onMouseOut="noChange('Seinäjoki')" />
            <area   shape="circle"
                    coords="76,295, 7"
                    href="/contactLists#Pietarsaari"
                    title="PIETARSAARI"
                    onMouseOver="Change('Pietarsaari')"
                    onMouseOut="noChange('Pietarsaari')"  />
            <area   shape="circle"
                    coords="97,316, 7"
                    href="/contactLists#Alajärvi"
                    title="ALAJÄRVI"
                    onMouseOver="Change('Alajärvi')"
                    onMouseOut="noChange('Alajärvi')"  />
            <area   shape="circle"
                    coords="124,333, 7"
                    href="/contactLists#Saarijärvi"
                    title="SAARIJÄRVI"
                    onMouseOver="Change('Saarijärvi')"
                    onMouseOut="noChange('Saarijärvi')" />
            <area   shape="circle"
                    coords="174,328, 7"
                    href="/contactLists#Kuopio"
                    title="KUOPIO"
                    onMouseOver="Change('Kuopio')"
                    onMouseOut="noChange('Kuopio')" />
            <area   shape="circle"
                    coords="164,293, 7"
                    href="/contactLists#Iisalmi"
                    title="IISALMI"
                    onMouseOver="Change('Iisalmi')"
                    onMouseOut="noChange('Iisalmi')" />
            <area   shape="circle"
                    coords="175,265, 7"
                    href="/contactLists#Kajaani"
                    title="KAJAANI"
                    onMouseOver="Change('Kajaani')"
                    onMouseOut="noChange('Kajaani')" />
            <area   shape="circle"
                    coords="112,254, 7"
                    href="/contactLists#Ylivieska"
                    title="YLIVIESKA"
                    onMouseOver="Change('Ylivieska')"
                    onMouseOut="noChange('Ylivieska')" />
            <area   shape="circle"
                    coords="129,228, 7"
                    href="/contactLists#Oulu"
                    title="OULU"
                    onMouseOver="Change('Oulu')"
                    onMouseOut="noChange('Oulu')"  />
            <area   shape="circle"
                    coords="109,188, 7"
                    href="/contactLists#Kemi"
                    title="KEMI"
                    onMouseOver="Change('Kemi')"
                    onMouseOut="noChange('Kemi')" />
            <area   shape="circle"
                    coords="133,157, 7"
                    href="/contactLists#Rovaniemi"
                    title="ROVANIEMI"
                    onMouseOver="Change('Rovaniemi')"
                    onMouseOut="noChange('Rovaniemi')"  />
            <area   shape="circle"
                    coords="170,55, 7"
                    href="/contactLists#Inari"
                    title="INARI"
                    onMouseOver="Change('Inari')"
                    onMouseOut="noChange('Inari')" />
        </map>
    </nav>

{{--    Page Content Holder--}}
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a href="#" id="sidebarCollapse" class="material-icons btn btn-info btn-lg logout">toggle_on</a>
                <div class="navbar-collapse " id="navbarNav">
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
{{--                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}


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
{{--        Back To The Top Button--}}
        <button onclick="topFunction()" class="btn btn-default btn-sm" id="toTop" title="Go to top"><i class="material-icons">arrow_upward</i>Ylös</button>
    </div>
</div>
