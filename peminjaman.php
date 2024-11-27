<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 20px;
        }
        h2 {
            color: #333;
        }
        .btn-primary {
            background-color: #007bff; /* Biru sesuai contoh */
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Biru gelap saat hover */
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .btn-edit {
            background-color: #ffc107;
            color: #fff;
            border: none;
        }
        .btn-edit:hover {
            background-color: #e0a800;
        }
        .btn-hapus {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
        .btn-hapus:hover {
            background-color: #c82333;
        }
        .table th {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Daftar Peminjaman</h2>

    <!-- Tombol Kembali ke Beranda dan Tambah Transaksi -->
    <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Beranda</a>
    <a href="tambah_peminjaman.php" class="btn btn-primary mb-3">Tambah Peminjaman</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>ID Ruangan</th>
                <th>ID User</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Koneksi ke database
            include 'koneksi.php';

            // Query untuk mendapatkan data transaksi
            $sql = "SELECT * FROM peminjaman";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id_peminjaman']}</td>
                            <td>{$row['id_ruangan']}</td>
                            <td>{$row['id_user']}</td>
                            <td>{$row['tanggal_pinjam']}</td>
                            <td>{$row['tanggal_kembali']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <a href='edit_peminjaman.php?id_peminjaman={$row['id_peminjaman']}' class='btn btn-edit btn-sm'>Edit</a>
                                <a href='hapus_peminjaman.php?id_peminjaman={$row['id_peminjaman']}' onclick=\"return confirm('Yakin ingin menghapus data ini?')\" class='btn btn-hapus btn-sm'>Hapus</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>Tidak ada data peminjaman</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
