DROP DATABASE IF EXISTS prestasi;
GO

-- Membuat Database
CREATE DATABASE prestasi;
GO

-- Menggunakan Database
USE prestasi;
GO



-- TABEL ROLES
CREATE TABLE roles (
    id INT PRIMARY KEY IDENTITY(1,1),
    role_name VARCHAR(50) NOT NULL UNIQUE
);
GO
INSERT INTO roles (role_name) VALUES 
('Mahasiswa'),
('Admin'),
('Dosen');
GO
select * from roles;



-- TABEL USERS
CREATE TABLE users (
    id INT PRIMARY KEY IDENTITY(1,1),
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);
GO
INSERT INTO users (username, password, role_id) VALUES 
('agus', 'asd', 1),
('samid', 'asd', 2),
('samsul', 'asd', 3);
GO
select * from users;



-- TABEL PRODI
CREATE TABLE prodi (
    id INT PRIMARY KEY IDENTITY(1,1),
    nama VARCHAR(100) NOT NULL UNIQUE
);
GO
INSERT INTO prodi (nama) VALUES 
('Teknik Informatika'),
('Sistem Informasi Bisnus');
GO
SELECT * FROM PRODI;



-- TABEL ADMIN
CREATE TABLE admin (
    id INT PRIMARY KEY IDENTITY(1,1),
    no_pegawai CHAR(10) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) CHECK (email LIKE '%_@__%.__%'),
	username VARCHAR(100) NOT NULL UNIQUE
);
GO
INSERT INTO admin (no_pegawai, nama, email, username) VALUES 
('ADM001', 'Samid', 'samsam@mail.com', 'samid');
GO
INSERT INTO admin (no_pegawai, nama, email, username) VALUES 
('ADM002', 'An Naastasya Sakina', 'natha@mail.com', 'natha'),
('ADM003', 'Adam Nur Alifi', 'adam@mail.com', 'adam'),
('ADM004', 'Titania Aurellia Putri', 'titania@mail.com', 'titan'),
('ADM005', 'Alfin Afriansyah', 'alfin@mail.com', 'alfin');
GO
SELECT * FROM ADMIN;


-- TABEL DOSEN
CREATE TABLE dosen (
    id INT PRIMARY KEY IDENTITY(1,1),
    nidn CHAR(10) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) CHECK (email LIKE '%_@__%.__%')
);
GO
INSERT INTO dosen (nidn, nama, email) VALUES 
('111001', 'Dr. Samsul Hidayat', 'samsul@mail.com');
GO
INSERT INTO dosen (nidn, nama, email) VALUES 
('111002', 'Dr. Siti Aminah', 'siti@mail.com'),
('111003', 'Dr. Bambang Sutrisno', 'bambang@mail.com'),
('111004', 'Prof. Dewi Lestari', 'dewi@mail.com'),
('111005', 'Dr. Agus Pranoto', 'agusp@mail.com'),
('111006', 'Dr. Rina Andayani', 'rina@mail.com'),
('111007', 'Prof. Indra Wijaya', 'indra@mail.com'),
('111008', 'Dr. Hendra Gunawan', 'hendra@mail.com'),
('111009', 'Dr. Farida Rahmawati', 'farida@mail.com'),
('111010', 'Prof. Yudi Santoso', 'yudi@mail.com');
GO
SELECT * FROM DOSEN;



-- TABEL JENIS KOMPETISI
CREATE TABLE jenis_kompetisi (
    id INT PRIMARY KEY IDENTITY(1,1),
    nama VARCHAR(100) NOT NULL UNIQUE
);
GO
INSERT INTO jenis_kompetisi (nama) VALUES 
('Olahraga'),
('Seni'),
('Akademik');
GO
SELECT * FROM jenis_kompetisi;



-- TABEL TINGKAT KOMPETISI
CREATE TABLE tingkat_kompetisi (
    id INT PRIMARY KEY IDENTITY(1,1),
    nama VARCHAR(100) NOT NULL UNIQUE
);
GO
INSERT INTO tingkat_kompetisi (nama) VALUES 
('Lokal'),
('Nasional'),
('Internasional');
GO
SELECT * FROM tingkat_kompetisi;



-- TABEL MAHASISWA
CREATE TABLE mahasiswa (
    id INT PRIMARY KEY IDENTITY(1,1),
    nim CHAR(10) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    alamat VARCHAR(255),
    no_telp CHAR(15),
    email VARCHAR(100) CHECK (email LIKE '%_@__%.__%'),
    prodi_id INT NOT NULL,
	username VARCHAR(100) NOT NULL UNIQUE,
    FOREIGN KEY (prodi_id) REFERENCES prodi(id) ON DELETE CASCADE,
);
GO
INSERT INTO mahasiswa (nim, nama, alamat, no_telp, email, prodi_id, username) VALUES 
('220001001', 'Agus Sulaiman', 'Jl. Sawojajar No. 1', '081234567890', 'agus@mail.com', 2, 'agus'),
('220001002', 'Odin din', 'Jl. Odeen No. 1', '081234567890', 'jeroden@mail.com', 2, 'odin');
GO
INSERT INTO mahasiswa (nim, nama, alamat, no_telp, email, prodi_id, username) VALUES 
('220001003', 'Budi Hartono', 'Jl. Melati No. 10', '081234567891', 'budi@mail.com', 1, 'budi'),
('220001004', 'Citra Andini', 'Jl. Mawar No. 15', '081234567892', 'citra@mail.com', 2, 'citra'),
('220001005', 'Dewi Kartika', 'Jl. Kenanga No. 20', '081234567893', 'dewi@mail.com', 1, 'dewi'),
('220001006', 'Eko Santoso', 'Jl. Dahlia No. 25', '081234567894', 'eko@mail.com', 2, 'eko'),
('220001007', 'Fani Rahmawati', 'Jl. Anggrek No. 30', '081234567895', 'fani@mail.com', 1, 'fani'),
('220001008', 'Gilang Permana', 'Jl. Cempaka No. 35', '081234567896', 'gilang@mail.com', 2, 'gilang'),
('220001009', 'Hani Pratiwi', 'Jl. Tulip No. 40', '081234567897', 'hani@mail.com', 1, 'hani'),
('220001010', 'Indra Setiawan', 'Jl. Teratai No. 45', '081234567898', 'indra@mail.com', 2, 'indra'),
('220001011', 'Joko Widodo', 'Jl. Flamboyan No. 50', '081234567899', 'joko@mail.com', 1, 'joko'),
('220001012', 'Kartika Sari', 'Jl. Kamboja No. 55', '081234567800', 'kartika@mail.com', 2, 'kartika'),
('220001013', 'Lina Marlina', 'Jl. Bougenville No. 60', '081234567801', 'lina@mail.com', 1, 'lina'),
('220001014', 'Mira Setiani', 'Jl. Sakura No. 65', '081234567802', 'mira@mail.com', 2, 'mira'),
('220001015', 'Nanda Pratama', 'Jl. Seruni No. 70', '081234567803', 'nanda@mail.com', 1, 'nanda');
GO
SELECT * FROM MAHASISWA;



-- TABEL STATUS
CREATE TABLE status (
    id INT PRIMARY KEY IDENTITY(1,1),
    nama VARCHAR(50) NOT NULL
);
GO
	INSERT INTO Status (nama) 
	VALUES 
		('Proses'),
		('Berhasil'),
		('Gagal');
	GO
SELECT * FROM STATUS;



-- TABEL KOMPETISI
CREATE TABLE kompetisi (
    id INT PRIMARY KEY IDENTITY(1,1),
	status_id INT NOT NULL,
    jenis_id INT NOT NULL,
    tingkat_id INT NOT NULL,
    nama_kompetisi VARCHAR(100) NOT NULL,
    tempat_kompetisi VARCHAR(255),
    url_kompetisi VARCHAR(255),
    tanggal_mulai DATE NOT NULL,
    tanggal_akhir DATE NOT NULL,
    no_surat_tugas VARCHAR(100),
    tanggal_surat_tugas DATE,
    file_surat_tugas VARCHAR(100),
    file_sertifikat VARCHAR(100),
    foto_kegiatan VARCHAR(100),
    file_poster VARCHAR(100),
    FOREIGN KEY (status_id) REFERENCES status(id) ON DELETE CASCADE,
	FOREIGN KEY (jenis_id) REFERENCES jenis_kompetisi(id) ON DELETE CASCADE,
    FOREIGN KEY (tingkat_id) REFERENCES tingkat_kompetisi(id) ON DELETE CASCADE,
    CONSTRAINT chk_tanggal CHECK (tanggal_mulai <= tanggal_akhir)
);
GO
INSERT INTO kompetisi (status_id, jenis_id, tingkat_id, nama_kompetisi, tempat_kompetisi, url_kompetisi, tanggal_mulai, tanggal_akhir, no_surat_tugas, tanggal_surat_tugas) VALUES 
(1, 1, 2, 'Lomba Sepak Bola', 'Stadion Nasional', 'http://lombasepakbola.com', '2024-01-10', '2024-01-15', 'ST-001', '2024-01-05'),
(2, 2, 3, 'Festival Tari Internasional', 'Gedung Kesenian', 'http://festivaltari.com', '2024-02-20', '2024-02-25', 'ST-002', '2024-02-15'),
(3, 3, 1, 'Olimpiade Matematika', 'Kampus A', 'http://olimpiadematematika.com', '2024-03-01', '2024-03-03', 'ST-003', '2024-02-25');
GO
INSERT INTO kompetisi (status_id, jenis_id, tingkat_id, nama_kompetisi, tempat_kompetisi, url_kompetisi, tanggal_mulai, tanggal_akhir, no_surat_tugas, tanggal_surat_tugas) VALUES 
(1, 1, 1, 'Turnamen Futsal Antar Sekolah', 'Lapangan Indoor ABC', 'http://turnamenfutsal.com', '2024-03-15', '2024-03-18', 'ST-004', '2024-03-10'),
(2, 2, 2, 'Pameran Seni Rupa', 'Galeri Seni Modern', 'http://pameransenirupa.com', '2024-04-05', '2024-04-07', 'ST-005', '2024-03-30'),
(3, 3, 3, 'Kompetisi Debat Internasional', 'Universitas XYZ', 'http://kompetisidebat.com', '2024-05-10', '2024-05-12', 'ST-006', '2024-05-05'),
(1, 1, 3, 'Kejuaraan Renang Internasional', 'Aquatic Center', 'http://kejuaraanrenang.com', '2024-06-20', '2024-06-25', 'ST-007', '2024-06-15'),
(2, 3, 1, 'Lomba Sains Lokal', 'Sekolah Negeri 1', 'http://lombasainslokal.com', '2024-07-01', '2024-07-03', 'ST-008', '2024-06-25'),
(3, 2, 2, 'Festival Musik Nasional', 'Gedung Kesenian Utama', 'http://festivalmusik.com', '2024-08-10', '2024-08-12', 'ST-009', '2024-08-05'),
(1, 1, 2, 'Turnamen Basket Nasional', 'Stadion Basket Pro', 'http://turnamenbasket.com', '2024-09-01', '2024-09-05', 'ST-010', '2024-08-25'),
(2, 2, 1, 'Kompetisi Fotografi', 'Pusat Kebudayaan', 'http://kompetisifotografi.com', '2024-10-15', '2024-10-17', 'ST-011', '2024-10-10'),
(3, 3, 3, 'Olimpiade Fisika Internasional', 'Kampus Teknik Internasional', 'http://olimpiadefisika.com', '2024-11-01', '2024-11-05', 'ST-012', '2024-10-25'),
(1, 1, 3, 'Kejuaraan Marathon Dunia', 'Jalan Raya Utama', 'http://kejuaraanmarathon.com', '2024-12-10', '2024-12-15', 'ST-013', '2024-12-05'),
(2, 2, 2, 'Festival Teater Nasional', 'Gedung Teater Baru', 'http://festivalteater.com', '2024-11-20', '2024-11-25', 'ST-014', '2024-11-15'),
(3, 3, 1, 'Lomba Kimia Lokal', 'Lab Kimia Sekolah', 'http://lombakimia.com', '2024-12-01', '2024-12-03', 'ST-015', '2024-11-27');
GO
SELECT * FROM kompetisi;



-- TABEL KOMPETISI MAHASISWA
CREATE TABLE kompetisi_mahasiswa (
    kompetisi_id INT NOT NULL,
    mahasiswa_id INT NOT NULL,
    FOREIGN KEY (kompetisi_id) REFERENCES kompetisi(id) ON DELETE CASCADE,
    FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id) ON DELETE CASCADE,
);
GO
INSERT INTO kompetisi_mahasiswa (kompetisi_id, mahasiswa_id) VALUES 
(1, 1), -- Lomba Sepak Bola, Agus Sulaiman
(1, 2), -- Lomba Sepak Bola, Odin din
(2, 2), -- Festival Tari Internasional, Budi Hartono
(2, 4), -- Festival Tari Internasional, Citra Andini
(3, 5), -- Olimpiade Matematika, Dewi Kartika
(3, 6), -- Olimpiade Matematika, Eko Santoso
(4, 7), -- Kejuaraan Bulutangkis, Fani Rahmawati
(4, 8), -- Kejuaraan Bulutangkis, Gilang Permana
(5, 9), -- Lomba Sains Lokal, Hani Pratiwi
(6, 10), -- Festival Musik Nasional, Indra Setiawan
(7, 11), -- Turnamen Basket Nasional, Joko Widodo
(8, 2), -- Kompetisi Fotografi, Kartika Sari
(9, 3), -- Olimpiade Fisika Internasional, Lina Marlina
(10, 14), -- Kejuaraan Marathon Dunia, Mira Setiani
(11, 15); -- Festival Teater Nasional, Nanda Pratama
GO
select * from kompetisi_mahasiswa;



-- TABEL KOMPETISI DOSEN
CREATE TABLE kompetisi_dosen (
    kompetisi_id INT NOT NULL,
    dosen_id INT NOT NULL,
    FOREIGN KEY (kompetisi_id) REFERENCES kompetisi(id) ON DELETE CASCADE,
    FOREIGN KEY (dosen_id) REFERENCES dosen(id) ON DELETE CASCADE,
);
GO
INSERT INTO kompetisi_dosen (kompetisi_id, dosen_id) VALUES 
(1, 1), -- Lomba Sepak Bola, Dr. Samsul Hidayat
(2, 2), -- Festival Tari Internasional, Dr. Siti Aminah
(3, 3), -- Olimpiade Matematika, Dr. Bambang Sutrisno
(4, 4), -- Kejuaraan Bulutangkis, Prof. Dewi Lestari
(5, 5), -- Lomba Sains Lokal, Dr. Agus Pranoto
(6, 6), -- Festival Musik Nasional, Dr. Rina Andayani
(7, 7), -- Turnamen Basket Nasional, Prof. Indra Wijaya
(8, 8), -- Kompetisi Fotografi, Dr. Hendra Gunawan
(9, 9), -- Olimpiade Fisika Internasional, Dr. Farida Rahmawati
(10, 10), -- Kejuaraan Marathon Dunia, Prof. Yudi Santoso
(11, 1), -- Festival Teater Nasional, Dr. Samsul Hidayat
(12, 2), -- Festival Teater Nasional, Dr. Siti Aminah
(13, 3), -- Olimpiade Fisika Internasional, Dr. Bambang Sutrisno
(14, 4), -- Kejuaraan Marathon Dunia, Prof. Dewi Lestari
(15, 5); -- Kompetisi Fotografi, Dr. Agus Pranoto
GO
SELECT * FROM kompetisi_dosen;
