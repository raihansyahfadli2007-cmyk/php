<?php

$daftarNama = [];
$menu = "";

do {
    echo "\nMenu\n";
    echo "1. Create\n";
    echo "2. Display\n";
    echo "3. Edit\n";
    echo "4. Delete\n";
    echo "0. Exit\n";

    $menu = trim(readline("Enter Menu: "));

    switch ($menu) {

        // CREATE
        case "1":
            $daftarNama = [];
            $index = 0;

            while (true) {
                $nama = readline("Index $index: ");

                if (trim($nama) == "") {
                    break;
                }

                $daftarNama[] = $nama;
                $index++;
            }

            echo "Data Successfully Added\n";
            break;

        // DISPLAY
        case "2":
            if (empty($daftarNama)) {
                echo "Daftar nama masih kosong\n";
            } else {
                foreach ($daftarNama as $index => $nama) {
                    echo "Index $index: $nama\n";
                }
            }

            echo "Data Successfully Displayed\n";
            break;

        // EDIT
        case "3":
            if (empty($daftarNama)) {
                echo "Daftar nama masih kosong\n";
                break;
            }

            $index = trim(readline("Enter the index you want to edit: "));

            if (!ctype_digit($index) || !array_key_exists((int)$index, $daftarNama)) {
                echo "Invalid Index\n";
                break;
            }

            $namaBaru = trim(readline("Enter the new name: "));

            if ($namaBaru == "") {
                echo "Nama tidak boleh kosong\n";
                break;
            }

            $daftarNama[(int)$index] = $namaBaru;

            echo "Data in the list has been successfully changed\n";
            break;

        // DELETE
        case "4":
            if (empty($daftarNama)) {
                echo "Daftar nama masih kosong\n";
                break;
            }

            $index = trim(readline("Enter the index you want to delete: "));

            if (!ctype_digit($index) || !array_key_exists((int)$index, $daftarNama)) {
                echo "Invalid Index\n";
                break;
            }

            array_splice($daftarNama, (int)$index, 1);

            echo "Data Successfully Deleted\n";
            break;

        // EXIT
        case "0":
            echo "Thank you for using my program\n";
            break;

        // INVALID INPUT
        default:
            echo "Invalid Input\n";
            break;
    }

} while ($menu != "0");

?>
