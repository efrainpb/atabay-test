<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Atabay Test 2</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
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
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" id="sky-form" name="sky-form" method="post" novalidate action="/action/login.php">
                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="pass">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" value="1"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                     Login <i class="fa fa-btn fa-sign-in"></i>
                                </button>

                                <a class="btn btn-link" href="/registrar.php">Registrame</a>
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

<script>
    var reglas = {
        email: {required: true , email:true}
    };
    var mensajes = {
        email:{ required: 'Por favor ingrese un email', email:'El email que ingresó no es valido'}
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
                            $('#success1').attr('disabled', 'disabled').html("<i class='fa fa-circle-o-notch fa-spin'></i> Accediendo...");
                        },
                        success: function(e)
                        {
                            if(e == "ok"){
                                $('#success1').attr('disabled', false).html("Login <i class='fa fa-btn fa-sign-in'></i>");
                                window.location.replace("/");
                            }
                            else{
                                $('#success1').attr('disabled', false).html("Login <i class='fa fa-btn fa-sign-in'></i>");
                                bootbox.alert(e);
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