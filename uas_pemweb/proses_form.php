<?php
session_start();

class UserDataProcessor {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addData($nama, $nim, $program_studi, $email, $pw, $jenis_kelamin, $tgl_lahir, $alamat) {
        $query = "INSERT INTO nama (nama, nim, program_studi, email, pw, jenis_kelamin, tgl_lahir, alamat) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Bind parameter ke prepared statement
        $stmt->bind_param("ssssssss", $nama, $nim, $program_studi, $email, $pw, $jenis_kelamin, $tgl_lahir, $alamat);

        // Eksekusi pernyataan persiapan
        if ($stmt->execute()) {
            echo "Data berhasil ditambahkan.";
        } else {
            echo "Error: " . $query . "<br>" . $stmt->error;
        }

        $stmt->close();
        header("Location: table.php");
    }
}

include("koneksi.php");

if (!isset($_SESSION['nim'])) {
    header("Location: login.php");
}

$logged_in_user = $_SESSION['nim'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userDataProcessor = new UserDataProcessor($conn);

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $program_studi = $_POST['program_studi'];
    $email = $_POST['email'];
    $pw = $_POST['pw'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    $userDataProcessor->addData($nama, $nim, $program_studi, $email, $pw, $jenis_kelamin, $tgl_lahir, $alamat);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Halaman Formulir</title>
    <link rel="stylesheet" type="text/css" href="style_form.css">
    <link rel="stylesheet" type="text/js" href="js.js">
</head>

<body>
    <header>
        <nav>
            <p>Tabel</p>
            <div class="navbar">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="proses_form.php">Form</a></li>
                    <li><a href="table.php">Tabel</a></li>
                 </ul>
                <div class="menu_akun">
                    <div class="akun">
                        <p>User: <?php echo $logged_in_user; ?></p>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
    </nav>
    </header>
    <main>
        <h2>Formulir Pendaftaran</h2>
        <!-- biar setelah disubmit langsung buka table.html -->
        <form action="" method="post">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required><br>
            <label for="nim">NIM:</label>
            <input type="text" id="nim" name="nim" required><br>
            <label for="program_studi">Program Studi:</label>
            <input type="text" id="program_studi" name="program_studi" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="pw">Password:</label>
            <input type="password" id="pw" name="pw" required><br> <!-- Ganti type menjadi password -->
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <label for="laki">Laki-Laki</label>
            <input type="radio" id="laki" name="jenis_kelamin" value="Laki-Laki" required>
            <label for="perempuan">Perempuan</label>
            <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" required>
            <label for="tgl_lahir">Tanggal Lahir:</label>
            <input type="date" id="tgl_lahir" name="tgl_lahir" required><br>
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required></textarea><br>
            <input type="submit" value="Daftar">
        </form>
        <img src="bg-image.png" alt="image" class="main__bg">
    </main>
    <footer>
        <p>&copy; 2023 Hak Cipta Kami</p>
    </footer>
</body>

</html>
