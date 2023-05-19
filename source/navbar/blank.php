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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link" href="#">Menu 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Menu 3</a>
                </li> -->
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0 mr-3" method="POST" action="search.php">
                <div class="input-group">
                    <input class="form-control" type="search" name="searchKeyword" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </div>
            </form> -->

        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>