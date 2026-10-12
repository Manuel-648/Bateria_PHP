<?php

// Opciones de cada desplegable guardadas en arrays
$introducciones = [
    "Yo en tu lugar",
    "La verdad es que",
    "Tú sabes que",
    "No hay duda de que",
    "Al final",
    "La gente no se da cuenta de que"
];

$acciones = [
    "siempre hay que invertir en",
    "lo importante es",
    "nunca subestimes",
    "yo siempre digo que",
    "el secreto está en",
    "hay que tener mucho cuidado con",
    "nadie te cuenta la verdad sobre"
];

$cierres = [
    "la bolsa de valores",
    "el no tener dinero congelado en el banco",
    "los chemtrails",
    "la nube",
    "las crypto",
    "los chiringuitos que pagamos entre todos",
    "los bancos y sus comisiones"
];

// Función que convierte un array en el texto HTML de las <option>
function crearOpciones($lista) {
    $html = "";
    foreach ($lista as $opcion) {
        $texto = htmlspecialchars($opcion);
        $html .= "<option value='" . $texto . "'>" . $texto . "</option>";
    }
    return $html;
}

// Las <option> ya preparadas para que el HTML solo tenga que mostrarlas
$opcionesIntroduccion = crearOpciones($introducciones);
$opcionesAccion = crearOpciones($acciones);
$opcionesCierre = crearOpciones($cierres);

// Por defecto no se muestra ninguna frase
$salida = "";
$hayFrase = false;

if (isset($_GET["aleatorio"])) {

    // MODO ALEATORIO: array_rand devuelve una posición al azar del array
    $introduccion = $introducciones[array_rand($introducciones)];
    $accion = $acciones[array_rand($acciones)];
    $cierre = $cierres[array_rand($cierres)];
    $hayFrase = true;

} elseif (isset($_GET["introduccion"]) && isset($_GET["accion"]) && isset($_GET["cierre"])) {

    // MODO MANUAL: recogemos las tres opciones de los desplegables
    $introduccion = $_GET["introduccion"];
    $accion = $_GET["accion"];
    $cierre = $_GET["cierre"];

    // EXTRA LIFE: si el input custom no está vacío, sustituye al desplegable
    // (trim quita los espacios para que "   " cuente como vacío)
    if (isset($_GET["custom_introduccion"]) && trim($_GET["custom_introduccion"]) != "") {
        $introduccion = trim($_GET["custom_introduccion"]);
    }
    if (isset($_GET["custom_accion"]) && trim($_GET["custom_accion"]) != "") {
        $accion = trim($_GET["custom_accion"]);
    }
    if (isset($_GET["custom_cierre"]) && trim($_GET["custom_cierre"]) != "") {
        $cierre = trim($_GET["custom_cierre"]);
    }
    $hayFrase = true;
}

if ($hayFrase) {
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
    <title>Constructor de frases cuñado 2: the revengeance</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 60px; }
        select, input, button { font-size: 16px; padding: 8px 12px; margin: 5px; }
        button { cursor: pointer; }
        .columna { display: inline-block; vertical-align: top; }
        .frase { font-size: 24px; font-style: italic; color: #333; }
    </style>
</head>
<body>
    <h1>Constructor de frases cuñado 2: the revengeance</h1>

    <form method="get" action="">

        <div class="columna">
            <select name="introduccion">
                <?php echo $opcionesIntroduccion; ?>
            </select>
            <br>
            <input type="text" name="custom_introduccion" placeholder="Introducción custom">
        </div>

        <div class="columna">
            <select name="accion">
                <?php echo $opcionesAccion; ?>
            </select>
            <br>
            <input type="text" name="custom_accion" placeholder="Acción custom">
        </div>

        <div class="columna">
            <select name="cierre">
                <?php echo $opcionesCierre; ?>
            </select>
            <br>
            <input type="text" name="custom_cierre" placeholder="Cierre custom">
        </div>

        <br>
        <button type="submit">Generar frase</button>
        <button type="submit" name="aleatorio" value="1">Frase aleatoria</button>
    </form>

    <?php echo $salida; ?>
</body>
</html>