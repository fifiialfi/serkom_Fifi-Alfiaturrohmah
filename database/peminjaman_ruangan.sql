START TRANSACTION;
CREATE DATABASE peminjaman_ruangan;
USE peminjaman_ruangan;
DROP DATABASE peminjaman_ruangan;
SHOW DATABASES;
SHOW TABLES;

-----------------------------------------------------------

-- --------------------------------------------------------
-- Table structure for table `user`
-- --------------------------------------------------------

CREATE TABLE user (
  id_user INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(50) NOT NULL,
  tanggal_lahir DATE NOT NULL,
  jenis_kelamin CHAR(1) NOT NULL CHECK (jenis_kelamin IN ('L', 'P')),
  alamat VARCHAR(50) NOT NULL,
  no_telp VARCHAR(15) NOT NULL,
  tanggal_masuk DATETIME NOT NUll,
  hak_akses ENUM('admin', 'user') DEFAULT 'user',
  PRIMARY KEY (id_user)
);
DESCRIBE user;

-- --------------------------------------------------------
-- Insert data into `user`
-- --------------------------------------------------------

INSERT INTO user (id_user, username, password, tanggal_lahir, jenis_kelamin, alamat, no_telp, tanggal_masuk, hak_akses)
VALUES 
(1, 'fifialfi', 'fifi123', '2003-06-08', 'P', 'Purwokerto', '08123456789', '2024-10-25 12:00:00', 'admin'),
(2, 'arinda', 'arin123', '2002-08-15', 'P', 'Purwakarta', '08234567890', '2024-10-27 12:00:00', 'user'),
(3, 'amanda', 'manda123', '2000-11-25', 'P', 'Wangon', '08345678901', '2024-11-01 12:00:00', 'user'),
(4, 'dudul', 'dudul123', '1999-03-10', 'L', 'Bekasi', '08456789012', '2024-11-02 12:00:00', 'user'),
(5, 'bedul', 'bedul123', '1998-07-30', 'L', 'Depok', '08567890123', '2024-11-03 12:00:00', 'user');
SELECT*FROM user;

-- --------------------------------------------------------
-- Table structure for table `ruangan`
-- --------------------------------------------------------

CREATE TABLE ruangan (
  id_ruangan INT(11) NOT NULL AUTO_INCREMENT,
  nama_ruangan VARCHAR(50) NOT NULL,
  lokasi VARCHAR(50) NOT NULL,
  kapasitas INT(11) NOT NULL CHECK (kapasitas > 0),
  fasilitas TEXT NOT NULL,
  status ENUM('Tersedia', 'Tidak Tersedia') DEFAULT 'Tersedia',
  PRIMARY KEY (id_ruangan)
);
DESCRIBE ruangan;

-- --------------------------------------------------------
-- Insert data into `ruangan`
-- --------------------------------------------------------

INSERT INTO ruangan (id_ruangan, nama_ruangan, lokasi, kapasitas, fasilitas, status)
VALUES 
(1, 'Ruang Rapat', 'Lantai 1', 30, 'Proyektor, AC, Whiteboard', 'Tersedia'),
(2, 'Ruang Seminar', 'Lantai 2', 100, 'Proyektor, Sound System, Kursi', 'Tersedia'),
(3, 'Ruang Belajar', 'Lantai 3', 20, 'AC, Meja, Kursi', 'Tersedia'),
(4, 'Ruang Workshop', 'Lantai 1', 80, 'Proyektor, Meja, Kursi', 'Tidak Tersedia'),
(5, 'Ruang Diskusi', 'Lantai 2', 50, 'AC, Whiteboard', 'Tersedia');

SELECT*FROM ruangan;

-- --------------------------------------------------------
-- Table structure for table `peminjaman`
-- --------------------------------------------------------

CREATE TABLE peminjaman (
  id_peminjaman INT(11) NOT NULL AUTO_INCREMENT,
  id_ruangan INT(11) NOT NULL,
  id_user INT(11) NOT NULL,
  tanggal_pinjam DATETIME NOT NULL,
  tanggal_kembali DATETIME NOT NULL,
  status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
  PRIMARY KEY (id_peminjaman),
  FOREIGN KEY (id_ruangan) REFERENCES ruangan (id_ruangan),
  FOREIGN KEY (id_user) REFERENCES user (id_user)
);
DESCRIBE peminjaman;

-- --------------------------------------------------------
-- Insert data into `peminjaman`
-- --------------------------------------------------------

INSERT INTO peminjaman (id_peminjaman, id_ruangan, id_user, tanggal_pinjam, tanggal_kembali, status)
VALUES
(1, 1, 1, '2024-11-01 10:00:00', '2024-11-01 12:00:00', 'pending'),
(2, 2, 2, '2024-11-02 14:00:00', '2024-11-02 16:00:00', 'approved'),
(3, 3, 3, '2024-11-03 09:00:00', '2024-11-03 11:00:00', 'pending'),
(4, 4, 4, '2024-11-04 13:00:00', '2024-11-04 15:00:00', 'rejected'),
(5, 5, 5, '2024-11-05 08:00:00', '2024-11-05 10:00:00', 'pending');

SELECT*FROM peminjaman;

-- --------------------------------------------------------
-- Table structure for table `review_ruangan`
-- --------------------------------------------------------

CREATE TABLE review_ruangan (
  id_review_ruangan INT(11) NOT NULL AUTO_INCREMENT,
  id_peminjaman INT(11) NOT NULL,
  rating INT CHECK (rating >= 1 AND rating <= 5),
  review_text TEXT,
  tanggal_review DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_review_ruangan),
  FOREIGN KEY (id_peminjaman) REFERENCES peminjaman (id_peminjaman)
);
DESCRIBE review_ruangan;

-- --------------------------------------------------------
-- Insert data into `review_ruangan`
-- --------------------------------------------------------

INSERT INTO review_ruangan (id_review_ruangan, id_peminjaman, rating, review_text, tanggal_review)
VALUES
(1, 1, 5, 'Ruang yang sangat nyaman dan lengkap.', '2024-11-02 12:00:00'),
(2, 2, 2, 'Ruangnya bagus, tetapi pencahayaannya agak redup.', '2024-11-03 14:00:00'),
(3, 3, 3, 'Ruang sangat ideal untuk pertemuan kecil.', '2024-11-04 09:00:00'),
(4, 4, 4, 'Ruang kurang bersih dan ada bau tidak sedap, semoga next peminjaman lebih baik lagi.', '2024-11-05 13:00:00'),
(5, 5, 3, 'Ruang cukup baik, namun kapasitasnya terlalu kecil untuk acara kami.', '2024-11-06 08:00:00');

SELECT*FROM review_ruangan;

-- --------------------------------------------------------
-- Indexes
-- --------------------------------------------------------
CREATE INDEX idx_username ON user (username);
DROP INDEX idx_username ON user;
SELECT * FROM user WHERE username = 'arinda';
ALTER TABLE user
    ADD UNIQUE INDEX idx_username (username);
ALTER TABLE ruangan
  MODIFY nama_ruangan VARCHAR(30);
SELECT * FROM user LIMIT 5;

-- --------------------------------------------------------
-- Data Definition Language (DDL)
-- --------------------------------------------------------
-- CONSTRAINT
---- PRIMARY KEY
---- FOREIGN KEY
---- UNIQUE
---- NOT NULL
---- CHECK
---- DEFAULT
---- AUTO_INCREMENT 
---- INDEX
CREATE INDEX idx_username ON user (username);
SHOW INDEX FROM user;

-- Relasi antar table
ALTER TABLE review_ruangan
    ADD CONSTRAINT review_ruangan
    FOREIGN KEY (id_peminjaman) REFERENCES peminjaman(id_peminjaman)
    ON DELETE CASCADE;

SELECT*FROM review_ruangan;
-- --------------------------------------------------------
-- Data Manipulation Language (DML)
-- --------------------------------------------------------
-- INSERT
INSERT INTO user (id_user, username, password, tanggal_lahir, jenis_kelamin, alamat, no_telp, tanggal_masuk, hak_akses)
VALUES 
(6, 'dreamy', 'dreamy123', '2003-08-06', 'L', 'Jakarta', '08112345678', '2024-11-02 12:00:00', 'admin');

-- UPDATE
UPDATE user
SET username = 'dreamyou', password = 'dreamyou123'
WHERE username = 'dreamy';

-- SELECT
SELECT username, jenis_kelamin FROM user
WHERE id_user = '1';

-- Menampilkan semua peminjaman beserta nama pengguna dan nama ruangan // manipuasi antar tabel
SELECT p.id_peminjaman, u.username, r.nama_ruangan, p.tanggal_pinjam, p.tanggal_kembali, p.status
FROM peminjaman p
JOIN user u ON p.id_user = u.id_user
JOIN ruangan r ON p.id_ruangan = r.id_ruangan;

-- Membuat view yang menampilkan peminjaman yang masih pending // manipuasi antar view
CREATE VIEW pending_peminjaman AS
SELECT p.id_peminjaman, u.username, r.nama_ruangan, p.tanggal_pinjam, p.tanggal_kembali
FROM peminjaman p
JOIN user u ON p.id_user = u.id_user
JOIN ruangan r ON p.id_ruangan = r.id_ruangan
WHERE p.status = 'pending';
SELECT * FROM pending_peminjaman;

-- DELETE
DELETE FROM user
WHERE username = 'dreamy';

-- --------------------------------------------------------
-- Data Query Language (DQL)
-- --------------------------------------------------------
-- Sorting
---- Mengurutkan kapasitas ruangan pada tabel ruangan secara ascending (nilai terkecil ke terbesar)
SELECT * FROM ruangan
ORDER BY kapasitas ASC;

---- Mengurutkan username pada tabel user secara descending (Z ke A)
SELECT * FROM user 
ORDER BY username DESC;

-- Searching
---- Memfilter output agar hanya menampilkan baris di mana kolom hak_akses mengandung kata “user” pada tabel user
SELECT * FROM user 
WHERE hak_akses LIKE '%user%';

-- --------------------------------------------------------
-- Transaction Control Language (TCL)
-- --------------------------------------------------------
-- 1. Procedure
---- procedure user
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE GetUserByHakAkses (IN role_param VARCHAR(10))   
BEGIN
    SELECT * FROM user WHERE hak_akses = role_param;
END$$
DELIMITER ;
CALL GetUserByHakAkses ('admin');
CALL GetUserByHakAkses ('user');
DROP PROCEDURE GetUserByHakAkses;
-- ngecek
SELECT DISTINCT hak_akses FROM user;
SET @query = CONCAT('SELECT * FROM user WHERE hak_akses = "', 'admin', '"');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;


---- procedure ruangan
DELIMITER $$
CREATE DEFINER=root@localhost PROCEDURE GetRuanganByStatus (IN status_param VARCHAR(15))   
BEGIN
    SELECT * FROM ruangan WHERE status = status_param;
END$$
DELIMITER ;
CALL GetRuanganByStatus('Tersedia');
CALL GetRuanganByStatus('Tidak Tersedia');
DROP PROCEDURE GetRuanganByStatus;

---- procedure peminjaman
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE GetPeminjamanByStatus (IN status_param VARCHAR(10))   
BEGIN
    SELECT * FROM peminjaman WHERE status = status_param;
END$$
DELIMITER ;
CALL GetPeminjamanByStatus ('pending');
CALL GetPeminjamanByStatus ('approved');
CALL GetPeminjamanByStatus ('rejected');
DROP PROCEDURE GetPeminjamanByStatus;

---- procedure review_ruangan
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE GetReviewByRating (IN rating_param INT)   
BEGIN
    SELECT * FROM review_ruangan WHERE rating = rating_param;
END$$
DELIMITER ;
CALL GetReviewByRating ('1');
CALL GetReviewByRating ('2');
CALL GetReviewByRating ('3');
CALL GetReviewByRating ('4');
CALL GetReviewByRating ('5');
DROP PROCEDURE GetReviewByRating;

-- 2. Function
---- function user
DELIMITER $$
CREATE FUNCTION GetUserById (id_user_param INT) 
RETURNS VARCHAR(255) 
DETERMINISTIC
BEGIN
    DECLARE result VARCHAR(255);

    -- Memilih nama ruangan berdasarkan id_ruangan_param dan mengisi hasilnya ke dalam variable result
    SELECT CONCAT('ID User: ', id_user, ', Username: ', username, ', Password: ', password, 
                  ', Tanggal Lahir: ', tanggal_lahir, ', Jenis Kelamin: ', jenis_kelamin, 
                  ', Alamat: ', alamat, ', No Telp: ', no_telp, ', Tanggal Masuk: ', tanggal_masuk, ', Hak Akses: ', hak_akses)  
    INTO result
    FROM user
    WHERE id_user = id_user_param
    LIMIT 1;

    RETURN result;
END$$
DELIMITER ;
SELECT GetUserById(1);  -- Ganti 1 dengan id_ruangan yang ingin dicari

---- function ruangan
DELIMITER $$
CREATE FUNCTION GetRuanganById (id_ruangan_param INT) 
RETURNS VARCHAR(255) 
DETERMINISTIC
BEGIN
    DECLARE result VARCHAR(255);
    
    -- Memilih nama ruangan berdasarkan id_ruangan_param dan mengisi hasilnya ke dalam variable result
    SELECT CONCAT('ID Ruangan: ', id_ruangan, ', Nama Ruangan: ', nama_ruangan, ', Lokasi: ', lokasi, 
                  ', Kapasitas: ', kapasitas, ', Fasilitas: ', fasilitas, ', Status: ', status)  
    INTO result
    FROM ruangan
    WHERE id_ruangan = id_ruangan_param
    LIMIT 1;

    RETURN result;
END$$
DELIMITER ;
SELECT GetRuanganById(1);  -- Ganti 1 dengan id_ruangan yang ingin dicari


---- function peminjaman
DELIMITER $$
CREATE FUNCTION GetPeminjamanById (id_peminjaman_param INT) 
RETURNS VARCHAR(255) 
DETERMINISTIC
BEGIN
    DECLARE result VARCHAR(255);
    
    -- Memilih informasi peminjaman berdasarkan id_peminjaman_param
    SELECT CONCAT('ID Peminjaman: ', id_peminjaman, ', ID Ruangan: ', id_ruangan, 
                  ', ID User: ', id_user, ', Tanggal Pinjam: ', tanggal_pinjam, 
                  ', Tanggal Kembali: ', tanggal_kembali, ', Status: ', status) 
    INTO result
    FROM peminjaman
    WHERE id_peminjaman = id_peminjaman_param
    LIMIT 1;

    RETURN result;
END $$
DELIMITER ;
SELECT GetPeminjamanById(1);  -- Ganti 1 dengan id_peminjaman yang ingin dicari

---- function review_ruangan
DELIMITER $$
CREATE FUNCTION GetReviewById (id_review_param INT) 
RETURNS VARCHAR(255) 
DETERMINISTIC
BEGIN
    DECLARE result VARCHAR(255);

    -- Memilih informasi peminjaman berdasarkan id_peminjaman_param
    SELECT CONCAT('ID Review: ', id_review_ruangan, ', ID Peminjaman: ', id_peminjaman, 
                  ', Rating: ', rating, ', Review: ', review_text, 
                  ', Tanggal Review: ', tanggal_review) 
    INTO result
    FROM review_ruangan
    WHERE id_review_ruangan = id_review_param
    LIMIT 1;

    RETURN result;
END $$
DELIMITER ;
SELECT GetReviewById(1);  -- Ganti 1 dengan id_peminjaman yang ingin dicari

-- 3. Trigger
---- Trigger user
DELIMITER $$

CREATE TRIGGER validate_user
BEFORE INSERT ON user
FOR EACH ROW
BEGIN
    -- Check if the inserted status is valid
    IF NOT (NEW.hak_akses IN ('admin', 'user')) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid hak_akses value. Only "admin" or "user" are allowed.';
    END IF;
END $$

DELIMITER ;

INSERT INTO user (id_user, username, password, tanggal_lahir, jenis_kelamin, alamat, no_telp, tanggal_masuk, hak_akses)
VALUES 
(10, 'pipi', 'pipi123', '2003-06-09', 'P', 'jkt', '08123956789', '2024-10-25 12:00:00', 'super admin');

---- Trigger ruangan
DELIMITER $$

CREATE TRIGGER validate_status
BEFORE INSERT ON ruangan
FOR EACH ROW
BEGIN
    -- Check if the inserted status is valid
    IF NOT (NEW.status IN ('Tersedia', 'Tidak Tersedia')) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid status value. Only "Tersedia" or "Tidak Tersedia" are allowed.';
    END IF;
END $$

DELIMITER ;

INSERT INTO ruangan (id_ruangan, nama_ruangan, lokasi, kapasitas, fasilitas, status)
VALUES (7, 'Ruang Kreatif', 'Lantai 4', 40, 'Proyektor, Meja, Kursi', 'Available');

---- Trigger ruangan
DELIMITER $$
CREATE TRIGGER ruangan_before_insert 
BEFORE INSERT ON ruangan 
FOR EACH ROW 
BEGIN
    IF NEW.kapasitas < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Kapasitas tidak boleh kurang dari 0';
    END IF;
END$$
DELIMITER ;

INSERT INTO ruangan (id_ruangan, nama_ruangan, lokasi, kapasitas, fasilitas, status)
VALUES (7, 'Ruang Kreatif', 'Lantai 4', -20, 'Proyektor, Meja, Kursi', 'Tersedia');

---- Trigger peminjaman
DELIMITER $$

CREATE TRIGGER validate_status_peminjaman
BEFORE INSERT ON peminjaman
FOR EACH ROW
BEGIN
    -- Check if the inserted status is valid
    IF NOT (NEW.status IN ('pending', 'approved', 'rejected')) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid status value. Only "pending" or "approved" or "rejected" are allowed.';
    END IF;
END $$

DELIMITER ;

INSERT INTO peminjaman (id_peminjaman, id_ruangan, id_user, tanggal_pinjam, tanggal_kembali, status)
VALUES
(6, 6, 6, '2024-11-01 10:00:00', '2024-11-02 12:00:00', 'valid');

---- Trigger peminjaman
DELIMITER $$
CREATE TRIGGER peminjaman_before_insert 
BEFORE INSERT ON peminjaman 
FOR EACH ROW 
BEGIN
    IF NEW.tanggal_kembali < NEW.tanggal_pinjam THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Tanggal kembali tidak boleh lebih awal dari tanggal pinjam.';
    END IF;
END$$
DELIMITER ;

INSERT INTO peminjaman (id_peminjaman, id_ruangan, id_user, tanggal_pinjam, tanggal_kembali, status)
VALUES
(6, 6, 6, '2024-11-02 10:00:00', '2024-11-01 12:00:00', 'pending');

---- Trigger review_ruangan
DELIMITER $$

CREATE TRIGGER review_ruangan_before_insert
BEFORE INSERT ON review_ruangan
FOR EACH ROW
BEGIN
    DECLARE tanggal_kembali_peminjaman DATETIME;
    SELECT tanggal_kembali INTO tanggal_kembali_peminjaman
    FROM peminjaman
    WHERE id_peminjaman = NEW.id_peminjaman;
    
    IF NEW.tanggal_review < tanggal_kembali_peminjaman THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Tanggal review tidak boleh lebih awal dari tanggal kembali peminjaman.';
    END IF;
END$$

DELIMITER ;

INSERT INTO review_ruangan (id_review_ruangan, id_peminjaman, rating, review_text, tanggal_review)
VALUES
(6, 5, 8, 'Ruang yang sangat nyaman dan lengkap.', '2024-11-2 12:00:00');

-- 4. Commit
START TRANSACTION;
INSERT INTO user (id_user, username, password, tanggal_lahir, jenis_kelamin, alamat, no_telp, tanggal_masuk, hak_akses)
VALUES 
(6, 'anotheruser', 'user123', '2003-07-08', 'L', 'jkt', '08123457689', '2024-11-25 12:00:00', 'user');
COMMIT;
SELECT*FROM user;

-- 5. Rollback
START TRANSACTION;
INSERT INTO user (id_user, username, password, tanggal_lahir, jenis_kelamin, alamat, no_telp, tanggal_masuk, hak_akses)
VALUES 
(7, 'dreamy', 'dreamy123', '2003-07-09', 'P', 'depok', '08123458689', '2024-11-24 12:00:00', 'admin');
SELECT*FROM user;
ROLLBACK;
SELECT*FROM user;

-- --------------------------------------------------------
-- Optimalisasi Penulisan Query Basis Data
-- --------------------------------------------------------
-- 1. Optimasi query dengan indeks pada username di tabel user
SELECT * FROM user WHERE username = 'fifialfi';
-- 2. Optimasi query dengan indeks pada nama_ruangan di tabel ruangan
SELECT * FROM ruangan WHERE nama_ruangan = 'Ruang Rapat';
-- 3. Optimasi query dengan indeks pada rating di tabel review_ruangan
SELECT * FROM review_ruangan WHERE rating = '5';
SELECT user.username, user.alamat, ruangan.id_ruangan, ruangan.fasilitas
FROM user, ruangan
JOIN user ON user.id_user = peminjaman.id_user
JOIN ruangan ON ruangan.id_ruangan = peminjaman.id_ruangan
JOIN peminjaman ON peminjaman.id_ruangan = ruangan.id_ruangan
JOIN peminjaman ON peminjaman.id_user = user.id_user
WHERE user.jenis_kelamin = 'perempuan' AND ruangan.status = 'rejected';
