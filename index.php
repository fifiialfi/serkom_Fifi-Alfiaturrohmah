<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Ruangan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #432E54;
            color: #ffffff;
            font-weight: bold ;
            padding: 15px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .sidebar {
            background-color: #4B4376;
            padding: 15px;
            border-radius: 8px;
            color: #fff;
        }
        .sidebar .btn-menu {
            background-color: #AE445A;
            color: #fff;
            text-decoration: none;
            padding: 12px;
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 10px;
            display: block;
            text-align: center;
        }
        .sidebar .btn-menu:hover {
            background-color: #E8BCB9;
            color: #ffffff;
        }
        .nav-top {
            text-align: right;
            padding: 10px 0;
        }
        .nav-top a {
            margin: 0 10px;
            color: #2980b9;
            text-decoration: none;
            font-weight: bold;
        }
        .nav-top a:hover {
            color: #e74c3c;
        }
        .content {
            padding: 20px;
            background-color: #ecf0f1;
            border-radius: 8px;
            border: 1px solid #dfe6e9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .content h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        .content h4 {
            text-align: center;
            font-weight: normal;
            color: #34495e;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #2c3e50;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>SISTEM MANAJEMEN RUANGAN</h1>
    </div>

    <div class="row">
        <div class="col-md-3 sidebar">
            <a href="user.php" class="btn-menu">DAFTAR USER</a>
            <a href="ruangan.php" class="btn-menu">DAFTAR RUANGAN</a>
            <a href="peminjaman.php" class="btn-menu">DAFTAR PEMINJAMAN</a>
            <a href="review_ruangan.php" class="btn-menu">REVIEW RUANGAN</a>
        </div>
        
        <div class="col-md-9">
            <div class="content">
                <h2>SELAMAT DATANG DI SISTEM PEMINJAMAN RUANGAN KAMPUS</h2>
                <h4>RAYAKAN MOMEN BELAJAR ANDA</h4>
                <p>Selamat datang di platform peminjaman ruangan kampus! 
                    Di sini, Anda dapat dengan mudah menemukan dan meminjam ruangan untuk berbagai kegiatan akademis dan non-akademis. 
                    Setiap ruangan dirancang untuk memberikan kenyamanan dan fasilitas yang mendukung proses belajar-mengajar.</p>
                <p>Jadwalkan kegiatan Anda dan manfaatkan fasilitas yang tersedia untuk menciptakan pengalaman belajar yang lebih baik. 
                    Mari bersama menciptakan suasana kampus yang produktif dan inspiratif!</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
