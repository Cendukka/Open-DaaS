<div class="wrapper">

    <!-- Sidebar Holder -->
    <nav id="sidebar">

        <div class="sidebar-header">
            <a href="/"><h3>JALOSTUSLAITOS</h3></a>
        </div>

        <div class="finland-map">
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
                        <span>Toggle Sidebar</span>
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
                        
                        <a href="/home" class="btn btn-info btn-lg logout">Hallita</a></li>

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

    //When the user scrolls down 30px from the top of the document, show the button
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
