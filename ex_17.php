<?php

function contarCaracteres($texto) {
    return strlen($texto);
}

function contarPalavras($texto) {
    $palavras = preg_split('/\s+/', trim($texto));
    return count($palavras);
}

function contarFrases($texto) {
    $frases = preg_split('/[.!?]+/', trim($texto));
    return count(array_filter($frases));
}

function encontrarMaiorPalavra($texto) {
    $palavras = preg_split('/\s+/', trim($texto));
    $maior = "";

    foreach ($palavras as $palavra) {
        $palavra = preg_replace('/[^a-zA-ZÀ-ÿ]/', '', $palavra);

        if (strlen($palavra) > strlen($maior)) {
            $maior = $palavra;
        }
    }

    return $maior;
}

function encontrarMenorPalavra($texto) {
    $palavras = preg_split('/\s+/', trim($texto));
    $menor = $palavras[0];

    foreach ($palavras as $palavra) {
        $palavra = preg_replace('/[^a-zA-ZÀ-ÿ]/', '', $palavra);

        if (strlen($palavra) < strlen($menor)) {
            $menor = $palavra;
        }
    }

    return $menor;
}

function contarRepetidas($texto) {
    $palavras = preg_split('/\s+/', strtolower(trim($texto)));
    $contagem = array_count_values($palavras);
    $repetidas = 0;

    foreach ($contagem as $quantidade) {
        if ($quantidade > 1) {
            $repetidas++;
        }
    }

    return $repetidas;
}

function cincoMaisFrequentes($texto) {
    $palavras = preg_split('/\s+/', strtolower(trim($texto)));
    $contagem = array_count_values($palavras);

    arsort($contagem);

    return array_slice($contagem, 0, 5, true);
}

function removerEspacos($texto) {
    return preg_replace('/\s+/', ' ', trim($texto));
}

function formatarTexto($texto) {
    return ucwords(strtolower($texto));
}

function processarTexto($texto) {

    return [
        "Caracteres" => contarCaracteres($texto),
        "Palavras" => contarPalavras($texto),
        "Frases" => contarFrases($texto),
        "Maior palavra" => encontrarMaiorPalavra($texto),
        "Menor palavra" => encontrarMenorPalavra($texto),
        "Palavras repetidas" => contarRepetidas($texto),
        "Mais frequentes" => cincoMaisFrequentes($texto),
        "Sem espaços duplicados" => removerEspacos($texto),
        "Texto formatado" => formatarTexto($texto)
    ];
}


$texto = "o aluno estuda muito. o aluno aprende muito.";

$resultado = processarTexto($texto);

echo "Caracteres: " . $resultado["Caracteres"] . "<br>";
echo "Palavras: " . $resultado["Palavras"] . "<br>";
echo "Frases: " . $resultado["Frases"] . "<br>";
echo "Maior palavra: " . $resultado["Maior palavra"] . "<br>";
echo "Menor palavra: " . $resultado["Menor palavra"] . "<br>";
echo "Palavras repetidas: " . $resultado["Palavras repetidas"] . "<br>";

echo "5 palavras mais frequentes:<br>";

foreach ($resultado["Mais frequentes"] as $palavra => $quantidade) {
    echo $palavra . " (" . $quantidade . " vezes)<br>";
}

echo "Texto sem espaços duplicados: " . $resultado["Sem espaços duplicados"] . "<br>";
echo "Texto formatado: " . $resultado["Texto formatado"];

?>