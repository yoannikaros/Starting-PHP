<?php
// Memeriksa apakah pengguna sudah login atau belum
session_start();

if (!isset($_SESSION['id_user'])) {
    // Jika pengguna belum login, redirect ke halaman login.php
    header("Location: ../auth/login");
    exit();
}

// Mendapatkan $id_user dari session
$id_user = $_SESSION['id_user'];

require_once '../config/index.php';
$koneksi = mysqli_connect($host, $username, $password_db, $database);

// Periksa apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mendapatkan data status dari tabel pengguna
$query = "SELECT status FROM users WHERE id_users = '$id_user'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $status = $row['status'];

    // Periksa jika status adalah bukan 'admin'
    if ($status != 'admin') {
        // Jika bukan admin, redirect ke halaman lain
        header("Location: ../auth/login");
        exit();
    }
} else {
    // Jika data pengguna tidak ditemukan, redirect ke halaman lain
    header("Location: ../auth/login");
    exit();
}

// Tutup koneksi
mysqli_close($koneksi);
?>

<h1>Welcome to admin</h1>