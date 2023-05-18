<!DOCTYPE html>
<html>

<head>
    <title>Form Update Data</title>
</head>

<body>
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

    require_once '../../config/index.php';
    $koneksi = new mysqli($host, $username, $password_db, $database);

    if ($koneksi->connect_error) {
        die("Koneksi ke database gagal: " . $koneksi->connect_error);
    }

    // Mendapatkan nilai-nilai data yang akan diperbarui
    if (isset($_GET['id_data'])) {
        $id_data = $_GET['id_data'];
        $sql = "SELECT * FROM data WHERE id_data = '$id_data'";
        $result = $koneksi->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $des = $row['des'];
        } else {
            echo "Data tidak ditemukan.";
        }
    }

    // Memproses data yang dikirimkan melalui form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_data = $_POST['id_data'];
        $name = $_POST['name'];
        $des = $_POST['des'];

        // Mengunggah foto baru jika ada yang diunggah
        if ($_FILES["photos"]["name"]) {
            $target_dir = "../tambah/uploads/";
            $target_file = $target_dir . basename($_FILES["photos"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Memeriksa apakah file yang diunggah adalah gambar
            $check = getimagesize($_FILES["photos"]["tmp_name"]);
            if ($check === false) {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Memeriksa ukuran file
            if ($_FILES["photos"]["size"] > 500000) {
                echo "Maaf, ukuran file terlalu besar.";
                $uploadOk = 0;
            }

            // Memeriksa tipe file yang diizinkan
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
                $uploadOk = 0;
            }

            // Jika semua pengecekan lolos, unggah file baru dan perbarui foto di database
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["photos"]["tmp_name"], $target_file)) {
                    echo "Foto " . basename($_FILES["photos"]["name"]) . " berhasil diunggah.";
                    $sql = "UPDATE data SET name='$name', des='$des', photos='$target_file' WHERE id_data='$id_data'";
                    if ($koneksi->query($sql) === TRUE) {
                        echo "Data berhasil diperbarui.";
                    } else {
                        echo "Error: " . $sql . "<br>" . $koneksi->error;
                    }
                } else {
                    echo "Maaf, terjadi kesalahan saat mengunggah file.";
                }
            }
        } else {
            // Jika tidak ada foto baru diunggah, perbarui data tanpa memperbarui foto
            $sql = "UPDATE data SET name='$name', des='$des' WHERE id_data='$id_data'";
            if ($koneksi->query($sql) === TRUE) {
                echo "Data berhasil diperbarui.";
            } else {
                echo "Error: " . $sql . "<br>" . $koneksi->error;
            }
        }
    }
    ?>

    <h2>Update Data</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_data" value="<?php echo $id_data; ?>">

        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" value="<?php echo $name; ?>" required><br><br>

        <label for="des">Deskripsi:</label>
        <textarea name="des" id="des" required><?php echo $des; ?></textarea><br><br>

        <label for="photos">Foto:</label>
        <input type="file" name="photos" id="photos"><br><br>

        <input type="submit" value="Update Data">
    </form>
</body>

</html>