<?php
header('Content-Type: application/json');

include('db.php'); 

$response = ['success' => false, 'message' => 'Error al registrar el usuario.'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    $query = "INSERT INTO usuarios (usuario, contrasena, nombre, apellidos, cedula, telefono) VALUES ('$usuario', '$contrasena', '$nombre', '$apellidos', '$cedula', '$telefono')";
    if (mysqli_query($conexion, $query)) {
        $response['success'] = true;
        $response['message'] = 'Registro exitoso.';
    } else {
        $response['message'] = 'Error: ' . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}

echo json_encode($response);
?>



