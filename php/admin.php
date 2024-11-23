<?php
// Incluir el archivo de conexión a la base de datos
include 'ConexionBE.php';

// Consulta SQL para obtener todos los usuarios
$sql = "SELECT * FROM Usuarios";
$result = $conexion->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los usuarios en una tabla HTML
    echo "<table border='1'>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Pasword</th>
                <th>rol</th>
            </tr>";

    // Recorrer los resultados y mostrarlos en filas de la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['Nombre'] . "</td>
                <td>" . $row['Correo'] . "</td>
                <td>" . $row['Telefono'] . "</td>
                <td>" . $row['Pasword'] . "</td>
                <td>" . $row['rol'] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron usuarios.";
}

// Cerrar la conexión
$conn->close();
?>
