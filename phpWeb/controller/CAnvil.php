<?php
session_start(); /*Esto hay que quitar cuando se termine, es para saltarse el login que no me funciona.*/
$_SESSION['usuario'] = "Prueba"; /*Esto hay que quitar cuando se termine, es para saltarse el login que no me funciona.*/
$_SESSION['id_usuario'] = 2; /*Esto hay que quitar cuando se termine, es para saltarse el login que no me funciona.*/
require_once __DIR__ . "/../db/DB.php";
require_once __DIR__ . "/../model/MBiblioteca.php";
require_once __DIR__ . "/../model/MJuego.php";
require_once __DIR__ . "/../model/MPerfil.php";
require_once __DIR__ . "/../model/MLogin.php";
require_once __DIR__ . "/CBiblioteca.php";
require_once __DIR__ . "/CJuego.php";
require_once __DIR__ . "/CPerfil.php";
require_once __DIR__ . "/CLogin.php";
require_once __DIR__ . "/CCarrito.php";

/*$entity = isset($_GET["entity"]) ? $_GET["entity"] : "login";*/ /*Esta es la que hay que dejar, hay que quitar la de abajo */
$entity = isset($_GET["entity"]) ? $_GET["entity"] : "juego"; /*Esto hay que quitar cuando se termine, es para saltarse el login que no me funciona.*/
$action = isset($_GET["action"]) ? $_GET["action"] : "index";
$id = isset($_GET["id"]) ? $_GET["id"] : null;

/*Cada vez que se carga una pagina, guardamos el nickname y el saldo del usuario en la sesion*/
if (isset($_SESSION["id_usuario"])) {
    $modelPerfil = new MPerfil();
    $perfilUsuario = $modelPerfil->show($_SESSION["id_usuario"]);

    if ($perfilUsuario) {
        $_SESSION["nickname"] = $perfilUsuario["nickname"];
        $_SESSION["saldo"] = $perfilUsuario["saldo"];
    }
}

switch ($entity) {
    case "login";
        switch ($action) {
            case "index":
                $controller = new CLogin();
                $controller->index();
                break;

            case "login":
                $controller = new CLogin();
                $controller->login();
                break;

            case "logout":
                $controller = new CLogin();
                $controller->logout();
                break;

            default:
                header("Location: index.php?entity=login&action=index");
        }
        break;

    case "juego":
        switch ($action) {
            case "index":
                $controller = new CJuego();
                $controller->index();
                break;

            case "show":
                $controller = new CJuego();
                $controller->show($id);
                break;

            case "create":
                $controller = new CJuego();
                $controller->create();
                break;

            case "store":
                $controller = new CJuego();
                $controller->store();
                break;

            case "edit":
                $controller = new CJuego();
                $controller->edit($id);
                break;

            case "update":
                $controller = new CJuego();
                $controller->update($id);
                break;

            case "destroy":
                $controller = new CJuego();
                $controller->destroy($id);
                break;

            default:
                header("Location: index.php?entity=juego&action=index");
        }

        break;

    case "biblioteca":
        switch ($action) {
            case "index":
                $controller = new CBiblioteca();
                $controller->index();
                break;

            case "show":
                $controller = new CBiblioteca();
                $controller->show($id);
                break;

            case "create":
                $controller = new CBiblioteca();
                $controller->create();
                break;

            case "store":
                $controller = new CBiblioteca();
                $controller->store($id);
                break;

            case "edit":
                $controller = new CBiblioteca();
                $controller->edit($id);
                break;

            case "update":
                $controller = new CBiblioteca();
                $controller->update($id);
                break;

            case "destroy":
                $controller = new CBiblioteca();
                $controller->destroy($id);
                break;

            default:
                header("Location: index.php?entity=biblioteca&action=index");
        }

        break;

    case "carrito":
        switch ($action) {
            case "index":
                $controller = new CCarrito();
                $controller->index();
                break;

            case "store":
                $controller = new CCarrito();
                $controller->store($id);
                break;

            case "destroy":
                $controller = new CCarrito();
                $controller->destroy($id);
                break;

            case "vaciar":
                $controller = new CCarrito();
                $controller->vaciar();
                break;

            case "comprar":
                $controller = new CCarrito();
                $controller->comprar();
                break;

            default:
                header("Location: index.php?entity=juego&action=index");
        }

        break;

    case "perfil":
        switch ($action) {
            case "index":
                $controller = new CPerfil();
                $controller->index();
                break;

            case "show":
                $controller = new CPerfil();
                $controller->show($id);
                break;

            case "create":
                $controller = new CPerfil();
                $controller->create();
                break;

            case "store":
                $controller = new CPerfil();
                $controller->store($id);
                break;

            case "edit":
                $controller = new CPerfil();
                $controller->edit($id);
                break;

            case "update":
                $controller = new CPerfil();
                $controller->update($id);
                break;

            case "destroy":
                $controller = new CPerfil();
                $controller->destroy($id);
                break;

            default:
                header("Location: index.php?entity=perfil&action=index");
        }

        break;

    default:
        header("Location: index.php?entity=login&action=index");
}