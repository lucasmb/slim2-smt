<?php

function vd($val) {
    var_dump($val);
    die();
}

function normalize($name) {
    $text = trim($name);

    $text = str_replace(array('Á', 'À', 'ã', 'â', 'à', 'á'), "a", $text);
    $text = str_replace(array('É', 'È', 'é', 'è'), "e", $text);
    $text = str_replace(array('Í', 'Ì', 'í', 'ì'), "i", $text);
    $text = str_replace(array('Ó/', 'Ò', 'ó', 'ò'), "o", $text);
    $text = str_replace(array('Ú', 'Ù', 'ú', 'ù'), "u", $text);
    $text = str_replace(array('Ñ', 'ñ'), "n", $text);
    $text = str_replace(array('Ç', 'ç'), "c", $text);
    $text = str_replace(array('ß'), "ss", $text);

    $text = str_replace(array('.', ",", "_"), "-", $text);
    $text = preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), $text);

    $text = strtolower($text);
    return $text;
}