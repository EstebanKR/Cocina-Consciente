<?php
include("ConexionBE.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $pasword = hash('sha512', $_POST["password"]); // Contraseña encriptada

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

    // Verificar que el correo no se repita en la base de datos
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM Usuarios WHERE Correo='$correo'");

    if (mysqli_num_rows($verificar_correo) > 0) {
        echo '
            <script>
                alert("Ya está registrado este correo en la plataforma. Intenta con otro.");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    // Insertar variables en la tabla Usuarios
    $query = "INSERT INTO Usuarios(`Nombre`, `Correo`, `Telefono`, `Pasword`) VALUES ('$nombre', '$correo', '$telefono', '$pasword')";
    $ejecutar = mysqli_query($conexion, $query);

    if ($ejecutar) {
        echo '
            <script>
                alert("Registro Exitoso");
                window.location = "../index.php";
            </script>
        ';
    } else {
        echo '
            <script>
                alert("Hubo un error al registrar el usuario. Intenta nuevamente.");
            </script>
        ';
    }

    mysqli_close($conexion);
}
?>
