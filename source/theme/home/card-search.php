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

        // Memeriksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Memeriksa apakah form telah dikirim
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Mendapatkan kata kunci pencarian dari form
            $searchKeyword = $_POST['searchKeyword'];

            // Membuat query untuk mencari data
            $query = "SELECT id_data, name, des, photos, id_users FROM data WHERE (id_data LIKE '%$searchKeyword%' OR name LIKE '%$searchKeyword%' OR des LIKE '%$searchKeyword%' OR photos LIKE '%$searchKeyword%' OR id_users LIKE '%$searchKeyword%') AND id_users = $id_user";


            // Menjalankan query
            $result = $conn->query($query);

            // Memeriksa apakah query mengembalikan hasil
            if ($result->num_rows > 0) {
                // Menampilkan data
                while ($row = $result->fetch_assoc()) {
        ?>
            <!-- Card -->
            <div class="col-md-4 mt-2">
                <div class="card p-3 rounded">
                    <div class="row">
                        <div class="col-md-4">
                            <img style="width: 100px;" src="home/<?php echo $row["photos"]; ?>"
                                class="card-image rounded" alt="Gambar 1">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row["name"]; ?></h5>
                                <p class="card-text">Deskripsi Card 1</p>
                                <a href="update/index.php?id_data=<?php echo $row["id_data"]; ?>"><button
                                        class="btn btn-primary">Edit</button></a>
                                <a href="delete/index.php?id_data=<?php echo $row["id_data"]; ?>"><button
                                        class="btn btn-danger">Delete</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card -->

            <?php
                }
            } else {
                echo "Tidak ditemukan hasil.";
            }

            // Menutup koneksi database
            $conn->close();
        }
        ?>
        </div>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>