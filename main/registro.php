<?php
// Configuración de conexión a la base de datos
$host = "localhost"; // Cambia esto si tu servidor es diferente
$usuario = "root"; // Cambia por tu usuario de MySQL
$contraseña = ""; // Cambia por tu contraseña de MySQL
$nombre_base_datos = "BD_pagina_web"; // Cambia por el nombre de tu base de datos

// Crear conexión
$conexion = new mysqli($host, $usuario, $contraseña, $nombre_base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['user_name'];
$contrasena = $_POST['user_password'];
$confirmar_contrasena = $_POST['user_passaword_confirm'];

// Validar que las contraseñas coincidan
if ($contrasena !== $confirmar_contrasena) {
    die("Las contraseñas no coinciden.");
}

// Preparar la consulta
$sql = "INSERT INTO usuarios (nombre, contrasena) VALUES (?, ?)";

// Preparar y ejecutar la declaración
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $nombre, $contrasena); // "ss" indica que ambos parámetros son cadenas

if ($stmt->execute()) {
    echo "Registro exitoso.";
} else {
    echo "Error: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();
?>

