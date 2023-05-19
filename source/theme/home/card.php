<!DOCTYPE html>
<html>

<head>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card-image img {
            border-radius: 10%;
            max-width: 10px;
            /* Mengatur lebar maksimum gambar */
            max-height: 10px;
            /* Mengatur tinggi maksimum gambar */
        }
    </style>
</head>

<body class="bg bg-secondary">
    <?php include('../../navbar/blank.php'); ?>
    <div class="container">
        <div class="row">

            <!-- Card -->
            <div class="col-md-4 mt-2">
                <div class="card p-3 rounded">
                    <div class="row">
                        <div class="col-md-4">
                            <img style="width: 100px;" src="https://www.akseleran.co.id/blog/wp-content/uploads/2022/10/download-1.png" class="card-image rounded" alt="Gambar 1">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Card 1</h5>
                                <p class="card-text">Deskripsi Card 1</p>
                                <a><button class="btn btn-primary">Edit</button></a>
                                <a><button class="btn btn-danger">Delete</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card -->



        </div>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>