/* ===== VARIABLES ===== */
/* URLs JSON */
const API_URL_JUEGOS = "http://localhost:3000/juegos";
const API_URL_USUARIOS = "http://localhost:3000/usuarios";
const API_URL_BIBLIOTECA = "http://localhost:3000/usuarios_juegos";

/* Navbar */
const btnHamburguesa = document.querySelector('header button');
const cajaHeader = document.querySelector('header nav');
const perfil = document.getElementById("perfil");
let usuario = JSON.parse(localStorage.getItem("usuario"));
const btnTema = document.getElementById('btnTema')

/* ===== FUNCIONES ===== */
/* Pintar nickname y saldo en el navbar */
function pintarPerfil() {
  perfil.querySelector("p:nth-child(1)").textContent = usuario.nombre;
  perfil.querySelector("p:nth-child(2)").textContent = usuario.saldo.toFixed(2) + "€";
}

/* Leer el carrito del usuario logueado, si es null lo hacemos vacío */
function getCarrito() {
  let carrito = JSON.parse(localStorage.getItem("carrito_" + usuario.id_usuario));

  if (!carrito)
    carrito = [];

  return carrito;
}

/* Guardar el carrito del usuario logueado */
function setCarrito(carrito) {
  localStorage.setItem("carrito_" + usuario.id_usuario, JSON.stringify(carrito));
}

/* Eliminar el carrito del usuario logueado */
function vaciarCarrito() {
  localStorage.removeItem("carrito_" + usuario.id_usuario);
}

/* ===== EVENTOS ===== */
/* Modo claro al cargar */
if (localStorage.getItem('tema') === 'claro') {
  document.body.classList.add('claro');
}

/* Hamburguesa desplegable */
/* Solo en las páginas que tienen navbar*/
if (btnHamburguesa) {
  btnHamburguesa.addEventListener('click', () => {

    /*Toggle es un interruptor, aplica o quita la clase activo.
    Para que se muestre o deje de mostrar el menú desplegable izquierdo*/
    cajaHeader.classList.toggle('activo');

  });
}

/* Pintar perfil en navbar */
/* Solo en las páginas que tienen navbar*/
if (perfil) {
  pintarPerfil();
}

/* Boton modo claro */
btnTema.addEventListener('click', () => {

  /* Pone o quita la clase "claro" del body */
  document.body.classList.toggle('claro');

  /* Guarda la eleccion para que se mantenga al cambiar de pagina */
  if (document.body.classList.contains('claro')) {
    localStorage.setItem('tema', 'claro');
  } else {
    localStorage.setItem('tema', 'oscuro');
  }

});