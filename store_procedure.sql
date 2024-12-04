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
