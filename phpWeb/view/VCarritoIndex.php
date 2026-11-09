<?php 
/* Si no ha iniciado sesion, le manda para el login, previene el poder entrar sin logear cambiando la url */
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php?entity=login&action=index");
    exit();
}

/** @var array $data */ /** @var float|int $total */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="css/Carrito.css">
    <link rel="icon" type="image/png" href="resources/logoAnvil.png">
</head>

<body>

    <!--Navbar-->
    <header>

        <button>☰</button>

        <aside>
            <img src="resources/logoAnvil.png" alt="Logo de Anvil">
            <span>ANVIL <?php if ($_SESSION["rol"] == "admin"){echo "(ADMIN)";};?></span>
        </aside>

        <nav>
            <a href="index.php?entity=juego&action=index">Tienda</a>
            <a href="index.php?entity=biblioteca&action=index">Biblioteca</a>
            <a href="index.php?entity=carrito&action=index" class="actual">Carrito</a>
        </nav>

        <aside>
            <!-- Carrito -->
            <a href="index.php?entity=carrito&action=index" title="Carrito"></a>
            <!-- Cerrar sesión -->
            <a href="index.php?entity=login&action=logout">Cerrar sesión</a>
            <!-- Perfil personalizado -->
            <article id="perfil">
                <p><?php echo ($_SESSION["nickname"]); ?></p>
                <p><?php echo number_format($_SESSION["saldo"], 2, ',', '.'); ?>€</p>
            </article>
        </aside>

    </header>

    <!-- Contenedor todo lo referente -->
    <section class="seccion-carrito">
        <!-- Titulo y titulo secundario -->
        <h1>Resumen de tu carrito</h1>

        <h2>CESTA</h2>

        <!-- Carrito -->
        <div>
            <?php if (isset($_SESSION["mensaje"])): ?>
                <p class="mensaje"><?php echo ($_SESSION["mensaje"]); ?></p>
                <?php unset($_SESSION["mensaje"]); ?>
            <?php endif; ?>

            <?php if (!empty($data)): ?>
                <?php foreach ($data as $juego): ?>
                    <article>

                        <img src="resources/portadaPruebas.jpg" alt="<?php echo ($juego['nombre']); ?>">
                        <h3><?php echo ($juego['nombre']); ?></h3>
                        <p>PEGI <?php echo ($juego['pegi']); ?></p>

                        <p><?php echo ($juego['precio']); ?>€</p>
                        <a href="index.php?entity=carrito&action=destroy&id=<?php echo ($juego['id_juego']); ?>">
                            <img src="resources/papelera.png" alt="Quitar del carrito">
                        </a>

                    </article>
                <?php endforeach; ?>

                <p>Total a pagar: <?php echo number_format($total, 2, ',', '.'); ?>€</p>
            <?php else: ?>
                <p>Tu carrito está vacío.</p>
            <?php endif; ?>

            <form class="acciones-carrito" method="post">
                <button formaction="index.php?entity=carrito&action=vaciar">Vaciar carrito</button> <!--Formaction es igual a un href-->
                <button formaction="index.php?entity=carrito&action=comprar">Comprar ahora</button>
            </form>

        </div>
    </section>

    <!-- Footer -->
    <footer>
        <img src="resources/logoAnvil.png" class="logo-footer" />
        <p>© 2026 Anvil. Todos los derechos reservados.</p>
    </footer>

    <!--Elace al script-->
    <script src="js/Script.js"></script>
</body>

</html>