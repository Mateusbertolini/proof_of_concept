<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include_once('config.php');

// Initialize an array to store the data
$data = array();

// Check if periodo and cod_disciplina are provided in the URL
if(isset($_GET['periodo']) && isset($_GET['cod_disciplina'])){
    
    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM avaliacoesAtendimento WHERE periodo = ? AND cod_disciplina = ?";
    $stmt = mysqli_prepare($connection, $query);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ss", $_GET['periodo'], $_GET['cod_disciplina']);
    
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
    // Handle the case where periodo and/or cod_disciplina are not provided in the URL
    $error = array("error" => "Invalid or missing parameters.");
    echo json_encode($error);
}
?>
