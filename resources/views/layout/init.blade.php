<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>Restaurante | @yield('title','Restaurante')</title>
    <!-- CSS  -->
    <link href="{{asset('css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>

@section('alternalCSS')

    @show
    </head>
    <body>

        @section('content')

        @show

    </body>

<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="{{asset('js/functions.js')}}"></script>
<script src="{{asset('js/materialize.js')}}"></script>

@section('alternalJS')

    @show
</html>
