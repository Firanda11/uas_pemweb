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