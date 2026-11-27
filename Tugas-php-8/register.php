
<?php

require_once "config.php";

$error = "";

if (isset($_POST["register"])) {

    $name = trim($_POST["name"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($name == "" || $username == "" || $email == "" || $password == "") {

        $error = "Semua kolom wajib diisi.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Format email tidak valid.";

    } elseif (strlen($password) < 6) {

        $error = "Password minimal 6 karakter.";

    } else {

        try {

            $check = $db->prepare(
                "SELECT id FROM users
                 WHERE username = :username OR email = :email"
            );

            $check->execute([
                ":username" => $username,
                ":email" => $email
            ]);

            if ($check->fetch()) {

                $error = "Username atau email sudah digunakan.";

            } else {

                $hashedPassword = password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );

                $sql = "INSERT INTO users
                        (username, email, password, name, photo)
                        VALUES
                        (:username, :email, :password, :name, :photo)";

                $stmt = $db->prepare($sql);

                $stmt->execute([
                    ":username" => $username,
                    ":email" => $email,
                    ":password" => $hashedPassword,
                    ":name" => $name,
                    ":photo" => "default.svg"
                ]);

                header("Location: login.php?registered=1");
                exit;

            }

        } catch (PDOException $e) {

            $error = "Pendaftaran gagal. Silakan periksa data.";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Pesbuk</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="auth-container">

    <div class="auth-card">

        <h2>Buat Akun Pesbuk</h2>

        <p>Daftarkan akunmu sekarang!</p>

        <?php if ($error): ?>

            <div class="alert error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <label>Nama Lengkap</label>
            <input type="text" name="name" required>

            <label>Username</label>
            <input type="text" name="username" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" minlength="6" required>

            <button type="submit" name="register" class="btn full">
                Daftar Sekarang
            </button>

        </form>

        <p class="auth-link">
            Sudah punya akun?
            <a href="login.php">Login di sini</a>
        </p>

    </div>

</div>

</body>
</html>
