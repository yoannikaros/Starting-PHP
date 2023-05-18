<?php
// Koneksi ke database
require_once '../../config/index.php';
$koneksi = new mysqli($host, $username, $password_db, $database);

// Memulai session
session_start();

// Memeriksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['id_user'])) {
    // Jika pengguna belum login, redirect ke halaman login
    header("Location: ../../auth/login");
    exit();
}

// Mendapatkan $id_user dari session
$id_user = $_SESSION['id_user'];

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Cek apakah formulir telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai-nilai dari formulir
    $name = $_POST["name"];
    $des = $_POST["des"];
    $photos = $_POST["photos"];
    $id_users = $_POST["id_users"];

    // Membuat query untuk menambahkan data ke tabel
    $sql = "INSERT INTO data (name, des, photos, id_users) VALUES ('$name', '$des', '$photos', '$id_users')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Terjadi kesalahan: " . $koneksi->error;
    }

    // Menutup koneksi
    $koneksi->close();
}
?>

<!-- Formulir HTML -->
<!DOCTYPE html>
<html>

<head>
    <title>Formulir Tambah Data</title>
</head>

<body>
    <h2>Formulir Tambah Data</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="des">Deskripsi:</label>
        <textarea name="des" id="des" required></textarea><br>

        <label for="photos">Foto:</label>
        <input type="text" name="photos" id="photos" required><br>

        <input hidden type="text" name="id_users" value="<?php echo $id_user ?>" id="id_users" required><br>

        <input type="submit" value="Tambah Data">
    </form>
</body>

</html>