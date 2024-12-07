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
GO


-- isUsernameExists
CREATE PROCEDURE CheckUsernameExists
    @Username NVARCHAR(255)
AS
BEGIN
    SELECT 1
    FROM users
    WHERE username = @Username;
END;
GO


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
GO


-- Ambil Nim dari Login
CREATE PROCEDURE GetNimByLogin
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
    @username = 'agus', 
    @Nim = @Nim OUTPUT;
PRINT @Nim;



--- AMBIL KOMPETISI SESUAI LOGIN NIM 
CREATE PROCEDURE GetKompetisiByNim 
    @Username NVARCHAR(100)
AS
BEGIN
    -- Deklarasi variabel untuk menyimpan NIM
    DECLARE @Nim NVARCHAR(20);

    -- Eksekusi prosedur untuk mendapatkan NIM berdasarkan username
    EXEC GetNimByLogin @Username, @Nim OUTPUT;

    -- Periksa apakah NIM ditemukan
    IF @Nim IS NOT NULL
    BEGIN
        -- Query untuk mengambil data kompetisi mahasiswa
        SELECT 
            m.nim                                AS NIM,
            m.nama                               AS Nama_Mahasiswa,
            k.nama_kompetisi                     AS Nama_Kompetisi,
            jk.nama                              AS Jenis_Kompetisi,
            tk.nama                              AS Tingkat_Kompetisi,
            k.tempat_kompetisi                   AS Tempat_Kompetisi,
            FORMAT(k.tanggal_mulai, 'yyyy-MM-dd') AS Tanggal_Mulai,
            FORMAT(k.tanggal_akhir, 'yyyy-MM-dd') AS Tanggal_Akhir,
            k.url_kompetisi                      AS URL_Kompetisi,
            k.no_surat_tugas                     AS No_Surat_Tugas
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
        -- Pesan jika NIM tidak ditemukan
        SELECT 
            'Tidak Ada Data Prestasi' AS Pesan;
        RETURN;
    END
END;



--- AMBIL KOMPETISI SEMUANYA 
--CREATE PROCEDURE GetKompetisi_All 
--AS
--BEGIN
--    SELECT 
--        m.nim                                      AS NIM,
--        m.nama                                     AS Nama_Mahasiswa,
--        m.email                                    AS Email_Mahasiswa,
--        k.nama_kompetisi                           AS Nama_Kompetisi,
--        jk.nama                                    AS Jenis_Kompetisi,
--        tk.nama                                    AS Tingkat_Kompetisi,
--        k.tempat_kompetisi                         AS Tempat_Kompetisi,
--        FORMAT(k.tanggal_mulai, 'yyyy-MM-dd')       AS Tanggal_Mulai,
--        FORMAT(k.tanggal_akhir, 'yyyy-MM-dd')       AS Tanggal_Akhir,
--        k.url_kompetisi                            AS URL_Kompetisi,
--        k.no_surat_tugas                           AS No_Surat_Tugas,
--        FORMAT(k.tanggal_surat_tugas, 'yyyy-MM-dd') AS Tanggal_Surat_Tugas
--    FROM 
--        mahasiswa m
--    JOIN 
--        kompetisi_mahasiswa km ON m.id = km.mahasiswa_id
--    JOIN 
--        kompetisi k ON km.kompetisi_id = k.id
--    JOIN 
--        jenis_kompetisi jk ON k.jenis_id = jk.id
--    JOIN 
--        tingkat_kompetisi tk ON k.tingkat_id = tk.id;
--END;



-- AMBIL KOMPETISI ALL (PAGING VERSION)
CREATE PROCEDURE GetKompetisi_All 
    @limit INT,          -- Jumlah data per halaman
    @offset INT          -- Offset berdasarkan halaman yang diminta
AS
BEGIN
    SELECT 
        m.nim                                      AS NIM,
        m.nama                                     AS Nama_Mahasiswa,
        m.email                                    AS Email_Mahasiswa,
        k.nama_kompetisi                           AS Nama_Kompetisi,
        jk.nama                                    AS Jenis_Kompetisi,
        tk.nama                                    AS Tingkat_Kompetisi,
        k.tempat_kompetisi                         AS Tempat_Kompetisi,
        FORMAT(k.tanggal_mulai, 'yyyy-MM-dd')       AS Tanggal_Mulai,
        FORMAT(k.tanggal_akhir, 'yyyy-MM-dd')       AS Tanggal_Akhir,
        k.url_kompetisi                            AS URL_Kompetisi,
        k.no_surat_tugas                           AS No_Surat_Tugas,
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
        tingkat_kompetisi tk ON k.tingkat_id = tk.id
    ORDER BY 
        k.tanggal_mulai DESC  -- Mengurutkan berdasarkan tanggal mulai kompetisi, bisa disesuaikan
    OFFSET @offset ROWS      -- Menggunakan offset untuk paginasi
    FETCH NEXT @limit ROWS ONLY; -- Mengambil data berdasarkan batas limit
END;
GO



-- HITUNG SEMUA KOMPETISI
CREATE PROCEDURE GetKompetisi_Count
AS
BEGIN
    SELECT COUNT(*) AS total
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
GO
EXEC GetKompetisi_Count;



-- HITUNG PROSES KOMPETISI
CREATE PROCEDURE CountKompetisi_Proses
AS
BEGIN
    SELECT COUNT(*) AS JumlahKompetisi
    FROM kompetisi
    WHERE status_id = (SELECT id FROM status WHERE nama = 'Proses');
END;
GO
EXEC CountKompetisi_Proses;



-- HITUNG BERHASIL KOMPETISI
CREATE PROCEDURE CountKompetisi_Berhasil
AS
BEGIN
    SELECT COUNT(*) AS JumlahKompetisi
    FROM kompetisi
    WHERE status_id = (SELECT id FROM status WHERE nama = 'Berhasil');
END;
GO
EXEC CountKompetisi_Berhasil;



-- HITUNG GAGAL KOMPETISI
CREATE PROCEDURE CountKompetisi_Gagal
AS
BEGIN
    SELECT COUNT(*) AS JumlahKompetisi
    FROM kompetisi
    WHERE status_id = (SELECT id FROM status WHERE nama = 'Gagal');
END;
GO
EXEC CountKompetisi_Gagal;



-- MENAMPILKAN PROFIL DI ADMIN
CREATE PROCEDURE GetAdminDataFromUser
    @username VARCHAR(100)
AS
BEGIN
    SELECT a.id, a.no_pegawai, a.nama, a.email, a.username
    FROM admin a
    INNER JOIN users u ON a.username = u.username
    WHERE u.username = @username;
END
GO



-- MENCARI NIM & KOMPETISI DI SEARCH BAR
CREATE PROCEDURE SearchBar_Nim 
	@nim CHAR(10)
AS
BEGIN
    SELECT k.nama_kompetisi, k.tempat_kompetisi, k.tanggal_mulai, k.tanggal_akhir
    FROM kompetisi_mahasiswa km
    INNER JOIN mahasiswa m ON km.mahasiswa_id = m.id
    INNER JOIN kompetisi k ON km.kompetisi_id = k.id
    WHERE m.nim = @nim;
END;
GO


--===============================================================================


-- INSERT DATA KOMPETISI
CREATE PROCEDURE InsertKompetisi
    @jenis_id INT,
    @tingkat_id INT,
    @nama_kompetisi VARCHAR(255),
    @tempat_kompetisi VARCHAR(255),
    @url_kompetisi VARCHAR(255),
    @tanggal_mulai DATE,
    @tanggal_akhir DATE,
    @no_surat_tugas VARCHAR(50),
    @tanggal_surat_tugas DATE,
	@file_surat_tugas VARCHAR(100),
	@file_sertifikat VARCHAR(100),
	@foto_kegiatan VARCHAR(100),
	@file_poster VARCHAR(100)
AS
BEGIN
    BEGIN TRY
        INSERT INTO kompetisi (
            status_id, 
            jenis_id, 
            tingkat_id, 
            nama_kompetisi, 
            tempat_kompetisi, 
            url_kompetisi, 
            tanggal_mulai, 
            tanggal_akhir, 
            no_surat_tugas, 
            tanggal_surat_tugas,
			file_surat_tugas,
			file_sertifikat,
			foto_kegiatan,
			file_poster
        )
        VALUES (
            1, 
            @jenis_id, 
            @tingkat_id, 
            @nama_kompetisi, 
            @tempat_kompetisi, 
            @url_kompetisi, 
            @tanggal_mulai, 
            @tanggal_akhir, 
            @no_surat_tugas, 
            @tanggal_surat_tugas,
			@file_surat_tugas,
			@file_sertifikat,
			@foto_kegiatan,
			@file_poster
        );

        PRINT 'Data kompetisi berhasil ditambahkan.';
    END TRY
    BEGIN CATCH
        -- Tangani error dan tampilkan pesan
        DECLARE @ErrorMessage VARCHAR(255) = ERROR_MESSAGE();
        DECLARE @ErrorSeverity INT = ERROR_SEVERITY();
        DECLARE @ErrorState INT = ERROR_STATE();

        RAISERROR (@ErrorMessage, @ErrorSeverity, @ErrorState);
    END CATCH
END;
GO

--DECLARE @jenis_id INT,
--    @tingkat_id INT,
--    @nama_kompetisi VARCHAR(255),
--    @tempat_kompetisi VARCHAR(255),
--    @url_kompetisi VARCHAR(255),
--    @tanggal_mulai DATE,
--    @tanggal_akhir DATE,
--    @no_surat_tugas VARCHAR(50),
--    @tanggal_surat_tugas DATE,
--	@file_surat_tugas VARCHAR(100),
--	@file_sertifikat VARCHAR(100),
--	@foto_kegiatan VARCHAR(100),
--	@file_poster VARCHAR(100);
--EXEC InsertKompetisi 1, 2, 'Lomba Sepak Bola', 'Stadion Nasional', 'http://lombasepakbola.com', 
--'2024-01-10', '2024-01-15', 'ST-001', '2024-01-05', '1.jpg', '2.jpg', '3.jpg', '4.jpg';
--select top 1 * from kompetisi order by id desc;



-- CARI ID UNTUK INSERT KOMPETISI INDIVIDU
CREATE PROCEDURE GetIdByLogin 
	@Username VARCHAR(100),
    @Mahasiswa_id INT OUTPUT
AS
BEGIN
    -- Deklarasi variabel untuk menyimpan NIM
    DECLARE @Nim VARCHAR(20);
	-- Eksekusi prosedur untuk mendapatkan NIM berdasarkan username
    EXEC GetNimByLogin @Username, @Nim OUTPUT

	IF @Nim IS NOT NULL
    BEGIN
        SELECT @Mahasiswa_id = m.id
		FROM mahasiswa m
		WHERE m.username = @Username
	END
    ELSE
    BEGIN
        SELECT 
            'Mahasiswa_id tidak ditemukan' AS Pesan;
        RETURN;
    END
END;
		
--DECLARE @Mahasiswa_id int;
--EXEC GetIdByLogin 
--    @username = 'odin', 
--    @Mahasiswa_id = @Mahasiswa_id OUTPUT;
--PRINT @Mahasiswa_id;
		


-- CARI ID UNTUK INSERT KOMPETISI KELOMPOK
CREATE PROCEDURE GetIdFromNim 
	@Nim CHAR(10),
    @Mahasiswa_id INT OUTPUT
AS
BEGIN
	SELECT @Mahasiswa_id = m.id
	FROM mahasiswa m
	WHERE m.nim = @Nim

    IF @Mahasiswa_id IS NULL
	BEGIN
        SELECT 
            'Mahasiswa_id tidak ditemukan' AS Pesan;
        RETURN;
    END
END;

--DECLARE @Mahasiswa_id int;
--EXEC GetIdFromNim 
--    @nim = '220001002', 
--    @Mahasiswa_id = @Mahasiswa_id OUTPUT;
--PRINT @Mahasiswa_id;

ALTER PROCEDURE GetKompetisiByNim 
    @Username NVARCHAR(100)
AS
BEGIN
    -- Deklarasi variabel untuk menyimpan NIM
    DECLARE @Nim NVARCHAR(20);

    -- Eksekusi prosedur untuk mendapatkan NIM berdasarkan username
    EXEC GetNimByLogin @Username, @Nim OUTPUT;

    -- Periksa apakah NIM ditemukan
    IF @Nim IS NOT NULL
    BEGIN
        -- Query untuk mengambil data kompetisi mahasiswa
        SELECT 
            m.nim                                AS NIM,
            m.nama                               AS Nama_Mahasiswa,
            k.nama_kompetisi                     AS Nama_Kompetisi,
            jk.nama                              AS Jenis_Kompetisi,
            tk.nama                              AS Tingkat_Kompetisi,
            k.tempat_kompetisi                   AS Tempat_Kompetisi,
            FORMAT(k.tanggal_mulai, 'yyyy-MM-dd') AS Tanggal_Mulai,
            FORMAT(k.tanggal_akhir, 'yyyy-MM-dd') AS Tanggal_Akhir,
            k.url_kompetisi                      AS URL_Kompetisi,
            k.no_surat_tugas                     AS No_Surat_Tugas,
			FORMAT(k.tanggal_surat_tugas, 'yyyy-MM-dd') AS Tanggal_Surat_Tugas
			k.file_surat_tugas					AS File_Surat_Tugas,
			k.file_sertifikat					AS File_Sertifikat,
			k.foto_kegiatan						AS Foto_Kegiatan,
			k.file_poster						AS File_Poster

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
		join 
			status s on k.status_id = s.id
        WHERE 
            m.nim = @Nim;
    END
    ELSE
    BEGIN
        -- Pesan jika NIM tidak ditemukan
        SELECT 
            'Tidak Ada Data Prestasi' AS Pesan;
        RETURN;
    END
END;