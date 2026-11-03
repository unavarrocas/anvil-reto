<?php

class MBiblioteca
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getConexion();
    }

    function index()
    {
        $data = null;
        $sql = "SELECT * FROM `usuarios_juegos`";

        $query = $this->db->query($sql);

        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }

        $query->close();

        return  $data;
    }

    function show($idUsuario, $idJuego)
    {
        $data = null;

        $sql = "SELECT * FROM `usuarios_juegos` WHERE usuarios_juegos.id_usuario = ? AND usuarios_juegos.id_juego = ?";

        $query = $this->db->prepare($sql);
        $query->bind_param("ii", $idUsuario, $idJuego);
        $query->execute();

        $resultado = $query->get_result();

        if ($row = $resultado->fetch_assoc())
            $data = $row;

        $query->close();

        return $data;
    }

    function store($idUsuario, $idJuego)
    {
        $sql = "INSERT INTO `usuarios_juegos` (`id_usuario`, `id_juego`) VALUES (?, ?)";

        $query = $this->db->prepare($sql);

        $query->bind_param("ii", $idUsuario, $idJuego);

        $query->execute();

        $query->close();
    }

    function update($idUsuarioNew, $idJuegoNew, $idUsuario, $idJuego)
    {
        $sql = "UPDATE `usuarios_juegos` SET `id_usuario` = ?, `id_juego` = ?
        WHERE `usuarios_juegos`.`id_usuario` = ? AND `usuarios_juegos`.`id_juego` = ?";

        $query = $this->db->prepare($sql);

        $query->bind_param("iiii", $idUsuarioNew, $idJuegoNew, $idUsuario, $idJuego);

        $query->execute();

        $query->close();
    }

    function destroy($idUsuario, $idJuego)
    {
        $query = $this->db->prepare("DELETE FROM usuarios_juegos WHERE `usuarios_juegos`.`id_usuario` = ? AND `usuarios_juegos`.`id_juego` = ?");

        $query->bind_param("ii", $idUsuario, $idJuego);

        $query->execute();

        $query->close();
    }
}
