<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="css/Tienda.css">
    <link rel="icon" type="image/png" href="resources/logoAnvil.png">
</head>

<body>

    <!--Navbar-->
    <header>

        <button>☰</button>

        <aside>
            <img src="resources/logoAnvil.png" alt="Logo de Anvil">
            <span>ANVIL</span>
        </aside>

        <nav>
            <a href="index.php?entity=juego&action=index" class="actual">Tienda</a>
            <a href="index.php?entity=biblioteca&action=index">Biblioteca</a>
            <a href="index.php?entity=carrito&action=index">Carrito</a>
        </nav>

        <aside>
            <!-- Carrito -->
            <a href="index.php?entity=carrito&action=index" title="Carrito"></a>
            <!-- Perfil personalizado -->
            <article id="perfil">
                <p>Nickname</p>
                <p>777€</p>
            </article>
        </aside>

    </header>


    <!--Contenedor de cards-->
    <main id="cards">

        <section>

            <?php if (!empty($data) && is_array($data)): ?>
                <?php $carrito = isset($_SESSION["carrito"]) ? $_SESSION["carrito"] : []; ?>
                <?php foreach ($data as $juego): ?>
                    <article>
                        <!--No hay imagenes de juegos todavia, hay que indicar la ruta-->
                        <img src="resources/portadaPruebas.jpg" alt="<?php echo ($juego['nombre']); ?>">
                        <aside>
                            <div>
                                <h3><?php echo ($juego['nombre']); ?></h3>
                                <span>PEGI <?php echo ($juego['pegi']); ?></span>
                                <span><?php echo ($juego['precio']); ?> €</span>
                            </div>
                            <p><?php echo ($juego['descripcion']); ?></p>
                            <?php if (in_array($juego['id_juego'], $propios)): ?>
                                <button disabled>En tu biblioteca</button> <!--Esto es cuando el usuario ya tiene el juego-->
                            <?php elseif (in_array($juego['id_juego'], $carrito)): ?>
                                <button disabled>Añadido al carrito</button> <!--Esto es cuando el juego esta en el carrito, el boton se desactive-->
                            <?php else: ?>
                                <form method="post" action="index.php?entity=carrito&action=store&id=<?php echo ($juego['id_juego']); ?>">
                                    <button>Añadir al carrito</button>
                                </form>
                            <?php endif; ?>
                        </aside>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se han encontrado juegos en la base de datos.</p>
            <?php endif; ?>

        </section>

    </main>

    <!-- Trailer juego -->
    <section class="trailer">
        <article>
            <h2>Vice City te espera: descubre el tráiler de GTA VI</h2>
            <p>Lucia y Jason te llevan al estado de Leonida en la entrega más ambiciosa de la saga.</p>
            <ul>
                <li>Acción</li>
                <li>Crimen</li>
                <li>Aventura</li>
            </ul>
        </article>

        <!-- Insertar video descargado -->
        <!-- autoplay: empieza a reproducirse solo.
        muted: arranca sin sonido. Sin esto, el autoplay no funciona porque el
        navegador no permite videos con sonido en autoplay.
        loop: vuelve a empezar cuando termina.
        playsinline: En los moviles, a veces, cuando un video empieza a reproducirse
        el navegador lo abre automaticamente a pantalla completa. playsinline hace
        que se reproduzca en el lugar que se le asigno.
        controls: muestra los controles del video para que el usuario pueda activar
        el sonido. -->
        <video autoplay muted loop playsinline controls>
            <source src="resources/Trailer.mp4" type="video/mp4">
        </video>
    </section>

    <!-- Footer -->
    <footer>
        <img src="resources/logoAnvil.png" class="logo-footer" />
        <p>© 2026 Anvil. Todos los derechos reservados.</p>
    </footer>

    <!--Elaces a los scripts-->
    <script src="js/Script.js"></script>
    <!-- <script src="js/Tienda.js"></script> -->

</body>

</html>