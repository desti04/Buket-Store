<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buket Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #fdf4f7;
            font-family: 'Poppins', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            height: 100vh;
            background: #e8b8c8;
            padding-top: 20px;
            position: fixed;
            width: 240px;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        /* LOGO */
        .sidebar-logo {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
            box-shadow: 0 0 8px rgba(255,255,255,0.6);
        }

        /* TEXT BUKET ADMIN */
        .store-title {
            font-weight: 700;
            font-size: 20px;
            margin-left: 12px;
            color: #ffffff !important;
            text-shadow: 0 1px 4px rgba(0,0,0,0.15);
        }

        /* MENU BOX */
        .menu-box {
            margin: 10px 18px;
            padding: 12px 18px;
            background: rgba(255,255,255,0.15);
            border-radius: 15px;
            backdrop-filter: blur(6px);
            transition: 0.25s ease-in-out;
        }

        /* HOVER EFFECT */
        .menu-box:hover {
            background: rgba(255,255,255,0.35);
            transform: translateX(6px);
            box-shadow: 0 0 10px rgba(255, 210, 225, 0.5);
        }

        /* MENU TEXT & ICON → PUTIH */
        .menu-box a,
        .menu-box button {
            color: #ffffff !important;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            border: none;
            background: none;
            width: 100%;
        }

        .menu-box i {
            color: #ffffff !important;
            opacity: 0.95;
        }

        /* HOVER → PINK TUA */
        .menu-box:hover a,
        .menu-box:hover button,
        .menu-box:hover i {
            color: #DB2777 !important;
        }

        /* LOGOUT AT BOTTOM */
        .logout-wrapper {
            margin-top: auto;
            width: 100%;
        }

        /* NAVBAR */
        .navbar-custom {
            margin-left: 240px;
            background: white !important;
            border-bottom: 2px solid #f4d5e3;
        }

        .navbar-right-text {
            font-size: 15px;
            font-weight: 600;
            color: #8b5d6b;
        }

        /* CONTENT */
        .content {
            margin-left: 240px;
            padding: 28px;
        }

        /* FIX SELECT TEXT */
        select.form-control,
        select.form-select,
        .form-control,
        .form-select {
            color: #000 !important;
            background-color: #fff !important;
        }

        select.form-control option,
        select.form-select option {
            color: #000 !important;
            background-color: #fff !important;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="d-flex align-items-center px-3 mb-4">
            <img src="{{ asset('images/logo buket new.png') }}" alt="Logo" class="sidebar-logo">
            <span class="store-title">Buket Admin</span>
        </div>

        <!-- MENU -->
        <div class="menu-box">
            <a href="/admin">
                <i class="fa fa-home"></i> Dashboard
            </a>
        </div>

        <div class="menu-box">
            <a href="/admin/produk">
                <i class="fa fa-gift"></i> Data Produk
            </a>
        </div>

        <div class="menu-box">
            <a href="/admin/pesanan">
                <i class="fa fa-shopping-cart"></i> Pesanan
            </a>
        </div>

        <div class="menu-box">
            <a href="{{ route('admin.pengguna.index') }}">
                <i class="fa fa-users"></i> Pengguna
            </a>
        </div>

        <!-- LOGOUT -->
        <div class="logout-wrapper">
            <div class="menu-box">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand navbar-light shadow-sm navbar-custom px-4">
        <div class="container-fluid d-flex justify-content-end align-items-center">
            <span class="navbar-right-text">
                💗 Halo, {{ Auth::user()->name ?? 'Admin' }} 💗
            </span>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>
