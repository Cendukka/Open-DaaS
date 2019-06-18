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
                    	<li><a href="/manage/">Käyttäjäoikeudet</a></li>
                        <li><a href="#">Kategoriat</a></li>
                        <li><a href="#">Lisää uusi toimipiste</a></li>
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
                	
                	<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn toggle">
                    	<i class="glyphicon glyphicon-align-left"></i>
                        	<span>Toggle Sidebar</span>
                    </button>
                        
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                	
                	<ul class="nav navbar-nav navbar-right">
                    	<li><a href="#" class="info-btn">Yhteystiedot</a></li>
                        <li><a href="#" class="btn btn-info btn-lg logout">KIRJAUDU ULOS</a></li>
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

<!-- jQuery CDN for LeftSide Menu-->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- Bootstrap Js CDN -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar, #content').toggleClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>

<!-- Script for Back To The Top Button -->
<script>

<!-- When the user scrolls down 30px from the top of the document, show the button -->
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
    document.getElementById("toTop").style.display = "block";
  } else {
    document.getElementById("toTop").style.display = "none";
  }
}

<!-- When the user clicks on the button, scroll to the top of the document -->
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

<!-- <div class="navbar">
    <div class="navbar-inner">
        <a id="logo" href="/">BigData Pilot</a>
        <ul class="nav">
            <li><a href="/companies">Yritykset</a></li>
            <li><a href="/materials">Materials</a></li>
            <li><a href="/ewc">EWC Codes</a></li>-->