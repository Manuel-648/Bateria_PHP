<?php

// Por defecto no se muestra ninguna frase
$salida = "";

// Si el formulario se envió (llegan las tres opciones por la URL)
if (isset($_GET["introduccion"]) && isset($_GET["accion"]) && isset($_GET["cierre"])) {

    // Recogemos las tres opciones elegidas
    $introduccion = $_GET["introduccion"];
    $accion = $_GET["accion"];
    $cierre = $_GET["cierre"];

    // Las unimos en una sola frase
    $frase = $introduccion . ", " . $accion . " " . $cierre . ".";

    // htmlspecialchars evita que alguien meta código raro a través de la URL
    $salida = "<h2>Tu frase cuñada:</h2>";
    $salida .= "<p class='frase'>" . htmlspecialchars($frase) . "</p>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Constructor de frases cuñado</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 60px; }
        select, button { font-size: 16px; padding: 8px 12px; margin: 5px; }
        button { cursor: pointer; }
        .frase { font-size: 24px; font-style: italic; color: #333; }
    </style>
</head>
<body>
    <h1>Constructor de frases cuñado</h1>

    <form method="get" action="">
        <select name="introduccion">
            <option value="Yo en tu lugar">Yo en tu lugar</option>
            <option value="La verdad es que">La verdad es que</option>
            <option value="Tú sabes que">Tú sabes que</option>
            <option value="No hay duda de que">No hay duda de que</option>
            <option value="Al final">Al final</option>
        </select>

        <select name="accion">
            <option value="siempre hay que invertir en">siempre hay que invertir en</option>
            <option value="lo importante es">lo importante es</option>
            <option value="nunca subestimes">nunca subestimes</option>
            <option value="yo siempre digo que">yo siempre digo que</option>
            <option value="el secreto está en">el secreto está en</option>
        </select>

        <select name="cierre">
            <option value="la bolsa de valores">la bolsa de valores</option>
            <option value="el no tener dinero congelado en el banco">el no tener dinero congelado en el banco</option>
            <option value="los chemtrails">los chemtrails</option>
            <option value="la nube">la nube</option>
            <option value="las crypto">las crypto</option>
        </select>

        <br>
        <button type="submit">Generar frase</button>
    </form>

    <?php echo $salida; ?>
</body>
</html>