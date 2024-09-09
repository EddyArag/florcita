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

$id = $_GET['id'];
$nombre_libro = $_POST['nombre_libro'];
$autor = $_POST['autor'];
$isbn = $_POST['isbn'];
$descripcion = $_POST['descripcion'];

// Actualizar el libro en la base de datos
$sql = "UPDATE libros SET nombre_libro='$nombre_libro', autor='$autor', isbn='$isbn', descripcion='$descripcion' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Libro actualizado exitosamente";
    header("Location: index.php");  // Redirigir a la página principal
} else {
    echo "Error al actualizar el libro: " . $conn->error;
}

$conn->close();
?>
