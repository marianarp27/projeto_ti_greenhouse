<?php
    header('Content-Type: text/html; charset=utf-8');
    //echo $_SERVER['REQUEST_METHOD'];

    // Ligação à Base de Dados (BD)
    require('../connection.php'); 

    // Apresentar todos os nomes das tabelas/sensores existentes na Base de Dados 
    $sql = "show tables;";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_row($result)) {
        echo "$row[0]\n";
    }

       
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        print_r($_POST);       
        
        if ( isset($_POST['nome']) && isset($_POST['valor']) && isset($_POST['hora'])) {
            
            $nome=$_POST["nome"]; $valor=$_POST['valor']; $hora=$_POST['hora']; // guardar em variaves os valores recebidos

            // "Select 1 from 'table_name' " -> vai returnar 'false' se a tabela/sensor não existir na BD
            $sql = "SELECT 1 from $nome LIMIT 1";
            $result = $conn->query($sql); //verifica a conecção com a Base de Dados
                       
            if($result !== FALSE) { // verifica se encontrou a tabela/sensor
                //se sim, insere os novos dados
                $sql = "INSERT INTO $nome (valor, hora) VALUES ('$valor', '$hora')";

                if (mysqli_query($conn, $sql)) { // confirmação da inserção dos dados
                    echo "\n Novos dados adicionados com sucesso!";
                } else {
                    echo "\n Error ao inserir dados: " . mysqli_error($conn);
                    http_response_code(403);
                }

                $conn->close();
            }
            else //se não existe, cria uma nova tabela para esse sensor
            {
                //criação da nova tabela
                $sql = "CREATE TABLE $nome (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    valor INT(5) NOT NULL,
                    hora VARCHAR(20) NOT NULL
                )";
    
                if(mysqli_query($conn, $sql)){// confirmação da criação da nova tabela
                      echo "Novo sensor criado com sucesso!\n";
                } else {
                      echo "Erro na criação do sensor: " . mysqli_error($conn). "\n";
                }
                
                //Adicina os dados à tabela criada
                $sql = "INSERT INTO $nome (valor, hora) VALUES ('$valor', '$hora')"; 
                  
                if (mysqli_query($conn, $sql)) { // confirmação da inserção dos dados
                      echo "Dados adicionados com sucesso!";
                } else {
                      echo "Erro ao inserir dados: " . mysqli_error($conn);
                      http_response_code(403);
                }

                $conn->close();
            }
                       

        }else{
            echo "\n [ERRO] Parametros recebidos não válidos!";
            http_response_code(404);
        }

    // ***************  Metodo GET  ***************
    }else if($_SERVER["REQUEST_METHOD"] == "GET"){

        if ( isset($_GET['nome'])) {  
            $nome=$_GET['nome'];

            $sql = "SELECT 1 from $nome LIMIT 1";
            $result = $conn->query($sql); //verifica a conecção com a base de dados(BD)
                       
            if($result !== FALSE) { // verifica se existe a tabela/sensor na BD

                $sql = "SELECT id, valor FROM $nome ORDER BY id DESC LIMIT 1"; // 'limit 1' -> apresentar apenas 1º da lista
                $db = $conn->query($sql);

                //echo "Valor: " . $row["valor"];    <------  ver se resulta apenas com este campo, pois já estamos a limitar a 1
                if ($db->num_rows > 0) {                  
                    while($row = $db->fetch_assoc()) {
                        echo "Valor: " . $row["valor"];
                    }
                } else { // caso o sensor pedido não conter nenhum dado
                    echo "Sensor sem resultados/dados a apresentar.";
                }
                $conn->close();

            // caso o nome/sensor pedido não exista na BD    
            }else{
                echo "\n O sensor '" . $nome . "' não existe!";
            }

        }else{
            echo "\n [ERRO] Parâmetros em falta no metodo GET";
            http_response_code(404);
        }

    }else{
        echo "Metodo não permitido!";
        http_response_code(403);
    }

    
   
?>