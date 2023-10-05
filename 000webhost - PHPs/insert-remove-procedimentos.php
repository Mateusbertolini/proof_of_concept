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
            $sql = "DELETE FROM `procedimentos_sus` WHERE `cod_sus` = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $idToDelete);

            if ($stmt->execute()) {
                $successMessage = "Procedimento(s) deletado(s) com sucesso.";
            } else {
                $errorMessage = "Erro ao deletar procedimento: " . $stmt->error;
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
            isset($_POST['codSUS']) && 
            isset($_POST['descricaoSUS']) && 
            isset($_POST['tipoSUS']) && 
            $_POST['tipoSUS'] !== "Escolher"
        ) {
            // Retrieve form data
            $codSUS = $_POST['codSUS'];
            $descricaoSUS = $_POST['descricaoSUS'];
            $tipoSUS = $_POST['tipoSUS'];

            // It's an insert operation as 'codSUS' is provided by the user
            $sql = "INSERT INTO `procedimentos_sus` (`cod_sus`, `nome`, `tipo`) VALUES (?, ?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("iss", $codSUS, $descricaoSUS, $tipoSUS);

            if ($stmt->execute()) {
                // Return success message as JSON
                echo json_encode("Procedimento cadastrado com sucesso.");
            } else {
                // Return error message as JSON
                echo json_encode("Erro ao cadastrar procedimento: " . $stmt->error);
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            // Return error message as JSON
            echo json_encode("Um ou mais campos do formulário estão faltando ou não atendem às condições necessárias.");
        }
    }
} else {
    // Handle the case where the form was not submitted
    echo json_encode("Formulário não submetido.");
}
?>
