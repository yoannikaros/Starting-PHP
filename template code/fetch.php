<?php

// Koneksi ke database
require_once '../config/index.php';
$conn = mysqli_connect($host, $username, $password_db, $database);

// Query Tampil Semua data
$sql = "SELECT * FROM TABEL_MU";

// Eksekusi query
$result = mysqli_query($conn, $sql);

// Tampilkan hasil query
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>


        <!-- Memanggil -->
        -- <?php echo $row["panggil"]; ?>
        -- <?php echo "Rp " . number_format($row["anggaran"], 0, ",", "."); ?>


<?php
    }
} else {
    echo "Tidak ada data yang absen hari ini";
}

// Tutup koneksi
mysqli_close($conn);

?>