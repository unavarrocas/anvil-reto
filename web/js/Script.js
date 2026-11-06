/* ===== VARIABLES ===== */
/* Navbar */
const btnHamburguesa = document.querySelector('header button');
const caja1 = document.querySelector('header nav');


/* ===== HAMBURGUESA DESPLEGABLE ===== */
btnHamburguesa.addEventListener('click', () => {

  /*Toggle es un interruptor, aplica o quita el estado de activo.
  Para que se muestre o deje de mostrar el menú desplegable izquierdo*/
  caja1.classList.toggle('activo');

});