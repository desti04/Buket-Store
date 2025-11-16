<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buket-Store Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .sidebar {
            height: 100vh;
            background: #343a40;
            color: white;
            padding-top: 20px;
            position: fixed;
            width: 230px;
        }
        .sidebar a {
            color: #c2c7d0;
            display: block;
            padding: 10px 20px;
            font-size: 15px;
        }
        .sidebar a:hover {
            background: #495057;
            color: white;
        }
        .content {
            margin-left: 230px;
            padding: 25px;
        }
        .navbar-custom {
            margin-left: 230px;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="text-center mb-4">Buket-Store</h4>

        <a href="/admin"><i class="fa fa-home"></i> Dashboard</a>
        <a href="/admin/produk"><i class="fa fa-gift"></i> Data Produk</a>
        <a href="/admin/kategori"><i class="fa fa-tags"></i> Kategori</a>
        <a href="/admin/pesanan"><i class="fa fa-shopping-cart"></i> Pesanan</a>
        <a href="/admin/users"><i class="fa fa-users"></i> Pengguna</a>
        <a href="/admin/logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand navbar-light bg-white shadow-sm navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand">Admin Dashboard</span>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
