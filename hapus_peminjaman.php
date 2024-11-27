<?php
// Include koneksi database
include 'koneksi.php';

// Cek apakah parameter id_peminjaman ada
if (isset($_GET['id_peminjaman'])) {
    $id_peminjaman = $_GET['id_peminjaman'];

    // Query untuk menghapus peminjaman berdasarkan id_peminjaman
    $sql = "DELETE FROM peminjaman WHERE id_peminjaman = $id_peminjaman";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Peminjaman berhasil dihapus'); window.location.href='peminjaman.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus peminjaman: " . $conn->error . "'); window.location.href='peminjaman.php';</script>";
    }
} else {
    echo "<script>alert('ID Peminjaman tidak ditemukan'); window.location.href='peminjaman.php';</script>";
}

$conn->close();
?>
