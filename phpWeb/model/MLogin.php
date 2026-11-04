<?php

class MLogin
{

    private $db;

    public function __construct()
    {
        $this->db = DB::getConexion();
    }

    function login($usuario, $password)
    {
        $data = null;

        $query = $this->db->prepare("SELECT * FROM usuarios WHERE nombre = ?");
        $query->bind_param("s", $usuario);
        $query->execute();

        $result = $query->get_result();

        $query->close();

        if ($row = $result->fetch_assoc()) {
            $data = $row;
            if (password_verify($password, $data["contrasenia"])) {
                return $data;
            }
        }

        return null;
    }
}
