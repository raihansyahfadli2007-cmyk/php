
<?php

require_once "config.php";

session_start();

$error = "";

if (isset($_POST["login"])) {

    $identity = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    $sql = "SELECT * FROM users
            WHERE username = :username
            OR email = :email
            LIMIT 1";

    $stmt = $db->prepare($sql);

    $stmt->execute([
        ":username" => $identity,
        ":email" => $identity
    ]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {

        session_regenerate_id(true);

        $_SESSION["user"] = $user;

        header("Location: timeline.php");
        exit;

    } else {

        $error = "Username atau password salah!";

    }

}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Pesbuk</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="auth-container">

    <div class="auth-card">

        <h2>Selamat Datang!</h2>

        <p>Login ke akun Pesbuk kamu.</p>

        <?php if (isset($_GET["registered"])): ?>

            <div class="alert success">
                Pendaftaran berhasil! Silakan login.
            </div>

        <?php endif; ?>

        <?php if ($error): ?>

            <div class="alert error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <label>Username atau Email</label>

            <input
                type="text"
                name="username"
                placeholder="Masukkan username atau email"
                required
            >

            <label>Password</label>

            <input
                type="password"
                name="password"
                placeholder="Masukkan password"
                required
            >

            <button type="submit" name="login" class="btn full">
                Masuk
            </button>

        </form>

        <p class="auth-link">
            Belum punya akun?
            <a href="register.php">Daftar sekarang</a>
        </p>

        <p class="auth-link">
            <a href="index.php">Kembali ke Beranda</a>
        </p>

    </div>

</div>

</body>
</html>
