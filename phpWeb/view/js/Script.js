/* ===== VARIABLES ===== */
/* URLs JSON */
const API_URL_JUEGOS = "http://localhost:3000/juegos";
const API_URL_USUARIOS = "http://localhost:3000/usuarios";
const API_URL_BIBLIOTECA = "http://localhost:3000/usuarios_juegos";

/* Navbar */
const btnHamburguesa = document.querySelector('header button');
const cajaHeader = document.querySelector('header nav');

/* ===== FUNCIONES ===== */


/* ===== EVENTOS ===== */
/* Hamburguesa desplegable */
btnHamburguesa.addEventListener('click', () => {

  /*Toggle es un interruptor, aplica o quita el estado de activo.
  Para que se muestre o deje de mostrar el menú desplegable izquierdo*/
  cajaHeader.classList.toggle('activo');

});