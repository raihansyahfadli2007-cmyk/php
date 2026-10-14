
<?php
$max = (int) readline("Input Nilai Max: ");

if ($max > 0) {

    // Bagian turun
    for ($i = $max; $i >= 1; $i--) {
        for ($j = 1; $j <= $i; $j++) {
            echo $i;
        }
        echo "\n";
    }

    // Bagian naik
    for ($i = 2; $i <= $max; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo $i;
        }
        echo "\n";
    }

} else {
    echo "Masukkan angka lebih dari 0!\n";
}
?>
