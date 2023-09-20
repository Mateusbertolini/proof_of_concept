<?php

#CONEXÃO COM O BANCO DE DADOS
$servername = "localhost";
$username = "id21264648_databasesaude";
$password = "MaTeRiAiS01?";
$database = "id21264648_databasesaude";

$connection = mysqli_connect($servername, $username, $password, $database);

if ($connection){
    echo "Connected";
}else{
    echo "Error";
}

#CRIAR UMA TABELA USANDO PHP
#TABELA MATERIAIS (ID, NOME, QUANTIDADE, TIPO DE MATERIAL)

$insert = "INSERT INTO MATERIAIS (NOME, QUANTIDADE, TIPO DE MATERIAL) VALUES ('MATERIAL 1', 1, 'TIPO 1')";

#TABELA PROCEDIMENTOS SUS (ID, CodSUS, NOME, COMPLEXIDADE, DATA DO PROCEDIMENTO, NUMERO DE PROCEDIMENTOS)

$insert = "INSERT INTO PROCEDIMENTOS SUS (CodSUS, NOME, COMPLEXIDADE, DATA DO PROCEDIMENTO, NUMERO DE PROCEDIMENTOS) VALUES ('000000000000000', 'PROCEDIMENTO 1', 'COMPLEXIDADE 1', '2019-01-01', 1)";

?>