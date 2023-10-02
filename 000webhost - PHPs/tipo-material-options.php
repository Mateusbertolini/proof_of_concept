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

// Initialize an array to store the distinct values
$distinctValues = array();

// Fetch distinct values from the database
$consulta = mysqli_query($connection, "SELECT DISTINCT tipo_material FROM materiais");

if ($consulta) {
    while ($linha = mysqli_fetch_assoc($consulta)) {
        $distinctValues[] = $linha['tipo_material'];
    }

    // Generate the HTML options dynamically
    $optionsHTML = '';
    foreach ($distinctValues as $value) {
        $optionsHTML .= '<option value="' . htmlspecialchars($value) . '">' . htmlspecialchars($value) . '</option>';
    }

    // Output the HTML options
    echo $optionsHTML;
} else {
    // Handle the error gracefully and return an error JSON response
    $error = array("error" => "Database query error: " . mysqli_error($connection));
    echo json_encode($error);
}

// Close the database connection
mysqli_close($connection);
?>
