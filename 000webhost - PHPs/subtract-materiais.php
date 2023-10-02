<?php
// Allow cross-origin requests from any origin (replace '*' with the specific origin if needed)
header("Access-Control-Allow-Origin: *");

// Allow specific HTTP methods (e.g., GET, POST, PUT) - adjust as needed
header("Access-Control-Allow-Methods: GET, POST, PUT");

// Allow specific headers in the request - adjust as needed
header("Access-Control-Allow-Headers: Content-Type");

// Set the response content type to JSON
header("Content-Type: application/json");

// Include your database configuration file
include_once('config.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $id = $_POST['id']; // Assuming you have 'id' in your form
    $qtd_atendida = $_POST['qtd_atendida']; // Assuming you have 'qtd_atendida' in your form
    $justificativaSolicitacao = $_POST['justificativaSolicitacao'];
    $solicitacaoMaterial = $_POST['solicitacaoMaterial'];

    // Perform the subtraction from 'materiais' table
    $stmt = $connection->prepare("UPDATE materiais SET quantidade = quantidade - ? WHERE id = ?");
    $stmt->bind_param("ii", $qtd_atendida, $id);
    $stmt->execute();
    $stmt->close();

    // Update 'solicitacao_materiais' table with justificativaSolicitacao
    $stmt = $connection->prepare("UPDATE solicitacao_materiais SET obs_tramite = ? WHERE id_solicitacao = ?");
    $stmt->bind_param("si", $justificativaSolicitacao, $id);
    $stmt->execute();
    $stmt->close();

    // Update 'solicitacao_materiais' status
    $stmt = $connection->prepare("UPDATE solicitacao_materiais SET statusSolicitacao = ? WHERE id_solicitacao = ?");
    $stmt->bind_param("si", $solicitacaoMaterial, $id);
    $stmt->execute();
    $stmt->close();

    echo json_encode(["message" => "Operations completed successfully."]);
} else {
    echo json_encode(["error" => "Invalid request method. Use POST to submit data."]);
}
?>
