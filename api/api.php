<?php
    header('Content-Type: text/html; charset=utf-8');
    //echo $_SERVER['REQUEST_METHOD'];

    // Ligação à Base de Dados (BD)
    require('../connection.php'); 

       
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        print_r($_POST);       
        
        if ( isset($_POST['nome']) && isset($_POST['valor']) && isset($_POST['hora'])) {
            
            $nome=$_POST["nome"]; $valor=$_POST['valor']; $hora=$_POST['hora']; // guardar em variaves os valores recebidos

            // "Select 1 from 'table_name' " -> vai returnar 'false' se a tabela/sensor não existir na BD          
            $result = $conn->query("SELECT 1 from Sensores WHERE designacao='$nome'");
            
            if($result->num_rows != 0) { // verifica se encontrou a tabela/sensor
                //se sim, insere os novos dados
                                    
                // *** ACTUALIZA o sensor ****
                $sql_sensor = "UPDATE Sensores SET valor='$valor', hora='$hora' WHERE designacao='$nome'";
                
                // *** ADICIONA ao histórico ***
                $sql_historico = "INSERT INTO Historico (nome, valor, hora) VALUES ('$nome','$valor','$hora')";
                

                if (mysqli_query($conn, $sql_sensor)) { // confirmação da actualização dos dados na tabela 'sensores'
                    echo "\n Dados inseridos!";
                } else {
                    echo "\n Error ao inserir dados no sensor " . $nome .": " . mysqli_error($conn);
                    http_response_code(403);
                }

                if (mysqli_query($conn, $sql_historico) ) { // confirmação da inserção dos dados na tabela 'historico'
                    echo " Dados inseridos com sucesso!\n";
                } else {
                    echo "\n Error ao inserir dados no historico: " . mysqli_error($conn);
                    http_response_code(403);
                }

                $conn->close();
            }
            else //se não existe, cria uma nova tabela para esse sensor
            {
                // *** CRIA novo sensor e ADICIONA dados ****
                $sql_newSensor = "INSERT INTO Sensores (designacao,valor,hora) VALUES ('$nome','$valor','$hora')";

                // *** ADICIONA o novo sendor ao histórico ***
                $sql_historico = "INSERT INTO Historico (nome, valor, hora) VALUES ('$nome','$valor','$hora')";
                
                
                if(mysqli_query($conn, $sql_newSensor)){ // confirmação da inserção dos dados na tabela 'sensores'
                      echo "Novo sensor criado com sucesso.";
                } else {
                      echo "Erro na criação do novo sensor: " . mysqli_error($conn). "\n";
                } 

                if(mysqli_query($conn, $sql_historico)){ // confirmação da inserção dos dados na tabela 'historico'
                    echo " Dados adicionados!\n";
                } else {
                        echo "Erro na criação do historico do novo sensor: " . mysqli_error($conn). "\n";
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

            $result = $conn->query("SELECT 1 from Sensores WHERE designacao='$nome'");
                                   
            if($result->num_rows != 0) { // verifica se existe a tabela/sensor na BD

                $sql_sensor = "SELECT valor FROM Sensores WHERE designacao='$nome'";
                $db = $conn->query($sql_sensor);

                //echo "Valor: " . $row["valor"];    <------  ver se resulta apenas com este campo, pois já estamos a limitar a 1
                if ($db->num_rows > 0) {                  
                    while($row = $db->fetch_assoc()) {
                        echo $row["valor"];
                    }
                } else { // caso o sensor pedido não conter nenhum dado
                    echo "Sensor sem resultados/dados a apresentar.";
                }
                $conn->close();

            // caso o nome/sensor pedido não exista na BD    
            }else{
                echo "O sensor '" . $nome . "' não existe!";
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