<?php
/* Si no ha iniciado sesion, le manda para el login, previene el poder entrar sin logear cambiando la url */
if (!isset($_SESSION["usuario"])) {
    header("Location: index.php?entity=login&action=index");
    exit();
}

$pegiValidos = [3, 7, 12, 16, 18];
?>
<!DOCTYPE html>
<html lang="es">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANVIL - Añadir juego</title>
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="css/FormEditCreate.css">
    <link rel="icon" type="image/png" href="resources/logoAnvil.png">
</head>
 
<body>
 
    <main>
        <form method="post" action="index.php?entity=juego&action=store">
            <h1>Añadir juego</h1>
 
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" maxlength="100" required>
 
            <label for="precio">Precio (€)</label>
            <input type="number" id="precio" name="precio" min="0" step="0.01" required>
 
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="5" required></textarea>
 
            <label for="pegi">PEGI</label>
            <select id="pegi" name="pegi" required>
                <?php foreach ($pegiValidos as $valor): ?>
                    <option value="<?php echo $valor; ?>"><?php echo $valor; ?></option>
                <?php endforeach; ?>
            </select>
 
            <div class="botones">
                <button type="submit">Crear juego</button>
                <a href="index.php?entity=juego&action=index">Cancelar</a>
            </div>
        </form>
    </main>
 
</body>
 
</html>
