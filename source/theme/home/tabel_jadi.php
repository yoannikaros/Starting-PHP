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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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

<body class="bg-secondary">

    <?php include('../source/navbar/nav.php'); ?>
    <div class="container card p-3 mt-3">
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
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["des"]; ?></td>
                <td><?php echo $row["photos"]; ?></td>
                <td>
                    <a href="update/index.php?id_data=<?php echo $row["id_data"]; ?>">Edit</a>
                    <a href="delete/index.php?id_data=<?php echo $row["id_data"]; ?>">Hapus</a>
                </td>
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
        <a href="tambah"><button class="btn btn-primary w-100 mt-4">Tambah</button></a>
    </div>
</body>

</html>