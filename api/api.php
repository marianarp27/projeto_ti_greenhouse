<?php
    header('Content-Type: text/html; charset=utf-8');
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //(valor=45&nome=temperatura&hora=2021/03/25 00:31);
        print_r($_POST);       
        
        if ( isset($_POST['nome']) && isset($_POST['valor']) && isset($_POST['hora'])) {
                       
            //file_put_contents("files/".$_POST["nome"]."/nome.txt", $_POST['nome']);
           
            file_put_contents("files/".$_POST["nome"]."/valor.txt", $_POST['valor']);
    
            file_put_contents("files/".$_POST["nome"]."/hora.txt", $_POST['hora']);

            file_put_contents("files/".$_POST["nome"]."/log.txt", $_POST["hora"].";".$_POST["valor"] . PHP_EOL, FILE_APPEND);

        }else{
            echo "\n Parametros recebidos não válidos!";
        }

    }else if($_SERVER["REQUEST_METHOD"] == "GET"){
        // -- 'get' para mostrar o valor recebido do 'post' --> uso para o projeto

        if ( isset($_GET['nome'])) {
                       
            $get_valor = file_get_contents("files/".$_GET['nome']."/valor.txt");
            $get_hora = file_get_contents("files/".$_GET['nome']."/hora.txt");
            echo "Valor: $get_valor\n";
            echo "Hora: $get_hora";

        }else{
            echo "\n Faltam parâmetros no GET";
        }

    }else{
        echo "metodo nao permitido";
    }
    
   
?>