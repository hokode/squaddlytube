<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 
    <meta charset="utf-8" />
           <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Squaddly Tube lets you focus on videos, not processes." name="description" />
        <meta content="Squaddly" name="author" />
       
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

          <!-- template Css-->
        <link href="{{ asset('css/templatemo-style.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css" />

         <!-- JQuery -->
         <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>

</head>


<body>
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>


         <!-- nav-->
          @include('layouts.nav')
         <!-- nav ends here-->


         <!-- nav-->
         @include('layouts.header')
         <!-- nav ends here-->

         <!--content-->
         @yield('content')
        <!-- content ends here-->
   

        <!-- footer-->
           @include('layouts.footer')
         <!-- footer ends here-->
    
    </body>


 
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });

        $(function(){
            /************** Video background *********/

            function setVideoSize() {
                const vidWidth = 1280;
                const vidHeight = 720;
                const maxVidHeight = 400;
                let windowWidth = window.innerWidth;
                let newVidWidth = windowWidth;
                let newVidHeight = windowWidth * vidHeight / vidWidth;
                let marginLeft = 0;
                let marginTop = 0;
            
                if (newVidHeight < maxVidHeight) {
                    newVidHeight = maxVidHeight;
                    newVidWidth = newVidHeight * vidWidth / vidHeight;
                }
            
                if(newVidWidth > windowWidth) {
                    marginLeft = -((newVidWidth - windowWidth) / 2);
                }
            
                if(newVidHeight > maxVidHeight) {
                    marginTop = -((newVidHeight - $('#tm-video-container').height()) / 2);
                }
            
                const tmVideo = $('#tm-video');
            
                tmVideo.css('width', newVidWidth);
                tmVideo.css('height', newVidHeight);
                tmVideo.css('margin-left', marginLeft);
                tmVideo.css('margin-top', marginTop);
            }

            setVideoSize();

            // Set video background size based on window size
            let timeout;
            window.onresize = function () {
                clearTimeout(timeout);
                timeout = setTimeout(setVideoSize, 100);
            };

            // Play/Pause button for video background      
            const btn = $("#tm-video-control-button");

            btn.on("click", function (e) {
                const video = document.getElementById("tm-video");
                $(this).removeClass();

                if (video.paused) {
                    video.play();
                    $(this).addClass("fas fa-pause");
                } else {
                    video.pause();
                    $(this).addClass("fas fa-play");
                }
            });
        });
    </script>

</html>

