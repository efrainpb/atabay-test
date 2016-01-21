<?php
include("conect.php");
session_start();
if(isset($_SESSION['token'])){
    $token = $_SESSION['token'];
    $registro = $mysqli->query("SELECT * FROM usuarios WHERE token = '$token'");
    $row = $registro->fetch_array();
}
else if(isset($_COOKIE["token_cookie"])){
    $token = $_COOKIE['token_cookie'];
    $registro = $mysqli->query("SELECT * FROM usuarios WHERE token = '$token'");
    $row = $registro->fetch_array();
}
else
    header("Location: login.php");
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Atabay Test 2</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="/">
                Atabay Test
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php echo $row['email']; ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/action/logout.php"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Atabay Test</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 text-center"><h1>Hola <?php echo $row['nombre']; ?>!</h1></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="map2"></div>
                            <input type="hidden" value="<?php echo $row['latitud']; ?>" id="MainContent_hdnLat" name="latitud">
                            <input type="hidden" value="<?php echo $row['longitud']; ?>" id="MainContent_hdnLng" name="longitud">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4><?php echo $row['direccion']; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery-1.9.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootbox.min.js"></script>
<script src="/js/modals.init.js"></script>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
    window.onload = function(){
        initialize();
    }
    var geocoder;
    var map;
    function initialize()
    {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(29.156604213328453,-106.49368660000005);
        var myOptions = {
            zoom: 16,
            minZoom: 5,
            maxZoom: 19,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }


    map = new google.maps.Map(document.getElementById("map2"), myOptions);

    var hdnLat = document.getElementById("MainContent_hdnLat");

    if(hdnLat.value != "")
    {
        var hdnLng = document.getElementById("MainContent_hdnLng");
        myLatlng = new google.maps.LatLng(hdnLat.value,hdnLng.value);
        placeMarker(myLatlng);
    }
    }

    var marker;
    function placeMarker(location)
    {
        if (marker != null)
            marker.setMap(null);

        marker = new google.maps.Marker({
            position: location,
            map: map,
            icon: '//findicons.com/files/icons/2232/wireframe_mono/48/pin_map.png'
        });

        map.setCenter(location);
    }

</script>
</body>
</html>