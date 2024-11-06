CREATE DATABASE if NOT EXISTS dlsVeterinaris;

USE dlsVeterinaris;

CREATE TABLE Veterinario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    experiencia INT,
    especialidad VARCHAR(50),
    licencia VARCHAR(50),
    telefono VARCHAR(50)

);