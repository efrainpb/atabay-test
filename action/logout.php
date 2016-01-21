<?php
/**
 * Created by PhpStorm.
 * User: Efrain
 * Date: 21/1/2016
 * Time: 04:25
 */
 session_start();
 session_destroy();
 if (isset($_COOKIE['token_cookie'])) {
        unset($_COOKIE['token_cookie']);
        setcookie('token_cookie', null, -1, '/');
 }
 header('Location: /index.php');