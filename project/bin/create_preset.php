<?php

include dirname(dirname(__FILE__)) . '/init.php';

use \Nette\Utils\Arrays as A;

function preparar_metadata($str) {
    $props = explode(';', $str);
    $result = array();
    foreach ($props as $prop) {
        $exp = explode(':', $prop);
        $result[A::get($exp, 0)] = A::get($exp, 1);
    }

    return json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_OBJECT_AS_ARRAY);
}

echo 'Uso: ' . $argv[0] . ' <slug> <titulo> <descricao> metadados (no formato "height:X;width:Y;outrapropriedade:Z")' . PHP_EOL;

$slug = A::get($argv, 1);
$titulo = A::get($argv, 2);
$descricao = A::get($argv, 3, "");
$metadados = preparar_metadata(A::get($argv, 4));

$pdo = \C::connection();


$stmt = $pdo->prepare('insert into preset (slug, titulo, descricao, metadados) values (?, ?, ?, ?)');

$stmt->bindValue(1, $slug);
$stmt->bindValue(2, $titulo);
$stmt->bindValue(3, $descricao);
$stmt->bindValue(4, $metadados);

$stmt->execute();


//$id = $pdo->lastInsertId('preset_id_seq');


echo 'Preset criado.', PHP_EOL;
