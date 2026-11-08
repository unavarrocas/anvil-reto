/* ===== VARIABLES ===== */
/* Contenedor de cards */
const cards = document.querySelector("#cards section");

/* ===== FUNCIONES ===== */
/* Cargar juegos del usuario */
/* Conexion con server */
async function cargarBiblioteca() {
    /* Declarar arrays */
    let biblioteca = [];
    let juegos = [];

    try {
        /* Recoger relaciones usuario-juego del server */
        const responseBiblioteca = await fetch(API_URL_BIBLIOTECA);

        if (!responseBiblioteca.ok) {
            throw new Error("No se ha podido cargar la biblioteca");
        }

        /* Recoger juegos del server */
        const responseJuegos = await fetch(API_URL_JUEGOS);

        if (!responseJuegos.ok) {
            throw new Error("No se han podido cargar los juegos");
        }

        /* Introducirlos en los arrays */
        biblioteca = await responseBiblioteca.json();
        juegos = await responseJuegos.json();

        /* Vaciar HTML de cards */
        cards.innerHTML = "";

        /* Recorrer la biblioteca y quedarse con las del usuario logueado */
        for (const b of biblioteca) {
            /* Compara con el id del objeto usuario que habíamos creado en Script.js */
            if (b.id_usuario === usuario.id_usuario) {
                /* Buscar el juego que corresponde y crear su card */
                for (const j of juegos) {
                    if (j.id_juego === b.id_juego)
                        crearCard(j);
                }
            }
        }

        /* Mensaje si el usuario no tiene juegos */
        if (cards.innerHTML === "") {
            cards.innerHTML = "<p>Todavía no tienes juegos en tu biblioteca.</p>";
        }
    } catch (error) {
        /* Mensaje de error si no consigue conectarse al server */
        alert("No se han podido cargar tus juegos.");
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
    let p = document.createElement("p");
    let papelera = document.createElement("img");

    /* Darle contenido */
    article.id = juego.id_juego;
    img.src = juego.imagen;
    h3.textContent = juego.nombre;
    spanPegi.textContent = "PEGI " + juego.pegi;
    p.textContent = juego.descripcion;
    papelera.src = "../resources/papelera.png";

    /* Al clicar en la papelera */
    papelera.addEventListener("click", async () => {

        let confirmacion = confirm("¿Seguro que quiere eliminar " + juego.nombre + " de su biblioteca? En ningún caso se le reembolsará el dinero.");
        if (!confirmacion)
            return;

        try {
            /* Recoger relaciones usuario-juego del server */
            const responseBiblioteca = await fetch(API_URL_BIBLIOTECA);

            if (!responseBiblioteca.ok) {
                throw new Error("No se ha podido cargar la biblioteca");
            }

            let biblioteca = await responseBiblioteca.json();

            /* Buscar la relacion por id_usuario e id_juego y borrarla del server */
            for (const b of biblioteca) {
                if (b.id_usuario === usuario.id_usuario && b.id_juego === juego.id_juego) {
                    const response = await fetch(API_URL_BIBLIOTECA + "/" + b.id, {
                        method: "DELETE"
                    });

                    if (!response.ok) {
                        throw new Error("No se ha podido eliminar el juego");
                    }
                }
            }

            /* Quitar la card de la pagina */
            article.remove();

            /* Mensaje si ya no quedan juegos */
            if (cards.innerHTML === "") {
                cards.innerHTML = "<p>Todavía no tienes juegos en tu biblioteca.</p>";
            }
        } catch (error) {
            /* Mensaje de error si no consigue borrar */
            alert("No se ha podido eliminar el juego.");
        }
    })

    /* Montarlo y anadirlo */
    div.append(h3, spanPegi);
    aside.append(div, p, papelera);
    article.append(img, aside);
    cards.append(article);
}

/* ===== EVENTOS ===== */
/* Cargar juegos del usuario al principio */
cargarBiblioteca();