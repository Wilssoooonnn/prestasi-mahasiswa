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
