<?php

function contarMaiusculas($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_upper($senha[$i])) {
            $quantidade++;
        }
    }

    return $quantidade;
}

function contarMinusculas($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_lower($senha[$i])) {
            $quantidade++;
        }
    }

    return $quantidade;
}

function contarNumeros($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (is_numeric($senha[$i])) {
            $quantidade++;
        }
    }

    return $quantidade;
}

function contarEspeciais($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (!ctype_alnum($senha[$i])) {
            $quantidade++;
        }
    }

    return $quantidade;
}

function classificarSenha($senha) {
    $pontos = 0;

    if (strlen($senha) >= 8) {
        $pontos++;
    }

    if (contarMaiusculas($senha) > 0) {
        $pontos++;
    }

    if (contarMinusculas($senha) > 0) {
        $pontos++;
    }

    if (contarNumeros($senha) > 0) {
        $pontos++;
    }

    if (contarEspeciais($senha) > 0) {
        $pontos++;
    }

    if ($pontos <= 2) {
        return "Fraca";
    } elseif ($pontos == 3) {
        return "Média";
    } elseif ($pontos == 4) {
        return "Forte";
    } else {
        return "Muito Forte";
    }
}

function analisarSenha($senha) {
    return [
        "Maiúsculas" => contarMaiusculas($senha),
        "Minúsculas" => contarMinusculas($senha),
        "Números" => contarNumeros($senha),
        "Especiais" => contarEspeciais($senha),
        "Tamanho" => strlen($senha),
        "Segurança" => classificarSenha($senha)
    ];
}


$senha = "Senha123!";

$resultado = analisarSenha($senha);

echo "Senha: $senha<br>";
echo "Maiúsculas: " . $resultado["Maiúsculas"] . "<br>";
echo "Minúsculas: " . $resultado["Minúsculas"] . "<br>";
echo "Números: " . $resultado["Números"] . "<br>";
echo "Caracteres especiais: " . $resultado["Especiais"] . "<br>";
echo "Tamanho: " . $resultado["Tamanho"] . "<br>";
echo "Nível de segurança: " . $resultado["Segurança"];

?>