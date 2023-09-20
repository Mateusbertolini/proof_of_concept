<?php

#CONEXÃO COM O BANCO DE DADOS
$servername = "localhost";
$username = "id21264648_databasesaude";
$password = "MaTeRiAiS01?";
$database = "id21264648_databasesaude";

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully<br>";

// Assuming you have a variable $selectedId containing the ID you want to delete
$selectedId = 25; // Replace with your actual selected ID

$deleteQuery = "DELETE FROM materiais WHERE ID = $selectedId";

if (mysqli_query($connection, $deleteQuery)) {
    echo "Record with ID $selectedId deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($connection);
}

mysqli_close($connection);
?>