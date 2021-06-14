<?php
    session_start();
    require_once('functions.php');  
    require_once('connection.php');
    
    if(isLoggedIn()){
        header("Location: index.php");
    }

    if ( isset($_POST['username']) && isset($_POST['password']) ) { //isset — Informa se a variável foi iniciada        
        $username = $_POST['username'];
            
        $querySelecionaNome = ( "SELECT username FROM utilizadores WHERE username = '$username'" );
        $result = $conn->query($querySelecionaNome);
        if ( $conn && ($result->num_rows> 0) ) {
            while ($row = $result->fetch_assoc()) {
                $username = $row['username'];
            }
        }
        
        $querySelecionaPerfil = ( "SELECT perfil FROM utilizadores  WHERE username = '$username'" );//Seleciona a linha do id selecionado no input
        $result = $conn->query($querySelecionaPerfil);
        
        if ($conn && ($result->num_rows > 0)) {
            while ($row = $result->fetch_assoc()) {
                $perfil = $row['perfil'];
            }
        }

       $password = hash('sha512', $_POST['password']); //Algoritmo de cifragem no código - Password em hash
        
        if ( isset($username) ) {
            $sql = (  "SELECT * FROM Utilizadores WHERE username = '$username' AND password = '$password'"  );
            $erro = "erro ao selecionar";
            
            $verifica = $conn->query($sql) or die($erro);
            
            if ( $verifica -> num_rows<=0 ){
                echo"<script>alert('Login e/ou senha incorretos'); window.location.href='login.php';</script>";
                die();
            } else {
                $_SESSION['authenticated'] = true;

                $_SESSION['username'] = $username;
                $_SESSION['perfil'] = $perfil;
            
                setcookie("username", $username);
                header("Location:index.php"); // Ir para a página do Home
            }
        }
    } else {
        header("Location: login.php");
    }

    $conn->close();
?>

