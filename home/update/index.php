<?php
// Mulai sesi
session_start();

// Periksa apakah pengguna sudah masuk atau belum
if (!isset($_SESSION['id_user'])) {
    echo "Silakan masuk terlebih dahulu.";
    exit;
}

// Mendapatkan ID pengguna dari sesi
$id_user = $_SESSION['id_user'];

// Koneksi ke database

require_once '../../config/index.php';
$koneksi = new mysqli($host, $username, $password_db, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Cek apakah formulir telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai-nilai dari formulir
    $id_data = $_POST["id_data"];
    $name = $_POST["name"];
    $des = $_POST["des"];
    $photos = $_POST["photos"];
    $id_users = $_POST["id_users"];

    // Memeriksa apakah ID pengguna sesuai dengan sesi
    if ($id_users == $id_user) {
        // Membuat query untuk mengedit data dalam tabel
        $sql = "UPDATE data SET name='$name', des='$des', photos='$photos' WHERE id_data='$id_data' AND id_users='$id_user'";

        if ($koneksi->query($sql) === TRUE) {
            echo "Data berhasil diupdate.";
        } else {
            echo "Terjadi kesalahan: " . $koneksi->error;
        }
    } else {
        echo "Anda tidak memiliki izin untuk mengedit data ini.";
    }

    // Menutup koneksi
    $koneksi->close();
}

// Mendapatkan data yang akan diedit
$id_data = $_GET["id_data"];
$sql = "SELECT * FROM data WHERE id_data='$id_data' AND id_users='$id_user'";
$result = $koneksi->query($sql);
$row = $result->fetch_assoc();

// Memastikan data ditemukan
if (!$row) {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!-- Formulir HTML -->
<!DOCTYPE html>
<html>

<head>
    <title>Formulir Edit Data</title>
</head>

<body>
    <h2>Formulir Edit Data</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="hidden" name="id_data" value="<?php echo $row['id_data']; ?>">
        <input type="hidden" name="id_users" value="<?php echo $row['id_users']; ?>">

        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required><br>

        <label for="des">Deskripsi:</label>
        <textarea name="des" id="des" required><?php echo $row['des']; ?></textarea><br>

        <label for="photos">Foto:</label>
        <input type="text" name="" id="photos" value="<?php echo $row['photos']; ?>" required><br>
        <input type="submit" value="Update Data">
    </form>
</body>

</html>