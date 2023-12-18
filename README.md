Aginda Dufira
121140058

Bagian 1: Client-side Programming
terjadi pada oproses tersebut
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

Elemen-elemen input:

<label>: Mewakili label atau keterangan untuk elemen input yang terletak di bawahnya.
<input>: Elemen input untuk berbagai jenis masukan seperti teks, email, password, radio, dan date.
<textarea>: Elemen textarea digunakan untuk masukan teks panjang, seperti alamat.
<input type="password">: Input jenis ini digunakan untuk memasukkan kata sandi. Ketika diisi, nilai yang dimasukkan akan disembunyikan (berbentuk titik atau bintang) untuk keamanan.
<input type="radio">: Input jenis ini digunakan untuk pilihan radio button, di mana pengguna hanya bisa memilih salah satu dari beberapa opsi. Pilihan ini dikelompokkan bersama dengan menggunakan atribut name yang sama.
<input type="date">: Input jenis ini memberikan antarmuka kalender untuk memilih tanggal.

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Bagian 2: Server-side Programming (Bobot: 30%)
pada proses ini terdapat post dan get

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

PROSES OOP TERJADI PADA
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
kode ditas tenasuk kedalam php dengan paradigma Pemrograman Berorientasi Objek (OOP). Terdapat kelas UserDataProcessor yang memiliki metode __construct sebagai konstruktor dan addData sebagai metode yang bertanggung jawab untuk menambahkan data ke dalam database.
Berikut adalah penjelasan singkat mengenai struktur kodenya:

session_start();: Fungsi ini digunakan untuk memulai sesi di PHP. Diperlukan jika Anda berencana menggunakan variabel sesi.
class UserDataProcessor: Ini adalah definisi kelas yang berfungsi untuk memproses data pengguna.
private $conn;: Properti $conn digunakan untuk menyimpan koneksi ke database.
public function __construct($conn): Ini adalah konstruktor kelas yang menerima parameter koneksi dan menginisialisasi properti $conn.
public function addData($nama, $nim, $program_studi, $email, $pw, $jenis_kelamin, $tgl_lahir, $alamat): Ini adalah metode yang digunakan untuk menambahkan data ke dalam database. Metode ini menerima parameter data pengguna, mempersiapkan pernyataan SQL dengan prepared statement, mengikat parameter, mengeksekusi pernyataan, dan kemudian mengarahkan pengguna ke halaman "table.php".
$stmt->bind_param("ssssssss", $nama, $nim, $program_studi, $email, $pw, $jenis_kelamin, $tgl_lahir, $alamat);: Ini adalah bagian dari prepared statement yang digunakan untuk mengikat nilai-nilai parameter ke dalam pernyataan SQL.
if ($stmt->execute()) { echo "Data berhasil ditambahkan."; } else { echo "Error: " . $query . "<br>" . $stmt->error; }: Ini adalah bagian yang mengeksekusi pernyataan SQL dan memberikan pesan kesalahan jika eksekusi gagal.
$stmt->close();: Ini adalah bagian yang menutup pernyataan persiapan setelah pengguna data berhasil ditambahkan.
header("Location: table.php");: Ini mengarahkan pengguna ke halaman "table.php" setelah data berhasil ditambahkan.

-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Bagian 3: Database Management
CREATE TABLE nama(
    nama VARCHAR (30) NOT NULL,
    nim INT (30) PRIMARY KEY,
    program_studi VARCHAR (30) NOT NULL,
    email VARCHAR (30) NOT NULL,
    pw VARCHAR(30) NOT NULL,
    jenis_kelamin VARCHAR (30) NOT NULL,
    tgl_lahir date NOT NULL,
    alamat VARCHAR(20) NOT NULL
);

CREATE TABLE akun(
    nim INT (30) PRIMARY KEY ,
    email VARCHAR (30) NOT NULL,
    pw VARCHAR (100) NOT NULL
);

<?php 
$conn = new mysqli('localhost', 'root', '', 'nama');
?>
---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Bagian 4: State Management

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
session_start();

if (!isset($_SESSION['nim'])) {
    header("Location: login.php");
}


Kode ini mendefinisikan kelas UserDataProcessor yang bertanggung jawab untuk memproses data pengguna.
Konstruktor kelas ini menerima koneksi sebagai parameter dan menyimpannya dalam properti $conn.
Terdapat metode addData yang digunakan untuk menambahkan data ke dalam database. Metode ini menggunakan prepared statement untuk mencegah serangan SQL injection.
Keseluruhan, kedua bagian kode tersebut berfungsi dalam konteks manajemen sesi pengguna. Bagian pertama adalah kelas yang bertanggung jawab untuk memproses data pengguna, sementara bagian kedua adalah langkah-langkah awal untuk memastikan bahwa pengguna memiliki sesi yang valid sebelum melanjutkan ke halaman lain.

---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Bagian Bonus: Hosting Aplikasi Web 
HOSTING MENGGUNAKAN INFINITY FREE KARENA GRATIS


Langkah-langkah Meng-host Aplikasi Web:

1. Pemilihan Penyedia Hosting: Pilih penyedia hosting yang sesuai dengan kebutuhan aplikasi web Anda. Periksa persyaratan sistem, dukungan teknis, dan harga.
2. Registrasi Domain: Jika belum memiliki domain, daftarlah di registrar domain. Pilih nama domain yang representatif dan mudah diingat.
3. Pemilihan Jenis Hosting: Pilih jenis hosting yang sesuai, seperti shared hosting, VPS (Virtual Private Server), atau cloud hosting, berdasarkan kebutuhan dan tingkat kontrol yang diinginkan.
4. Pengaturan Server: Konfigurasikan server dengan sistem operasi, server web (seperti Apache, Nginx), database server (seperti MySQL, PostgreSQL), dan bahasa pemrograman yang mendukung aplikasi Anda.
5. Unggah Aplikasi: Unggah file aplikasi Anda ke server menggunakan FTP atau alat unggahan file yang disediakan oleh penyedia hosting.
5. Konfigurasi Database: Jika aplikasi menggunakan database, konfigurasikan dan impor skema database ke server.
6. Pengaturan DNS: Atur pengaturan DNS agar domain mengarah ke alamat IP server hosting Anda.
7. Uji Aplikasi: Lakukan uji coba untuk memastikan aplikasi berfungsi seperti yang diharapkan di lingkungan hosting.


Pemilihan Penyedia Hosting:

1. Pemilihan penyedia hosting tergantung pada sejumlah faktor, seperti:
2. Skalabilitas: Apakah penyedia mendukung pertumbuhan aplikasi Anda.
3. Keandalan: Ketersediaan server dan dukungan teknis yang baik.
4. Keamanan: Fasilitas keamanan yang disediakan oleh penyedia.
5. Harga: Sesuaikan dengan anggaran yang dimiliki.


Keamanan Aplikasi Web:

1. Firewall: Terapkan firewall untuk melindungi server dari serangan jaringan.
2. SSL Certificate: Pasang SSL untuk mengamankan transmisi data antara server dan pengguna.
3. Update Rutin: Selalu perbarui sistem operasi, server web, dan aplikasi ke versi terbaru.
4. Backup Data: Lakukan pencadangan data secara rutin untuk mengatasi kehilangan data.
5. Pemindaian Keamanan: Gunakan alat pemindaian keamanan untuk mendeteksi potensi kerentanan.


Konfigurasi Server:

1. Load Balancing (jika diperlukan): Bagi lalu lintas aplikasi di antara beberapa server.
2. Caching: Terapkan caching untuk meningkatkan kinerja aplikasi.
3. Konfigurasi PHP (jika diperlukan): Sesuaikan konfigurasi PHP sesuai kebutuhan aplikasi.
4. Monitoring: Gunakan alat pemantauan untuk memantau kesehatan server dan kinerja aplikasi.

Jawaban diatas sudah mennjawab pertanyaan untuk bagian 5

