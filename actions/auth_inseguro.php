<?php
require_once("../class/class_usuarios_dal.php");
$dal = new class_usuarios_dal();

$username = $_POST['username'] ?? ''; 

$usuario = $dal->login_inseguro_vulnerable($username);

if ($usuario) {
    session_start();
    $_SESSION['user_id'] = $usuario['id'];
    echo json_encode(['bool' => true, 'mensaje' => 'Acceso Concedido']);
} else {
    echo json_encode(['bool' => false, 'mensaje' => 'Acceso Denegado']);
}
exit;