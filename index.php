<?php
session_start();

// Memeriksa apakah pengguna sudah login atau belum
if (isset($_SESSION['id_user'])) {
    // Jika pengguna sudah login, redirect ke halaman profile.php
    header("Location: home");
    exit();
} else {
    header("Location: auth/login");
}
