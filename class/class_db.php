<?php

/**
 * Clase para la conexión a la base de datos
 */
if (class_exists('class_db') != true) {
    class class_db
    {
        private $db_conn;
        private $db_name;
        private $db_query;

        public function __construct()
        {
         
            $host = "db"; 
            $user = "root";
            $passwd = "root";
            $db = "sistema_auth"; 
            $port = 3306;
           

            $this->set_db($host, $user, $passwd, $db, $port);
        }

        public function __destruct()
        {
            $this->close_db();
        }

        private function set_db($host, $user, $passwd, $db, $port)
        {
            $this->db_conn = mysqli_connect($host, $user, $passwd, $db, $port);

            if (!$this->db_conn) {
                throw new Exception("Error en la conexión: " . mysqli_connect_error());
            }

            $this->db_name = $db;
            mysqli_set_charset($this->db_conn, "utf8mb4");
        }

        public function close_db()
        {
            if ($this->db_conn) {
                mysqli_close($this->db_conn);
            }
        }

        public function set_sql($sql)
        {
            $this->db_query = $sql;
        }

        public function ejecutar_query($params = [])
            {
            if (!$this->db_conn) {
                return json_encode([
                    "bool" => false,
                    "error" => "No hay conexión a la base de datos."
                ]);
            }

            // Compatibilidad con PHP 5 *********
            if (version_compare(PHP_VERSION, '7.0.0', '<')) {

                mysqli_set_charset($this->db_conn, "utf8"); // Asegurar codificación correcta

                if (preg_match('/^\s*(INSERT|UPDATE|DELETE|SELECT|SHOW|DESCRIBE|EXPLAIN)\s/i', $this->db_query)) {

                    $stmt = mysqli_prepare($this->db_conn, $this->db_query);
                    if ($stmt === false) {
                        return json_encode(array(
                            "bool" => false,
                            "error" => "Error al preparar la consulta: " . mysqli_error($this->db_conn)
                        ));
                    }

                    if (!empty($params)) {
                        $tipos = str_repeat("s", count($params)); // asumimos strings
                        // PHP 5 no permite bind_param con array directo
                        $bind_names[] = $tipos;
                        for ($i = 0; $i < count($params); $i++) {
                            $bind_name = 'bind' . $i;
                            $$bind_name = $params[$i];
                            $bind_names[] = &$$bind_name;
                        }
                        call_user_func_array(array($stmt, 'bind_param'), $bind_names);
                    }

                    // Ejecutar la consulta
                    try {
                        $ok_exec = mysqli_stmt_execute($stmt);
                    } catch (Exception $e) {
                        return json_encode(array(
                            "bool" => false,
                            "error" => "Error al ejecutar consulta: " . $e->getMessage()
                        ));
                    }
                    if (!$ok_exec) {
                        return json_encode(array(
                            "bool" => false,
                            "error" => "Error al ejecutar consulta: " . mysqli_stmt_error($stmt)
                        ));
                    }

                    if (preg_match('/^\s*INSERT\s/i', $this->db_query)) {
                        return json_encode(array(
                            "bool" => true,
                            "id_insertado" => mysqli_insert_id($this->db_conn) // Obtener el ID de inserción
                        ));
                    }

                    if (preg_match('/^\s*(UPDATE|DELETE)\s/i', $this->db_query)) {
                        return json_encode(array(
                            "bool" => true,
                            "filas_afectadas" => mysqli_stmt_affected_rows($stmt)  // Número de filas afectadas
                        ));
                    }

                    if (preg_match('/^\s*(SELECT|SHOW|DESCRIBE|EXPLAIN)\s/i', $this->db_query)) {
                        mysqli_stmt_store_result($stmt);

                        $meta = mysqli_stmt_result_metadata($stmt);
                        $fields = array();
                        $row = array();
                        $results = array();

                        while ($field = mysqli_fetch_field($meta)) {
                            $fields[] = &$row[$field->name];
                        }

                        call_user_func_array(array($stmt, 'bind_result'), $fields);

                        while (mysqli_stmt_fetch($stmt)) {
                            $c = array();
                            foreach ($row as $key => $val) {
                                $c[$key] = $val;
                            }
                            $results[] = $c;
                        }

                        return json_encode(array(
                            "bool" => true,
                            "data" => $results
                        ));
                    }

                    return json_encode(array("bool" => true));
                }
            }
            // Para PHP 7 y versiones superiores ***********
            else {
                mysqli_set_charset($this->db_conn, "utf8mb4"); // Asegurar codificación correcta

                // Verificar si es una consulta preparada
                if (preg_match('/^\s*(INSERT|UPDATE|DELETE|SELECT|SHOW|DESCRIBE|EXPLAIN)\s/i', $this->db_query)) {

                    //**Preparar la consulta y evitar sql injection*
                    $stmt = $this->db_conn->prepare($this->db_query);

                    if ($stmt === false) {
                        return json_encode([
                            "bool" => false,
                            "error" => "Error al preparar la consulta: " . mysqli_error($this->db_conn)
                        ]);
                    }

                    // Verifica que $params no esté vacío antes de bind_param
                    if (!empty($params)) {
                        $tipos = str_repeat("s", count($params)); // Asumimos que todos los valores son strings
                        // Compatibilidad con versiones que no soportan operador ... y asegurar referencias
                        $bind_values = array_values($params);
                        $refs = [];
                        foreach ($bind_values as $k => $v) {
                            $refs[$k] = &$bind_values[$k];
                        }
                        array_unshift($refs, $tipos);
                        call_user_func_array([$stmt, 'bind_param'], $refs);
                    }
                    /* solo descomentar este else en dado caso que no se pase no este pasando ningun parametro si se quita el comentario no va a permitir ejecutar 
            la consulta SELECT 
            else {
                return json_encode([
                    "bool" => false,
                    "error" => "No se proporcionaron parámetros para la consulta."
                ]);
            }*/

                    // **Ejecutar la consulta**
                    try {
                        $ok_exec = $stmt->execute();
                    } catch (\mysqli_sql_exception $e) {
                        // Devolver JSON con el error en lugar de permitir que la excepción llegue arriba
                        return json_encode([
                            "bool" => false,
                            "error" => "Error al ejecutar consulta: " . $e->getMessage()
                        ]);
                    }
                    if (!$ok_exec) {
                        return json_encode([
                            "bool" => false,
                            "error" => "Error al ejecutar consulta: " . $stmt->error
                        ]);
                    }

                    // Para los casos de INSERT
                    if (preg_match('/^\s*INSERT\s/i', $this->db_query)) {
                        return json_encode([
                            "bool" => true,
                            "id_insertado" => $this->db_conn->insert_id // Obtener el ID de inserción
                        ]);
                    }

                    // Para UPDATE y DELETE
                    if (preg_match('/^\s*(UPDATE|DELETE)\s/i', $this->db_query)) {
                        return json_encode([
                            "bool" => true,
                            "filas_afectadas" => $stmt->affected_rows // Número de filas afectadas
                        ]);
                    }

                    // Para SELECT, SHOW, DESCRIBE, EXPLAIN
                    if (preg_match('/^\s*(SELECT|SHOW|DESCRIBE|EXPLAIN)\s/i', $this->db_query)) {
                        $result = $stmt->get_result();
                        $data = [];
                        while ($row = mysqli_fetch_assoc($result)) {
                            $data[] = $row;
                        }
                        return json_encode([
                            "bool" => true,
                            "data" => $data
                        ], JSON_UNESCAPED_UNICODE); //elemental para caracteres especiales
                    }

                    return json_encode(["bool" => true]);
                }
            }

            return json_encode([
                "bool" => false,
                "error" => "Consulta no válida"
            ]);
        }

        public function iniciar_transaccion()
        {
            if (version_compare(PHP_VERSION, '7.0.0', '<')) {
                mysqli_autocommit($this->db_conn, false);
            } else {
                mysqli_begin_transaction($this->db_conn);
            }
        }

        public function commit()
        {
            if (version_compare(PHP_VERSION, '7.0.0', '<')) {
                mysqli_commit($this->db_conn);
                mysqli_autocommit($this->db_conn, true);
            } else {
                mysqli_commit($this->db_conn);
            }
        }

        public function rollback()
        {
            if (version_compare(PHP_VERSION, '7.0.0', '<')) {
                echo "Estoy en PHP " . PHP_VERSION . " (menor a 7)";
            } else {
                mysqli_rollback($this->db_conn);
                mysqli_autocommit($this->db_conn, true);
            }
        }

        // MÉTODO VULNERABLE PARA CLASE (NO USAR EN PRODUCCIÓN)
        public function ejecutar_query_inseguro($sql)
        {
            if (!$this->db_conn) {
                return json_encode(["bool" => false, "error" => "No conexión"]);
            }
            
            // AQUÍ ESTÁ EL PELIGRO: Ejecutamos el SQL tal cual viene
            $result = mysqli_query($this->db_conn, $sql);
            
            if (!$result) {
                return json_encode(["bool" => false, "error" => mysqli_error($this->db_conn)]);
            }

            // Si es un SELECT, devolvemos los datos
            if ($result instanceof mysqli_result) {
                $data = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
                return json_encode(["bool" => true, "data" => $data]);
            }

            return json_encode(["bool" => true]);
        }
    }
}
