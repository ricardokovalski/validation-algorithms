<?php

$cnpj = str_pad(preg_replace("/[^0-9]/", "", $string), 14, '0', STR_PAD_LEFT);
	
if (strlen($cnpj) != 14) {
    return false;
}

if (preg_match('/^(\d)\1{13}$/', $cnpj)) {
    return false;
}

for ($i = 0, $j = 5, $k = 6, $soma1 = 0, $soma2 = 0; $i < 13; $i++, $j--, $k--) {
    $j = ($j == 1) ? 9 : $j;
    $k = ($k == 1) ? 9 : $k;
    $soma2 += ($cnpj{$i} * $k);
    if ($i < 12) {
        $soma1 += ($cnpj{$i} * $j);
    }
}

if ($cnpj{12} != (($soma1 % 11) < 2) ? 0 : (11 - ($soma1 % 11))) {
    return false;
}

if ($cnpj{13} != (($soma2 % 11) < 2) ? 0 : (11 - ($soma2 % 11))) {
    return false;
}

return true;
