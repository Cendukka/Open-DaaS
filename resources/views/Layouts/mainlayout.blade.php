<!DOCTYPE html>

<html lang="en">

    <head>
        <title>Bigdata project</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        @include('layouts.style')
    
    </head>
    
    <body>
    
        <div class="container-fluid">
            <div class="row content">
                <div class="col-sm-3 sidenav">

                    @include('layouts.navigationBar')
                    
                </div>
                
                <div class="col-sm-9 page">
                
                     @include('pages.examplePage')   <!-- this is example page every other pages are added here  -->          
                    
                </div>
    </div>
    </div>
    
    </body>
    
</html>