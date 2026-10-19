<?php

function identitas() {
    echo "--------------------\n";
    echo "| Raihansyah Fadli |\n";
    echo "|      Bekasi      |\n";
    echo "--------------------\n";
}

function tambah($a = 5, $b = 5) {
    return $a + $b;
}

function kurang($a = 5, $b = 5) {
    return $a - $b;
}

function bagi($a = 5, $b = 5) {
    return $a / $b;
}

function kali($a = 5, $b = 5) {
    return $a * $b;
}

function modulus($a = 5, $b = 5) {
    return $a % $b;
}

identitas();

while (true) {
    echo "\nMasukkan Menu (+|-|/|*|%|stop): ";
    $menu = trim(fgets(STDIN));

    if (strtolower($menu) == "stop") {
        echo "Program Berhenti, Terima Kasih telah menggunakan program saya.\n";
        break;
    }

    if (!in_array($menu, ["+", "-", "/", "*", "%"])) {
        echo "Menu tidak valid!\n";
        continue;
    }

    echo "Masukkan Nilai 1: ";
    $nilai1 = (float) trim(fgets(STDIN));

    echo "Masukkan Nilai 2: ";
    $nilai2 = (float) trim(fgets(STDIN));

    switch ($menu) {
        case "+":
            $hasil = tambah($nilai1, $nilai2);
            echo "Hasil Penjumlahan $nilai1 + $nilai2 adalah $hasil\n";
            break;

        case "-":
            $hasil = kurang($nilai1, $nilai2);
            echo "Hasil Pengurangan $nilai1 - $nilai2 adalah $hasil\n";
            break;

        case "/":
            if ($nilai2 == 0) {
                echo "Tidak bisa membagi dengan nol!\n";
            } else {
                $hasil = bagi($nilai1, $nilai2);
                echo "Hasil Pembagian $nilai1 / $nilai2 adalah $hasil\n";
            }
            break;

        case "*":
            $hasil = kali($nilai1, $nilai2);
            echo "Hasil Perkalian $nilai1 * $nilai2 adalah $hasil\n";
            break;

        case "%":
            if ($nilai2 == 0) {
                echo "Tidak bisa melakukan modulus dengan nol!\n";
            } else {
                $hasil = modulus((int)$nilai1, (int)$nilai2);
                echo "Hasil Modulus $nilai1 % $nilai2 adalah $hasil\n";
            }
            break;
    }
}

?>
