<?php

class MPerfil
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getConexion();
    }

    function show($id)
    {
        $data = null;

        $sql = "SELECT * FROM `perfil_usuario` WHERE id_usuario = ?";

        $query = $this->db->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $resultado = $query->get_result();

        if ($row = $resultado->fetch_assoc())
            $data = $row;

        $query->close();

        return $data;
    }

    function update($nickname, $saldo, $id)
    {
        $sql = "UPDATE `perfil_usuario` SET `nickname` = ?, `saldo` = ? WHERE `perfil_usuario`.`id_usuario` = ?";
        $query = $this->db->prepare($sql);

        $query->bind_param("sdi", $nickname, $saldo, $id);

        $query->execute();

        $query->close();
    }
}
