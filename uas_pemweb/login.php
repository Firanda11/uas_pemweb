<?php
session_start();

include("koneksi.php");

// Cek apakah pengguna sudah login
if (isset($_SESSION['nim'])) {
    header("Location: proses_form.php"); // Redirect ke halaman dashboard jika sudah login
    exit();
}

// Cek apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Simpan data login dari form
    $nim = $_POST['nim'];
    $password = $_POST['pw'];

    // Lakukan query untuk mendapatkan informasi pengguna berdasarkan nim
    $stmt = $conn->prepare("SELECT * FROM akun WHERE nim LIKE ?");
    $stmt->bind_param('s', $nim);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi kata sandi menggunakan password_verify
        if (password_verify($password, $user['pw'])) {
            // Set data pengguna dalam session
            $_SESSION['nim'] = $user['nim'];

            // Redirect ke halaman dashboard setelah login berhasil
            header("indeks.php");
            exit();
        } else {
            $error_message = "NIM atau password salah";
        }
    } else {
        $error_message = "NIM atau password salah";
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="stylelogin.css">
</head>
<body>
    <main class="main">
        <h1>Form Login</h1>
         <img src="bg-image.png" alt="image" class="main__bg">
            <div class="kotak_login">
		    <p class="tulisan_login">Silahkan login</p>
 
            <form action="" method="post">
			<label>NIM</label>
			<input type="text" name="nim" class="form_login" placeholder="Username atau email ..">
 
			<label>Password</label>
			<input type="text" name="pw" class="form_login" placeholder="Password ..">
 
			<input type="submit" class="tombol_login" value="LOGIN">
 
			<br/>
			<br/>
			<center>
				<a class="link" href="index.php">kembali</a>
			</center>
		    </form>
		
	        </div>
    </main>

 
</body>
</html>