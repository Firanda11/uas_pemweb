<?php
// Mulai session
session_start();

if (!isset($_SESSION['nim'])) {
    header("Location: login.php");
}

$logged_in_user = $_SESSION['nim'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Halaman Tabel</title>
    <link rel="stylesheet" type="text/js" href="js.js">
    <link rel="stylesheet" type="text/css" href="styletable.css">
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
        <h2>Daftar Mahasiswa</h2>
        <?php
include("koneksi.php");
$sql = "SELECT * FROM nama";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Menampilkan data baris per baris
    echo
    "Daftar Tabel Mahasiswa
    <table border='1'>
    <tr>
    <th>Nama</th>
    <th>NIM</th>
    <th>Program Studi</th>
    <th>Email</th>
    <th>Password</th>
    <th>Jenis Kelamin</th>
    <th>Tanggal Lahir</th>
    <th>Alamat</th>
    </tr>";
    // Tampilkan setiap baris data
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["nama"] . "</td><td>" . $row["nim"] . "</td><td>" . $row["program_studi"] . "</td><td>" . $row["email"] . "</td><td>" . $row["pw"] . "</td><td>" . $row["jenis_kelamin"] . "</td><td>". $row["tgl_lahir"] . "</td><td>". $row["alamat"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data dalam tabel.";
}
?>
<form method="get" action="">
    Cari NIM: <input type="number" name="nim" placeholder="Masukkan NIM..." required>
    <input type="submit" class="tombol_login" value="Cari">
</form>

<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['nim'])) {
        $nim = $_GET['nim'];

        // Prepared statement untuk menghindari SQL Injection
        $sql = "SELECT * FROM nama WHERE nim LIKE ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nim);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Data Ditemukan: ";
            echo "<table border='1'>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Program Studi</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row["nama"] . "</td>
                    <td>" . $row["nim"] . "</td>
                    <td>" . $row["program_studi"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["pw"] . " </td>
                    <td>" . $row["jenis_kelamin"] . "</td>
                    <td>" . $row["tgl_lahir"] . "</td>
                    <td>" . $row["alamat"] . "</td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "Data dengan nama '$nim' tidak ditemukan.";
        }

        // Tutup statement dan koneksi setelah penggunaan
        $stmt->close();
        $conn->close();
    }
}
?>
<form method="post" action="">
    Hapus berdasarkan NIM: <input type="number" name="nimToDelete" placeholder="Masukkan NIM..." required>
    <input type="submit" class="tombol_login" value="Hapus">
</form>
<?php
include("koneksi.php");

// Proses penghapusan jika formulir di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nimToDelete'])) {
        $nimToDelete = $_POST['nimToDelete'];

        // Prepared statement untuk menghindari SQL Injection
        $sql = "DELETE FROM nama WHERE nim = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $nimToDelete); // Menggunakan "i" untuk tipe data integer
        $stmt->execute();

        // Cek apakah data berhasil dihapus
        if ($stmt->affected_rows > 0) {
            echo "Data dengan NIM '$nimToDelete' berhasil dihapus.";
        } else {
            echo "Gagal menghapus data. NIM '$nimToDelete' tidak ditemukan.";
        }

        // Tutup statement setelah penggunaan
        $stmt->close();
    }
}

// Tutup koneksi ke basis data
$conn->close();
?>

    </main>
    <footer>
        <p>&copy; 2023 Hak Cipta Kami</p>
    </footer>
    
    <!-- manggil javascript -->
    <script src="proses.js"></script>
</body>
</html>
