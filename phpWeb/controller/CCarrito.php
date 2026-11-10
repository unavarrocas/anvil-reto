<?php

class CCarrito
{
    private MJuego $model;
    private MPerfil $modelPerfil;
    private MBiblioteca $modelBiblioteca;

    function __construct()
    {
        $this->model = new MJuego();
        $this->modelPerfil = new MPerfil();
        $this->modelBiblioteca = new MBiblioteca();

        /*Si todavia no existe el carrito en la sesion, lo creamos vacio*/
        if (!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = [];
        }
    }

    function index()
    {
        $data = [];
        $total = 0;

        /*El carrito solo guarda ids, asi que buscamos cada juego en la BD*/
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

        /*Si ya lo tiene en su biblioteca, no se puede comprar otra vez*/
        $yaLoTiene = $this->modelBiblioteca->show($_SESSION["id_usuario"], $id);

        /*Solo lo metemos si no esta ya en el carrito ni en su biblioteca*/
        if (!$yaLoTiene && !in_array($id, $_SESSION["carrito"])) {
            $_SESSION["carrito"][] = $id;
        }

        header("Location: index.php?entity=juego&action=index");
        exit();
    }

    function destroy($id)
    {
        /* Parsea a entero el id */
        $id = (int) $id;

        /*Dejamos en el carrito todos los ids menos el que quitamos*/
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

    function comprar()
    {
        $idUsuario = $_SESSION["id_usuario"];
        $perfil = $this->modelPerfil->show($idUsuario);

        $juegos = [];
        $total = 0;

        foreach ($_SESSION["carrito"] as $idJuego) {
            /*Si ya lo tiene en su biblioteca lo saltamos en esta vuelta si no, la BD daria error por duplicado*/
            if ($this->modelBiblioteca->show($idUsuario, $idJuego)) {
                continue;
            }

            $juego = $this->model->show($idJuego);

            if ($juego) {
                $juegos[] = $juego;
                $total += $juego["precio"];
            }
        }

        if (empty($juegos)) {
            $_SESSION["mensaje"] = "No hay juegos que comprar.";
            /* Redondea a dos decimales, el saldo lo parsea a float (desde la db llega como texto)
            y comprueba si el total es mayor que el saldo. */
        } elseif (round($total, 2) > round((float) $perfil["saldo"], 2)) {
            $_SESSION["mensaje"] = "No tienes saldo suficiente.";
        } else {
            /*Todo correcto: pasamos los juegos a la biblioteca*/
            foreach ($juegos as $juego) {
                $this->modelBiblioteca->store($idUsuario, $juego["id_juego"]);
            }

            /*Restamos el total al saldo*/
            $nuevoSaldo = $perfil["saldo"] - $total;
            $this->modelPerfil->update($perfil["nickname"], $nuevoSaldo, $idUsuario);

            $_SESSION["carrito"] = [];

            header("Location: index.php?entity=biblioteca&action=index");
            exit();
        }

        /*Si algo ha fallado, volvemos al carrito con el mensaje*/
        header("Location: index.php?entity=carrito&action=index");
        exit();
    }
}
