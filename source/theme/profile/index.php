<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class="bg-secondary">
    <?php include('../../navbar/blank.php'); ?>
    <section class="vh-100">
        <div class="container py-5 h-200">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-4">
                            <div class="d-flex text-black">
                                <div class="flex-shrink-0">
                                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjCX5TOKkOk3MBt8V-f8PbmGrdLHCi4BoUOs_yuZ1pekOp8U_yWcf40t66JZ4_e_JYpRTOVCl0m8ozEpLrs9Ip2Cm7kQz4fUnUFh8Jcv8fMFfPbfbyWEEKne0S9e_U6fWEmcz0oihuJM6sP1cGFqdJZbLjaEQnGdgJvcxctqhMbNw632OKuAMBMwL86/s414/pp%20kosong%20wa%20default.jpg"
                                        alt="Generic placeholder image" class="img-fluid"
                                        style="width: 180px; border-radius: 10px;" id="profile-image">

                                </div>
                                <div class="flex-grow-1 ms-3 pt-3">
                                    <h5 class="mb-1">Danny McLoan</h5>
                                    <p class="mb-2 pb-1" style="color: #2b2a2a;">Senior Journalist</p>

                                    <div class="d-flex pt-1 mt-5">

                                        <button type="button" class="btn btn-primary flex-grow-1 mr-2">Edit
                                            Profile</button>
                                        <button type="button"
                                            class="btn btn-outline-primary me-1 flex-grow-1">Logout</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#profile-image').click(function() {
            // Kirim permintaan AJAX ke server
            $.ajax({
                url: 'update_foto.php', // Ubah sesuai dengan alamat skrip PHP Anda
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    // Tanggapi hasil dari server
                    if (response.success) {
                        $('#profile-image').attr('src', response
                            .photoURL
                        ); // Perbarui sumber gambar dengan URL foto yang diperbarui
                    }
                },
                error: function() {
                    // Tangani kesalahan jika terjadi
                    console.log('Error updating photo.');
                }
            });
        });
    });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>