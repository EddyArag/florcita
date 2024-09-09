<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";  // Asegúrate de que sea tu base de datos
// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// Consultar la base de datos
$sql = "SELECT * FROM libros";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
        <tr>
            <th>Nombre del Libro</th>
            <th>Autor</th>
            <th>ISBN</th>
            <th>Descripción</th>
            <th>Eliminar</th>
            <th>Modificar</th>
        </tr>";
    
    // Mostrar los datos
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["nombre_libro"] . "</td>
            <td>" . $row["autor"] . "</td>
            <td>" . $row["isbn"] . "</td>
            <td>" . $row["descripcion"] . "</td>
            <td><a href='eliminar.php?id=" . $row["id"] . "'>Eliminar</a></td>
            <td><a href='editar.php?id=" . $row["id"] . "'>Editar</a></td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "No hay libros registrados";
}

$conn->close();
?>
