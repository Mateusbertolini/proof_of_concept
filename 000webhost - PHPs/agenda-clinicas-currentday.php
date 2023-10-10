<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include_once('config.php');

// Initialize an array to store the data
$data = array();

// Get the current date
$currentDate = date("Y-m-d");

// Fetch data from the database where data_agendamento = CurrentDate
$consulta = mysqli_query($connection, "SELECT * FROM `agenda-clinicas` WHERE `data_agendamento` = '$currentDate'");

if ($consulta) {
    while ($linha = mysqli_fetch_assoc($consulta)) {
        $data[] = $linha;
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