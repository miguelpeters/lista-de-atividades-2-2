<?php

function contarConsultas($consultas) {
    return count($consultas);
}

function contarPacientes($consultas) {
    $pacientes = [];

    foreach ($consultas as $consulta) {
        $pacientes[$consulta["paciente"]] = true;
    }

    return count($pacientes);
}

function contarEspecialidades($consultas) {
    $resultado = [];

    foreach ($consultas as $consulta) {
        $especialidade = $consulta["especialidade"];

        if (isset($resultado[$especialidade])) {
            $resultado[$especialidade]++;
        } else {
            $resultado[$especialidade] = 1;
        }
    }

    return $resultado;
}

function ordenarConsultas($consultas) {
    usort($consultas, function($a, $b) {
        return strcmp($a["horario"], $b["horario"]);
    });

    return $consultas;
}

function pesquisarPaciente($consultas, $nome) {
    $resultado = [];

    foreach ($consultas as $consulta) {
        if ($consulta["paciente"] == $nome) {
            $resultado[] = $consulta;
        }
    }

    return $resultado;
}

function verificarDuplicados($consultas) {
    $horarios = [];
    
    foreach ($consultas as $consulta) {
        $horarios[] = $consulta["horario"];
    }

    return count($horarios) != count(array_unique($horarios));
}

function organizarAgenda($consultas, $nome) {

    $ordenadas = ordenarConsultas($consultas);

    return [
        "total" => contarConsultas($consultas),
        "pacientes" => contarPacientes($consultas),
        "especialidades" => contarEspecialidades($consultas),
        "primeiro" => $ordenadas[0],
        "ultimo" => $ordenadas[count($ordenadas) - 1],
        "ordenadas" => $ordenadas,
        "pesquisa" => pesquisarPaciente($consultas, $nome),
        "duplicados" => verificarDuplicados($consultas)
    ];
}


$consultas = [
    ["paciente" => "João", "especialidade" => "Cardiologia", "data" => "04/10/2026", "horario" => "08:00"],
    ["paciente" => "Maria", "especialidade" => "Dermatologia", "data" => "04/10/2026", "horario" => "10:00"],
    ["paciente" => "Pedro", "especialidade" => "Ortopedia", "data" => "04/10/2026", "horario" => "14:00"],
    ["paciente" => "João", "especialidade" => "Cardiologia", "data" => "04/10/2026", "horario" => "16:00"]
];

$resultado = organizarAgenda($consultas, "João");

echo "Total de consultas: " . $resultado["total"] . "<br>";
echo "Pacientes diferentes: " . $resultado["pacientes"] . "<br>";

echo "Especialidades:<br>";
foreach ($resultado["especialidades"] as $nome => $quantidade) {
    echo "$nome: $quantidade<br>";
}

echo "Primeiro atendimento: " . $resultado["primeiro"]["horario"] . "<br>";
echo "Último atendimento: " . $resultado["ultimo"]["horario"] . "<br>";

echo "Consultas do João:<br>";
foreach ($resultado["pesquisa"] as $consulta) {
    echo $consulta["horario"] . "<br>";
}

if ($resultado["duplicados"]) {
    echo "Existem horários duplicados.";
} else {
    echo "Não existem horários duplicados.";
}

?>