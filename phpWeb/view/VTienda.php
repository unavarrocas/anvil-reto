<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenido a ANVIL</title>
  <link rel="stylesheet" href="../resources/style.css">
</head>

<body>

  <!--Navbar-->
  <header>

    <button id="btn_hamburguesa">☰</button>

    <a id="href_logo" href="#">
      <img src="../resources/Imagenes/logoAnvil.png" id="logoAnvil" alt="Anvil_Logo"><!--Logo-->
      <span>ANVIL</span>
    </a>

    <div id="caja1">

      <a id="btn_login_menu" href="login.html">Login</a>
      <a id="carrito_menu" class="enlace-menu" href="#">Carrito</a>

      <a id="href_tienda" class="enlace-menu activo-menu" href="#">Tienda</a> <!--Hrefs para navegar-->
      <a id="href_biblioteca" class="enlace-menu" href="#">Biblioteca</a> <!--Hrefs para navegar-->
    </div>

    <div id="caja2">

      <a id="href_carrito" href="#">
        <img src="../resources/Imagenes/carritoCompra.png" id="iconoCarrito" alt="Carrito"><!--Carrito-->
      </a>

      <a id="href_login" href="login.html">Login</a> <!--Hrefs para iniciar sesion-->
    </div>

  </header>
  <!--/Navbar-->


  <!--Carrusel-->
  <div>

  </div>
  <!--/Carrusel-->


  <!--Contenedor de cards-->
  <div>

    <section>

      <article class="card-juego">
        <img src="../resources/Imagenes/portadaPruebas.jpg" alt="Jueguito 1">
        <div>
          <h3>Juego 1</h3>
          <p>Descripcion de relleno para poder empezar a crear cards sin pensar mucho</p>
          <p>Precio: 20€</p>
          <p>PEGI: 7</p>
          <button class="boton-añadir">Añadir al carrito</button>
        </div>
      </article>

      <article class="card-juego">
        <img src="../resources/Imagenes/portadaPruebas.jpg" alt="Jueguito 2">
        <div>
          <h3>Juego 2</h3>
          <p>Descripcion de relleno para poder empezar a crear cards sin pensar mucho</p>
          <p>Precio: 20€</p>
          <p>PEGI: 7</p>
          <button class="boton-añadir">Añadir al carrito</button>
        </div>
      </article>

      <article class="card-juego">
        <img src="../resources/Imagenes/portadaPruebas.jpg" alt="Jueguito 3">
        <div>
          <h3>Juego 3</h3>
          <p>Descripcion de relleno para poder empezar a crear cards sin pensar mucho</p>
          <p>Precio: 20€</p>
          <p>PEGI: 7</p>
          <button class="boton-añadir">Añadir al carrito</button>
        </div>
      </article>

      <article class="card-juego">
        <img src="../resources/Imagenes/portadaPruebas.jpg" alt="Jueguito 4">
        <div>
          <h3>Juego 4</h3>
          <p>Descripcion de relleno para poder empezar a crear cards sin pensar mucho</p>
          <p>Precio: 20€</p>
          <p>PEGI: 7</p>
          <button class="boton-añadir">Añadir al carrito</button>
        </div>
      </article>

      <article class="card-juego">
        <img src="../resources/Imagenes/portadaPruebas.jpg" alt="Jueguito 5">
        <div>
          <h3>Juego 5</h3>
          <p>Descripcion de relleno para poder empezar a crear cards sin pensar mucho</p>
          <p>Precio: 20€</p>
          <p>PEGI: 7</p>
          <button class="boton-añadir">Añadir al carrito</button>
        </div>
      </article>

    </section>

  </div>
  <!--/Contenedor de cards-->

  <footer>

    <img src="../resources/Imagenes/logoAnvil.png" class="logo-footer"/>
    <p>© 2026 Anvil. Todos los derechos reservados.</p>

  </footer>


  <!--Elace al script-->
  <script src="script.js"></script>

</body>

</html>