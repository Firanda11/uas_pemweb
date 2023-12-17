// Ambil data dari query string pada URL Form.html
const urlParams = new URLSearchParams(window.location.search);

// Periksa apakah ada data yang dikirimkan
if (urlParams.has('nama')) {
    // Ambil data dari query string
    const nama = urlParams.get('nama');
    const nim = urlParams.get('nim');
    const program_studi = urlParams.get('prodi');
    const email = urlParams.get('email');
    const jenis_kelamin = urlParams.get('jenis_kelamin');
    const tanggal_lahir = urlParams.get('tgl_lahir');
    const alamat = urlParams.get('alamat');

    // Tampilkan data dalam tabel pada Halaman Tabel
    const table = document.querySelector('table tbody');
    const newRow = table.insertRow(-1);
    newRow.innerHTML = `<td>${nama}</td><td>${nim}</td><td>${program_studi}</td><td>${email}</td><td>${jenis_kelamin}</td><td>${tanggal_lahir}</td><td>${alamat}</td>`;
}
