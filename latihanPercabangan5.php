<?php
$a = (float) readline("Masukkan nilai A: ");
$b = (float) readline("Masukkan nilai B: ");
$c = (float) readline("Masukkan nilai C: ");

// Cek nilai A
if ($a == 0) {
    echo "Bukan merupakan persamaan kuadrat";
} else {

    // Menghitung diskriminan
    $D = ($b * $b) - (4 * $a * $c);

    // Menampilkan persamaan kuadrat
    echo "Persamaan Kuadrat: {$a}x^2 + ({$b})x + ({$c}) = 0\n";
    echo "Nilai Diskriminan: " . $D . "\n";

    // Menentukan jenis akar
    if ($D > 0) {

        $x1 = (-$b + sqrt($D)) / (2 * $a);
        $x2 = (-$b - sqrt($D)) / (2 * $a);

        echo "Merupakan Akar Berbeda\n";
        echo "Nilai Akar x1: " . $x1 . "\n";
        echo "Nilai Akar x2: " . $x2 . "\n";

    } elseif ($D < 0) {

        $real = -$b / (2 * $a);
        $imajiner = sqrt(-$D) / abs(2 * $a);

        echo "Merupakan Akar Imajiner\n";
        echo "Rumus Akar x1: " . $real . " + " . $imajiner . "i\n";
        echo "Rumus Akar x2: " . $real . " - " . $imajiner . "i\n";

    } else {

        $x = -$b / (2 * $a);

        echo "Merupakan Akar Kembar\n";
        echo "Nilai Akar: " . $x . "\n";
    }
}
?>
