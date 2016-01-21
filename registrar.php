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
    </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar</div>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" id="sky-form" name="sky-form" method="post" novalidate action="/action/registrar.php">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="map"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Nombre</label>
                            <div class="col-md-8">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" name="nombre" class="form-control" placeholder="Nombre">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">E-mail</label>
                            <div class="col-md-8">
                                <div class="form-group input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="text" name="email" class="form-control" placeholder="E-mail">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Password</label>
                            <div class="col-md-8">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                    <input type="password" id="pass" name="pass" class="form-control" placeholder="Password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Confirmar Password</label>
                            <div class="col-md-8">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                    <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Confirmar Password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Dirección</label>
                            <div class="col-md-8">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                                    <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección">
                                    <input type="hidden" name="latitud" id="latitud">
                                    <input type="hidden" name="longitud" id="longitud">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="success1" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/jquery-1.9.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootbox.min.js"></script>
<script src="/js/modals.init.js"></script>
<script src="/js/jquery.validate.min.js"></script>
<script src="/js/jquery.form.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?signed_in=true&callback=initMap" async defer></script>
<script>

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 16
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                $('#latitud').val(position.coords.latitude);
                $('#longitud').val(position.coords.longitude);
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({'latLng': pos}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $('#direccion').val(results[0].formatted_address);
                        } else {
                            alert('No results found');
                        }
                    } else {
                        alert('Geocoder failed due to: ' + status);
                    }
                });
                infoWindow.setPosition(pos);
                infoWindow.setContent('Tu posición ahora');
                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }
    var reglas = {
        nombre: {required: true },
        email: {required: true , email:true},
        pass:{required: true},
        pass2: {required: true , equalTo: "#pass"},
        direccion: {required: true }
    };

    var mensajes = {
        nombre: {required: 'Por favor ingrese el nombre del cliente'},
        email:{ required: 'Por favor ingrese un email', email:'El email que ingresó no es valido'},
        pass: {required: 'Por favor ingresa una contraseña'},
        pass2: {required: 'Por favor confirme su contraseña',equalTo: 'La contraseña no coincide'},
        direccion: {required: 'Por favor ingrese su direccionan o recargue la página'}
    };

    $(function(){
        $("#sky-form").validate({
            rules: reglas,
            ignore: ".ignore",
            messages: mensajes,
            resetForm:true,
            debug:true,
            submitHandler: function(form){
                $(form).ajaxSubmit(
                    {
                        beforeSubmit: function(){
                            $('#success1').attr('disabled', 'disabled').html("<i class='fa fa-circle-o-notch fa-spin'></i> Registrando...");
                        },
                        success: function(e)
                        {
                            if(e == "ok"){
                                $('form').trigger('reset');
                                $('#success1').attr('disabled', false).html("<i class='fa fa-btn fa-user'></i> Registrar");
                                window.location.replace("/");
                            }
                            else{
                                $('#success1').attr('disabled', false).html("<i class='fa fa-btn fa-user'></i> Registrar");
                                bootbox.alert("El correo ya ha sido registrado");
                            }
                        }
                    });
            },
            errorPlacement: function(error, element)
            {
                error.insertAfter(element.parent());
            }
        });
    });
</script>
</body>
</html>