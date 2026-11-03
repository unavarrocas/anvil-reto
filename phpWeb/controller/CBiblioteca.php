<?php

class CBiblioteca
{
    private MBiblioteca $model;

    function __construct()
    {
        $this->model = new MBiblioteca();
    }

    function index()
    {
        $data = $this->model->index();
        /* require __DIR__ . "/../view/VEscudoIndex.php"; */
    }

    function show($idUsuario)
    {
        $idJuego = $_POST["idJuego"];
        $data = $this->model->show($idUsuario, $idJuego);
        /* require __DIR__ . "/../view/VEscudoShow.php"; */
    }

    function  create()
    {
        /* require __DIR__ . "/../view/VEscudoCreate.php"; */
    }

    function  store($idUsuario)
    {
        $idJuego = $_POST["idJuego"];

        $this->model->store($idUsuario, $idJuego);

        /* header("Location: index.php?entity=escudo"); */
    }

    function  edit($idUsuario)
    {
        $idJuego = $_POST["idJuego"];

        $data = $this->model->show($idUsuario, $idJuego);
        /* require __DIR__ . "/../view/VEscudoEdit.php"; */
    }

    function  update($idUsuario)
    {
        $idJuego = $_POST["idJuego"];
        $idUsuarioNew = $_POST["idUsuarioNew"];
        $idJuegoNew = $_POST["idJuegoNew"];

        $this->model->update($idUsuarioNew, $idJuegoNew, $idUsuario, $idJuego);

        /* header("Location: index.php"); */
    }

    function destroy($idUsuario)
    {
        $idJuego = $_POST["idJuego"];
        $this->model->destroy($idUsuario, $idJuego);

        /* header("Location: index.php?entity=escudo"); */
    }
}
