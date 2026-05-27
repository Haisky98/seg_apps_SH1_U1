<?php
require_once("../class/class_usuarios_dal.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dal = new class_usuarios_dal();
    
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo json_encode(['bool' => false, 'mensaje' => 'Campos incompletos']);
        exit;
    }

    $insegura = hash('sha256', $password);
    $segura = password_hash($password, PASSWORD_DEFAULT);
   
    $resultado = $dal->create_usuario($username, $insegura, $segura);

    if ($resultado) {
        echo json_encode(['bool' => true, 'mensaje' => '¡Usuario registrado correctamente!']);
    } else {
        echo json_encode(['bool' => false, 'mensaje' => 'Error al guardar en la base de datos']);
    }
}
?>