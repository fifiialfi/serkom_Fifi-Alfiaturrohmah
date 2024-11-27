<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="mt-4">Edit Review</h2>

    <!-- Tombol Kembali ke Review Ruangan -->
    <a href="review_ruangan.php" class="btn btn-secondary mb-3">Kembali ke Review Ruangan</a>

    <?php
    // Include koneksi database
    include 'koneksi.php';

    $id_peminjaman = $rating = $review_text = $tanggal_review = "";

    // Proses update data saat form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_peminjaman = $_POST['id_peminjaman'];
        $rating = $_POST['rating'];
        $review_text = $_POST['review_text'];
        $tanggal_review = $_POST['tanggal_review'];

        // Query untuk memasukkan data Review ke tabel
        $sql = "INSERT INTO review_ruangan (id_peminjaman, rating, review_text, tanggal_review) 
                VALUES ('$id_peminjaman', '$rating', '$review_text', '$tanggal_review')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>Review berhasil diperbarui</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }

        $conn->close();
    }
    ?>

    <!-- Form Edit Review Ruangan -->
    <form action="" method="post">
        <div class="form-group">
            <label for="id_peminjaman">ID Peminjaman:</label>
            <input type="text" class="form-control" id="id_peminjaman" name="id_peminjaman" value="<?php echo $id_peminjaman; ?>" required>
        </div>
        <div class="form-group">
            <label for="rating">Rating:</label>
            <select class="form-control" id="rating" name="rating" value="<?php echo $rating; ?>"required>
                <option value='1' <?php if($rating == "1") echo "selected"; ?>>1</option>
                <option value='2' <?php if($rating == "2") echo "selected"; ?>>2</option>
                <option value='3' <?php if($rating == "3") echo "selected"; ?>>3</option>
                <option value='4' <?php if($rating == "4") echo "selected"; ?>>4</option>
                <option value='5' <?php if($rating == "5") echo "selected"; ?>>5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="review_text">Review:</label>
            <input type="text" class="form-control" id="review_text" name="review_text" value="<?php echo $review_text; ?>" required>
        </div>
        <div class="form-group">
            <label for="tanggal_review">Tanggal Review:</label>
            <input type="datetime-local" class="form-control" id="tanggal_review" name="tanggal_review" value="<?php echo $tanggal_review; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>
