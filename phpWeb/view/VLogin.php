<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANVIL - Login</title>
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="css/Login.css">
</head>

<body>

    <!-- Formulario -->
    <main>
        <form method="post" action="?entity=login&action=login">
            <img src="resources/logoAnvil.png" alt="Logo de Anvil">
            <h1>Inicia sesión</h1>

            <label for="usuario">Nombre de la cuenta</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="contrasenia">Contraseña</label>
            <input type="password" id="contrasenia" name="contrasenia" required>

            <button type="submit">Iniciar sesión</button>
            <!-- Pequeño evento de js para cerrar pestaña -->
            <button type="button" onclick="window.close()">Cerrar</button>
        </form>
    </main>

    <!-- Aside para imagen -->
    <aside></aside>

</body>

</html>