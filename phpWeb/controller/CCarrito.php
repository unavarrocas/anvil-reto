<?php

class CCarrito
{
    private MJuego $model;

    function __construct()
    {
        $this->model = new MJuego();

        /* Si todavia no existe el carrito en la sesion, lo creamos vacio */
        if (!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = [];
        }
    }

    function index()
    {
        $data = [];
        $total = 0;

        /* El carrito solo guarda ids, asi que buscamos cada juego en la BD */
        foreach ($_SESSION["carrito"] as $idJuego) {
            $juego = $this->model->show($idJuego);

            if ($juego) {
                $data[] = $juego;
                $total += $juego["precio"];
            }
        }

        require __DIR__ . "/../view/VCarritoIndex.php";
    }

    function store($id)
    {
        $id = (int) $id;

        /* Solo lo metemos si no esta ya */
        if (!in_array($id, $_SESSION["carrito"])) {
            $_SESSION["carrito"][] = $id;
        }

        header("Location: index.php?entity=juego&action=index");
        exit();
    }

    function destroy($id)
    {
        $id = (int) $id;

        /* Dejamos en el carrito todos los ids menos el que quitamos */
        $_SESSION["carrito"] = array_values(array_diff($_SESSION["carrito"], [$id]));

        header("Location: index.php?entity=carrito&action=index");
        exit();
    }

    function vaciar()
    {
        $_SESSION["carrito"] = [];

        header("Location: index.php?entity=carrito&action=index");
        exit();
    }
}
