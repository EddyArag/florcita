<?php
$servername = "localhost";  // Cambia si es necesario
$username = "root";         // Usuario de MySQL
$password = "";             // Contraseña de MySQL
$dbname = "biblioteca";     // Tu base de datos

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['username'];
    $contrasena = md5($_POST['password']);  // Puedes usar password_hash() para mayor seguridad

    // Consulta SQL para verificar si el usuario existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario='$nombre_usuario' AND contrasena='$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si se encuentra el usuario
        echo "Inicio de sesión exitoso. Bienvenido, $nombre_usuario!";
        // Aquí puedes redirigir al usuario o iniciar sesión con $_SESSION
    } else {
        // Si no se encuentra el usuario
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}

$conn->close();
?>
