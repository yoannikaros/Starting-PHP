<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Navbar with Profile, Search, and Menu</title>
    <style>
        .navbar .dropdown-toggle::after {
            display: none;
        }

        .navbar .dropdown-toggle::before {
            content: '\f007';
            font-family: FontAwesome;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Menu 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Menu 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Menu 3</a>
                </li> -->
            </ul>
            <form class="form-inline my-2 my-lg-0 mr-3" method="POST" action="search.php">
                <div class="input-group">
                    <input class="form-control" type="search" name="searchKeyword" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <?php

                        // Koneksi ke database
                        require_once '../config/index.php';
                        $conn = mysqli_connect($host, $username, $password_db, $database);

                        $sql = "SELECT * FROM users WHERE id_users = '$id_user'";

                        // Eksekusi query
                        $result = mysqli_query($conn, $sql);

                        // Tampilkan hasil query
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <!-- <img src="../profile/edit/uploads/<?php echo $row["foto"]; ?>" alt="Profile"
                            class="rounded-circle" width="30" height="30"> -->
                                <?php
                                // Memeriksa apakah ada data foto
                                if (!empty($row["foto"])) {
                                    // Jika ada data foto, tampilkan foto tersebut
                                    echo '<img src="../profile/edit/uploads/' . $row["foto"] . '" alt="Profile" class="rounded-circle" width="30" height="30">';
                                } else {
                                    // Jika tidak ada data foto, tampilkan foto lain
                                    echo '<img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjCX5TOKkOk3MBt8V-f8PbmGrdLHCi4BoUOs_yuZ1pekOp8U_yWcf40t66JZ4_e_JYpRTOVCl0m8ozEpLrs9Ip2Cm7kQz4fUnUFh8Jcv8fMFfPbfbyWEEKne0S9e_U6fWEmcz0oihuJM6sP1cGFqdJZbLjaEQnGdgJvcxctqhMbNw632OKuAMBMwL86/s414/pp%20kosong%20wa%20default.jpg" alt="Default Profile" class="rounded-circle" width="30" height="30">';
                                }
                                ?>

                                <?php echo $row["name"]; ?>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../profile">Profile</a>
                        <a class="dropdown-item" href="../profile/edit/index.php">Settings</a>
                        <?php
                                $status = $row['status'];

                                // Periksa jika status adalah 'admin'
                                if ($status == 'admin') {
                                    echo '<a class="dropdown-item" href="../admin">Admin</a>';
                                }

                        ?>
                <?php
                            }
                        } else {
                            echo "Tidak ada data yang absen hari ini";
                        }

                        // Tutup koneksi
                        mysqli_close($conn);

                ?>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>