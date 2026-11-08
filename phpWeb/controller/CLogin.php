<?php
class CLogin {
    private MLogin $model;

    function __construct()
    {
        $this->model = new MLogin();
    }

    function index(){

        require_once __DIR__ . "/../view/VLogin.php";

    }
    function login(){

        $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : null;
        $contrasenia = isset($_POST["contrasenia"]) ? $_POST["contrasenia"] : null;

        $login = $this->model->login($usuario, $contrasenia);

        if ($login) {

            $_SESSION["usuario"] = $login["id_usuario"];
            $_SESSION["id_usuario"] = $login["id_usuario"]; /*Esta es la que usan el carrito, la biblioteca y el navbar*/
            $_SESSION["rol"] = $login["rol"];
            header("Location: index.php?entity=juego&action=index");
            exit();

        } else {

            header("Location: index.php?entity=login&action=index");
            exit();

        }

    }
    function logout(){

        session_unset();
        session_destroy();
        header("Location: index.php?entity=login&action=index");
        exit();

    }
}