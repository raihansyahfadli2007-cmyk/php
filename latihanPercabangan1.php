<?php

// Input angka
$angka = readline("Masukkan sebuah angka: ");

// Proses menentukan ganjil atau genap
if ($angka % 2 == 0) {
    echo "Angka $angka adalah GENAP";
} else {
    echo "Angka $angka adalah GANJIL";
}

?>