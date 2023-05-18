<?php
session_start();

// Fungsi untuk mengambil data user berdasarkan ID
function getUser($conn, $id)
{
    $sql = "SELECT * FROM users WHERE id_users = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } else {
        return false;
    }
}

// Fungsi untuk memperbarui data user
function updateUser($conn, $id, $name, $foto, $email, $pass)
{
    if (!empty($foto)) {
        $sql = "UPDATE users SET name = '$name', foto = '$foto', email = '$email', pass = '$pass' WHERE id_users = '$id'";
    } else {
        $sql = "UPDATE users SET name = '$name', email = '$email', pass = '$pass' WHERE id_users = '$id'";
    }

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

require_once '../../config/index.php';
$targetDir = "uploads/"; // Ganti dengan direktori upload foto

// Buat koneksi ke database
$conn = mysqli_connect($host, $username, $password_db, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_user = $_SESSION['id_user'];
    $id = $id_user;
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $pass = mysqli_real_escape_string($conn, $_POST["pass"]);
    $foto = "";

    // Cek apakah ada file foto yang diupload
    if (!empty($_FILES["foto"]["name"])) {
        $fileName = basename($_FILES["foto"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Cek apakah file adalah gambar
        $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file ke server
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFilePath)) {
                $foto = $fileName;

                // Update data user dengan foto baru
                if (updateUser($conn, $id, $name, $foto, $email, $pass)) {
                    echo "Data user berhasil diperbarui.";
                } else {
                    echo "Gagal memperbarui data user.";
                }
            } else {
                echo "Gagal mengupload file foto.";
            }
        } else {
            echo "File yang diupload harus berupa gambar.";
        }
    } else {
        // Update data user tanpa mengubah foto
        if (updateUser($conn, $id, $name, $foto, $email, $pass)) {
            echo "Data user berhasil diperbarui.";
        } else {
            echo "Gagal memperbarui data user.";
        }
    }
}

// Ambil data user berdasarkan ID yang diberikan
$id_user = $_SESSION['id_user'];
$user = getUser($conn, $id_user);

// Tampilkan form edit profile
?>
<img src="uploads/<?php echo $user['foto']; ?>">
<br>
<form method="post" enctype="multipart/form-data">
    <label for="name">Nama:</label>
    <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

    <label for="foto">Foto:</label>
    <input type="file" name="foto" accept="image/*">

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>

    <label for="pass">Password:</label>
    <input type="password" name="pass" value="<?php echo $user['pass']; ?>" required>

    <button type="submit">Simpan</button>
</form>

<?php
// Tutup koneksi ke database
mysqli_close($conn);
?>