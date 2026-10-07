<?php

echo "=== PROGRAM KONVERSI SUHU ===\n";
echo "1. Celsius ke Fahrenheit\n";
echo "2. Celsius ke Kelvin\n";
echo "3. Fahrenheit ke Celsius\n";
echo "4. Fahrenheit ke Kelvin\n";
echo "5. Kelvin ke Celsius\n";
echo "6. Kelvin ke Fahrenheit\n";

$menu = readline("Pilih menu (1-6): ");
$suhu = readline("Masukkan suhu: ");

switch ($menu) {
    case 1:
        $hasil = ($suhu * 9 / 5) + 32;
        echo "Hasil: $suhu °C = $hasil °F\n";
        break;

    case 2:
        $hasil = $suhu + 273.15;
        echo "Hasil: $suhu °C = $hasil K\n";
        break;

    case 3:
        $hasil = ($suhu - 32) * 5 / 9;
        echo "Hasil: $suhu °F = $hasil °C\n";
        break;

    case 4:
        $hasil = (($suhu - 32) * 5 / 9) + 273.15;
        echo "Hasil: $suhu °F = $hasil K\n";
        break;

    case 5:
        $hasil = $suhu - 273.15;
        echo "Hasil: $suhu K = $hasil °C\n";
        break;

    case 6:
        $hasil = (($suhu - 273.15) * 9 / 5) + 32;
        echo "Hasil: $suhu K = $hasil °F\n";
        break;

    default:
        echo "Menu tidak tersedia!\n";
        break;
}
?>