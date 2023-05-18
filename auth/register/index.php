<?php
require_once '../../config/index.php';

$conn = new mysqli($host, $username, $password_db, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$status = 'user';
// Memproses data registrasi saat form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form registrasi
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];

    $_POST['status'] = $status;

    // Mengenkripsi password menggunakan bcrypt
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Memasukkan data pengguna ke dalam tabel
    $sql = "INSERT INTO users (name, email, pass,status) VALUES ('$name', '$email', '$hashedPassword','$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Registrasi</title>
</head>

<body>
    <h2>Form Registrasi</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="pass">Password:</label>
        <input type="password" name="pass" id="pass" required><br>

        <input type="submit" value="Daftar">
    </form>
</body>

</html>

<?php
$conn->close();
?>