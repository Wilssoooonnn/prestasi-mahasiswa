-- Get User By Username Login
CREATE PROCEDURE GetUserByUsername
    @Username NVARCHAR(255)
AS
BEGIN
    SELECT u.username, u.password, r.role_name
    FROM users u
    JOIN roles r ON u.role_id = r.id
    WHERE u.username = @Username;
END;

-- isUsernameExists
CREATE PROCEDURE CheckUsernameExists
    @Username NVARCHAR(255)
AS
BEGIN
    SELECT 1
    FROM users
    WHERE username = @Username;
END;


-- Register User
CREATE PROCEDURE RegisterUser
    @Username NVARCHAR(255),
    @Password NVARCHAR(255),
    @RoleId INT
AS
BEGIN
    INSERT INTO users (username, password, role_id)
    VALUES (@Username, @Password, @RoleId);
END;

-- Ambil Nim dari Login
alter PROCEDURE GetNimByLogin
    @Username NVARCHAR(100),
	@Nim NVARCHAR(20) OUTPUT
AS
BEGIN
	SELECT @Nim = m.nim
    FROM mahasiswa m
    JOIN users u ON m.username = u.username
    WHERE u.username = @Username;
END;

DECLARE @Nim int;
EXEC GetNimByLogin 
    @username = 'mahasiswa1', 
    @Nim = @Nim OUTPUT;
PRINT @Nim;

--- AMBIL KOMPETISI SESUAI LOGIN NIM
CREATE PROCEDURE GetKompetisiByNim
    @Username NVARCHAR(100)
AS
BEGIN
    DECLARE @Nim NVARCHAR(20);
    EXEC GetNimByLogin @Username, @Nim OUTPUT;

    IF @Nim IS NOT NULL
    BEGIN
        SELECT 
            m.nim AS NIM,
            m.nama AS Nama_Mahasiswa,
            k.nama_kompetisi AS Nama_Kompetisi,
            jk.nama AS Jenis_Kompetisi,
            tk.nama AS Tingkat_Kompetisi,
            k.tempat_kompetisi AS Tempat_Kompetisi,
            FORMAT(k.tanggal_mulai, 'yyyy-MM-dd') AS Tanggal_Mulai,
            FORMAT(k.tanggal_akhir, 'yyyy-MM-dd') AS Tanggal_Akhir,
            k.url_kompetisi AS URL_Kompetisi,
            k.no_surat_tugas AS No_Surat_Tugas
        FROM 
            mahasiswa m
        JOIN 
            kompetisi_mahasiswa km ON m.id = km.mahasiswa_id
        JOIN 
            kompetisi k ON km.kompetisi_id = k.id
        JOIN 
            jenis_kompetisi jk ON k.jenis_id = jk.id
        JOIN 
            tingkat_kompetisi tk ON k.tingkat_id = tk.id
        WHERE 
            m.nim = @Nim;
    END
    ELSE
    BEGIN
        SELECT 'Tidak Ada Data Prestasi' AS Pesan;
        RETURN;
    END
END;

--- AMBIL KOMPETISI SEMUANYA
CREATE PROCEDURE GetKompetisi_All
AS
BEGIN
    SELECT 
        m.nim AS NIM,
        m.nama AS Nama_Mahasiswa,
        m.email AS Email_Mahasiswa,
        k.nama_kompetisi AS Nama_Kompetisi,
        jk.nama AS Jenis_Kompetisi,
        tk.nama AS Tingkat_Kompetisi,
        k.tempat_kompetisi AS Tempat_Kompetisi,
        FORMAT(k.tanggal_mulai, 'yyyy-MM-dd') AS Tanggal_Mulai,
        FORMAT(k.tanggal_akhir, 'yyyy-MM-dd') AS Tanggal_Akhir,
        k.url_kompetisi AS URL_Kompetisi,
        k.no_surat_tugas AS No_Surat_Tugas,
        FORMAT(k.tanggal_surat_tugas, 'yyyy-MM-dd') AS Tanggal_Surat_Tugas
    FROM 
        mahasiswa m
    JOIN 
        kompetisi_mahasiswa km ON m.id = km.mahasiswa_id
    JOIN 
        kompetisi k ON km.kompetisi_id = k.id
    JOIN 
        jenis_kompetisi jk ON k.jenis_id = jk.id
    JOIN 
        tingkat_kompetisi tk ON k.tingkat_id = tk.id;
END;

-- Membuat tabel Status
CREATE TABLE status (
    id INT PRIMARY KEY IDENTITY(1,1), -- Auto increment
    nama NVARCHAR(50) NOT NULL
);

-- Menambahkan data ke tabel Status
INSERT INTO Status (nama) 
VALUES 
    ('Proses'),
    ('Berhasil'),
    ('Gagal');


-- Tambahkan status_id di kompetisi_mahasiswa
ALTER TABLE kompetisi_mahasiswa
ADD status_id INT;

-- Tambahkan foreign key untuk status_id
ALTER TABLE kompetisi_mahasiswa
ADD CONSTRAINT fk_status 
FOREIGN KEY (status_id) REFERENCES status(id) ON DELETE CASCADE; 

-- untuk tahu nama constraint
--SELECT 
--    o.name AS Constraint_Name, 
--    c.name AS Table_Name,
--    o.type_desc AS Constraint_Type
--FROM sys.objects o
--JOIN sys.tables c ON o.parent_object_id = c.object_id
--WHERE c.name = 'kompetisi_mahasiswa';

-- Ganti primary key
ALTER TABLE kompetisi_mahasiswa
DROP CONSTRAINT PK__kompetis__BFC723E9C700849A;
--lanjut
UPDATE kompetisi_mahasiswa
SET status_id = 1
WHERE status_id IS NULL;

--ALTER TABLE kompetisi_mahasiswa
--ADD CONSTRAINT PK_kompetisi_mahasiswa PRIMARY KEY (kompetisi_id, mahasiswa_id, status_id);
