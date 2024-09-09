<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca"; // Asegúrate de que esta sea la base de datos correcta

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// OPERACIÓN: Crear Usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['crear_usuario'])) {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = md5($_POST['contrasena']);  // Hashear la contraseña para mayor seguridad

    $sql = "INSERT INTO usuarios (nombre_usuario, contrasena) VALUES ('$nombre_usuario', '$contrasena')";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario creado exitosamente.";
    } else {
        echo "Error al crear usuario: " . $conn->error;
    }
}

// OPERACIÓN: Eliminar Usuario
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $sql = "DELETE FROM usuarios WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado exitosamente.";
    } else {
        echo "Error al eliminar usuario: " . $conn->error;
    }
}

// OPERACIÓN: Leer Usuarios (listar)
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

echo "<h2>Gestión de Usuarios</h2>";
if ($result->num_rows > 0) {
    echo "<table border='1'>
        <tr>
            <th>Nombre de Usuario</th>
            <th>Acciones</th>
        </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["nombre_usuario"] . "</td>
            <td>
                <a href='crud.php?editar=" . $row["id"] . "'>Editar</a>
                <a href='crud.php?eliminar=" . $row["id"] . "'>Eliminar</a>
            </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "No hay usuarios registrados.";
}

// OPERACIÓN: Formulario de creación de usuario
?>

<h3>Crear Nuevo Usuario</h3>
<form method="POST" action="crud.php">
    <input type="text" name="nombre_usuario" placeholder="Nombre de usuario" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <input type="submit" name="crear_usuario" value="Registrar">
</form>

<?php
// OPERACIÓN: Actualizar Usuario
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $sql = "SELECT * FROM usuarios WHERE id='$id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
    ?>
    <h3>Editar Usuario</h3>
    <form method="POST" action="crud.php?actualizar=<?php echo $id; ?>">
        <input type="text" name="nombre_usuario" value="<?php echo $user['nombre_usuario']; ?>" required>
        <input type="password" name="contrasena" placeholder="Nueva contraseña" required>
        <input type="submit" value="Actualizar">
    </form>
    <?php
}

if (isset($_GET['actualizar'])) {
    $id = $_GET['actualizar'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = md5($_POST['contrasena']);

    $sql = "UPDATE usuarios SET nombre_usuario='$nombre_usuario', contrasena='$contrasena' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado exitosamente.";
    } else {
        echo "Error al actualizar usuario: " . $conn->error;
    }
}

$conn->close();
?>
