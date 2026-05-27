<?php
require_once("../class/class_usuarios_dal.php");
$dal = new class_usuarios_dal();

$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'] ?? '';

$resultado = $dal->update_usuario($id, $username, $password);

echo json_encode(['bool' => $resultado]);