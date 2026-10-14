<?php
do {
    $angka = (int) readline("Masukkan Angka Bebas: ");

    if ($angka % 2 == 0) {
        echo "Angka $angka merupakan genap\n";
    } else {
        echo "Angka $angka merupakan ganjil\n";
    }

    $ulang = readline("Ingin mengulanginya lagi? (Y/N): ");
    echo "\n";

} while (strtoupper($ulang) == "Y");

echo "Program Berhenti\n";
echo "Terima kasih telah menggunakan program saya ^^ \n";
?>