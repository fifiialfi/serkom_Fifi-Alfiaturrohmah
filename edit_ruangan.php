<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ruangan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Edit Ruangan</h2>

    <!-- Button Kembali ke Daftar Ruangan -->
    <a href="ruangan.php" class="btn btn-secondary mb-3">Kembali ke Daftar Ruangan</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Cek apakah parameter id_ruangan ada
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Query untuk mendapatkan data ruangan berdasarkan id_ruangan
        $sql = "SELECT * FROM ruangan WHERE id_ruangan = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Ambil data ruangan
            $row = $result->fetch_assoc();
            $nama_ruangan = $row['nama_ruangan'];
            $lokasi = $row['lokasi'];
            $kapasitas = $row['kapasitas'];
            $fasilitas = $row['fasilitas'];
            $status = $row['status'];
        } else {
            echo "<div class='alert alert-danger'>Ruangan tidak ditemukan.</div>";
            exit();
        }
    } else {
        echo "<div class='alert alert-danger'>ID ruangan tidak ditemukan.</div>";
        exit();
    }

    // Proses update data saat form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_ruangan = $_POST['nama_ruangan'];
        $lokasi = $_POST['lokasi'];
        $kapasitas = $_POST['kapasitas'];
        $fasilitas = $_POST['fasilitas'];
        $status = $_POST['status'];

        // Validasi kapasitas
        if (strtotime($kapasitas) > 0) {
            echo "<div class='alert alert-danger'>Error: Kapasitas tidak boleh kurang dari 0.</div>";
        } else {
            // Query untuk update data ruangan
            $sql = "UPDATE ruangan SET nama_ruangan='$nama_ruangan', lokasi='$lokasi', kapasitas='$kapasitas', fasilitas='$fasilitas', status='$status' WHERE id_ruangan=$id";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Ruangan berhasil diperbarui</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        }

        $conn->close();
    }
    ?>

    <!-- Form Edit Ruangan -->
    <form action="" method="post">
        <div class="form-group">
            <label for="nama_ruangan">Nama Ruangan Buku:</label>
            <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" value="<?php echo $nama_ruangan; ?>" required>
        </div>
        <div class="form-group">
            <label for="lokasi">Lokasi:</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php echo $lokasi; ?>" required>
        </div>
        <div class="form-group">
            <label for="kapasitas">Kapasitas:</label>
            <input type="text" class="form-control" id="kapasitas" name="kapasitas" value="<?php echo $kapasitas; ?>" required>
        </div>
        <div class="form-group">
            <label for="fasilitas">Fasilitas :</label>
            <input type="text" class="form-control" id="fasilitas" name="fasilitas" value="<?php echo $fasilitas; ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Tersedia" <?php if ($status == "Tersedia") echo "selected"; ?>>Tersedia</option>
                <option value="Tidak Tersedia" <?php if ($status == "Tidak Tersedia") echo "selected"; ?>>Tidak Tersedia</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>
