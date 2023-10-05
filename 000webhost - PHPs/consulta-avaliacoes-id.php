<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include_once('config.php');

// Initialize an array to store the data
$data = array();

// Check if matricula parameter is set in the request
if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];

    // Prepare the SQL query with a placeholder for matricula
    $query = "SELECT * FROM avaliacoesAtendimento WHERE matricula = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($connection, $query);

    // Bind the matricula parameter to the placeholder
    mysqli_stmt_bind_param($stmt, "s", $matricula);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the results
    $result = mysqli_stmt_get_result($stmt);

    // Fetch data and store it in the array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Output the data as JSON
    echo json_encode($data);
} else {
    // Handle the case when matricula parameter is not provided
    $error = array("error" => "Matricula parameter is missing.");
    echo json_encode($error);
}

// Close the statement and the database connection
mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
