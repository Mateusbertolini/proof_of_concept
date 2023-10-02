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
    // Get the form data
    $setor = $_POST['setor'];
    $nome_solicitante = $_POST['nome_solicitante'];
    $id_materials = $_POST['id_material'];
    $qtd_solicitadas = $_POST['qtd_solicitada'];
    $nome_materiais = $_POST['material'];

    // Check if id_materials, qtd_solicitadas, and nome_materiais are arrays
    if (is_array($id_materials) && is_array($qtd_solicitadas) && is_array($nome_materiais)) {
        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO solicitacao_materiais (setor, nome_solicitante, data_pedido, lista_ids, lista_materiais, lista_qtd, statusSolicitacao) VALUES (?, ?, NOW(), ?, ?, ?, 'Solicitado')";
        $stmt = $connection->prepare($sql);

        if ($stmt) {
            // Bind parameters
            $lista_ids = implode(',', $id_materials);
            $lista_qtd = implode(',', $qtd_solicitadas);
            $lista_materiais = implode(',', $nome_materiais);
            $stmt->bind_param("sssss", $setor, $nome_solicitante, $lista_ids, $lista_materiais, $lista_qtd);

            // Execute the statement
            if ($stmt->execute()) {
                echo json_encode(["message" => "Records inserted successfully."]);
            } else {
                echo json_encode(["error" => "Error: " . $stmt->error]);
            }

            // Close the statement
            $stmt->close();
        } else {
            echo json_encode(["error" => "Error in preparing the SQL statement."]);
        }
    } else {
        echo json_encode(["error" => "Invalid data format for id_material, nome, and qtd_solicitada."]);
    }

    // Close the database connection
    $connection->close();
} else {
    echo json_encode(["error" => "Invalid request method. Use POST to submit data."]);
}
?>
