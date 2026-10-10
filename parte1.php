<?php

//Activa las sesiones: permite recordar datos entre una tirada y la siguiente
session_start();

// Lista de dibujos de dado (posición 1 a 6)
$caras = ["", "⚀", "⚁", "⚂", "⚃", "⚄", "⚅"];

//Si es la primera vez, creamos el historial vacío
if (!isset($_SESSION["historial"])) {
    $_SESSION["historial"] = [];
}

// Si se pulsa el botón de reiniciar, borramos el historial
if (isset($_GET["reiniciar"])) {
    $_SESSION["historial"] = [];
}

// Por defecto no se muestra nada
$salida = "";
$listaHistorial = "";

// Si se pulsó el botón, lanzamos el dado y preparamos el texto a mostrar
if (isset($_GET["lanzar"])) {
    $resultado = rand(1, 6);
    $salida = "<div class='dado'>" . $caras[$resultado] . "</div>";
    $salida .= "<p>Ha salido el número: <strong>" . $resultado . "</strong></p>";

    $salida = "<div class= 'dado'>" . $caras[$resultado] . "</div>";
    $salida .= "<p>Ha salido el número: <strong>" . $resultado . "</strong></p>";
}

// Si hay tiradas guardadas, preparamos la lista del historial
if (count($_SESSION["historial"]) > 0) {
    $listaHistorial = "<h2>Historial de tiradas:</h2><ul>";
    foreach ($_SESSION["historial"] as $posicion => $valor) {
        $listaHistorial .= "<li>" . $caras[$valor] . " (Número: " . $valor . ")</li>";
    }
    $listaHistorial .= "</ul>";
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
        button { font-size: 18px; padding: 10px 24px; cursor: pointer; margin: 0 5px; }
        ul { list-style-type: none; padding: 0; }
    </style>
</head>
<body>
    <h1>Lanzamiento de dados</h1>

    <form method="get" action="parte1.php">
        <button type="submit" name="lanzar" value="1">Lanzar dado</button>
        <button type="submit" name="reiniciar" value="1">Reiniciar dado</button>
    </form>

    <?php echo $salida; ?>
    <?php echo $listaHistorial; ?>
</body>
</html>