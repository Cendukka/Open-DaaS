<div class="navbar">
    <div class="navbar-inner">
        <a id="logo" href="/">BigData Pilot</a>
        <ul class="nav">
            <li><a href="/companies">Yritykset</a></li>
            <li><a href="/materials">Materials</a></li>
            <li><a href="/ewc">EWC Codes</a></li>
            <li> <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        <!-- @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif -->
                    @endauth
                </div>
            @endif
            </li>

            
        </ul>
    </div>
</div>
<br>