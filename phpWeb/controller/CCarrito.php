<?php

class CCarrito
{
    function __construct()
    {
        /*Si todavia no existe el carrito en la sesion, lo creamos vacio*/
        if (!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = [];
        }
    }

    function store($id)
    {
        $id = (int) $id;

        /*Solo lo metemos si no esta ya*/
        if (!in_array($id, $_SESSION["carrito"])) {
            $_SESSION["carrito"][] = $id;
        }

        header("Location: index.php?entity=juego&action=index");
        exit();
    }
}