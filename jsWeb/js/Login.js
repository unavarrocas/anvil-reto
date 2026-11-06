/* ====== VARIABLES ===== */
/* Formulario */
const mensajeError = document.getElementById("mensajeError");

/* Comprobar */
let comprobar = false;

/* ===== FUNCIONES ===== */
/* Get de usuarios y direccion */
async function getUsuarios(usr, psw) {
    let usuarios = [];

    const response = await fetch(API_URL_USUARIOS);

    if (!response.ok) {
        throw new Error("No se han podido cargar los usuarios")
    }

    usuarios = await response.json();

    for (const u of usuarios) {
        comprobarLogin(u, usr, psw);
    }
}

/* Comprobar formulario */
function comprobarLogin(usuario, usr, psw) {
    if (usr === usuario.nombre && psw === usuario.contrasenia) {
        window.location.href = "../html/Tienda.html";
        comprobar = true;
    }
}


/* ===== EVENTOS ===== */
/* Al enviar formulario */
document.querySelector("form").addEventListener("submit", async (e) => {
    /* Cancelar el envío del formulario y por tanto la recarga */
    e.preventDefault();

    /* Recoge datos y los comprueba */
    const usr = document.getElementById("usuario").value;
    const psw = document.getElementById("contrasenia").value;
    await getUsuarios(usr, psw);

    /* Si el login no es correcto y el formulario no esta vacio
    saca mensaje de error */
    if (!comprobar)
        mensajeError.textContent = "Usuario o contraseña incorrectos";
})