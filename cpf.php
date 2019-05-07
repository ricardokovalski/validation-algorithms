<?php

$cpf = str_pad(preg_replace('/[^0-9]/', '', $string), 11, '0', STR_PAD_LEFT);

if (strlen($cpf) != 11) {
    return false;
}

if (preg_match('/(\d)\1{10}/', $cpf)) {
    return false;
}

for ($char = 9; $char < 11; $char++) {

    for ($digit = 0, $column = 0; $column < $char; $column++) {
        $digit += $cpf{$column} * (($char + 1) - $column);
    }

    $digit = ((10 * $digit) % 11) % 10;

    if ($cpf{$column} != $digit) {
        return false;
    }
}

return true;
