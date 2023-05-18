<?php
session_start();

// Memeriksa apakah pengguna sudah login atau belum
if (isset($_SESSION['id_user'])) {
    // Jika pengguna sudah login, redirect ke halaman profile.php
    header("Location: ../../home");
    exit();
}

require_once '../../config/index.php';
$conn = new mysqli($host, $username, $password_db, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memproses data login saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form login
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Mengecek kecocokan email dalam database
    $sql = "SELECT id_users, pass FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['pass'];

        // Memverifikasi password
        if (password_verify($password, $hashedPassword)) {
            // Password cocok, menyimpan ID pengguna ke dalam session
            $_SESSION['id_user'] = $row['id_users'];

            // Redirect ke halaman home.php setelah login berhasil
            header("Location: ../../home/index.php");
            exit();
        } else {
            // Password tidak cocok
            echo "Password salah.";
        }
    } else {
        // Pengguna tidak ditemukan
        echo "Pengguna tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Login</title>
</head>

<body>
    <h2>Form Login</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="pass">Password:</label>
        <input type="password" name="pass" id="pass" required><br>

        <input type="submit" value="Login">
    </form>
</body>

</html>

<?php
$conn->close();
?>