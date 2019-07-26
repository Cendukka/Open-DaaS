<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Open Daas FastWow - @yield('title') </title>

         <!-- Bootstrap CSS CDN -->
{{--        <link rel="stylesheet" href=" {{ asset ('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}">--}}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
{{--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">--}}
        
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="<?php echo asset('css/sidebar.css')?>" type="text/css">
        <link rel="stylesheet" href="<?php echo asset('css/homepage.css')?>" type="text/css">
{{--        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" type="text/css"> --}}

        
        <!-- Scrollbar Custom CSS (for fixed LeftSide Menu) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

        <!-- Scripts for the homepage -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
{{--        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>--}}
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <!-- jQuery CDN for LeftSide Menu-->
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
        <!-- General JS file -->
{{--        <script type="text/javascript" src="C:\Users\samuli.lehtonen\Documents\GitHub\BigData\public\js\PublicJS.js"></script>--}}
        <script type="text/javascript" src="{{ URL::asset('js\PublicJS.js') }}"></script>

<!--<style>
    * {
        box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        padding: 10px;

    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    .container {
        margin:0;
    }

</style>-->
       
