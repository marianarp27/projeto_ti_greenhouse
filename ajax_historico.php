<?php
require('connection.php');
$nome_sensor = $_GET['nome'];

$data = array();

$sql = "SELECT hora, valor FROM historico WHERE nome='$nome_sensor' ORDER BY idHistorico DESC";
$db = $conn->query($sql);


while ($row = $db->fetch_assoc()) {
    $data['data'][] = $row;
}
echo (json_encode($data));
