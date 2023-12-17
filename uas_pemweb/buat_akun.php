<?php
session_start();

include("koneksi.php");


// Cek apakah pengguna sudah login
if (isset($_SESSION['nim'])) {
    header("Location: proses_from.php"); // Redirect ke halaman dashboard jika sudah login
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Simpan data login dari form
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO akun (nim, email, pw)
        VALUES (?, ?, ?)"
    );

    // Bind parameter ke prepared statement
    $stmt->bind_param("sss", $nim, $email, $pw);

    // Eksekusi pernyataan persiapan
    $stmt->execute();

    $_SESSION['nim'] = $nim;

    // Redirect ke halaman login setelah pendaftaran berhasil
    header("Location: login.php");

    // Tutup statement dan koneksi setelah penggunaan
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="stylebuat_akun.css">
  <title>Form Pendaftaran</title>
</head>
<body>
    <img src="bg-image.png" alt="image" class="main__bg">
    <div class="form-container">
        <h2>Form Pendaftaran Akun</h2>
        <form action="" method="post">
            <label for="nim">NIM:</label>
            <input type="text" id="nim" name="nim" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="pw">Password:</label>
            <input type="password" id="pw" name="pw" required><br><br>

            <input type="submit" value="Daftar">
            <br/>
			<br/>
            <center>
                <p>Sudah punya akun? <a class="link" href="login.php">Login di sini</a></p>
            </center>
        </form>
    </div>
</body>
</html>
