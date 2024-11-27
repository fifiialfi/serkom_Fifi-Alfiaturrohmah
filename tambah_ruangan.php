<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ruangan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Tambah Ruangan</h2>

    <!-- Button Kembali ke Daftar Ruangan -->
    <a href="ruangan.php" class="btn btn-secondary mb-3">Kembali ke Daftar Ruangan</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Proses form saat tombol submit ditekan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_ruangan = $_POST['nama_ruangan'];
        $lokasi = $_POST['lokasi'];
        $kapasitas = $_POST['kapasitas'];
        $fasilitas = $_POST['fasilitas'];
        $status = $_POST['status'];

        // Query untuk memasukkan data ke tabel ruangan
        $sql = "INSERT INTO ruangan (nama_ruangan, lokasi, kapasitas, fasilitas, status) 
                VALUES ('$nama_ruangan', '$lokasi', '$kapasitas', '$fasilitas', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>ruangan berhasil ditambahkan</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>

    <!-- Form Tambah ruangan -->
    <form action="tambah_ruangan.php" method="post">
        <div class="form-group">
            <label for="nama_ruangan">Nama Ruangan:</label>
            <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" required>
        </div>
        <div class="form-group">
            <label for="lokasi">Lokasi:</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
        </div>
        <div class="form-group">
            <label for="kapasitas">Kapasitas:</label>
            <input type="number" class="form-control" id="kapasitas" name="kapasitas" required>
        </div>
        <div class="form-group">
            <label for="fasilitas">Fasilitas:</label>
            <input type="text" class="form-control" id="fasilitas" name="fasilitas" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="Tersedia">Tersedia</option>
                <option value="Tidak Tersedia">Tidak Tersedia</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>

</body>
</html>
