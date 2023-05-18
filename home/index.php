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

        // Query Tampil Semua data
        $sql = "SELECT * FROM data where id_users = $id_user";

        // Eksekusi query
        $result = mysqli_query($conn, $sql);

        // Tampilkan hasil query
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
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
            echo "Tidak ada data yang absen hari ini";
        }

        // Tutup koneksi
        mysqli_close($conn);

        ?>
    </table>
    <a href="tambah">Text</a>
    <a href="tambah/add.php">Foto</a>
</body>

</html>