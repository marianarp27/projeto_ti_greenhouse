<?php
    header('Content-Type: text/html; charset=utf-8'); 
    session_start();

    if(!isset ($_SESSION['username'])){
        header("refresh:30; url=dashboard.php");
        die("Acesso restrito.");
    }


    $nome = "";
    $valor= "";
    $hora = "";
    

    //Confirma qual o método utilizado por omissão no envio de pedidos HTTP à "api.php":
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Definição das variaveis:
        $nome = $_POST["nome"];
        $valor=  $_POST["valor"];
        $hora =  $_POST["hora"];
    } else{
        echo "Metodo nao permitido";
    }

    $dados = array("valor"=>$valor,"nome"=>$nome,"hora"=>$hora);

    file_put_contents("api/files/sensores/valor.txt",$valor . "\n",FILE_APPEND);
    file_put_contents("api/files/sensores/nome.txt",$nome . PHP_EOL,FILE_APPEND);
    file_put_contents("api/files/sensores/hora.txt",$hora . PHP_EOL,FILE_APPEND);

?>

<!DOCTYPE html>
<html lang="pt">
    <?php require 'head.php'; ?>

    <body>
        <?php require 'header.php'; ?>

        <div class="container">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="form-group">
                    <label for="valor">Valor:</label>
                    <input type="text" class="form-control" id="valor" name="valor" placeholder="valor" required>
                <?php 
                        if (!isset($valor)) {
                            echo "Variavel valor não está definida \n";
                        }
                    ?>
                </div>
                <div class="form-group">
                    <label for="nome">Name:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="nome" required>
                    <?php
                        if (!isset($nome)) {
                            echo "Variavel nome não está definida \n";
                        }
                    ?>
                </div>
                
                <div class="form-group">
                    <label for="hora">Hora:</label>
                    <input type="datetime-local" class="form-control" id="hora" name="hora" placeholder="hora" required>
                    <?php
                        if (!isset($hora)) {
                            echo "Variavel hora não está definida \n";
                        }
                    ?>
                </div>
                <button type="submit" class="btn btn-success w-100">Submeter</button>
            </form>
        </div>

        <?php require 'footer.php'; ?>
    </body>
</html>