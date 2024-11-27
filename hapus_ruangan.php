<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data ruangan berdasarkan ID
    $sql = "DELETE FROM ruangan WHERE id_ruangan = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Ruangan berhasil dihapus');
                window.location.href = 'ruangan.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: Gagal menghapus ruangan');
                window.location.href = 'ruangan.php';
              </script>";
    }

    $conn->close();
} else {
    echo "<script>
            alert('ID ruangan tidak valid');
            window.location.href = 'ruangan.php';
          </script>";
}
?>
