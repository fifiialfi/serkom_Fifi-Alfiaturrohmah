<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4 bg-primary-subtle">Tambah User</h2>

    <!-- Button Kembali ke Daftar User -->
    <a href="user.php" class="btn btn-secondary mb-3">Kembali ke Daftar User</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Proses form saat tombol submit ditekan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $tanggal_masuk = $_POST['tanggal_masuk'];
        $hak_akses = $_POST['hak_akses'];

        // Query untuk memasukkan data user ke tabel
        $sql = "INSERT INTO user (username, password, tanggal_lahir, jenis_kelamin, alamat, no_telp, tanggal_masuk, hak_akses) 
                VALUES ('$username', '$password', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$no_telp', '$tanggal_masuk', '$hak_akses')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>User berhasil ditambahkan</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>

    <!-- Form Tambah User -->
    <form action="tambah_user.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="datetime-local" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="no_telp">No Telepon:</label>
            <input type="number" class="form-control" id="no_telp" name="no_telp" required>
        </div>  
        <div class="form-group">
            <label for="tanggal_masuk">Tanggal Masuk:</label>
            <input type="datetime-local" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo $row['tanggal_masuk']; ?>" required>
        </div>
        <div class="form-group">
            <label for="hak_akses">Hak Akses:</label>
            <select class="form-control" id="hak_akses" name="hak_akses" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>

    </form>
</div>

</body>
</html>
