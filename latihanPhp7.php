<?php

class LoginSystem {

    // Array maksimal 10 akun
		private $akun = [
    [
        "email" => "raihan@gmail.com",
        "username" => "Raihan",
        "password" => "raihan123"
    ],
    [
        "email" => "tiara@gmail.com",
        "username" => "Tiara",
        "password" => "tiara123"
    ],
    [
        "email" => "jordie@gmail.com",
        "username" => "Jordie",
        "password" => "jordie123"
    ],
    [
        "email" => "ridho@gmail.com",
        "username" => "Ridho",
        "password" => "ridho123"
    ],
    [
        "email" => "budi@gmail.com",
        "username" => "Budi",
        "password" => "budi123"
    ],
    [
        "email" => "andi@gmail.com",
        "username" => "Andi",
        "password" => "andi123"
    ],
    [
        "email" => "siti@gmail.com",
        "username" => "Siti",
        "password" => "siti123"
    ],
    [
        "email" => "rudi@gmail.com",
        "username" => "Rudi",
        "password" => "rudi123"
    ],
    [
        "email" => "dina@gmail.com",
        "username" => "Dina",
        "password" => "dina123"
    ],
    [
        "email" => "fajar@gmail.com",
        "username" => "Fajar",
        "password" => "fajar123"
	]
    ];

    // Fungsi untuk input
    public function input($pesan) {
        echo $pesan;
        return trim(fgets(STDIN));
    }

    // Fungsi untuk validasi email/username dan password
    public function validasi($identitas, $password, $pilihan) {

        foreach ($this->akun as $data) {

            if ($pilihan == 1) {
                $identitasBenar = ($data["email"] == $identitas);
            } else {
                $identitasBenar = ($data["username"] == $identitas);
            }

            if ($identitasBenar && $data["password"] == $password) {
                return true;
            }
        }

        return false;
    }

    // Fungsi utama login
    public function login() {

        echo "-----------------------------\n";
        echo "|      Raihansyah Fadli     |\n";
        echo "|           Bekasi          |\n";
        echo "-----------------------------\n";
        echo "|     Basic Login System    |\n";
        echo "-----------------------------\n";

        while (true) {

            echo "\nMenu Login\n";
            echo "1. Login menggunakan Email\n";
            echo "2. Login menggunakan Username\n";
            echo "0. Exit\n";

            $pilihan = $this->input("Enter Menu: ");

            if ($pilihan == "0") {
                echo "Program Selesai\n";
                break;
            }

            if ($pilihan != "1" && $pilihan != "2") {
                echo "Invalid Input\n";
                continue;
            }

            // Perulangan login sampai berhasil
            while (true) {

                if ($pilihan == "1") {
                    $identitas = $this->input(
                        "Enter Email: "
                    );
                } else {
                    $identitas = $this->input(
                        "Enter Username: "
                    );
                }

                $password = $this->input("Enter Password: ");

                if ($this->validasi(
                    $identitas,
                    $password,
                    $pilihan
                )) {

                    echo "Login Successful\n";
                    break 2;

                } else {

                    echo "Email/Username or Password Wrong, Please try again\n";
                }
            }
        }
    }
}

// Membuat objek
$program = new LoginSystem();

// Menjalankan program
$program->login();

?>
