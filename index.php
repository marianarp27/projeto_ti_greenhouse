<!DOCTYPE html>
<html lang="pt">
    <?php require 'head.php'; ?>

    <body>    
   
    <?php require 'header.php'; ?>

        <div class="container">

            <div class="card card_form shadow-sm bg-light border-0 rounded-lg">
                <div class="card-body">
                    <h3 class="card-title text-center text-uppercase
                        text-success"> <b>Smart Greenhouse</b> </h3>

                    <div class="row justify-content-md-center">
                        <div class="media col-lg-5">
                            <img src="assets/img/smart_greenhouse.svg"
                                alt="imagme de uma estufa ilustrada">
                        </div>
                        <div class="col-lg-7">
                            <!-- Alerta caso não tenha colocado as credenciais corretas -->
                            <div class="alert alert-danger fade show"
                                role="alert">
                                Dados de acesso inválidos!
                            </div>

                            <form action="dashboard.php" method="POST">
                                <div class="form-group">
                                    <i class="icon fas fa-user"></i>
                                    <input type="text" class="form_input
                                        form-control" id="nameInput"
                                        placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <i class="icon fas fa-lock"></i>
                                    <input type="password" class="form_input
                                        form-control" id="passInput"
                                        placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-success
                                    w-100">Entrar</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <?php require 'footer.php'; ?>
    </body>
</html>