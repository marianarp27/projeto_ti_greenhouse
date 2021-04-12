<?php
    //var_dump(file_get_contents('php://input'));
    //define('PHP_EOL', "\n");

    header('Content-Type: text/html; charset=utf-8');
    //echo $_SERVER['REQUEST_METHOD'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "recebido um POST";

        $post_array = array('valor'=>'42', 'nome'=>'temperatura', 'hora'=>'2021/03/25 00:31');
        print_r($post_array);

        if (isset($post_array['valor'],$lpost_arrayist['nome'],$post_array['hora'])) {

            $file_nome = dirname(__FILE__).'\files\temperatura\nome.txt';    
            file_put_contents($file_nome, $post_array['nome']);
    
            $file_valor = dirname(__FILE__).'\files\temperatura\valor.txt';    
            file_put_contents($file_valor, $post_array['valor']);
    
            $file_hora = dirname(__FILE__).'\files\temperatura\hora.txt';    
            file_put_contents($file_hora, $post_array['hora']);

            // array só com a 'hora' e 'valor'
            $hora_valor = array($post_array['hora'],$post_array['valor']);
            $separador = implode(";", $hora_valor);
            
            // 'dirname' mostra direturia onde está o ficheiro
            $file_log = dirname(__FILE__).'\files\temperatura\log.txt'; 
            file_put_contents($file_log, $separador .PHP_EOL, FILE_APPEND);
        }

 
        
    }else if($_SERVER["REQUEST_METHOD"] == "GET"){
        echo "recebido um GET";
    }else{
        echo "metodo nao permitido";
    }
    

    //('username'=>$_POST['username'])
    //$list = array('valor'=>'42', 'nome'=>'temperatura', 'hora'=>'2021/03/25 00:31');
    //print_r($list);

    //$postArray = array(valor='42'&nome='temperatura'&hora='2021/03/25 00:31');
    //print_r($postArray);

    
    
?>