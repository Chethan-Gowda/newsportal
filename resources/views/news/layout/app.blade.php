<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <title>News Portal</title>        
        <link rel="icon" type="image/png" href="{{ asset('news/uploads/favicon.png') }}">
        @include('news.layout.css')
        @include('news.layout.js')
        <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6212352ed76fda0a"></script>        
        <!-- Google Analytics -->
        {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-84213520-6"></script> --}}
       {{--  <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-84213520-6');
        </script> --}}
    </head>
    <body>
            @include('news.layout.topmenu')
            @include('news.layout.nav')      
            @yield("main_content")
            @include('news.layout.footer')     
   </body>
</html>