<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Veterinario</title>
    <link rel="stylesheet" href="Formulari.css">
</head>
<body>  
<div>
<!-- Formulario para que el usuario introduzca datos (front end) -->
    <h1>Introduzca los datos del Veterinario</h1>
    <form id="formulario" action="IntroducirDatos.php" method="POST">
        <div>
            <h2>Información del Veterinario</h2>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-input" required/>

            <label for="experiencia">Experiencia (Años)</label>
            <input type="number" name="experiencia" class="form-input" required/>

            <label for="especialidad">Especialidad</label>
            <input type="text" name="especialidad" class="form-input" required/>

            <label for="licencia">Licencia</label>
            <input type="text" name="licencia" class="form-input" required/>

            <label for="telefono">Teléfono</label>
            <input type="number" name="telefono" class="form-input" required/>
        </div>

        <div>
            <button type="submit">Enviar</button>
            <button type="button" onclick="window.location.href='AdministrarVeterinarios.php';">Administrar Veterinarios</button>
        </div>
    </form>
</div>
</body>
</html>

