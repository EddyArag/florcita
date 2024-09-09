<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del libro a eliminar
$id = $_GET['id'];

// Eliminar el libro de la base de datos
$sql = "DELETE FROM libros WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Libro eliminado exitosamente";
    header("Location: index.php");  // Redirigir a la página principal
} else {
    echo "Error al eliminar el libro: " . $conn->error;
}

$conn->close();
?>
