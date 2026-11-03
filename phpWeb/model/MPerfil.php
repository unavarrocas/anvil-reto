<?php

class MPerfil
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getConexion();
    }

    function index()
    {
        $data = null;
        $sql = "SELECT * FROM `perfil_usuario`";

        $query = $this->db->query($sql);

        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }

        $query->close();

        return  $data;
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

    function store($id, $nickname, $saldo)
    {
        $sql = "INSERT INTO `perfil_usuario` (`id_usuario`, `nickname`, `saldo`)
        VALUES (?, ?, ?)";

        $query = $this->db->prepare($sql);

        $query->bind_param("isd", $id, $nickname, $saldo);

        $query->execute();

        $query->close();
    }

    function update($nickname, $saldo, $id)
    {
        $sql = "UPDATE `perfil_usuario` SET `nickname` = ?, `saldo` = ? WHERE `perfil_usuario`.`id_usuario` = ?";
        $query = $this->db->prepare($sql);

        $query->bind_param("sdi", $nickname, $saldo, $id);

        $query->execute();

        $query->close();
    }

    function destroy($id)
    {
        $query = $this->db->prepare("DELETE FROM perfil_usuario WHERE `perfil_usuario`.`id_usuario` = ?");

        $query->bind_param("i", $id);

        $query->execute();

        $query->close();
    }
}
