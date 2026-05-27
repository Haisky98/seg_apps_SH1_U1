<?php
session_start();
require_once("../class/class_usuarios_dal.php");

$dal = new class_usuarios_dal();
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$usuario = $dal->get_usuario_by_username($username);

if ($usuario && password_verify($password, $usuario['password_segura'])) {
    session_regenerate_id(true); 
    $_SESSION['user_id'] = $usuario['id'];
    $_SESSION['username'] = $usuario['username'];
    
    echo json_encode(['bool' => true, 'mensaje' => 'Acceso Concedido']);
} else {
    echo json_encode(['bool' => false, 'mensaje' => 'Usuario o contraseña incorrectos']);
}
exit;