<?php

// Lista de dibujos de dado (posición 1 a 6)
$caras = ["", "⚀", "⚁", "⚂", "⚃", "⚄", "⚅"];

// Por defecto no se muestra nada
$salida = "";

// Si se pulsó el botón, lanzamos el dado y preparamos el texto a mostrar
if (isset($_GET["lanzar"])) {
    $resultado = rand(1, 6);
    $salida = "<div class='dado'>" . $caras[$resultado] . "</div>";
    $salida .= "<p>Ha salido el número: <strong>" . $resultado . "</strong></p>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lanzamiento de dados</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 60px; }
        .dado { font-size: 120px; line-height: 1; }
        button { font-size: 18px; padding: 10px 24px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Lanzamiento de dados</h1>

    <form method="get" action="parte1.php">
        <button type="submit" name="lanzar" value="1">Lanzar dado</button>
    </form>

    <?php echo $salida; ?>
</body>
</html>