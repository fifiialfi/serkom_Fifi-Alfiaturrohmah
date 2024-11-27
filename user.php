<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script>
        function confirmDelete(id) {
            if (confirm("Yakin ingin menghapus data ini?")) {
                window.location.href = "hapus_user.php?id=" + id;
            }
        }
    </script>
    <style>
        .table-container {
            margin-top: 20px;
        }
        .btn-primary, .btn-secondary {
            margin-bottom: 10px;
        }
        .table th, .table td {
            text-align: center;
        }
        .btn-warning, .btn-danger {
            width: 70px;
        }
        .btn-danger {
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mt-4">Daftar User</h2>

    <!-- Tombol Kembali ke Beranda -->
    <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Beranda</a>
    <!-- Tombol Tambah User -->
    <a href="tambah_user.php" class="btn btn-primary mb-3">Tambah User</a>

    <div class="table-container">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Tanggal Masuk</th>
                    <th>Hak Akses</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';
                $sql = "SELECT * FROM user";
                $result = $conn->query($sql);

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_user']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['hased_password']}</td>
                                <td>{$row['tanggal_lahir']}</td>
                                <td>{$row['jenis_kelamin']}</td>
                                <td>{$row['alamat']}</td>
                                <td>{$row['no_telp']}</td>
                                <td>{$row['tanggal_masuk']}</td>
                                <td>{$row['hak_akses']}</td>
                                <td>
                                    <a href='edit_user.php?id={$row['id_user']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <button onclick='confirmDelete({$row['id_user']})' class='btn btn-danger btn-sm'>Hapus</button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
