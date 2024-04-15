<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .btn-custom {
            background-color: #27374D;
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #526D82;
            color: #fff;
        }

        /* Style untuk navbar */
        .navbar {
            background-color: #526D82; /* Warna background navbar */
        }

        .navbar-brand {
            color: #fff;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #fff;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #fff !important;
        }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-sm d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="#">Pelayaran</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="utama.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="keloladatauser.php">Kelola Data User</a>
                </li>
            </ul>
        </div>
        <div>
            <a href="logout.php" class="btn btn-custom">Logout</a>
        </div>
    </div>
</nav>
</body>
</html>
