
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.querySelector('form');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah formulir untuk langsung di-submit

            // Validasi formulir (sesuaikan dengan kebutuhan)
            var nama = document.getElementById('nama').value;
            var nim = document.getElementById('nim').value;
            var programStudi = document.getElementById('program_studi').value;
            var email = document.getElementById('email').value;
            var pw = document.getElementById('pw').value;
            var jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
            var tglLahir = document.getElementById('tgl_lahir').value;
            var alamat = document.getElementById('alamat').value;

            if (!nama || !nim || !programStudi || !email || !pw || !jenisKelamin || !tglLahir || !alamat) {
                alert('Harap lengkapi semua field.');
                return;
            }

            // Lanjutkan dengan submit formulir
            form.submit();
        });
    });

