<?php

if( ! function_exists('parseLine') ) {
    /**
     * @throws Exception
     */
    function parseLine(string $line): array
    {
        $data = json_decode($line, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid json: ' . json_last_error_msg());
        }
        if (!isLineDataValid($data)) {
            throw new Exception('Invalid line data:' . $line);
        }

        return $data;
    }
}

if( ! function_exists('isLineDataValid') ) {
    function isLineDataValid(array $data): bool
    {
        if (!isset($data['bin']) || !isset($data['amount']) || !isset($data['currency'])) {
            return false;
        }
        if (!is_numeric($data['bin']) || !is_numeric($data['amount']) || !is_string($data['currency']) || strlen($data['currency']) != 3) {
            return false;
        }

        return true;
    }
}

if( ! function_exists('getBin') ) {
    /**
     * @throws Exception
     */
    function getBin(string $bin): array
    {
        return getFromUrl('https://lookup.binlist.net/' . $bin);
    }
}

if( ! function_exists('getExchangeRate') ) {
    /**
     * @throws Exception
     */
    function getExchangeRate(string $currency): ?float
    {
        $rate = getFromUrl('https://api.exchangeratesapi.io/latest');

        return $rate['rates'][$currency] ?? null;
    }
}

if( ! function_exists('getFromUrl') ) {
    /**
     * @throws Exception
     */
    function getFromUrl(string $url): array
    {
        $data = file_get_contents($url);
        if (!$data) {
            return [];
        }
        $r = json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Invalid json: ' . json_last_error_msg());
        }

        return $r;
    }
}


if( ! function_exists('isEu') ) {
    function isEu($c): bool
    {
        $eus = [
            'AT' => 1,
            'BE' => 1,
            'BG' => 1,
            'CY' => 1,
            'CZ' => 1,
            'DE' => 1,
            'DK' => 1,
            'EE' => 1,
            'ES' => 1,
            'FI' => 1,
            'FR' => 1,
            'GR' => 1,
            'HR' => 1,
            'HU' => 1,
            'IE' => 1,
            'IT' => 1,
            'LT' => 1,
            'LU' => 1,
            'LV' => 1,
            'MT' => 1,
            'NL' => 1,
            'PO' => 1,
            'PT' => 1,
            'RO' => 1,
            'SE' => 1,
            'SI' => 1,
            'SK' => 1,
        ];

        return isset($eus[$c]);
    }
}