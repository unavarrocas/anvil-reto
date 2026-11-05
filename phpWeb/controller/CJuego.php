<?php

class CJuego
{
    private MJuego $model;

    function __construct()
    {
        $this->model = new MJuego();
    }

    function index()
    {
        $data = $this->model->index();
        require __DIR__ . "/../view/VTienda.php";
    }

    function show($id)
    {
        $data = $this->model->show($id);
        /* require __DIR__ . "/../view/VEscudoShow.php"; */
    }

    function  create()
    {
        /* require __DIR__ . "/../view/VEscudoCreate.php"; */
    }

    function  store()
    {
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $pegi = $_POST["pegi"];

        $this->model->store($nombre, $precio, $descripcion, $pegi);

        /* header("Location: index.php?entity=escudo"); */
    }

    function  edit($id)
    {
        $data = $this->model->show($id);
        /* require __DIR__ . "/../view/VEscudoEdit.php"; */
    }

    function  update($id)
    {
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $pegi = $_POST["pegi"];

        $this->model->update($nombre, $precio, $descripcion, $pegi, $id);

        /* header("Location: index.php"); */
    }

    function destroy($id)
    {
        $this->model->destroy($id);

        /* header("Location: index.php?entity=escudo"); */
    }
}
