<?php
#CONEXÃO COM O BANCO DE DADOS
$servername = "localhost";
$username = "id21264648_databasesaude";
$password = "MaTeRiAiS01?";
$database = "id21264648_databasesaude";

$connection = mysqli_connect($servername, $username, $password, $database);

$query = "SELECT * FROM materiais";
$consulta = mysqli_query($connection, $query);