<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Tambah Peminjaman</h2>
    
    <!-- Tombol Kembali ke Daftar Peminjaman -->
    <a href="peminjaman.php" class="btn btn-secondary mb-3">Kembali ke Daftar Peminjaman</a>

    <?php
    include 'koneksi.php'; 

    $peminjamanBerhasil = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_ruangan = $_POST['id_ruangan'];
        $id_user = $_POST['id_user'];
        $tanggal_pinjam = $_POST['tanggal_pinjam'];
        $tanggal_kembali = $_POST['tanggal_kembali'];
        $status = $_POST['status'];

        // Validasi ID Ruangan
        $checkRuangan = $conn->query("SELECT * FROM ruangan WHERE id_ruangan = '$id_ruangan'");
        if ($checkRuangan->num_rows == 0) {
            echo "<div class='alert alert-danger'>ID Ruangan tidak valid.</div>";
            return;
        }

        // Validasi ID User
        $checkUser = $conn->query("SELECT * FROM user WHERE id_user = '$id_user'");
        if ($checkUser->num_rows == 0) {
            echo "<div class='alert alert-danger'>ID User tidak valid.</div>";
            return;
        }

        // Query untuk memasukkan data peminjaman
        $sql = "INSERT INTO peminjaman (id_ruangan, id_user, tanggal_pinjam, tanggal_kembali, status) 
                VALUES ('$id_ruangan', '$id_user', '$tanggal_pinjam', '$tanggal_kembali', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Peminjaman berhasil ditambahkan.</div>";
            $peminjamanBerhasil = true;
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat menambahkan peminjaman: " . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>

    <!-- Form Tambah Peminjaman, tampilkan hanya jika Peminjaman belum berhasil -->
    <?php if (!$peminjamanBerhasil): ?>
    <form action="tambah_peminjaman.php" method="post">
        <div class="form-group">
            <label for="id_ruangan">ID Ruangan:</label>
            <select class="form-control" id="id_ruangan" name="id_ruangan" required>
                <?php
                $queryRuangan = "SELECT DISTINCT id_ruangan, nama_ruangan FROM ruangan";
                $resultRuangan = $conn->query($queryRuangan);
                while ($rowRuangan = $resultRuangan->fetch_assoc()) {
                    echo "<option value='" . $rowRuangan['id_ruangan'] . "'>" . $rowRuangan['nama_ruangan'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_user">ID User:</label>
            <select class="form-control" id="id_user" name="id_user" required>
                <?php
                $queryUser = "SELECT DISTINCT id_user, username FROM user";
                $resultUser = $conn->query($queryUser);
                while ($rowUser = $resultUser->fetch_assoc()) {
                    echo "<option value='" . $rowUser['id_user'] . "'>" . $rowUser['username'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal_pinjam">Tanggal dan Waktu Pinjam:</label>
            <input type="datetime-local" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
        </div>

        <div class="form-group">
            <label for="tanggal_kembali">Tanggal dan Waktu Kembali:</label>
            <input type="datetime-local" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
    <?php endif; ?>
</div>

</body>
</html>
