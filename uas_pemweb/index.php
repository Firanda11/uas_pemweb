<?php
// Mulai session
session_start();

// Set nilai session jika belum ada
$logged_in_user = isset($_SESSION['nim']) ? $_SESSION['nim']:null;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styleindex.css">
    <title>Halaman Utama</title>
</head>
<body>
    <header>
        <nav>
            <?php if (isset($logged_in_user)) { ?>
                <!-- Tampilkan menu setelah login -->
                <ul class="navbar">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="proses_form.php">Form</a></li>
                    <li><a href="table.php">Tabel</a></li>
                    <li class="menu_akun">
                        <div class="akun">
                            <p>User: <?php echo $logged_in_user; ?></p>
                            <a href="logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            <?php } else { ?>
                <!-- Tampilkan menu sebelum login -->
                <ul class="navbar2">
                    <li><a href="proses_form.php" onclick="showAlert()">Form</a></li>
                    <li><a href="table.php" onclick="showAlert()">Tabel</a></li>
                    <li class="menu_akun">
                        <div class="akun">
                            <a href="buat_akun.php">Buat Akun</a>
                            <a href="login.php">Login</a>
                        </div>
                    </li>
                </ul>
            <?php } ?>
        </nav>
    </header>
    <main>
        <h1>Selamat datang di website kami!</h1>
        <p>Ini adalah website Aginda Dufira dengan beberapa halaman. Silakan navigasi ke halaman lain menggunakan menu di atas.</p>
        <img src="bg-image.png" alt="image" class="main__bg">
    </main>
    <footer>
        <p>&copy; 2023 Hak Cipta Kami</p>
    </footer>
</body>
</html>


