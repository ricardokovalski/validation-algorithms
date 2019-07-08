<?php

$cnpj = str_pad(preg_replace("/[^0-9]/", "", $string), 14, '0', STR_PAD_LEFT);
	
if (strlen($cnpj) != 14) {
    return false;
}

if (preg_match('/^(\d)\1{13}$/', $cnpj)) {
    return false;
}

for ($t = 12; $t < 14; $t++) {
    for ($d = 0, $p = $t - 7, $c = 0; $c < $t; $c++) {
        $d += $cnpj{$c} * $p;
        $p = ($p < 3) ? 9 : --$p;
    }
    
    $d = ((10 * $d) % 11) % 10;
    
    if ($cnpj{$c} != $d) {
        return false;
    }
}

return true;
