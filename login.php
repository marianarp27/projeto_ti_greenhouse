<?php
    session_start();
    //utilizador
    $user = "user";
    $pass = "pass";

    //admin
    $admin = "admin";
    $pass = "pass";
        
    if( (isset($_POST['username'])) && (isset($_POST['password'])) ){
    
        if (!empty($_POST['username']) && !empty($_POST['password'])) {     
            
            //confirmação das credenciais
            if ( ( $_POST['username'] == $user && $_POST['password'] == $pass ) ||
                 ( $_POST['username'] == $admin && $_POST['password'] == $pass  )
                ) {
                    $_SESSION['username'] = $_POST['username'];  
                    header('Location: index.php');
            }else{
                //mensagem de erro
                $error = "Dados de acesso inválidos!";
            }
        } else {
            //mensagem de erro
            $error = "Campos Vazios";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <?php include('head.php'); ?>
  <title>SG  | Login </title>
</head>

<body>

    <div class="container">

        <div class="card card_form shadow-sm bg-light border-0 rounded-lg">
            <div class="card-body">
                <h3 class="card-title text-center text-uppercase text-success"> <b>Smart Greenhouse</b> </h3>

                <div class="row justify-content-md-center">
                    <div class="media imagem col-lg-5">
                        <img src="public/img/smart_greenhouse.svg" alt="imagme de uma estufa ilustrada">
                    </div>
                    <div class="col-lg-7">

                        <!-- Alerta caso não tenha colocado as credenciais corretas -->
                        <?php
                            if (isset($error)) {
                                echo "<div class='alert alert-danger fade show' role='alert'> $error </div>";
                            }
                        ?>

                        <form action="#" method="POST">
                            <div class="form-group">
                                <i class="icon fas fa-user text-success"></i>
                                <input type="text" class="form_input form-control" name="username"
                                    placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <i class="icon fas fa-lock text-success"></i>
                                <input type="password" class="form_input form-control" name="password"
                                    placeholder="Password">
                            </div>
                            <button type="submit" class="btn bg-success text-white w-100">Entrar</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>


</body>

</html>