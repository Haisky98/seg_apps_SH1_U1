<?php
include_once("class_db.php");

class class_usuarios_dal extends class_db
{
    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        parent::__destruct();
    }

    function create_usuario($username, $password_insegura, $password_segura)
    {
        $sql = "INSERT INTO usuarios (
                    username,
                    password_insegura,
                    password_segura
                ) VALUES (?, ?, ?)";

        $this->set_sql($sql);

        $params = [
            $username,
            $password_insegura,
            $password_segura
        ];

        $json_result = $this->ejecutar_query($params);
        $result = json_decode($json_result, true);


        if (!$result['bool']) {
            error_log("Error DB: " . ($result['error'] ?? 'Desconocido')); 
        }

        return (is_array($result) && isset($result['bool']) && $result['bool'] === true) ? 1 : 0;
    }

    function read_usuarios()
    {
        $sql = "SELECT * FROM usuarios";

        $this->set_sql($sql);

        $json_result = $this->ejecutar_query([]);

        $result = json_decode($json_result, true);

        if (!$result['bool'] || count($result['data']) == 0) {
            return null;
        }

        $lista = [];
        foreach ($result['data'] as $renglon) {
            $obj = new stdClass();
            $obj->id = $renglon['id'];
            $obj->username = $renglon['username'];
            $obj->password_insegura = $renglon['password_insegura'];
            $obj->password_segura = $renglon['password_segura'];
            $lista[] = $obj;
        }

        return $lista;
    }

    function update_usuario($id, $username, $password_nueva)
    {
        if (empty($password_nueva)) {
            $sql = "UPDATE usuarios SET username = ? WHERE id = ?";
            $params = [$username, $id];
        } else {
          
            $insegura = hash('sha256', $password_nueva);
            $segura = password_hash($password_nueva, PASSWORD_DEFAULT);
            
            $sql = "UPDATE usuarios SET username = ?, password_insegura = ?, password_segura = ? WHERE id = ?";
            $params = [$username, $insegura, $segura, $id];
        }

        $this->set_sql($sql);
        $result = json_decode($this->ejecutar_query($params), true);
        return (isset($result['bool']) && $result['bool'] === true) ? 1 : 0;
    }

    function login_inseguro_vulnerable($username)
    {
        $sql = "SELECT * FROM usuarios WHERE username = '$username'";
      
        $json_result = $this->ejecutar_query_inseguro($sql);
        $result = json_decode($json_result, true);

        if ($result['bool'] && count($result['data']) > 0) {
            return $result['data'][0];
        }
        return null;
    }

    function delete_usuario($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $this->set_sql($sql);
        $result = json_decode($this->ejecutar_query([$id]), true);
        return (isset($result['bool']) && $result['bool'] === true) ? 1 : 0;
    }

    function get_usuario_by_username($username)
    {
        $sql = "SELECT id, username, password_insegura, password_segura FROM usuarios WHERE username = ?";
        $this->set_sql($sql);
        $json_result = $this->ejecutar_query([$username]);
        $result = json_decode($json_result, true);

        if ($result['bool'] && count($result['data']) > 0) {
            return $result['data'][0]; // Retorna el arreglo con los datos del usuario
        }
        return null; // Usuario no encontrado o error
    }
    
}
?>