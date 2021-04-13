<?php
    //var_dump(file_get_contents('php://input'));

    header('Content-Type: text/html; charset=utf-8');
    //echo $_SERVER['REQUEST_METHOD'];

    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "recebido um POST \n";

        //(valor=45&nome=temperatura&hora=2021/03/25 00:31);
        print_r($_POST);       
        
        if ( isset($_POST['nome']) && isset($_POST['valor']) && isset($_POST['hora'])) {
                       
            file_put_contents("files/".$_POST["nome"]."/nome.txt", $_POST['nome']);
           
            file_put_contents("files/".$_POST["nome"]."/valor.txt", $_POST['valor']);
    
            file_put_contents("files/".$_POST["nome"]."/hora.txt", $_POST['hora']);

            file_put_contents("files/".$_POST["nome"]."/log.txt", $_POST["hora"].";".$_POST["valor"] . PHP_EOL, FILE_APPEND);

        }else{
            echo "\n Parametros recebidos não válidos!";
        }

 
        
    }else if($_SERVER["REQUEST_METHOD"] == "GET"){
        echo "recebido um GET";
    }else{
        echo "metodo nao permitido";
    }
    

    
?>