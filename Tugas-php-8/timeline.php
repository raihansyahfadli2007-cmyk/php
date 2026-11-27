
<?php

require_once "auth.php";

$error = "";

// Membuat status baru
if (isset($_POST["publish"])) {

    $content = trim($_POST["content"] ?? "");

    if ($content == "") {

        $error = "Status tidak boleh kosong.";

    } elseif (mb_strlen($content) > 2000) {

        $error = "Status maksimal 2000 karakter.";

    } else {

        $stmt = $db->prepare(
            "INSERT INTO statuses
             (author_username, content)
             VALUES (:username, :content)"
        );

        $stmt->execute([
            ":username" => $user["username"],
            ":content" => $content
        ]);

        header("Location: timeline.php?posted=1");
        exit;

    }
}

// Mengambil seluruh status
$sql = "SELECT
            statuses.*,
            users.name,
            users.photo
        FROM statuses
        LEFT JOIN users
        ON statuses.author_username = users.username
        ORDER BY statuses.created_at DESC";

$stmt = $db->query($sql);

$statuses = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Timeline - Pesbuk</title>

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

            <a href="profile.php">Edit Profil</a>

            <a href="logout.php">Logout</a>

        </div>

    </div>

</nav>

<div class="container timeline-layout">

    <!-- Profil Pengguna -->
    <aside class="profile-card">

        <img
            src="img/<?= htmlspecialchars(
                $user["photo"] ?: "default.svg"
            ) ?>"
            alt="Foto Profil"
            class="profile-photo"
        >

        <h2>
            <?= htmlspecialchars($user["name"]) ?>
        </h2>

        <p>
            @<?= htmlspecialchars($user["username"]) ?>
        </p>

        <p>
            <?= htmlspecialchars($user["email"]) ?>
        </p>

        <a href="profile.php" class="btn full">
            Edit Profil
        </a>

    </aside>

    <!-- Timeline -->
    <main class="timeline-content">

        <!-- Form Status -->
        <div class="post-card">

            <h2>Bagikan Status</h2>

            <p>Apa yang sedang kamu pikirkan?</p>

            <?php if ($error != ""): ?>

                <div class="alert error">
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>

            <?php if (isset($_GET["posted"])): ?>

                <div class="alert success">
                    Status berhasil dibagikan!
                </div>

            <?php endif; ?>

            <form method="POST">

                <textarea
                    name="content"
                    placeholder="Tulis sesuatu..."
                    maxlength="2000"
                    required
                ></textarea>

                <button
                    type="submit"
                    name="publish"
                    class="btn"
                >
                    Publikasikan
                </button>

            </form>

        </div>

        <!-- Daftar Status -->
        <h2 class="section-title">
            Timeline Terbaru
        </h2>

        <?php if (count($statuses) > 0): ?>

            <?php foreach ($statuses as $status): ?>

                <div class="post-card">

                    <div class="post-header">

                        <img
                            src="img/<?= htmlspecialchars(
                                $status["photo"] ?: "default.svg"
                            ) ?>"
                            alt="Foto Pengguna"
                            class="post-photo"
                        >

                        <div>

                            <strong>
                                <?= htmlspecialchars(
                                    $status["name"] ?? $status["author_username"]
                                ) ?>
                            </strong>

                            <p>
                                @<?= htmlspecialchars(
                                    $status["author_username"]
                                ) ?>
                            </p>

                            <small>
                                <?= date(
                                    "d-m-Y H:i",
                                    strtotime($status["created_at"])
                                ) ?>
                            </small>

                        </div>

                    </div>

                    <div class="post-content">

                        <?= nl2br(
                            htmlspecialchars($status["content"])
                        ) ?>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="post-card empty">

                <h3>Belum Ada Status</h3>

                <p>
                    Jadilah orang pertama yang membagikan cerita!
                </p>

            </div>

        <?php endif; ?>

    </main>

</div>

</body>
</html>
