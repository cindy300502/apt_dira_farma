<?php

function formatRupiah($number) {
    // Remove any non-numeric characters
    $number = preg_replace('/[^0-9]/', '', $number);

    // Format the number with separators
    $formatted = number_format($number, 0, ',', '.');

    // Add the currency symbol and return the formatted number
    return 'Rp ' . $formatted;
}

?>