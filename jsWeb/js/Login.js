/* ====== VARIABLES ===== */
/* Formulario */
const mensajeError = document.getElementById("mensajeError");

/* Comprobar */
let comprobarUser = false;
let comprobarConexion = true;

/* ===== FUNCIONES ===== */
/* Get de usuarios y direccion */
async function getUsuarios(usr, psw) {
    /* Crea array para añadir usuarios */
    let usuarios = [];

    try {
        /* Pide usuarios al json */
        const response = await fetch(API_URL_USUARIOS);

        /* Saca mensaje de error por consola en caso de error */
        if (!response.ok) {
            throw new Error("No se han podido cargar los usuarios")
        }

        /* Añade los usuarios al array */
        usuarios = await response.json();

        /* Compara usuarios con datos introducidos */
        for (const u of usuarios) {
            comprobarLogin(u, usr, psw);
        }
    } catch (error) {
        alert("No se ha podido comprobar si el usuario y la contraseña son correctos.");
        comprobarConexion = false;
    }

}

/* Comprobar formulario */
function comprobarLogin(usuario, usr, psw) {
    if (usr === usuario.nombre && psw === usuario.contrasenia) {

        /* Guardar id, nombre y saldo en localStorage */
        let usuarioLogueado = {
            id_usuario: usuario.id_usuario,
            nombre: usuario.nombre,
            saldo: usuario.saldo
        };
        localStorage.setItem("usuario", JSON.stringify(usuarioLogueado));

        /* Redirige a tienda */
        window.location.href = "../html/Tienda.html";

        comprobarUser = true;
    }
}


/* ===== EVENTOS ===== */
/* Al enviar formulario */
document.querySelector("form").addEventListener("submit", async (e) => {
    /* Cancelar el envío del formulario y por tanto la recarga */
    e.preventDefault();

    /* Eliminar el usuario guardado anteriormente */
    localStorage.removeItem("usuario");

    /* Elimina posible mensaje de error */
    mensajeError.textContent = "";

    /* Recoge datos y los comprueba */
    const usr = document.getElementById("usuario").value;
    const psw = document.getElementById("contrasenia").value;
    await getUsuarios(usr, psw);

    if (!comprobarConexion) {
        comprobarConexion = true;
        return;
    }

    /* Si el login no es correcto y el formulario no esta vacio
    saca mensaje de error */
    if (!comprobarUser)
        mensajeError.textContent = "Usuario o contraseña incorrectos";
})