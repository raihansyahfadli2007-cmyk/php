
<?php

require_once "auth.php";

$error = "";

// Proses update profil
if (isset($_POST["update"])) {

    $name = trim($_POST["name"] ?? "");
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");

    // Foto lama
    $photo = $user["photo"];

    // Validasi data
    if ($name == "" || $username == "" || $email == "") {

        $error = "Semua kolom wajib diisi.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Format email tidak valid.";

    } else {

        // Periksa username dan email
        $check = $db->prepare(
            "SELECT id FROM users
             WHERE (username = :username OR email = :email)
             AND id != :id"
        );

        $check->execute([
            ":username" => $username,
            ":email" => $email,
            ":id" => $user["id"]
        ]);

        if ($check->fetch()) {

            $error = "Username atau email sudah digunakan.";

        } else {

            // Proses upload foto
            if (
                isset($_FILES["photo"]) &&
                $_FILES["photo"]["error"] !== UPLOAD_ERR_NO_FILE
            ) {

                if ($_FILES["photo"]["error"] !== UPLOAD_ERR_OK) {

                    $error = "Upload foto gagal.";

                } elseif ($_FILES["photo"]["size"] > 2 * 1024 * 1024) {

                    $error = "Ukuran foto maksimal 2 MB.";

                } else {

                    // Periksa tipe gambar
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);

                    $mime = finfo_file(
                        $finfo,
                        $_FILES["photo"]["tmp_name"]
                    );

                    finfo_close($finfo);

                    $allowed = [
                        "image/jpeg" => "jpg",
                        "image/png" => "png",
                        "image/webp" => "webp"
                    ];

                    if (!isset($allowed[$mime])) {

                        $error = "Format foto harus JPG, PNG, atau WEBP.";

                    } elseif (
                        getimagesize($_FILES["photo"]["tmp_name"]) === false
                    ) {

                        $error = "File yang dipilih bukan gambar valid.";

                    } else {

                        // Nama file acak
                        $filename = bin2hex(random_bytes(16))
                                  . "." . $allowed[$mime];

                        $folder = __DIR__ . "/img/uploads/";

                        // Pastikan folder tersedia
                        if (!is_dir($folder)) {
                            mkdir($folder, 0755, true);
                        }

                        $destination = $folder . $filename;

                        if (
                            move_uploaded_file(
                                $_FILES["photo"]["tmp_name"],
                                $destination
                            )
                        ) {

                            $photo = "uploads/" . $filename;

                        } else {

                            $error = "Foto gagal disimpan.";

                        }
                    }
                }
            }

            // Simpan perubahan jika tidak ada error
            if ($error == "") {

                try {

                    $db->beginTransaction();

                    $stmt = $db->prepare(
                        "UPDATE users
                         SET name = :name,
                             username = :username,
                             email = :email,
                             photo = :photo
                         WHERE id = :id"
                    );

                    $stmt->execute([
                        ":name" => $name,
                        ":username" => $username,
                        ":email" => $email,
                        ":photo" => $photo,
                        ":id" => $user["id"]
                    ]);

                    // Perbarui username pada status lama
                    $updateStatus = $db->prepare(
                        "UPDATE statuses
                         SET author_username = :new_username
                         WHERE author_username = :old_username"
                    );

                    $updateStatus->execute([
                        ":new_username" => $username,
                        ":old_username" => $user["username"]
                    ]);

                    $db->commit();

                    // Perbarui session
                    $stmt = $db->prepare(
                        "SELECT * FROM users WHERE id = :id"
                    );

                    $stmt->execute([
                        ":id" => $user["id"]
                    ]);

                    $_SESSION["user"] = $stmt->fetch();

                    // Kembali ke halaman profil
                    header("Location: profile.php?success=1");
                    exit;

                } catch (PDOException $e) {

                    if ($db->inTransaction()) {
                        $db->rollBack();
                    }

                    $error = "Gagal memperbarui profil.";

                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Profil - Pesbuk</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<!-- Navbar -->
<nav class="navbar">

    <div class="container nav-content">

        <a href="timeline.php" class="logo">
            Pesbuk
        </a>

        <div class="nav-menu">

            <a href="timeline.php">Timeline</a>

            <a href="profile.php">Profil</a>

            <a href="logout.php">Logout</a>

        </div>

    </div>

</nav>

<!-- Form Edit Profil -->
<div class="auth-container">

    <div class="auth-card">

        <h2>Edit Profil</h2>

        <p>Perbarui informasi dan foto profil kamu.</p>

        <?php if (isset($_GET["success"])): ?>

            <div class="alert success">
                Profil berhasil diperbarui!
            </div>

        <?php endif; ?>

        <?php if ($error != ""): ?>

            <div class="alert error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>

        <form method="POST"
              enctype="multipart/form-data">

            <!-- Foto Profil -->
            <div class="photo-upload">

                <img
                    src="img/<?= htmlspecialchars(
                        $user["photo"] ?: "default.svg"
                    ) ?>"
                    alt="Foto Profil"
                    class="profile-photo"
                >

                <label>Ganti Foto Profil</label>

                <input
                    type="file"
                    name="photo"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small>
                    JPG, PNG, WEBP. Maksimal 2 MB.
                </small>

            </div>

            <!-- Nama -->
            <label>Nama Lengkap</label>

            <input
                type="text"
                name="name"
                value="<?= htmlspecialchars($user["name"]) ?>"
                required
            >

            <!-- Username -->
            <label>Username</label>

            <input
                type="text"
                name="username"
                value="<?= htmlspecialchars($user["username"]) ?>"
                required
            >

            <!-- Email -->
            <label>Email</label>

            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($user["email"]) ?>"
                required
            >

            <!-- Tombol -->
            <button
                type="submit"
                name="update"
                class="btn full"
            >
                Simpan Perubahan
            </button>

        </form>

        <p class="auth-link">

            <a href="timeline.php">
                Kembali ke Timeline
            </a>

        </p>

    </div>

</div>

</body>
</html>
