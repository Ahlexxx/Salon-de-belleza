<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($contrasena, $row['contrasena'])) {
            $_SESSION['usuario'] = $usuario;
            echo json_encode(["success" => true, "message" => "Inicio de sesión exitoso"]);
            exit();
        } else {
            echo json_encode(["success" => false, "message" => "Usuario o contraseña incorrectos"]);
            exit();
        }
    } else {
        echo json_encode(["success" => false, "message" => "Usuario o contraseña incorrectos"]);
        exit();
    }
}
?>
