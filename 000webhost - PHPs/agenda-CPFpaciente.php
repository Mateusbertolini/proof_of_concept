<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include_once('config.php');

// Initialize an array to store the data
$data = array();

// Check if the 'cpf_paciente' parameter is set in the request
if(isset($_GET['cpf_paciente'])){
    $cpf_paciente = $_GET['cpf_paciente'];

    // Use a prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($connection, "SELECT * FROM `agenda-clinicas` WHERE `cpf_paciente` = ?");
    mysqli_stmt_bind_param($stmt, "s", $cpf_paciente);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get results from the statement
    $result = mysqli_stmt_get_result($stmt);

    // Fetch data from the result set
    while ($linha = mysqli_fetch_assoc($result)) {
        $data[] = $linha;
    }

    // Output the data as JSON
    echo json_encode($data);
} else {
    // Handle the case when 'cpf_paciente' parameter is not provided
    $error = array("error" => "Missing 'cpf_paciente' parameter");
    echo json_encode($error);
}

// Close the prepared statement and the database connection
mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
