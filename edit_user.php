<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Edit User</h2>

    <!-- Button Kembali ke Daftar User -->
    <a href="user.php" class="btn btn-secondary mb-3">Kembali ke Daftar User</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Cek apakah parameter id_user ada
    if (isset($_GET['id'])) {
        $id_user = $_GET['id'];

        // Query untuk mendapatkan data user berdasarkan id_user
        $sql = "SELECT * FROM user WHERE id_user = $id_user";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Ambil data user
            $row = $result->fetch_assoc();
        } else {
            echo "<div class='alert alert-danger'>User tidak ditemukan.</div>";
            exit();
        }
    } else {
        echo "<div class='alert alert-danger'>ID User tidak ditemukan.</div>";
        exit();
    }

    // Proses form saat tombol update ditekan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $no_telp = $_POST['no_telp'];
        $tanggal_masuk = $_POST['tanggal_masuk'];
        $hak_akses = $_POST['hak_akses'];

        // Validasi tanggal
        if (strtotime($tanggal_masuk) < strtotime($tanggal_lahir)) {
            echo "<div class='alert alert-danger'>Error: Tanggal masuk tidak boleh lebih awal dari tanggal lahir.</div>";
        } else {
            // Jika password diubah, tambahkan di query; jika tidak, lewati
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE user SET 
                username='$username', 
                password='$hashed_password', 
                tanggal_lahir='$tanggal_lahir', 
                jenis_kelamin='$jenis_kelamin', 
                alamat='$alamat', 
                no_telp='$no_telp', 
                tanggal_masuk='$tanggal_masuk', 
                hak_akses='$hak_akses' 
                WHERE id_user=$id_user";
            } else {
                $sql = "UPDATE user SET 
                username='$username', 
                tanggal_lahir='$tanggal_lahir', 
                jenis_kelamin='$jenis_kelamin', 
                alamat='$alamat', 
                no_telp='$no_telp', 
                tanggal_masuk='$tanggal_masuk', 
                hak_akses='$hak_akses' 
                WHERE id_user=$id_user";
            }

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>User berhasil diperbarui</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }
    }
    ?>    

    <!-- Form Edit User -->
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Nama User:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password (Kosongkan jika tidak ingin diubah):</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $row['tanggal_lahir']; ?>" required>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="L" <?php echo ($row['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
                <option value="P" <?php echo ($row['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required>
        </div>
        <div class="form-group">
            <label for="no_telp">No Telepon:</label>
            <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo $row['no_telp']; ?>" required>
        </div>
        <div class="form-group">
            <label for="tanggal_masuk">Tanggal Masuk:</label>
            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo $row['tanggal_masuk']; ?>" required>
        </div>
        <div class="form-group">
            <label for="hak_akses">Hak Akses:</label>
            <select class="form-control" id="hak_akses" name="hak_akses" required>
                <option value="admin" <?php echo ($row['hak_akses'] == "admin") ? "selected" : ""; ?>>Admin</option>
                <option value="user" <?php echo ($row['hak_akses'] == "user") ? "selected" : ""; ?>>User</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

</div>

</body>
</html>