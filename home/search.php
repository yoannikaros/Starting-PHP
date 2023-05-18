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

<!-- Tampilan tabel HTML -->
<!DOCTYPE html>
<html>

<head>
    <title>Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <?php include('../source/navbar/nav.php'); ?>
    <h2>Data</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Action</th>
        </tr>
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
                    <tr>
                        <th><?php echo $row["name"]; ?></th>
                        <th><?php echo $row["des"]; ?></th>
                        <th><?php echo $row["photos"]; ?></th>
                        <th>
                            <a href="update/index.php?id_data=<?php echo $row["id_data"]; ?>">Edit</a>
                            <a href="delete/index.php?id_data=<?php echo $row["id_data"]; ?>">Hapus</a>
                        </th>
                    </tr>
        <?php
                }
            } else {
                echo "Tidak ditemukan hasil.";
            }

            // Menutup koneksi database
            $conn->close();
        }
        ?>
    </table>
    <a href="tambah">Text</a>
    <a href="tambah/add.php">Foto</a>
</body>

</html>