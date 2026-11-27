
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pesbuk - Beranda</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<nav class="navbar">

    <div class="container nav-content">

        <a href="index.php" class="logo">Pesbuk</a>

        <div class="nav-menu">

            <?php if (isset($_SESSION["user"])): ?>

                <a href="timeline.php">Timeline</a>
                <a href="logout.php">Logout</a>

            <?php else: ?>

                <a href="login.php">Masuk</a>
                <a href="register.php" class="btn">Daftar</a>

            <?php endif; ?>

        </div>

    </div>

</nav>

<section class="hero">

    <div class="container">

        <h1>Selamat Datang di Pesbuk</h1>

        <p>
            Terhubung dengan teman, berbagi cerita,
            dan bagikan aktivitasmu setiap hari.
        </p>

        <a href="register.php" class="btn">
            Mulai Bergabung
        </a>

        <a href="login.php" class="btn btn-light">
            Masuk Sekarang
        </a>

    </div>

</section>

<section class="container features">

    <h2>Kenapa Bergabung dengan Pesbuk?</h2>

    <div class="feature-grid">

        <div class="feature-card">
            <h3>👥 Terhubung</h3>
            <p>Berinteraksi dan terhubung dengan pengguna lain.</p>
        </div>

        <div class="feature-card">
            <h3>📝 Berbagi Status</h3>
            <p>Bagikan cerita dan aktivitas terbaru kamu.</p>
        </div>

        <div class="feature-card">
            <h3>👤 Profil</h3>
            <p>Kelola informasi profil akunmu sendiri.</p>
        </div>

    </div>

</section>

<footer>
    <p>© 2026 Pesbuk. All Rights Reserved.</p>
</footer>

</body>
</html>
