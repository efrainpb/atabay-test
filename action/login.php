<?php
/**
 * Created by PhpStorm.
 * User: Efrain
 * Date: 21/1/2016
 */

include("../conect.php");
$correo = $_POST['email'];
$password = $_POST['pass'];
$result = $mysqli->query("SELECT * FROM usuarios WHERE email = '$correo'");
$row = $result->fetch_array();
if($result->num_rows>0){
    if(password_verify($password,$row['password'])){
        $token = md5($correo);
        $result = $mysqli->query("UPDATE usuarios SET token = '$token' WHERE id = 3;");
        session_start();
        $_SESSION["token"] = $token;
        if(isset($_POST['remember'])){
            setcookie("token_cookie",$token,time()+(60*60*24*2),'/');
        }
        echo "ok";
    }
    else{
        echo "La contraseña es incorrecta";
    }
}
else{
    echo "No existe este correo registrado";
}