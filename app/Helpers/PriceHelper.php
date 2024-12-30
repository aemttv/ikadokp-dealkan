<?php

if (!function_exists('format_price')) {
    /**
     * Format price into readable format (e.g., "1 juta", "250 ribu", "1 miliar").
     *
     * @param int|float $price The price to format.
     * @return string Formatted price.
     */
    function format_price($price)
    {
        if ($price >= 1_000_000_000) {
            $formatted = $price / 1_000_000_000;
            return rtrim(rtrim(number_format($formatted, 2), '0'), '.') . ' Miliar'; // Buang desimal jika tidak diperlukan
        } elseif ($price >= 1_000_000) {
            $formatted = $price / 1_000_000;
            return rtrim(rtrim(number_format($formatted, 2), '0'), '.') . ' Juta'; // Buang desimal jika tidak diperlukan
        } elseif ($price >= 1_000) {
            return number_format($price / 1_000, 0) . ' Ribu';
        } else {
            return number_format($price, 0);
        }
    }
}

