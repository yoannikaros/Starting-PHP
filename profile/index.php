<?php
session_start();

// Memeriksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_user'])) {
    // Jika pengguna belum login, redirect ke halaman login
    header("Location: ../auth/login");
    exit();
}

// Mendapatkan $id_user dari session
$id_user = $_SESSION['id_user'];

// Proses logout jika tombol Logout ditekan
if (isset($_POST['logout'])) {
    // Menghapus session id_user
    session_unset();
    session_destroy();

    // Redirect ke halaman login.php setelah logout berhasil
    header("Location: ../auth/login");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
</head>

<body>
    <?php

    // Koneksi ke database
    require_once '../config/index.php';
    $conn = mysqli_connect($host, $username, $password_db, $database);

    // Query database
    $sql = "SELECT * FROM users where id_users = '$id_user'";

    // Eksekusi query
    $result = mysqli_query($conn, $sql);

    // Tampilkan hasil query
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
            <h5>Nama</h5>
            <h5><?php echo $row["name"]; ?></h5>
            <a href="edit/index.php"><button>Edit</button></a>

    <?php
        }
    } else {
        echo "Tidak ada data yang absen hari ini";
    }

    // Tutup koneksi
    mysqli_close($conn);

    ?>

    <!-- Tombol Logout -->
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>

</html>