<?php
$max = (int) readline("Input Nilai Max: ");

for ($i = $max; $i >= 1; $i--) {
    for ($j = 1; $j <= $i; $j++) {
        echo $i;
    }
    echo "\n";
}
?>
