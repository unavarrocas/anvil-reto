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

            header("Location: index.php?entity=juego&action=index");
            exit();

        } else {

            header("Location: index.php?entity=login&action=index");
            exit();

        }

    }
    function logout(){}
}
