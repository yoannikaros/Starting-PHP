<?php
session_start();

// Memeriksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_user'])) {
    // Jika pengguna belum login, redirect ke halaman login.php
    header("Location: ../auth/login");
    exit();
}

// Mendapatkan $id_user dari session
$id_user = $_SESSION['id_user'];
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-image img {
            border-radius: 10%;
            max-width: 10px;
            /* Mengatur lebar maksimum gambar */
            max-height: 10px;
            /* Mengatur tinggi maksimum gambar */
        }
    </style>
</head>

<body class="bg bg-secondary">
    <?php include('../source/navbar/nav.php'); ?>
    <div class="container">
        <div class="row">
            <?php

            // Koneksi ke database
            require_once '../config/index.php';
            $conn = mysqli_connect($host, $username, $password_db, $database);

            // Query Tampil Semua data
            $sql = "SELECT * FROM data where id_users = $id_user";

            // Eksekusi query
            $result = mysqli_query($conn, $sql);

            // Tampilkan hasil query
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <!-- Card -->
                    <div class="col-md-4 mt-2">
                        <div class="card p-3 rounded">
                            <div class="row">
                                <div class="col-md-4">
                                    <img style="width: 100px;" src="home/<?php echo $row["photos"]; ?>" class="card-image rounded" alt="Gambar 1">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row["name"]; ?></h5>
                                        <p class="card-text">Deskripsi Card 1</p>
                                        <a href="update/index.php?id_data=<?php echo $row["id_data"]; ?>"><button class="btn btn-primary">Edit</button></a>
                                        <a href="delete/index.php?id_data=<?php echo $row["id_data"]; ?>"><button class="btn btn-danger">Delete</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->

            <?php
                }
            } else {
                echo "Tidak ada data hari ini";
            }

            // Tutup koneksi
            mysqli_close($conn);

            ?>

        </div>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>