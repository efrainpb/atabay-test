<?php
/**
 * Created by PhpStorm.
 * User: Efrain
 * Date: 21/1/2016
 * Time: 01:05
 */
 include("../conect.php");
 $nombre = $_POST['nombre'];
 $correo = $_POST['email'];
 $password = password_hash($_POST['pass'],PASSWORD_DEFAULT);
 $direccion = utf8_decode($_POST['direccion']);
 $latitud = $_POST['latitud'];
 $longitud = $_POST['longitud'];
 $token = md5($_POST['email']);
 $email = $mysqli->query("SELECT email FROM usuarios WHERE email = '$correo'");
 if($email->num_rows > 0)
     echo "error correo";
 else {
     $sql= "INSERT INTO usuarios(nombre,email,password,direccion,token,longitud,latitud) VALUES ('$nombre','$correo','$password','$direccion','$token',$longitud,$latitud);";
     session_start();
     $_SESSION["token"] = $token;
     if($resultado = $mysqli->query($sql)){
         echo "ok";
     }
     else{
         echo "No fue posible insertar";
     }
 }