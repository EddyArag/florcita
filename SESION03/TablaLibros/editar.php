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

// Obtener los datos actuales del libro
$sql = "SELECT * FROM libros WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

<!-- Formulario para editar los datos -->
<form action="actualizar.php?id=<?php echo $id; ?>" method="POST">
    <label>Nombre del Libro:</label>
    <input type="text" name="nombre_libro" value="<?php echo $row['nombre_libro']; ?>" required><br>
    <label>Autor:</label>
    <input type="text" name="autor" value="<?php echo $row['autor']; ?>" required><br>
    <label>ISBN:</label>
    <input type="text" name="isbn" value="<?php echo $row['isbn']; ?>" required><br>
    <label>Descripción:</label>
    <textarea name="descripcion" required><?php echo $row['descripcion']; ?></textarea><br>
    <button type="submit">Actualizar</button>
</form>

<?php
} else {
    echo "Libro no encontrado";
}

$conn->close();
?>
