<!DOCTYPE html>
<html>
<head>
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Proyect</title> 
	<link href={{ asset("welcome/homestyle.css") }} rel="stylesheet">

</head>
<body >
    <audio controls autoplay loop style="position:fixed ; z-index: 9999; top:90% ; left: 39%">
        <source src="{{ asset('welcome/music/guns.mp3') }}" type="audio/mp3">
        Tu navegador no soporta el elemento del audio.
    </audio>
    <div class="hero">

        <video autoplay loop muted plays-inline class="back-video" id="background-video">
            <source src="{{ asset('welcome/vid/video6.mp4') }}" type="video/mp4">
        </video>
        <script>
            const video = document.getElementById('background-video');
            video.playbackRate = 0.9; 
        </script>
        
        <nav>
            <img src={{ asset('welcome/img/logo9.png') }} class="logo">
            <ul>
                <li><a href='#' style="color: rgb(255, 255, 255);">Home</a></li>
                <li><a href={{route('login')}} style="color: rgb(252, 247, 247);">Log In</a></li>
            </ul>
        </nav>        
        <div class="content" >
            <div class="text" style="display: inline-block">
                <h1 class="aws2" style="overflow: hidden; font-size: 70px ">
               Bienvenido!
                </h1>                
             </div>
             <br>
            <a href={{route('login')}}>Ingresar</a>
        </div>
        
    </div>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	
    
</body>
</html>