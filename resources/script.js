const btnHamburguesa = document.getElementById('btn_hamburguesa');
const caja1 = document.getElementById('caja1');


/*En cuanto se haga click:*/
btnHamburguesa.addEventListener('click', () => {
  
  /*Toggle es un interruptor, aplica o quita el estado de activo.*/
  caja1.classList.toggle('activo');

});