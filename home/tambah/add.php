<!DOCTYPE html>
<html>

<head>
    <title>Form Tambah Data</title>
</head>

<body>
    <h2>Tambah Data</h2>
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


    if ($koneksi->connect_error) {
        die("Koneksi ke database gagal: " . $koneksi->connect_error);
    }

    // Memproses data yang dikirimkan melalui form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $des = $_POST['des'];
        //$id_users = $_POST['id_users'];
        $_POST['id_users'] = $id_user;

        // Mengunggah foto ke folder tertentu
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photos"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Memeriksa apakah file yang diunggah adalah gambar
        $check = getimagesize($_FILES["photos"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Memeriksa apakah file sudah ada
        if (file_exists($target_file)) {
            echo "Maaf, file tersebut sudah ada.";
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

        // Jika semua pengecekan lolos, unggah file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["photos"]["tmp_name"], $target_file)) {
                echo "Foto " . basename($_FILES["photos"]["name"]) . " berhasil diunggah.";

                // Simpan data ke database
                $sql = "INSERT INTO data (name, des, photos, id_users) VALUES ('$name', '$des', '$target_file', '$id_user')";
                if ($koneksi->query($sql) === TRUE) {
                    echo "Data berhasil ditambahkan.";
                } else {
                    echo "Error: " . $sql . "<br>" . $koneksi->error;
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
            }
        }
    }
    ?>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="des">Deskripsi:</label>
        <textarea name="des" id="des" required></textarea><br><br>

        <label for="photos">Foto:</label>
        <input type="file" name="photos" id="photos" required><br><br>

        <input type="submit" value="Tambah Data">
    </form>
</body>

</html>