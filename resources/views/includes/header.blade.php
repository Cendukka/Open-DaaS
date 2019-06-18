        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <a href="/"><h3>JALOSTUSLAITOS</h3>(BigData Pilot)</a>
                </div>

                <ul class="list-unstyled components">
                  
                    <li>
                        <a href="#">Oma toimipiste</a>
                        <a href="/companies/">Toimipisteet</a>
                        <a href="/ewc/">EWC Codes</a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Hallinnoi</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="/manage/">K�ytt�j�oikeudet</a></li>
                            <li><a href="#">Kategoriat</a></li>
                            <li><a href="/hallinnoi/lisauusitoimipiste">Lis�� uusi toimipiste</a></li>
                        </ul>
                    </li>
                    
                </ul>

                <ul class="list-unstyled CTAs">
                  
                    <li><a href="/" class="back">Back</a></li>
                </ul>
            </nav>

            <!-- Page Content Holder -->

            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="navbar-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#" class="info-btn">Yhteystiedot</a></li>
                                <li>
                                @guest
                                <li><a href="{{ route('login') }}" class="btn btn-info btn-lg logout">KIRJAUDU SISÄÄN</a></li>

                                <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> -->
                            </li>
                            
                        @else 
                        <a href="{{route('logout') }}" class="btn btn-info btn-lg logout">KIRJAUDU ULOS</a></li>

                                <!-- <li><a href="{{route('logout') }}">Logout</a></li> -->

                                        @csrf
                        @endguest
                                

                                <!-- <a href="#" class="btn btn-info btn-lg logout">KIRJAUDU ULOS</a></li>
                                <li><a href="#" class="btn btn-info btn-lg logout">KIRJAUDU SISÄÄN</a></li> -->

                            </ul>
                        </div>
                    </div>
                
                </nav>
                
                   <div id="main" class="column">
      				@yield('content')
   					</div>

                   
                
            </div>
        </div>

        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                     $(this).toggleClass('active');
                 });
             });
         </script>
