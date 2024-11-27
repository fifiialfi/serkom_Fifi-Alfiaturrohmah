<?php
include 'koneksi.php';

if (isset($_GET['id_review_ruangan']) && is_numeric($_GET['id_review_ruangan'])) {
    $id_review_ruangan = (int) $_GET['id_review_ruangan'];

    // Ambil id_peminjaman terkait dari review_ruangan
    $stmt = $conn->prepare("SELECT id_peminjaman FROM review_ruangan WHERE id_review_ruangan = ?");
    $stmt->bind_param("i", $id_review_ruangan);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $id_peminjaman = $row['id_peminjaman'];

        // Hapus data terkait di tabel peminjaman
        $stmt = $conn->prepare("DELETE FROM peminjaman WHERE id_peminjaman = ?");
        $stmt->bind_param("i", $id_peminjaman);
        $stmt->execute();
    }

    // Hapus data di tabel review_ruangan
    $stmt = $conn->prepare("DELETE FROM review_ruangan WHERE id_review_ruangan = ?");
    $stmt->bind_param("i", $id_review_ruangan);

    if ($stmt->execute()) {
        echo "<script>
                alert('Review berhasil dihapus');
                window.location.href = 'review_ruangan.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: Gagal menghapus review');
                window.location.href = 'review_ruangan.php';
              </script>";
    }

    $stmt->close();
} else {
    echo "<script>
            alert('ID review ruangan tidak valid');
            window.location.href = 'review_ruangan.php';
          </script>";
}
?>
