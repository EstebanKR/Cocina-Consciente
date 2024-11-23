<?php
include("ConexionBE.php");


// Limpiar y encriptar datos
$telefono = mysqli_real_escape_string($conexion, trim($_POST["telefono"]));
$pasword = mysqli_real_escape_string($conexion, trim($_POST["password"]));
$pasword = hash('sha512', $pasword); // Encriptar la contraseña ingresada

// Depuración: muestra los datos ingresados
echo "Teléfono ingresado: $telefono<br>";
echo "Contraseña encriptada ingresada: $pasword<br>";


        // Validar que el número de teléfono contenga solo dígitos
        if (!ctype_digit($telefono)) {
            echo '
                <script>
                    alert("El campo de teléfono solo puede contener números.");
                    window.location = "../index.php"; // Redirige al formulario de registro
                </script>
            ';
            exit();
        }


// Consulta a la base de datos con prepared statements
$query = "SELECT * FROM Usuarios WHERE Telefono=? AND Pasword=?";
$stmt = mysqli_prepare($conexion, $query);
mysqli_stmt_bind_param($stmt, "ss", $telefono, $pasword);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Verificar si el usuario existe
if (mysqli_num_rows($resultado) > 0) {
    echo '
        <script>
            alert("Inicio de sesión exitoso. ¡Bienvenido!");
            window.location = "../index.html";
        </script>
    ';
    exit();
} else {
    echo '
        <script>
            alert("Teléfono o contraseña incorrectos. Intenta de nuevo.");
            window.location = "../index.php";
        </script>
    ';
}

mysqli_close($conexion);
?>
