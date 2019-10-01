


<div class="wrapper">
{{--    Sidebar Holder--}}
    <nav id="sidebar">
		<div class="sidebar-header">
            <a href="/home"><h5>Open DaaS</h5><br><h6>Admin</h6></a>
		</div>
		<ul class="list-group components">
			<li>
				<a href="/home">Etusivu</a>
				<a href="/companies/">Organisaatiot</a>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Hallinnoi</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li><a href="/companiesUser/">Käyttäjät</a></li>
                    <li><a href="/materials">Materiaalit</a></li>
                    <li><a href="{{route('companies_create')}}">Rekisteröi uusi organisaatio</a></li>
                </ul>
                <a href="{{'/instructions'}}">Ohjeet</a>
			</li>
		</ul>
	</nav>
{{--    Page Content Holder--}}
    <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="navbar-header">
                    <a href="#" id="sidebarCollapse" class="material-icons btn btn-info btn-lg logout">toggle_on</a><br><br>
                    <span><h5>Käyttäjä: {{ Auth::user()->first_name }}</h5></span>
                </div>
                <div class="navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item p-1">
                            <a href="/home" class="btn btn-info btn-lg logout">Admin Etusivu</a>
                        </li>
                        <li class="nav-item p-1">
                            <a href="/" class="btn btn-info btn-lg logout">Julkinen sivu</a>
                        </li>
                        @guest
                            <li class="nav-item p-1">
                                <a href="{{ route('login') }}" class="btn btn-info btn-lg logout">Kirjaudu sisään</a>
                            </li>
                        @else
                            <li class="nav-item p-1">
                                <a href="{{route('logout') }}" class="btn btn-info btn-lg logout">Kirjaudu ulos</a>
                            </li>
                        @csrf
                        @endguest
                    </ul>
                </div>
            </nav>
{{--        Main Page Content Holder--}}
		<div id="main" class="column pb-4">
      		@yield('content')
   		</div>
{{--        Back To The Top Button--}}
        <button onclick="topFunction()" class="btn btn-default btn-sm" id="toTop" title="Go to top"><i class="material-icons">arrow_upward</i>Ylös</button>
	</div>
</div>
