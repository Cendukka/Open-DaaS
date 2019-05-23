<!doctype html>
<html>
<head>
   @include('includes.head')
</head>
<body>
<div class="container">
   <header class="column">
       @include('includes.header')
   </header>
   <div id="main" class="column">
           @yield('content')
   </div>
   <footer class="row">
       @include('includes.footer')
   </footer>
</div>
</body>
</html>