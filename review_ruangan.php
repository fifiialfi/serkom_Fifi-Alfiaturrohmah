<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Review Ruangan</h2>
    
    <!-- Tombol Kembali ke Beranda -->
    <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Beranda</a>
    <a href="tambah_review_ruangan.php" class="btn btn-primary mb-3">Tambah Review</a>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID Peminjaman</th>
                <th>Tanggal Review</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include koneksi database
            include 'koneksi.php';

            // Query untuk mendapatkan data review_ruangan
            $sql = "SELECT * FROM review_ruangan";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_peminjaman"] . "</td>";
                    echo "<td>" . $row["tanggal_review"] . "</td>";
                    echo "<td>" . $row["rating"] . "</td>";
                    echo "<td>" . $row["review_text"] . "</td>";
                    echo "<td>
                            <a href='edit_review_ruangan.php?id_review_ruangan=" . $row["id_review_ruangan"] . "' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='hapus_review_ruangan.php?id_review_ruangan=" . $row["id_review_ruangan"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Tidak ada data review</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
