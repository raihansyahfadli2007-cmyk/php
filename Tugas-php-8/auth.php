
<?php

session_start();

require_once "config.php";

// Periksa session login
if (!isset($_SESSION["user"])) {

    header("Location: login.php");
    exit;

}

// Ambil data pengguna
$stmt = $db->prepare(
    "SELECT * FROM users WHERE id = :id LIMIT 1"
);

$stmt->execute([
    ":id" => $_SESSION["user"]["id"]
]);

$user = $stmt->fetch();

// Jika akun tidak ditemukan
if (!$user) {

    $_SESSION = [];

    session_destroy();

    header("Location: login.php");
    exit;

}

// Perbarui session
$_SESSION["user"] = $user;

?>
