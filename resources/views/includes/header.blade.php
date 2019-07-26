<div class="wrapper">
    
    <!-- Sidebar Holder -->
    <nav id="sidebar">
		
		<div class="sidebar-header">
        	<a href="/home"><h4>TADAH Tekstiilikierrätyksen Avoimen DAtan Hallintajärjestelmä</h4>Admin</a>
		</div>

		<ul class="list-unstyled components">

			<li>
				<a href="/home">Etusivu</a>
				<a href="/companies/">Organisaatiot</a>
{{--                <a href="/ewc/">EWC Codes</a>--}}
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Hallinnoi</a>
                
                	<ul class="collapse list-unstyled" id="pageSubmenu">
                    	<li><a href="/companiesUser/">Käyttäjät</a></li>
                        <li><a href="/materials">Materiaalit</a></li>
                        <li><a href="{{url(action('company_controller@create'))}}">Rekisteröi uusi organisaatio</a></li>
					</ul>
			
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
                            <a href="/home" class="btn btn-info btn-lg logout">Admin Etusivu</a>
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
