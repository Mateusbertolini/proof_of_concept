<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include_once('config.php');

// Initialize an array to store the data
$data = array();

$query = "SELECT * FROM avaliacoesAtendimento";
$result = mysqli_query($connection, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Output the data as JSON
    echo json_encode($data);
} else {
    // Handle the error gracefully and return an error JSON response
    $error = array("error" => "Database query error: " . mysqli_error($connection));
    echo json_encode($error);
}

// Close the database connection
mysqli_close($connection);
?>
