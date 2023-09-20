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

echo '<table><tr>
        <th>Código</th>      
        <th>Nome</th>
        <th>Quantidade</th>
        <th>Tipo de material</th>
    </tr>
    <tbody>';
$consulta = mysqli_query($connection, "SELECT * FROM materiais");

while ($linha = mysqli_fetch_array($consulta)){
    echo '<tr><td>'.$linha['id'].'</td>';
    echo '<td>'.$linha['nome'].'</td>';
    echo '<td>'.$linha['quantidade'].'</td>';
    echo '<td>'.$linha['tipo_material'].'</td></tr>';
    }
echo '</tbody></table>';


?>

