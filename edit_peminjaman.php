<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Edit Peminjaman</h2>
    
    <!-- Tombol Kembali ke Daftar Peminjaman -->
    <a href="peminjaman.php" class="btn btn-secondary mb-3">Kembali ke Daftar Peminjaman</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Cek apakah parameter id_peminjaman ada
    if (isset($_GET['id_peminjaman'])) {
        $id_peminjaman = $_GET['id_peminjaman'];

        // Query untuk mendapatkan data peminjaman berdasarkan id_peminjaman
        $sql = "SELECT * FROM peminjaman WHERE id_peminjaman = $id_peminjaman";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Ambil data peminjaman
            $row = $result->fetch_assoc();
            $id_ruangan = $row['id_ruangan'];
            $id_user = $row['id_user'];
            $tanggal_pinjam = $row['tanggal_pinjam'];
            $tanggal_kembali = $row['tanggal_kembali'];
            $status = $row['status'];
        } else {
            echo "<div class='alert alert-danger'>Peminjaman tidak ditemukan.</div>";
            exit();
        }
    } else {
        echo "<div class='alert alert-danger'>ID Peminjaman tidak ditemukan.</div>";
        exit();
    }

    // Proses update data saat form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_ruangan = $_POST['id_ruangan'];
        $id_user = $_POST['id_user'];
        $tanggal_pinjam = $_POST['tanggal_pinjam'];
        $tanggal_kembali = $_POST['tanggal_kembali'];
        $status = $_POST['status'];

        // Query untuk update data peminjaman
        $sql = "UPDATE peminjaman SET id_ruangan='$id_ruangan', id_user='$id_user', tanggal_pinjam='$tanggal_pinjam', tanggal_kembali='$tanggal_kembali', status='$status' WHERE id_peminjaman=$id_peminjaman";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Peminjaman berhasil diperbarui</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>

    <!-- Form Edit Peminjaman -->
    <form action="" method="post">
        <div class="form-group">
            <label for="id_ruangan">ID Ruangan:</label>
            <select class="form-control" id="id_ruangan" name="id_ruangan" required>
                <!-- Ambil data ruangan dari database -->
                <?php
                 include 'koneksi.php'; // pastikan koneksi sudah ada di sini
                 $queryRuangan = "SELECT id_ruangan, nama_ruangan FROM ruangan";
                 $resultRuangan = $conn->query($queryRuangan);
                 while ($rowRuangan = $resultRuangan->fetch_assoc()) {
                     echo "<option value='" . $rowRuangan['id_ruangan'] . "'>" . $rowRuangan['id_ruangan'] . "</option>";
                 }
                 ?>
             </select>
        </div>
        <div class="form-group">
            <label for="id_user">ID User:</label>
            <select class="form-control" id="id_user" name="id_user" required>
                <!-- Ambil data id_user dari database -->
                <?php
                $queryUser = "SELECT id_user, username FROM user";
                $resultUser = $conn->query($queryUser);
                while ($rowUser = $resultUser->fetch_assoc()) {
                    echo "<option value='" . $rowUser['id_user'] . "'>" . $rowUser['id_user'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal_pinjam">Tanggal dan Waktu Pinjam:</label>
            <input type="datetime-local" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="<?php echo date('Y-m-d\TH:i', strtotime($tanggal_pinjam)); ?>" required>
        </div>
        <div class="form-group">
            <label for="tanggal_kembali">Tanggal dan Waktu Kembali:</label>
            <input type="datetime-local" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="<?php echo date('Y-m-d\TH:i', strtotime($tanggal_kembali)); ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>
