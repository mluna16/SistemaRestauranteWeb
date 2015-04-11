@extends('layout.init')

@section('title')
    Inicio
@stop
@section('alternalCSS')
    <link href="{{asset('css/paralax.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <style>
        .parallax-container {
            height: 500px;
        }
    </style>

@endsection
@section('content')

    @include('partials.principal.headerPrincipal')
    <style type="text/css">
        .parallaxParent {
            height: 100vh;
            overflow: hidden;
        }
        .parallaxParent > * {
            height: 200%;
            position: relative;
            top: -100%;
        }
    </style>
    <div class="spacer s0"></div>
    <div id="parallax1" class="parallaxParent">
        <div style="background-image: url('http://janpaepke.github.io/ScrollMagic/img/example_parallax_bg1.png');"></div>
    </div>
    <div class="spacer s1">
        <div class="box2 blue">
            <p>Content 1</p>
            <a href="#" class="viewsource">view source</a>
        </div>
    </div>
    <div class="spacer s0"></div>
    <div id="parallax2" class="parallaxParent">
        <div style="background-image: url('http://janpaepke.github.io/ScrollMagic/img/example_parallax_bg1.png');"></div>
    </div>
    <div class="spacer s1">
        <div class="box2 blue">
            <p>Content 2</p>
            <a href="#" class="viewsource">view source</a>
        </div>
    </div>
    <div class="spacer s0"></div>
    <div id="parallax3" class="parallaxParent">
        <div style="background-image: url('http://janpaepke.github.io/ScrollMagic/img/example_parallax_bg1.png');"></div>
    </div>
    <div class="spacer s2"></div>

@endsection

@section('alternalJS')
    <script src="http://janpaepke.github.io/ScrollMagic/js/lib/greensock/TweenMax.min.js"></script>
    <script src="http://janpaepke.github.io/ScrollMagic/scrollmagic/uncompressed/ScrollMagic.js"></script>
    <script src="http://janpaepke.github.io/ScrollMagic/scrollmagic/uncompressed/plugins/animation.gsap.js"></script>
    <script src="http://janpaepke.github.io/ScrollMagic/scrollmagic/uncompressed/plugins/debug.addIndicators.js"></script>

    <script>
        // init controller
        var controller = new ScrollMagic.Controller({globalSceneOptions: {triggerHook: "onEnter", duration: "200%"}});

        // build scenes
        new ScrollMagic.Scene({triggerElement: "#parallax1"})
                .setTween("#parallax1 > div", {y: "80%", ease: Linear.easeNone})
                .addTo(controller);

        new ScrollMagic.Scene({triggerElement: "#parallax2"})
                .setTween("#parallax2 > div", {y: "80%", ease: Linear.easeNone})
                .addTo(controller);

        new ScrollMagic.Scene({triggerElement: "#parallax3"})
                .setTween("#parallax3 > div", {y: "80%", ease: Linear.easeNone})
                .addTo(controller);
    </script>
@endsection