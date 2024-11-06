<?php
include 'Veterinario.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre'], $_POST['experiencia'], $_POST['especialidad'], $_POST['licencia'], $_POST['telefono'])) {
        $servername = "localhost";
        $username = "root";
        $password = "1234";
        $dbname = "dlsVeterinaris";

        try {
            // Conectar a la base de datos
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Crear una instancia de la clase Veterinario
            $veterinario = new Veterinario(
                trim($_POST['nombre']),
                trim($_POST['experiencia']),
                trim($_POST['especialidad']),
                trim($_POST['licencia']),
                trim($_POST['telefono'])
            );

            // Guardar el veterinario creado a partir de la clase en la base de datos
            $veterinario->guardar($conn);

            // Redirigir después de guardar
            header("Location: Formulari.php");
            exit();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
    } else {
        echo "Error: Datos del formulario no recibidos.";
    }
} else {
    echo "Error: El formulario no se ha enviado correctamente.";
}
?>
