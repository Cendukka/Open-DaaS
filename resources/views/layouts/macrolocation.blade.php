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
      <div id="macrolocation_name" class="row">
         @include('includes.macrolocation_name')
      </div>
      <div id="content" class="row">
         @yield('content')
      </div>
   </div>
   <footer class="row">
       @include('includes.footer')
   </footer>
</div>
</body>
</html>