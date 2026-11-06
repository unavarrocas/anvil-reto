/* ===== VARIABLES ===== */
/* Filtro */
const filtrar = document.getElementById("filtrar");
const limpiar = document.getElementById("limpiar");


/* Contenedor de cards */
const cards = document.querySelector("#cards section");

/* ===== FUNCIONES ===== */
/* Cargar juegos */
/* Conexion con server */
/* Si no recibe valores, estos son los predeterminados */
async function cargarJuegos(precioMin = 0, precioMax = 100) {
    let juegos = [];

    const response = await fetch(API_URL_JUEGOS);

    if (!response.ok) {
        throw new Error("No se han podido cargar los juegos")
    }

    juegos = await response.json();

    for (const j of juegos) {
        if (j.precio >= precioMin && j.precio <= precioMax)
            crearCard(j);
    }
}

/* Crear card */
function crearCard(juego) {
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
    img.src = "../resources/portadaPruebas.jpg";
    h3.textContent = juego.nombre
    spanPegi.textContent = "PEGI " + juego.pegi;
    spanPrecio.textContent = juego.precio + " €";
    p.textContent = juego.descripcion;
    button.textContent = "Añadir al carrito";

    /* Montarlo y anadirlo */
    div.append(h3, spanPegi, spanPrecio);
    aside.append(div, p, button);
    article.append(img, aside);
    cards.append(article);
}

cargarJuegos();

/* ===== EVENTOS ===== */
filtrar.addEventListener("click", (e) => {
    e.preventDefault();

    cards.innerHTML = "";

    var precioMin = Number(document.getElementById("precio-min").value || 0);
    var precioMax = Number(document.getElementById("precio-max").value || 100);

    cargarJuegos(precioMin, precioMax);
})

limpiar.addEventListener("click", () => {
    cards.innerHTML = "";

    cargarJuegos();
})