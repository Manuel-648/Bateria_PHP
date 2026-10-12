<?php

// Operadores disponibles en el desplegable
$operadores = ["and", "or", "xor", "+", "-"];

// Convierte el texto recibido por GET en un booleano.
// Por GET todo llega como cadena, y en PHP la cadena "false" sería true,
// así que hay que interpretarla a mano.
function aBooleano($texto) {
    $limpio = strtolower(trim($texto));
    if ($limpio == "false") {
        return false;
    }
    if (is_numeric($limpio)) {
        return ((float)$limpio != 0);   // 0 -> false, cualquier otro número -> true
    }
    return ($limpio != "");             // cadena vacía -> false, el resto -> true
}

// Convierte un booleano en el texto "true" o "false" (echo false no imprime nada)
function textoBooleano($valor) {
    if ($valor) {
        return "true";
    }
    return "false";
}

// Valores por defecto (formulario vacío la primera vez que se entra)
$valor1 = "";
$valor2 = "";
$operador = "";
$salida = "";

// Si el formulario se envió, llegan los tres datos por la URL
if (isset($_GET["valor1"]) && isset($_GET["operador"]) && isset($_GET["valor2"])) {

    $valor1 = $_GET["valor1"];
    $operador = $_GET["operador"];
    $valor2 = $_GET["valor2"];

    // If encadenado para decidir qué operación hacer
    if ($operador == "and") {
        // Los paréntesis son necesarios: sin ellos, "=" tiene más prioridad que "and"
        $logico = (aBooleano($valor1) and aBooleano($valor2));
        $resultado = textoBooleano($logico);

    } elseif ($operador == "or") {
        $logico = (aBooleano($valor1) or aBooleano($valor2));
        $resultado = textoBooleano($logico);

    } elseif ($operador == "xor") {
        $logico = (aBooleano($valor1) xor aBooleano($valor2));
        $resultado = textoBooleano($logico);

    } elseif ($operador == "+" || $operador == "-") {
        // Las operaciones aritméticas solo tienen sentido con números
        if (is_numeric($valor1) && is_numeric($valor2)) {
            if ($operador == "+") {
                $resultado = $valor1 + $valor2;
            } else {
                $resultado = $valor1 - $valor2;
            }
        } else {
            $resultado = "Error: para sumar o restar hacen falta dos números";
        }

    } else {
        $resultado = "Error: operador no válido";
    }

    // htmlspecialchars evita que alguien meta código raro a través de la URL
    $operacion = $valor1 . " " . $operador . " " . $valor2 . " → " . $resultado;
    $salida = "<h2>Resultado:</h2>";
    $salida .= "<p class='resultado'>" . htmlspecialchars($operacion) . "</p>";
}

// Las <option> del desplegable, dejando marcada la última elegida
$opcionesOperador = "";
foreach ($operadores as $op) {
    $seleccionada = "";
    if ($op == $operador) {
        $seleccionada = " selected";
    }
    $opcionesOperador .= "<option value='" . $op . "'" . $seleccionada . ">" . $op . "</option>";
}

// Valores ya escapados para devolverlos a los inputs y poder encadenar pruebas
$valor1Seguro = htmlspecialchars($valor1, ENT_QUOTES);
$valor2Seguro = htmlspecialchars($valor2, ENT_QUOTES);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comparator</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 60px; }
        input, select, button { font-size: 16px; padding: 8px 12px; margin: 5px; }
        button { cursor: pointer; }
        .resultado { font-size: 24px; font-weight: bold; color: #333; }
    </style>
</head>
<body>
    <h1>Comparator</h1>

    <?php echo $salida; ?>

    <form method="get" action="">
        <input type="text" name="valor1" placeholder="Valor 1" value="<?php echo $valor1Seguro; ?>">

        <select name="operador">
            <?php echo $opcionesOperador; ?>
        </select>

        <input type="text" name="valor2" placeholder="Valor 2" value="<?php echo $valor2Seguro; ?>">

        <br>
        <button type="submit">Calcular</button>
    </form>
</body>
</html>