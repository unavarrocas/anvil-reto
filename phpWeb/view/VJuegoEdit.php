<?php
// $data viene de CJuego::edit() y es la fila del juego (o null si el id no existe).
$juego = $data;
 
if (!$juego) {
    header("Location: index.php?entity=juego&action=index");
    exit();
}
 
$pegiValidos = [3, 7, 12, 16, 18];
?>
<!DOCTYPE html>
<html lang="es">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANVIL - Editar juego</title>
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="css/FormEditCreate.css">
    <link rel="icon" type="image/png" href="resources/logoAnvil.png">
</head>
 
<body>
 
    <main>
        <form method="post" action="index.php?entity=juego&action=update&id=<?php echo (int) $juego['id_juego']; ?>">
            <h1>Editar juego</h1>
 
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" maxlength="100" required
                value="<?php echo htmlspecialchars($juego['nombre']); ?>">
 
            <label for="precio">Precio (€)</label>
            <input type="number" id="precio" name="precio" min="0" step="0.01" required
                value="<?php echo htmlspecialchars($juego['precio']); ?>">
 
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="5" required><?php echo htmlspecialchars($juego['descripcion']); ?></textarea>
 
            <label for="pegi">PEGI</label>
            <select id="pegi" name="pegi" required>
                <?php foreach ($pegiValidos as $valor): ?>
                    <option value="<?php echo $valor; ?>" <?php echo ((int) $juego['pegi'] === $valor) ? 'selected' : ''; ?>>
                        <?php echo $valor; ?>
                    </option>
                <?php endforeach; ?>
            </select>
 
            <div class="botones">
                <button type="submit">Guardar cambios</button>
                <a href="index.php?entity=juego&action=index">Cancelar</a>
            </div>
        </form>
    </main>
 
</body>
 
</html>
