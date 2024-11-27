<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Review</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Tambah Review</h2>

    <!-- Tombol Kembali ke Daftar Review -->
    <a href="review_ruangan.php" class="btn btn-secondary mb-3">Kembali ke Review Ruangan</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    // Proses form saat tombol submit ditekan
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_peminjaman = $_POST['id_peminjaman'];
        $rating = $_POST['rating'];
        $review_text = $_POST['review_text'];
        $tanggal_review = $_POST['tanggal_review'];

        // Mengubah format tanggal_review menjadi format yang sesuai dengan MySQL
        $tanggal_review = str_replace("T", " ", $tanggal_review);

        // Check if id_peminjaman exists in peminjaman table
        $check_sql = "SELECT COUNT(*) FROM peminjaman WHERE id_peminjaman = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("i", $id_peminjaman);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();

        // If ID exists in the peminjaman table, proceed with insert
        if ($count > 0) {
            // Prepare and execute insert query
            $stmt = $conn->prepare("INSERT INTO review_ruangan (id_peminjaman, rating, review_text, tanggal_review) 
                                    VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $id_peminjaman, $rating, $review_text, $tanggal_review);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Review berhasil ditambahkan</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }

            // Close statement
            $stmt->close();
        } else {
            // If ID doesn't exist, display an error
            echo "<div class='alert alert-danger'>ID Peminjaman tidak ditemukan di database.</div>";
        }

        // Close database connection
        $conn->close();
    }
    ?>

    <!-- Form Tambah Review -->
    <form action="tambah_review_ruangan.php" method="post">
        <div class="form-group">
            <label for="id_peminjaman">ID Peminjaman:</label>
            <input type="text" class="form-control" id="id_peminjaman" name="id_peminjaman" required>
        </div>

        <div class="form-group">
            <label for="rating">Rating:</label>
            <select class="form-control" id="rating" name="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group">
            <label for="review_text">Review:</label>
            <input type="text" class="form-control" id="review_text" name="review_text" required>
        </div>

        <div class="form-group">
            <label for="tanggal_review">Tanggal Review:</label>
            <input type="datetime-local" class="form-control" id="tanggal_review" name="tanggal_review" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>

</body>
</html>
