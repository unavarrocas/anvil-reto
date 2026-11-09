/* ===== VARIABLES ===== */
/* Formulario */
const precioMinInput = document.getElementById("precio-min");
const precioMaxInput = document.getElementById("precio-max");
const filtrar = document.getElementById("filtrar");
const limpiar = document.getElementById("limpiar");
const mensajeErrorMin = document.getElementById("mensajeErrorMin");
const mensajeErrorMax = document.getElementById("mensajeErrorMax");


/* Contenedor de cards */
const cards = document.querySelector("#cards section");

/* ===== FUNCIONES ===== */
/* Cargar juegos */
/* Conexion con server */
/* Si no recibe valores, estos son los predeterminados */
async function cargarJuegos(precioMin = 0, precioMax = Infinity) {
    /* Declarar arrays */
    let juegos = [];
    let biblioteca = [];
    let idsBiblioteca = [];

    try {
        /* Recoger datos del server */
        const response = await fetch(API_URL_JUEGOS);


        if (!response.ok) {
            throw new Error("No se han podido cargar los juegos");
        }

        /* Recoger relaciones usuario-juego del server */
        const responseBiblioteca = await fetch(API_URL_BIBLIOTECA);

        if (!responseBiblioteca.ok) {
            throw new Error("No se ha podido cargar la biblioteca");
        }

        /* Introducirlos en los arrays */
        juegos = await response.json();
        biblioteca = await responseBiblioteca.json();

        /* Guardar los ids de los juegos que ya tiene el usuario logueado */
        for (const b of biblioteca) {
            if (b.id_usuario === usuario.id_usuario)
                idsBiblioteca.push(b.id_juego);
        }

        /* Vaciar HTML de cards */
        cards.innerHTML = "";

        /* Rellenar cards segun precio */
        for (const j of juegos) {
            if (j.precio >= precioMin && j.precio <= precioMax)
                /* Enviamos booleano para saber si el usuario ya posee el juego */
                crearCard(j, idsBiblioteca.includes(j.id_juego));
        }
    } catch (error) {
        /* Mensaje de error si no consigue conectarse al server */
        alert("No se han podido cargar los juegos.");
    }
}

/* Crear card */
function crearCard(juego, enPosesion) {
    /* Crear etiquetas */
    let article = document.createElement("article");
    let img = document.createElement("img");
    let aside = document.createElement("aside");
    let div = document.createElement("div");
    let h3 = document.createElement("h3");
    let spanPegi = document.createElement("span");
    let spanPrecio = document.createElement("span");
    let p = document.createElement("p");
    let button = document.createElement("button");

    /* Darle contenido */
    article.id = juego.id_juego;
    img.src = juego.imagen;
    h3.textContent = juego.nombre
    spanPegi.textContent = "PEGI " + juego.pegi;
    spanPrecio.textContent = juego.precio + " €";
    p.textContent = juego.descripcion;
    button.textContent = "Añadir al carrito";

    /* Si el juego ya está en el carrito, se bloquea el botón */
    if (getCarrito().includes(juego.id_juego)) {
        button.textContent = "En el carrito";
        button.disabled = true;
        button.classList.add("disabled");
    }

    /* Si el usuario ya tiene el juego, se bloquea el botón */
    if (enPosesion) {
        button.textContent = "En tu biblioteca";
        button.disabled = true;
        button.classList.add("disabled");
    }

    /* Al clicar, se añade al carrito */
    button.addEventListener("click", () => {
        let carrito = getCarrito();
        carrito.push(juego.id_juego);
        setCarrito(carrito);

        /* Bloquear el botón */
        button.textContent = "En el carrito";
        button.disabled = true;
        button.classList.add("disabled");
    });

    /* Montarlo y anadirlo */
    div.append(h3, spanPegi, spanPrecio);
    aside.append(div, p, button);
    article.append(img, aside);
    cards.append(article);
}

/* ===== EVENTOS ===== */
/* Cargar juegos al principio */
cargarJuegos();

/* Al clicar en filtrar */
filtrar.addEventListener("click", (e) => {
    /* Bloquea recarga */
    e.preventDefault();

    /* Recoge valores del formulario, sino deja entre 0 y 100 */
    var precioMin = Number(document.getElementById("precio-min").value.trim() || 0);
    var precioMax = Number(document.getElementById("precio-max").value.trim() || 100);

    /* Recarga los juegos según filtros */
    cargarJuegos(precioMin, precioMax);
})

/* Al clicar en limpiar*/
limpiar.addEventListener("click", () => {
    /* Limpia mensajes de error */
    mensajeErrorMax.textContent = "";
    mensajeErrorMin.textContent = "";

    /* Habilita filtrar si es necesario */
    if (filtrar.disabled == true) {
        filtrar.disabled = false;
        filtrar.classList.remove("disabled");
    }

    /* Carga juegos */
    cargarJuegos();
})

/* Cada vez que cambia el valor de precioMin */
precioMinInput.addEventListener("input", () => {
    const valor = precioMinInput.value.trim();

    /* Si no está vacío y no es numérico o es < 0, saca mensaje de error y deshabilita filtrar */
    if (valor.length > 0 && !(valor >= 0)) {
        mensajeErrorMin.textContent = "Introduzca un valor numérico superior o igual a 0 como precio mínimo";
        filtrar.disabled = true;
        filtrar.classList.add("disabled");
    } else {
        /* Si es correcto lo limpia y si Hasta tampoco tiene error, habilita filtrar */
        mensajeErrorMin.textContent = "";
        if (mensajeErrorMax.textContent.length == 0) {
            filtrar.disabled = false;
            filtrar.classList.remove("disabled");
        }
    }
})

/* Cada vez que cambia el valor de precioMax */
precioMaxInput.addEventListener("input", () => {
    const valor = precioMaxInput.value.trim();

    /* Si no está vacío y no es numérico o es < 0, saca mensaje de error y deshabilita filtrar */
    if (valor.length > 0 && !(valor >= 0)) {
        mensajeErrorMax.textContent = "Introduzca un valor numérico superior o igual a 0 como precio máximo";
        filtrar.disabled = true;
        filtrar.classList.add("disabled");
    } else {
        /* Si es correcto lo limpia y si Desde tampoco tiene error, habilita filtrar */
        mensajeErrorMax.textContent = "";
        if (mensajeErrorMin.textContent.length == 0) {
            filtrar.disabled = false;
            filtrar.classList.remove("disabled");
        }
    }
})