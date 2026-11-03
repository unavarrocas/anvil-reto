<?php

class MJuego
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getConexion();
    }

    function index()
    {
        $data = null;
        $sql = "SELECT * FROM `juegos`";

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

        $sql = "SELECT * FROM `juegos` WHERE juegos.id_juego = ?";

        $query = $this->db->prepare($sql);
        $query->bind_param("i", $id);
        $query->execute();

        $resultado = $query->get_result();

        if ($row = $resultado->fetch_assoc())
            $data = $row;

        $query->close();

        return $data;
    }

    function store($nombre, $precio, $descripcion, $pegi)
    {
        $sql = "INSERT INTO `juegos` (`id_juego`, `nombre`, `precio`, `descripcion`, `pegi`)
        VALUES (NULL, ?, ?, ?, ?)";

        $query = $this->db->prepare($sql);

        $query->bind_param("sdsi", $nombre, $precio, $descripcion, $pegi);

        $query->execute();

        $query->close();
    }

    function update($nombre, $precio, $descripcion, $pegi, $id)
    {
        $sql = "UPDATE `juegos` SET `nombre` = ?, `precio` = ?, `descripcion` = ?, `pegi` = ? WHERE `juegos`.`id_juego` = ?";
        $query = $this->db->prepare($sql);

        $query->bind_param("sdsii", $nombre, $precio, $descripcion, $pegi, $id);

        $query->execute();

        $query->close();
    }

    function destroy($id)
    {
        $query = $this->db->prepare("DELETE FROM juegos WHERE `juegos`.`id_juego` = ?");

        $query->bind_param("i", $id);

        $query->execute();

        $query->close();
    }
}
