<?php
$servername = "localhost";
$username = "id21264648_databasesaude";
$password = "MaTeRiAiS01?";
$database = "id21264648_databasesaude";

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['btnAdicionar'])) {
    // Retrieve values from input fields
    $nomeMaterial = $_POST['nomeMaterial'];
    $tipoMaterial = $_POST['tipoMaterial'];
    $qtdMaterial = $_POST['qtdMaterial'];

    // Create the INSERT query with placeholders
    $insert = "INSERT INTO MATERIAIS (NOME, QUANTIDADE, TIPO_DE_MATERIAL) VALUES (?, ?, ?)";
    
    // Prepare and execute the query with prepared statements
    $stmt = mysqli_prepare($connection, $insert);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ssi", $nomeMaterial, $qtdMaterial, $tipoMaterial);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Materiais cadastrados com sucesso!";
        } else {
            echo "Erro ao cadastrar o material: " . mysqli_error($connection);
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro ao cadastrar o material: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);
?>
