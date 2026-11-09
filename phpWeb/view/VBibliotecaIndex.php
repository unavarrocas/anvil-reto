<?php 
/* Si no ha iniciado sesion, le manda para el login, previene el poder entrar sin logear cambiando la url */
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php?entity=login&action=index");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="css/Biblioteca.css">
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
            <a href="index.php?entity=biblioteca&action=index" class="actual">Biblioteca</a>
            <a href="index.php?entity=carrito&action=index">Carrito</a>
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

    <!-- Titulo -->
    <h1>Elige tu próxima partida</h1>

    <!--Contenedor de cards-->
    <main id="cards">

        <section>

            <?php if (!empty($data) && is_array($data)): ?>
                <?php foreach ($data as $juego): ?>
                    <article>
                        <img src="resources/portadaPruebas.jpg" alt="<?php echo ($juego['nombre']); ?>">
                        <aside>
                            <div>
                                <h3><?php echo ($juego['nombre']); ?></h3>
                                <span>PEGI <?php echo ($juego['pegi']); ?></span>
                                <a href="index.php?entity=biblioteca&action=destroy&id=<?php echo ($juego['id_juego']); ?>"
                                    onclick="return confirm('¿Seguro que quieres eliminar el juego? Es permanente.')">
                                    <img src="resources/papelera.png" alt="Eliminar de la biblioteca">
                                </a>
                            </div>
                            <p><?php echo ($juego['descripcion']); ?></p>
                        </aside>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se han encontrado juegos en la biblioteca.</p>
            <?php endif; ?>

        </section>

    </main>

    <!-- Recuadro "Ir a tienda" -->
    <section class="ir-tienda">
        <h3>¿Buscas tu próxima aventura?</h3>
        <p>Descubre nuevos juegos en la tienda.</p>
        <a href="index.php?entity=juego&action=index">Ir a la tienda</a>
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