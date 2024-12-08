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
			s.nama								AS Status,
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
		JOIN status s on k.status_id = s.id
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


--==========================================================================


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
        FORMAT(k.tanggal_surat_tugas, 'yyyy-MM-dd') AS Tanggal_Surat_Tugas,
		k.file_surat_tugas							AS File_Surat_Tugas,
		k.file_sertifikat							AS File_Sertifikat,
		k.foto_kegiatan								AS Foto_Kegiatan,
		k.file_poster								AS File_Poster,
		s.nama										AS Status
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
	JOIN
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



ALTER PROCEDURE GetKompetisi_All 
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
        FORMAT(k.tanggal_surat_tugas, 'yyyy-MM-dd') AS Tanggal_Surat_Tugas,
		k.file_surat_tugas							AS File_Surat_Tugas,
		k.file_sertifikat							AS File_Sertifikat,
		k.foto_kegiatan								AS Foto_Kegiatan,
		k.file_poster								AS File_Poster,
		s.nama										AS Status
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
	JOIN
			status s on k.status_id = s.id
    ORDER BY 
        k.tanggal_mulai DESC  -- Mengurutkan berdasarkan tanggal mulai kompetisi, bisa disesuaikan
    OFFSET @offset ROWS      -- Menggunakan offset untuk paginasi
    FETCH NEXT @limit ROWS ONLY; -- Mengambil data berdasarkan batas limit
END;
GO



-- SP BESAR BUAT GABUNGIN SP SP INSERT KOMPETISI
CREATE PROCEDURE InsertKompetisi_MhsDos
    @Username VARCHAR(100),             -- Username mahasiswa yang login
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
    @file_poster VARCHAR(100),
    @dosen_id INT,                      -- Dosen pembimbing kompetisi
    @nim_list NVARCHAR(MAX) = NULL      -- Daftar NIM anggota (jika berkelompok, dipisahkan koma)
AS
BEGIN
    BEGIN TRY
        BEGIN TRANSACTION;

        -- 1. Dapatkan Mahasiswa_id untuk mahasiswa yang login
        DECLARE @Mahasiswa_id INT;
        EXEC GetIdByLogin @Username = @Username, @Mahasiswa_id = @Mahasiswa_id OUTPUT;

        IF @Mahasiswa_id IS NULL
        BEGIN
            RAISERROR ('Mahasiswa_id tidak ditemukan untuk username %s', 16, 1, @Username);
            ROLLBACK TRANSACTION;
            RETURN;
        END

        -- 2. Insert ke tabel kompetisi
        DECLARE @kompetisi_id INT;

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
            1, -- Default status_id
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

        SET @kompetisi_id = SCOPE_IDENTITY();

        -- 3. Insert ke tabel kompetisi_mahasiswa untuk mahasiswa login
        INSERT INTO kompetisi_mahasiswa (kompetisi_id, mahasiswa_id)
        VALUES (@kompetisi_id, @Mahasiswa_id);

        -- 4. Jika nim_list tidak NULL, proses anggota kelompok
        IF @nim_list IS NOT NULL AND LEN(@nim_list) > 0
        BEGIN
            DECLARE @nim NVARCHAR(10);
            DECLARE @anggota_id INT;

            WHILE LEN(@nim_list) > 0
            BEGIN
                -- Ambil NIM pertama dari daftar
                SET @nim = LEFT(@nim_list, CHARINDEX(',', @nim_list + ',') - 1);

                -- Cari mahasiswa_id berdasarkan NIM
                EXEC GetIdFromNim @Nim = @nim, @Mahasiswa_id = @anggota_id OUTPUT;

                IF @anggota_id IS NOT NULL
                BEGIN
                    INSERT INTO kompetisi_mahasiswa (kompetisi_id, mahasiswa_id)
                    VALUES (@kompetisi_id, @anggota_id);
                END

                -- Hapus NIM yang telah diproses dari daftar
                SET @nim_list = STUFF(@nim_list, 1, CHARINDEX(',', @nim_list + ','), '');
            END
        END

        -- 5. Insert ke tabel kompetisi_dosen
        INSERT INTO kompetisi_dosen (kompetisi_id, dosen_id)
        VALUES (@kompetisi_id, @dosen_id);

        COMMIT TRANSACTION;
        PRINT 'Data kompetisi, dosen, dan mahasiswa berhasil ditambahkan.';
    END TRY
    BEGIN CATCH
        ROLLBACK TRANSACTION;

        -- Tangani error
        DECLARE @ErrorMessage NVARCHAR(4000) = ERROR_MESSAGE();
        RAISERROR (@ErrorMessage, 16, 1);
    END CATCH
END;
GO



CREATE PROCEDURE GetKompetisiById
    @Id INT
AS
BEGIN
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
			FORMAT(k.tanggal_surat_tugas, 'yyyy-MM-dd') AS Tanggal_Surat_Tugas,
			k.file_surat_tugas					AS File_Surat_Tugas,
			k.file_sertifikat					AS File_Sertifikat,
			k.foto_kegiatan						AS Foto_Kegiatan,
			k.file_poster						AS File_Poster,
			s.nama								AS Status
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
		JOIN
			status s on k.status_id = s.id
        WHERE 
            k.id = @Id;
END;
GO
--DECLARE @Id int;
--EXEC GetKompetisiById 1;


--==========================================================================


CREATE PROCEDURE SetStatus_Berhasil 
	@Id INT
AS
BEGIN
	IF @Id IS NOT NULL
    BEGIN
        UPDATE kompetisi
		SET status_id = 2
		WHERE id = @Id;

		SELECT 
            'STATUS BERHASIL DIGANTI' AS Pesan;
        RETURN;
	END
    ELSE
    BEGIN
        SELECT 
            'GAGAL DIGANTI' AS Pesan;
        RETURN;
    END
END;
GO

--EXEC SetStatus_Berhasil @Id = 1
--select * from kompetisi where id = 1



CREATE PROCEDURE SetStatus_Gagal
	@Id INT
AS
BEGIN
	IF @Id IS NOT NULL
    BEGIN
        UPDATE kompetisi
		SET status_id = 3
		WHERE id = @Id;

		SELECT 
            'STATUS BERHASIL DIGANTI' AS Pesan;
        RETURN;
	END
    ELSE
    BEGIN
        SELECT 
            'GAGAL DIGANTI' AS Pesan;
        RETURN;
    END
END;
GO

--EXEC SetStatus_Gagal @Id = 4
--select * from kompetisi where id = 4



CREATE PROCEDURE GetKompetisiByNimPaginated
    @Username NVARCHAR(100),
    @Offset INT,
    @Limit INT
AS
BEGIN
    -- Deklarasi variabel untuk menyimpan NIM
    DECLARE @Nim NVARCHAR(20);

    -- Eksekusi prosedur untuk mendapatkan NIM berdasarkan username
    EXEC GetNimByLogin @Username, @Nim OUTPUT;

    -- Periksa apakah NIM ditemukan
    IF @Nim IS NOT NULL
    BEGIN
        -- Query untuk mengambil data kompetisi mahasiswa dengan paginasi
        SELECT 
            m.nim                                AS NIM,
            m.nama                               AS Nama_Mahasiswa,
            k.nama_kompetisi                     AS Nama_Kompetisi,
            jk.nama                              AS Jenis_Kompetisi,
            tk.nama                              AS Tingkat_Kompetisi,
            k.tempat_kompetisi                   AS Tempat_Kompetisi,
            s.nama                               AS Status,
            FORMAT(k.tanggal_mulai, 'yyyy-MM-dd') AS Tanggal_Mulai,
            FORMAT(k.tanggal_akhir, 'yyyy-MM-dd') AS Tanggal_Akhir,
            k.url_kompetisi                      AS URL_Kompetisi,
            k.no_surat_tugas                     AS No_Surat_Tugas,
            FORMAT(k.tanggal_surat_tugas, 'yyyy-MM-dd') AS Tanggal_Surat_Tugas,
            k.file_surat_tugas                   AS File_Surat_Tugas,
            k.file_sertifikat                    AS File_Sertifikat,
            k.foto_kegiatan                      AS Foto_Kegiatan,
            k.file_poster                        AS File_Poster
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
        JOIN 
            status s ON k.status_id = s.id
        WHERE 
            m.nim = @Nim
        ORDER BY 
            k.tanggal_mulai DESC -- Atur urutan sesuai kebutuhan
        OFFSET @Offset ROWS FETCH NEXT @Limit ROWS ONLY;
    END
    ELSE
    BEGIN
        -- Pesan jika NIM tidak ditemukan
        SELECT 
            'Tidak Ada Data Prestasi' AS Pesan;
        RETURN;
    END
END;
GO

--EXEC GetKompetisiByNim @Username = 'odin';



CREATE PROCEDURE GetMahasiswaDataByUsername
	@Username VARCHAR(100)
AS
BEGIN
    DECLARE @Nim NVARCHAR(20);
    EXEC GetNimByLogin @Username, @Nim OUTPUT;

	IF @Nim IS NOT NULL
    BEGIN
        -- Query untuk mengambil data kompetisi mahasiswa dengan paginasi
        SELECT
			m.nim,
			m.nama,
			m.no_telp,
			m.alamat,
			m.email,
			p.nama as nama_prodi
		FROM mahasiswa m
		JOIN prodi p ON m.prodi_id = p.id
		WHERE @Nim = m.nim
	END
    ELSE
    BEGIN
        -- Pesan jika NIM tidak ditemukan
        SELECT 
            'Tidak Ada Data Mahasiswa' AS Pesan;
        RETURN;
    END
END;
GO
-- EXEC GetMahasiswaDataByUsername @Username = 'odin';



CREATE PROCEDURE EditProfileMahasiswa
    @Username VARCHAR(100),
    @FullName VARCHAR(100),
    @Address VARCHAR(255),
    @Phone VARCHAR(20),
    @Email VARCHAR(100)
AS
BEGIN
    DECLARE @Mahasiswa_id INT;
    EXEC GetIdByLogin @Username, @Mahasiswa_id OUTPUT;

    IF @Mahasiswa_id IS NOT NULL
    BEGIN
        -- Melakukan update data mahasiswa
        UPDATE mahasiswa
        SET
            nama = @FullName,
            alamat = @Address,
            no_telp = @Phone,
            email = @Email
        WHERE id = @Mahasiswa_id;

        SELECT 'Data berhasil diupdate' AS Message;
    END
    ELSE
    BEGIN
        SELECT 'ID tidak ditemukan' AS Message;
    END
END;
GO
