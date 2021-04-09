<?php
    session_start();
    $_SESSION["username"]='username';

    $username="mariana";
    $password="123";

    $username="maria";
    $password="123";

    if( (isset($_POST['username'])) && (isset($_POST['password'])) ){
        if( (isset($username)) && (isset($password)) ){
            echo "O username submetido foi: " . $_POST['username'] . "<br>";
            echo 'A password submetida foi: ' . $_POST['password'] . "<br>";
        }
    } else  {
        echo "Credenciais erradas";
    }
?> 
 