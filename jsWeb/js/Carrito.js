/* ===== VARIABLES ===== */
/* Elementos del carrito */
const lista = document.getElementById("lista-carrito");
const totalTexto = document.getElementById("total");
const btnVaciar = document.getElementById("vaciar");
const btnComprar = document.getElementById("comprar");

/* Array con los juegos completos que hay en el carrito */
let juegosCarrito = [];

/* ===== FUNCIONES ===== */
/* Cargar juegos del carrito */
/* Conexion con server */
async function cargarCarrito() {
    /* Declarar arrays */
    let juegos = [];
    let carrito = getCarrito();

    try {
        /* Recoger juegos del server */
        const response = await fetch(API_URL_JUEGOS);

        if (!response.ok) {
            throw new Error("No se han podido cargar los juegos");
        }

        /* Introducirlos en el array */
        juegos = await response.json();

        /* Guardar y pintar solo los juegos que están en el carrito */
        for (const j of juegos) {
            if (carrito.includes(j.id_juego)) {
                juegosCarrito.push(j);
                crearArticle(j);
            }
        }

        /* Mensaje si el carrito está vacío */
        if (juegosCarrito.length === 0) {
            mostrarVacio();
        }

        pintarTotal();
    } catch (error) {
        /* Mensaje de error si no consigue conectarse al server */
        alert("No se ha podido cargar el carrito.");
    }
}

/* Crear article de un juego */
function crearArticle(juego) {
    /* Crear etiquetas */
    let article = document.createElement("article");
    let img = document.createElement("img");
    let h3 = document.createElement("h3");
    let pPegi = document.createElement("p");
    let pPrecio = document.createElement("p");
    let papelera = document.createElement("img");

    /* Darle contenido */
    img.src = juego.imagen;
    h3.textContent = juego.nombre;
    pPegi.textContent = "PEGI " + juego.pegi;
    pPrecio.textContent = juego.precio + "€";
    papelera.src = "../resources/papelera.png";

    /* Al clicar en la papelera */
    papelera.addEventListener("click", () => {
        /* Quitarlo del carrito del localStorage */
        let carrito = getCarrito();

        for (let i = 0; i < carrito.length; i++) {
            if (carrito[i] === juego.id_juego) {
                carrito.splice(i, 1);
            }
        }

        setCarrito(carrito);

        /* Quitarlo del array de juegos */
        for (let i = 0; i < juegosCarrito.length; i++) {
            if (juegosCarrito[i].id_juego === juego.id_juego) {
                juegosCarrito.splice(i, 1);
            }
        }

        /* Quitar el article de la página */
        article.remove();

        /* Mensaje si ya no quedan juegos */
        if (juegosCarrito.length === 0) {
            mostrarVacio();
        }

        pintarTotal();
    });

    /* Montarlo y añadirlo justo antes del total */
    article.append(img, h3, pPegi, pPrecio, papelera);
    totalTexto.before(article);
}

/* Mensaje de carrito vacío */
function mostrarVacio() {
    let p = document.createElement("p");
    p.textContent = "Tu carrito está vacío.";
    totalTexto.before(p);
}

/* Calcular total */
function calcularTotal() {
    let total = 0;

    /* Suma todos los precios */
    for (const j of juegosCarrito) {
        total += j.precio;
    }

    /* Devuelve total redondeado a dos decimales y parseado a int*/
    return Number(total.toFixed(2));
}

/* Pintar total y bloquear botones si está vacío */
function pintarTotal() {
    /* Pinta formateado a dos decimales */
    totalTexto.textContent = "Total: " + calcularTotal().toFixed(2) + " €";

    /* Activa o desactiva los botones segun si existen o no juegos */
    if (juegosCarrito.length === 0) {
        btnVaciar.disabled = true;
        btnComprar.disabled = true;
        btnVaciar.classList.add("disabled");
        btnComprar.classList.add("disabled");
    } else {
        btnVaciar.disabled = false;
        btnComprar.disabled = false;
        btnVaciar.classList.remove("disabled");
        btnComprar.classList.remove("disabled");
    }
}

/* ===== EVENTOS ===== */
/* Cargar carrito al principio */
cargarCarrito();

/* Al clicar en vaciar */
btnVaciar.addEventListener("click", () => {
    let confirmacion = confirm("¿Seguro que quiere vaciar el carrito?");
    if (!confirmacion)
        return;

    /* Borrar carrito del localStorage y recargar la página */
    vaciarCarrito();
    window.location.href = "Carrito.html";
});

/* Al clicar en comprar */
btnComprar.addEventListener("click", async () => {
    let total = calcularTotal();

    /* Comprobar saldo */
    if (total > usuario.saldo) {
        alert("No tienes saldo suficiente.");
        return;
    }

    /* Pedir confirmacion */
    let confirmacion = confirm("¿Confirmas la compra por " + total.toFixed(2) + " €?");
    if (!confirmacion)
        return;

    /* .toFixed(2) redondea a dos decimales, pero devuelve un string.
    Number lo parsea a numero */
    let nuevoSaldo = Number((usuario.saldo - total).toFixed(2));

    try {
        /* Añadir cada juego a la biblioteca */
        for (const j of juegosCarrito) {
            let relacion = {
                id_usuario: usuario.id_usuario,
                id_juego: j.id_juego
            };

            const response = await fetch(API_URL_BIBLIOTECA, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(relacion)
            });

            if (!response.ok) {
                throw new Error("No se ha podido añadir el juego a la biblioteca");
            }
        }

        /* Recoger usuarios para tener el usuario completo */
        const responseUsuarios = await fetch(API_URL_USUARIOS);

        if (!responseUsuarios.ok) {
            throw new Error("No se han podido cargar los usuarios");
        }

        let usuarios = await responseUsuarios.json();

        /* Sustituir el usuario con el saldo nuevo */
        for (const u of usuarios) {
            if (u.id_usuario === usuario.id_usuario) {

                let usuarioActualizado = {
                    id_usuario: u.id_usuario,
                    nombre: u.nombre,
                    contrasenia: u.contrasenia,
                    saldo: nuevoSaldo
                };

                const responseSaldo = await fetch(API_URL_USUARIOS + "/" + u.id, {
                    method: "PUT",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(usuarioActualizado)
                });

                if (!responseSaldo.ok) {
                    throw new Error("No se ha podido actualizar el saldo");
                }
            }
        }
    } catch (error) {
        console.error("Error:", error.message);
        alert("No se ha podido completar la compra.");
        /* Si no funciono, termina la ejecucion */
        return;
    }

    /* Actualizar saldo del usuario en localStorage */
    usuario.saldo = nuevoSaldo;
    localStorage.setItem("usuario", JSON.stringify(usuario));

    /* Vaciar carrito y llevar a la biblioteca */
    vaciarCarrito();
    window.location.href = "Biblioteca.html";
});