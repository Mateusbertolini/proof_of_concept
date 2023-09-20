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
#TABELA MATERIAIS (ID, NOME, QUANTIDADE, DATA DE VALIDADE, DATA DE ENTRADA, DATA DE SAÍDA, TIPO DE MATERIAL, OBSERVAÇÕES)

$sql = "CREATE TABLE materiais (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(30) NOT NULL,
    quantidade INT(6) NOT NULL,
    data_validade DATE,
    data_entrada DATE,
    data_saida DATE,
    tipo_material VARCHAR(30),
    observacoes VARCHAR(30)
    )";

$execute = mysqli_query($connection, $sql);
if ($execute){
    echo "Table created";
}else{
    echo "Error";
}

#TABELA PROCEDIMENTOS SUS (ID, CodSUS, NOME, COMPLEXIDADE, DATA DO PROCEDIMENTO, NUMERO DE PROCEDIMENTOS)

$sql = "CREATE TABLE procedimentos_sus (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cod_sus INT(6) NOT NULL,
    nome VARCHAR(30) NOT NULL,
    complexidade VARCHAR(30) NOT NULL,
    data_procedimento DATE,
    numero_procedimentos INT(6) NOT NULL
    )";

$execute = mysqli_query($connection, $sql);
if ($execute){
    echo "Table created";
}else{
    echo "Error";
}


?>