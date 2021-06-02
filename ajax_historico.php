<?php
require('connection.php');
$nome_sensor = $_GET['nome'];

$data = array();

$sql = "SELECT hora, valor FROM historico WHERE nome='$nome_sensor' ORDER BY idHistorico DESC";
$db = $conn->query($sql);

// vai buscar cado linha da tabela e colocala no array 'data'
while ($row = $db->fetch_assoc()) {
    $data['data'][] = $row;
}

// 'converte' o array para do tipo json
echo (json_encode($data));

$conn->close(); 
