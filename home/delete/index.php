<?php
// Membuat koneksi ke database
require_once '../../config/index.php';
$koneksi = new mysqli($host, $username, $password_db, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

// Mendapatkan ID data yang akan dihapus
$id_data = $_GET['id_data'];

// Membuat query DELETE
$query = "DELETE FROM data WHERE id_data = ?";

// Mempersiapkan statement
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id_data); // Mengikat parameter

// Menjalankan statement
if ($stmt->execute()) {
    echo "Data berhasil dihapus.";
    header("Location: ../");
} else {
    echo "Gagal menghapus data: " . $stmt->error;
    header("Location: ../");
}

// Menutup statement dan koneksi
$stmt->close();
$koneksi->close();
