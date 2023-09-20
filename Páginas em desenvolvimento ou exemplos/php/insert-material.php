<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set
    if (isset($_POST['nomeMaterial']) && isset($_POST['tipoMaterial']) && isset($_POST['qtdMaterial'])) {
        // Retrieve form data
        $nomeMaterial = $_POST['nomeMaterial'];
        $tipoMaterial = $_POST['tipoMaterial'];
        $qtdMaterial = $_POST['qtdMaterial'];

        // Print the form data
        echo "nomeMaterial: " . $nomeMaterial . "<br>";
        echo "tipoMaterial: " . $tipoMaterial . "<br>";
        echo "qtdMaterial: " . $qtdMaterial . "<br>";
    } else {
        echo "One or more form fields are missing.";
    }
} else {
    // Handle the case where the form was not submitted
    echo "Form not submitted.";
}
