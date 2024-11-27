<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data user berdasarkan ID
    $sql = "DELETE FROM user WHERE id_user = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('User berhasil dihapus');
                window.location.href = 'user.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: Gagal menghapus user');
                window.location.href = 'user.php';
              </script>";
    }

    $conn->close();
} else {
    echo "<script>
            alert('ID user tidak valid');
            window.location.href = 'user.php';
          </script>";
}
?>
