<?php
require_once("../class/class_usuarios_dal.php");
if ($_POST['id']) {
    $dal = new class_usuarios_dal();
    $dal->delete_usuario($_POST['id']);
}
?>