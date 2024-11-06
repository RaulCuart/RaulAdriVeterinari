<?php

/**
 * Clase Veterinario
 */
class Veterinario {
    protected $nombre;
    protected $experiencia; // Años de experiencia
    protected $especialidad;
    protected $licencia;
    protected $telefono;

    
    //Constructor de la clase Veterinario
    public function __construct($nombre, $experiencia, $especialidad, $licencia, $telefono) {
        if (!is_numeric($experiencia) || $experiencia < 0) {
            throw new InvalidArgumentException("La experiencia debe ser un número no negativo.");
        }

        $this->nombre = $nombre;
        $this->experiencia = $experiencia;
        $this->especialidad = $especialidad;
        $this->licencia = $licencia;
        $this->telefono = $telefono;
    }

    //Guardar el veterinario en la base de datos.
    public function guardar($conn) {
        $stmt = $conn->prepare("INSERT INTO Veterinario (nombre, experiencia, especialidad, licencia, telefono) 
                                 VALUES (:nombre, :experiencia, :especialidad, :licencia, :telefono)");
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':experiencia', $this->experiencia);
        $stmt->bindParam(':especialidad', $this->especialidad);
        $stmt->bindParam(':licencia', $this->licencia);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->execute();
    }
}
?>

