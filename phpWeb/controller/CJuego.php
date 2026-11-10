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
        /*Ids de los juegos que el usuario ya tiene en su biblioteca*/
        $biblioteca = $this->modelBiblioteca->index($_SESSION["id_usuario"]);
        /* Comprueba si biblioteca tiene algo, si lo tiene array column coge todos los ids
        de los juegos que posee el usuario. Si no lo tiene, lo deja vacio */
        $propios = $biblioteca ? array_column($biblioteca, "id_juego") : [];
        /* Le dice que si tiene rol en sesion lo devuelva para compararlo, si no lo tiene compara con null.
        Si es admin devuelve true */
        $esAdmin = ($_SESSION["rol"] ?? null) == "admin";
        require __DIR__ . "/../view/VJuegoIndex.php";
    }

    function show($id)
    {
        $data = $this->model->show($id);
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
}
