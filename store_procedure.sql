<<<<<<< HEAD
-- CEK USER LOGIN
-- CEK USER LOGIN
-- CEK USER LOGIN

--CREATE PROCEDURE CekUserLogin
--    @username NVARCHAR(100),
--    @password NVARCHAR(255),
--    @role NVARCHAR(50) OUTPUT
--AS
--BEGIN
--    DECLARE @role_id INT;
--    SELECT @role_id = role_id
--    FROM users
--    WHERE username = @username AND password = @password;

--    IF @role_id IS NULL
--    BEGIN
--        SET @role = 'Invalid';
--    END
--    ELSE
--    BEGIN
--        SET @role = 
--            CASE @role_id
--                WHEN 1 THEN 'mahasiswa'
--                WHEN 2 THEN 'admin'
--                WHEN 3 THEN 'dosen'
--                ELSE 'Unknown'
--            END;
--    END
--END;

--DECLARE @role NVARCHAR(50);
--EXEC CekUserLogin 
--    @username = 'dosen1', 
--    @password = 'dosen123', 
--    @role = @role OUTPUT;
--PRINT @role;

--drop procedure CekUserLogin;

-- CEK USER LOGIN
-- CEK USER LOGIN
-- CEK USER LOGIN
CREATE PROCEDURE CekUserLogin
    @username NVARCHAR(100)
AS
BEGIN
    SELECT 
        u.username,
        u.password,
        r.role_name
    FROM 
        users u
    JOIN 
        roles r ON u.role_id = r.id
    WHERE 
        u.username = @username;
END;

EXEC CekUserLogin @username = 'admin1';



-- CEK USER LOGIN
-- CEK USER LOGIN
-- CEK USER LOGIN
CREATE TRIGGER InsteadOf_Register
ON users
INSTEAD OF INSERT
AS
BEGIN
    -- Cek apakah username yang akan dimasukkan sudah ada di tabel users
    IF EXISTS (
        SELECT 1
        FROM users u
        JOIN inserted i ON u.username = i.username
    )
    BEGIN
        -- Jika username sudah ada, berikan pesan error
        SELECT 'Username tidak tersedia.' AS Error;
    END
    ELSE
    BEGIN
        -- Jika username belum ada, masukkan data baru
        INSERT INTO users (username, password, role_id)
        SELECT username, password, role_id
        FROM inserted;
    END
END;

enable trigger InsteadOf_Register on users;

INSERT INTO users (username, password, role_id) 
VALUES ('admin1', 'admin123', 2);


--- TAMPILKAN KOMPETISI SESUAI NIM MAHASISWA
--- TAMPILKAN KOMPETISI SESUAI NIM MAHASISWA
--- TAMPILKAN KOMPETISI SESUAI NIM MAHASISWA

alter PROCEDURE TampilKompetisi_Nim
    @nim NVARCHAR(20)
AS
BEGIN
    -- NIM valid
    IF EXISTS (SELECT 1 FROM mahasiswa WHERE nim = @nim)
=======
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
>>>>>>> 64de4873f77f5a2474b1b66578c902e4ea477122
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
<<<<<<< HEAD
            m.nim = @nim;
    END
	-- NIM invalid
=======
            m.nim = @Nim;
    END
>>>>>>> 64de4873f77f5a2474b1b66578c902e4ea477122
    ELSE
    BEGIN
        SELECT 'Tidak Ada Data Prestasi' AS Pesan;
        RETURN;
    END
END;
<<<<<<< HEAD

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
=======
>>>>>>> 64de4873f77f5a2474b1b66578c902e4ea477122
