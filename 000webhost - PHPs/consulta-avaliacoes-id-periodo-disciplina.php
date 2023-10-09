<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include_once('config.php');

// Initialize an array to store the data
$data = array();

// Check if matricula, cod_disciplina, and periodo are provided in the URL
if(isset($_GET['matricula']) && isset($_GET['cod_disciplina']) && isset($_GET['periodo'])){
    
    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM avaliacoesAtendimento WHERE matricula = ? AND cod_disciplina = ? AND periodo = ?";
    $stmt = mysqli_prepare($connection, $query);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "sss", $_GET['matricula'], $_GET['cod_disciplina'], $_GET['periodo']);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Get the result
    $result = mysqli_stmt_get_result($stmt);
    
    // Fetch data and add to the $data array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row; // Add each row to the data array
    }

    // Output the data as JSON
    echo json_encode($data);
} else {
    // Handle the case where matricula, cod_disciplina, and/or periodo are not provided in the URL
    $error = array("error" => "Invalid or missing parameters.");
    echo json_encode($error);
}