<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include_once('config.php');

// Retrieve data from the POST request
$agendado_por = $_POST['agendado_por'];
$cpf_paciente = $_POST['cpf_paciente'];
$data_agendamento = $_POST['data_agendamento'];
$turno_agendamento = $_POST['turno_agendamento'];
$horario_agendamento = $_POST['horario_agendamento'];
$local = $_POST['local'];
$atividade_curricular = $_POST['atividade_curricular'];
$descricao = $_POST['descricao'];
$status_agendamento = 'Agendado';

// Use prepared statement to insert data into the database
$stmt = $connection->prepare("INSERT INTO `agenda-clinicas` (`agendado_por`, `cpf_paciente`, `data_agendamento`, `turno_agendamento`, `horario_agendamento`, `atividade_curricular`, `local`, `descricao`, `status_agendamento`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssssss", $agendado_por, $cpf_paciente, $data_agendamento, $turno_agendamento, $horario_agendamento, $atividade_curricular, $local, $descricao, $status_agendamento);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "Agendamento cadastrado com sucesso!";
} else {
    $response['success'] = false;
    $response['message'] = "Erro ao cadastrar agendamento: " . $stmt->error;
}

// Output the response as JSON
echo json_encode($response);

// Close the prepared statement and the database connection
$stmt->close();
$connection->close();
?>