-- CEK USER LOGIN
-- CEK USER LOGIN
-- CEK USER LOGIN
CREATE PROCEDURE CekUserLogin
    @username NVARCHAR(100),
    @password NVARCHAR(255),
    @role NVARCHAR(50) OUTPUT
AS
BEGIN
    DECLARE @role_id INT;
    SELECT @role_id = role_id
    FROM users
    WHERE username = @username AND password = @password;

    IF @role_id IS NULL
    BEGIN
        SET @role = 'Invalid';
    END
    ELSE
    BEGIN
        SET @role = 
            CASE @role_id
                WHEN 1 THEN 'mahasiswa'
                WHEN 2 THEN 'admin'
                WHEN 3 THEN 'dosen'
                ELSE 'Unknown'
            END;
    END
END;

DECLARE @role NVARCHAR(50);
EXEC CekUserLogin 
    @username = 'dosen1', 
    @password = 'dosen123', -- belom dicoba kalo pw encrypt
    @role = @role OUTPUT;
PRINT @role;


--- TAMPILKAN KOMPETISI SESUAI NIM MAHASISWA
--- TAMPILKAN KOMPETISI SESUAI NIM MAHASISWA
--- TAMPILKAN KOMPETISI SESUAI NIM MAHASISWA
alter PROCEDURE TampilKompetisi_Nim
    @nim NVARCHAR(20)
AS
BEGIN
    -- NIM valid
    IF EXISTS (SELECT 1 FROM mahasiswa WHERE nim = @nim)
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
            m.nim = @nim;
    END
	-- NIM invalid
    ELSE
    BEGIN
        SELECT 'Tidak Ada Data Prestasi' AS Pesan;
        RETURN;
    END
END;

-- NIM valid
EXEC TampilKompetisi_Nim @nim = '220001003';
-- NIM invalid
EXEC TampilKompetisi_Nim @nim = '999999999';


--- TAMPILKAN SEMUA KOMPETISI (UTK ADMIN)
--- TAMPILKAN SEMUA KOMPETISI (UTK ADMIN)
--- TAMPILKAN SEMUA KOMPETISI (UTK ADMIN)
CREATE PROCEDURE TampilKompetisi
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

EXEC TampilKompetisi;