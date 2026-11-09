<?php

class CJuego
{
    private MJuego $model;
    private MBiblioteca $modelBiblioteca;

    function __construct()
    {
        $this->model = new MJuego();
        $this->modelBiblioteca = new MBiblioteca();
    }

    function index()
    {
        $data = $this->model->index();
        $esAdmin = ($_SESSION["rol"] ?? null) == "admin";

        /*Ids de los juegos que el usuario ya tiene en su biblioteca*/
        $biblioteca = $this->modelBiblioteca->index($_SESSION["id_usuario"]);
        $propios = $biblioteca ? array_column($biblioteca, "id_juego") : [];
        require __DIR__ . "/../view/VJuegoIndex.php";
    }

    function show($id)
    {
        $data = $this->model->show($id);
        /*require __DIR__ . "/../view/VEscudoShow.php";*/
    }

    function  create()
    {
        require __DIR__ . "/../view/VJuegoCreate.php";
    }

    function  store()
    {
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $pegi = $_POST["pegi"];

        $this->model->store($nombre, $precio, $descripcion, $pegi);

        header("Location: index.php?entity=juego&action=index");
        exit();
    }

    function  edit($id)
    {
        $data = $this->model->show($id);
        require __DIR__ . "/../view/VJuegoEdit.php";
    }

    function  update($id)
    {
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $pegi = $_POST["pegi"];

        $this->model->update($nombre, $precio, $descripcion, $pegi, $id);

        header("Location: index.php?entity=juego&action=index");
        exit();
    }

    function destroy($id)
    {
        $this->model->destroy($id);

        /*header("Location: index.php?entity=escudo");*/
    }
}
