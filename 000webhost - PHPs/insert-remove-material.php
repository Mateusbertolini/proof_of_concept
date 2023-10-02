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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['selectedId']) && is_array($_POST['selectedId'])) {
        // Check if 'selectedId' is present; if so, it's a delete operation
        $selectedIds = $_POST['selectedId'];

        // Loop through the selected IDs and delete the corresponding records
        $successMessage = "";
        $errorMessage = "";

        foreach ($selectedIds as $idToDelete) {
            // Perform the database deletion
            $sql = "DELETE FROM `materiais` WHERE `materiais`.`id` = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $idToDelete);

            if ($stmt->execute()) {
                $successMessage = "Material(s) deletado(s) com sucesso.";
            } else {
                $errorMessage = "Erro ao deletar material: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        }

        // Return the response as JSON
        if ($errorMessage !== "") {
            echo json_encode($errorMessage);
        } else {
            echo json_encode($successMessage);
        }
    } else {
        // If 'selectedId' is not present, it's an insert or update operation
        // Check if the form fields are set and meet the required conditions
        if (
            isset($_POST['nomeMaterial']) && 
            isset($_POST['tipoMaterial']) && $_POST['tipoMaterial'] !== "Escolher" &&
            isset($_POST['qtdMaterial']) && $_POST['qtdMaterial'] > 0 &&
            isset($_POST['apresentacao']) && $_POST['apresentacao'] !== "Escolher"
        ) {
            // Retrieve form data
            $nomeMaterial = $_POST['nomeMaterial'];
            $tipoMaterial = $_POST['tipoMaterial'];
            $qtdMaterial = $_POST['qtdMaterial'];
            $apresentacao = $_POST['apresentacao'];

            // Check if 'idMaterial' is present; if so, it's an update operation
            if (isset($_POST['idMaterial']) && $_POST['idMaterial'] !== "") {
                $idMaterial = $_POST['idMaterial'];
                // Perform the database update
                $sql = "UPDATE `materiais` SET `nome` = ?, `quantidade` = ?, `tipo_material` = ?, `apresentacao` = ? WHERE `id` = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("sissi", $nomeMaterial, $qtdMaterial, $tipoMaterial, $apresentacao, $idMaterial);

                if ($stmt->execute()) {
                    // Return success message as JSON
                    echo json_encode("Material atualizado com sucesso.");
                } else {
                    // Return error message as JSON
                    echo json_encode("Erro ao atualizar material: " . $stmt->error);
                }

                // Close the prepared statement
                $stmt->close();
            } else {
                // It's an insert operation as 'idMaterial' is not present
                // Perform the database insertion with the auto-incremented ID
                $sql = "INSERT INTO materiais (nome, quantidade, tipo_material, apresentacao) VALUES (?, ?, ?, ?)";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("siss", $nomeMaterial, $qtdMaterial, $tipoMaterial, $apresentacao);

                if ($stmt->execute()) {
                    // Return success message as JSON
                    echo json_encode("Material inserido com sucesso.");
                } else {
                    // Return error message as JSON
                    echo json_encode("Erro ao inserir material: " . $stmt->error);
                }

                // Close the prepared statement
                $stmt->close();
            }
        } else {
            // Return error message as JSON
            echo json_encode("Um ou mais campos do formulário estão faltando ou não atendem às condições necessárias.");
        }
    }
} else {
    // Handle the case where the form was not submitted
    echo json_encode("Form not submitted.");
}
?>
