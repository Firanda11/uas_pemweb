//Baca URL cth(...table.html?nama=Afrizal&nim=2131111&prodi=D3...)
const url_string = window.location;
const url = new URL(url_string);

// list nama inputan(sama dengan attribut name)
listForm = ["nama","nim","prodi","email","pw","jenis_kelamin","tgl_lahir","alamat"]

// ambil value dari URL
let data = [];
listForm.forEach(input => {
    data.push(url.searchParams.get(input));
});

//cari tbody pake ID
let tableBody = document.getElementById('TABLEBODY');

//buat tr baru
let Row = document.createElement('tr');

// buat td baru lalu langsung ditambahkan kedalam tr
let Cell = [];
for (let index = 0; index < listForm.length; index++) {
    Cell[index] = document.createElement('td');
    Cell[index].innerText = data[index];
    Row.appendChild(Cell[index]);
}

// tr yang barusan dibuat ditambahkan kedalam tbody
tableBody.appendChild(Row);