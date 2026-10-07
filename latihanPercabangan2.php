<?php

$umur = (int) readline("Masukkan umur: ");

if ($umur < 0) {
    echo "Umur tidak boleh negatif!";
} elseif ($umur <= 1) {
    echo "Kategori: Bayi";
} elseif ($umur <= 3) {
    echo "Kategori: Batita";
} elseif ($umur <= 5) {
    echo "Kategori: Balita";
} elseif ($umur <= 12) {
    echo "Kategori: Anak-Anak";
} elseif ($umur <= 17) {
    echo "Kategori: Remaja";
} elseif ($umur <= 21) {
    echo "Kategori: ABG";
} elseif ($umur <= 30) {
    echo "Kategori: Pra Dewasa";
} elseif ($umur <= 50) {
    echo "Kategori: Dewasa";
} elseif ($umur <= 70) {
    echo "Kategori: Pra Lansia";
} else {
    echo "Kategori: Lansia";
}

?>