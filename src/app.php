<?php

require_once __DIR__ . '/../vendor/autoload.php';

if ($argc < 2) {
    echo "\033[31mUsage: php app.php <input_file> <decimals>\033[0m" . PHP_EOL;
    exit(1);
}
if (!file_exists($argv[1])) {
    echo "\033[31mFile not found: \"{$argv[1]}\"\033[0m" . PHP_EOL;
    exit(1);
}
$decimals = $argv[2] ?? 2;
if($decimals < 0 || $decimals > 10) {
    echo "\033[31mDecimals must be between 0 and 10\033[0m" . PHP_EOL;
    exit(1);
}

if( ! function_exists('parseFile') ) {
    function parseFile(string $filename, int $decimals = 2): void
    {
        $file = fopen($filename, 'r');
        while (($line = fgets($file)) !== false) {
            try {
                $data = parseLine($line);
                $bin = getBin($data['bin']);
                $rate = getExchangeRate($data['currency']);
                if ($rate === null || !$bin) {
                    echo "\033[33mBin or rate is unavailable. Can't process {$line}\033[0m";
                    continue;
                }
                $isEu = isset($bin['country']['alpha2']) && isEu($bin['country']['alpha2']);
                $fee = $isEu ? 0.01 : 0.02;
                $amount = $data['amount'];
                if ($rate > 0 && $data['currency'] !== 'EUR') {
                    $amount /= $rate;
                }
                $amount *= $fee;

                $formattedAmount = number_format($amount, $decimals, '.', '');
                echo "\033[32m{$formattedAmount}\033[0m" . PHP_EOL;
            } catch (Exception $e) {
                echo "\033[31m{$e->getMessage()}\033[0m" . PHP_EOL;
            }
        }
        fclose($file);
    }
}

parseFile($argv[1], $decimals);

echo PHP_EOL . "\033[32mDone\033[0m" . PHP_EOL;