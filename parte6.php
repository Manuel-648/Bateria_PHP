<?php

// Frase original
$frase = "Hace frío mucho frío tiempo frío que frío me frío estoy frío quedando frío contigo frío";

// Convertimos la frase en un array de palabras (cortando por cada espacio)
$palabras = explode(" ", $frase);

// Nos quedamos solo con las palabras en posición impar (1ª, 3ª, 5ª...)
// Los arrays empiezan en la posición 0, así que la 1ª palabra es la 0,
// la 3ª es la 2, la 5ª es la 4... Por eso el bucle va de 2 en 2 empezando en 0.
$palabrasImpares = [];
for ($i = 0; $i < count($palabras); $i += 2) {
    $palabrasImpares[] = $palabras[$i];
}

// Unimos las palabras que quedan con espacios para formar la nueva frase
$fraseNueva = implode(" ", $palabrasImpares);

// htmlspecialchars por buena costumbre al mostrar texto en HTML
$fraseSegura = htmlspecialchars($frase);
$fraseNuevaSegura = htmlspecialchars($fraseNueva);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Trabajando con strings "cachondas"</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 60px; }
        .frase { font-size: 24px; font-style: italic; color: #333; }
    </style>
</head>
<body>
    <h1>Trabajando con strings "cachondas"</h1>

    <h2>Frase original:</h2>
    <p class="frase"><?php echo $fraseSegura; ?></p>

    <h2>Frase solo con las palabras en posición impar:</h2>
    <p class="frase"><?php echo $fraseNuevaSegura; ?></p>
</body>
</html>