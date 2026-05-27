<?php
require_once("../class/class_usuarios_dal.php");
$dal = new class_usuarios_dal();
$usuarios = $dal->read_usuarios();

echo json_encode(["data" => $usuarios]);
?>