<?php

//Conexión PHP
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "dlsVeterinaris";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Eliminación de un veterinario a partir del ID
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
        $deleteId = $_POST['delete_id'];
        $stmt = $conn->prepare("DELETE FROM Veterinario WHERE id = :id");
        $stmt->bindParam(':id', $deleteId);
        $stmt->execute();
        echo "Veterinario eliminado correctamente.<br>";
    }

    // Actualizar veterinario al clicar botón actualizar
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
        $updateId = $_POST['update_id'];
        $nombre = trim($_POST['nombre']);
        $experiencia = trim($_POST['experiencia']);
        $especialidad = trim($_POST['especialidad']);
        $licencia = trim($_POST['licencia']);
        $telefono = trim($_POST['telefono']);

        // La query interna funciona a partir del ID para actualizar.
        $stmt = $conn->prepare("UPDATE Veterinario SET nombre = :nombre, experiencia = :experiencia, 
                                especialidad = :especialidad, licencia = :licencia, telefono = :telefono 
                                WHERE id = :id");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':experiencia', $experiencia);
        $stmt->bindParam(':especialidad', $especialidad);
        $stmt->bindParam(':licencia', $licencia);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':id', $updateId);
        $stmt->execute();
        echo "Veterinario actualizado correctamente.<br>";
    }

    // Obtener todos los veterinarios existentes en la base de datos a partir de una query
    $stmt = $conn->query("SELECT * FROM Veterinario");
    //Se guarda la variable en $veterinarios para luego poder mostrarlo por pantalla con html
    $veterinarios = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Veterinarios</title>
</head>
<body>
<h1>Administrar Veterinarios</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Experiencia</th>
        <th>Especialidad</th>
        <th>Licencia</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($veterinarios as $veterinario):
    // Código para que salgan las celdas cuando muestras todos los veterinarios    
    ?>
    <tr>
        <td><?php echo $veterinario['id']; ?></td>
        <td><?php echo $veterinario['nombre']; ?></td>
        <td><?php echo $veterinario['experiencia']; ?></td>
        <td><?php echo $veterinario['especialidad']; ?></td>
        <td><?php echo $veterinario['licencia']; ?></td>
        <td><?php echo $veterinario['telefono']; ?></td>
        <td>
            <!-- Botón para eliminar directamente sin necesidad de especificar ID -->
            <form method="POST" style="display:inline;">
                <input type="hidden" name="delete_id" value="<?php echo $veterinario['id']; ?>">
                <button type="submit">Eliminar</button>
            </form>

            <!-- Botón para abrir desplegable para poder actualizar de una manera más sencilla -->
            <button onclick="document.getElementById('updateForm-<?php echo $veterinario['id']; ?>').style.display='block'">
                Actualizar
            </button>
            <div id="updateForm-<?php echo $veterinario['id']; ?>" style="display:none;">
                <form method="POST">
                    <?php 
                    //Al poner type HIDDEN hacemos que el usuario no pueda cambiar el ID del veterinario
                    ?>
                    <input type="hidden" name="update_id" value="<?php echo $veterinario['id']; ?>">
                    <label>Nombre: <input type="text" name="nombre" value="<?php echo $veterinario['nombre']; ?>" required></label><br>
                    <label>Experiencia: <input type="number" name="experiencia" value="<?php echo $veterinario['experiencia']; ?>" required></label><br>
                    <label>Especialidad: <input type="text" name="especialidad" value="<?php echo $veterinario['especialidad']; ?>" required></label><br>
                    <label>Licencia: <input type="text" name="licencia" value="<?php echo $veterinario['licencia']; ?>" required></label><br>
                    <label>Teléfono: <input type="number" name="telefono" value="<?php echo $veterinario['telefono']; ?>" required></label><br>
                    <button type="submit">Guardar Cambios</button>
                </form>
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<button type="button" onclick="window.location.href='Formulari.php';">Añadir Veterinario</button>
</body>
</html>
