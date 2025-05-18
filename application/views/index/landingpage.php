<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= get_website_name() ?> | <?= $title ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('public/' . get_website_logo()) ?>">
    <link rel="stylesheet" href="<?= base_url('public/template_assets/css/backend-plugin.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/template_assets/css/backend.css?v=1.0.0') ?>">
    <link rel="stylesheet" href="<?= base_url('public/template_assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/template_assets/vendor/remixicon/fonts/remixicon.css') ?>">

    <link rel="stylesheet" href="<?= base_url('public/template_assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/template_assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/template_assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css') ?>">

    <link rel="stylesheet" href="<?= base_url('public/local_assets/css/local.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        #loading-center {
            background: url("<?= base_url('public/' . get_website_logo()) ?>") no-repeat center center;
            background-size: 20%;
            width: 100%;
            height: 100%;
            position: relative;
            animation: loader 1.5s alternate infinite ease-in-out;
        }
    </style>

    <style>
        .text-underline a {
            text-decoration: none;
            position: relative;
            padding-bottom: 5px;
            color: inherit;
            transition: color 0.3s ease;
        }

        .text-underline a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 100%;
            background-color: #007bff; /* biru atau sesuaikan */
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s ease;
            border-radius: 2px;
        }

        .text-underline a:hover::after,
        .text-underline a.active::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }
        body {
            scroll-behavior: smooth;
        }
        .section {
            padding: 80px 0;
        }
        .section-heading {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 40px;
        }
        .card-price {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .custom-carousel {
        width: 100vw;
        max-width: 100%;
        overflow: hidden;
        border-radius: 25px;
        margin: 0 auto;
    }

    .custom-carousel img {
        object-fit: cover;
        height: 80vh;
        border-radius: 25px;
    }
    </style>


</head>

<?php
$has_sidebar = isset($has_sidebar) ? $has_sidebar : true;
?>

<body class="<?= isset($has_sidebar) && !$has_sidebar ? 'no-sidebar' : '' ?>">

    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->


    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="iq-sidebar-logo d-flex align-items-center">
                    <a href="<?= base_url('') ?>" class="header-logo">
                        <img src="<?= base_url('public/' . get_website_logo()) ?>" alt="logo">
                        <h4 class="logo-title text-uppercase"><?= get_website_name() ?></h4>
                    </a>
                </div>
                <div class="d-flex align-items-center">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-label="Toggle navigation">
                        <i class="ri-menu-3-line"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="d-flex justify-content-center mr-5">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                <li class="nav-item nav-icon text-underline">
                                    <a href="#products" class="">
                                        <strong>Product</strong>
                                    </a>
                                </li>
                                <li class="nav-item nav-icon text-underline">
                                    <a href="#pricing" class="">
                                        <strong>Pricing</strong>
                                    </a>
                                </li>
                                <li class="nav-item nav-icon text-underline">
                                    <a href="#" class="">
                                        <strong>FaQ</strong>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <ul class="navbar-nav ml-auto navbar-list align-items-center">
                            <?php if ($this->session->userdata('user_id')) { ?>
                                <li class="nav-item nav-icon p-0 ml-1 mr-1 mt-2">
                                    <?php if ($role_id == 1) { ?>
                                        <a href="<?= base_url('superadmin/dashboard') ?>" class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-grid mr-2">
                                                <rect x="3" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="14" width="7" height="7"></rect>
                                                <rect x="3" y="14" width="7" height="7"></rect>
                                            </svg>
                                        </a>
                                    <?php } elseif ($role_id == 2) { ?>
                                        <a href="<?= base_url('admin/dashboard') ?>" class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-grid mr-2">
                                                <rect x="3" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="14" width="7" height="7"></rect>
                                                <rect x="3" y="14" width="7" height="7"></rect>
                                            </svg>
                                        </a>
                                    <?php } elseif ($role_id == 3) { ?>
                                        <a href="<?= base_url('operator/dashboard') ?>" class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-grid mr-2">
                                                <rect x="3" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="14" width="7" height="7"></rect>
                                                <rect x="3" y="14" width="7" height="7"></rect>
                                            </svg>
                                        </a>
                                    <?php } elseif ($role_id == 4) { ?>
                                        <a href="<?= base_url('customerservice/dashboard') ?>" class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-grid mr-2">
                                                <rect x="3" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="14" width="7" height="7"></rect>
                                                <rect x="3" y="14" width="7" height="7"></rect>
                                            </svg>
                                        </a>
                                    <?php } elseif ($role_id == 5) { ?>
                                        <a href="<?= base_url('customer/dashboard') ?>" class="d-flex align-items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-grid mr-2">
                                                <rect x="3" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="3" width="7" height="7"></rect>
                                                <rect x="14" y="14" width="7" height="7"></rect>
                                                <rect x="3" y="14" width="7" height="7"></rect>
                                            </svg>
                                        </a>
                                    <?php } ?>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item nav-icon mt-2 mb-2">
                                    <a href="<?= base_url('auth/login') ?>" class="">
                                        <span class="btn btn-outline-light text-dark d-flex align-items-center">
                                            <span>Login</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item nav-icon mt-2 mb-2">
                                    <a href="<?= base_url('auth/register') ?>" class="">
                                        <span class="btn btn-primary text-white d-flex align-items-center">
                                            <span>Register</span>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>
                            
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>


    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page p-0">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 p-0">

                    <section class="section mb-4" style="background-image: url('public/local_assets/images/background.jpg'); background-size: cover; background-position: center;">
                            <div class="container" style="height:  78vh;">
                                <div class="row">
                                    <div class="col-md-6 mt-5">
                                        <h1 class="text-dark">Jasa Pembuatan PCB dan CNC Profeisonal</h1>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="<?= base_url('public/local_assets/images/illustrator.png') ?>" class="img-fluid" alt="Illustration" width="100%">
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="section px-3" style="margin-top: -250px;">
                            <div class="bd-example">
                                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="<?= base_url('public/local_assets/images/notfound_image.png') ?>" class="d-block w-100" alt="#">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h4 class="text-white">First slide label</h4>
                                                <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="<?= base_url('public/local_assets/images/notfound_image.png') ?>" class="d-block w-100" alt="#">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h4 class="text-white">Second slide label</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="<?= base_url('public/local_assets/images/notfound_image.png') ?>" class="d-block w-100" alt="#">
                                            <div class="carousel-caption d-none d-md-block">
                                                <h4 class="text-white">Third slide label</h4>
                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </section>


                        <!-- Card Section -->
                        <section class="section bg-primary-light mt-4 mb-4">
                            <div class="container">
                                <h2 class="section-heading text-center font-weight-bold mb-5">Layanan PCB & CNC Profesional</h2>

                                <!-- Row 1: Layanan PCB dan CNC -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="<?= base_url('public/local_assets/images/notfound_image.png') ?>" class="d-block w-100" alt="#">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h4 class="text-white">First slide label</h4>
                                                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="<?= base_url('public/local_assets/images/notfound_image.png') ?>" class="d-block w-100" alt="#">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h4 class="text-white">Second slide label</h4>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="<?= base_url('public/local_assets/images/notfound_image.png') ?>" class="d-block w-100" alt="#">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h4 class="text-white">Third slide label</h4>
                                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="card p-4 h-100 bottom-right shadow-showcase rounded">
                                            <h4 class="font-weight-bold">Jasa Pembuatan PCB</h4>
                                            <p>Kami menyediakan layanan pembuatan PCB berkualitas tinggi untuk kebutuhan elektronik Anda, mulai dari prototype hingga produksi massal.</p>
                                            <ul class="list-unstyled">
                                                <li>✔️ Desain hingga produksi</li>
                                                <li>✔️ Berbagai ukuran & lapisan</li>
                                                <li>✔️ Finishing profesional</li>
                                            </ul>
                                            <button class="btn btn-sm btn-primary mt-2">Order Sekarang</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="card p-4 h-100 bottom-right shadow-showcase rounded">
                                            <h4 class="font-weight-bold">Jasa CNC Milling & Engraving</h4>
                                            <p>Kami juga melayani pemotongan dan engraving menggunakan mesin CNC presisi untuk berbagai kebutuhan teknis dan artistik.</p>
                                            <ul class="list-unstyled">
                                                <li>✔️ Akurasi tinggi</li>
                                                <li>✔️ Bahan metal, akrilik, kayu</li>
                                                <li>✔️ Hasil rapi & cepat</li>
                                            </ul>
                                            <button class="btn btn-sm btn-primary mt-2">Order Sekarang</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 2: Detail layanan dan keunggulan -->
                                <div class="row mt-4">
                                    <div class="col-md-4 mb-4">
                                        <div class="card p-4 h-100 bottom-right shadow-showcase rounded">
                                            <h5 class="font-weight-bold">Spesifikasi PCB</h5>
                                            <p>Kustomisasi lengkap dari jenis material, ketebalan, hingga finishing.</p>
                                            <ul class="list-unstyled">
                                                <li>🧩 FR4, CEM1, Aluminium</li>
                                                <li>📏 2-8 Layer</li>
                                                <li>✨ Surface Finish: HASL, ENIG</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="card p-4 h-100 bottom-right shadow-showcase rounded">
                                            <h5 class="font-weight-bold">Kenapa Memilih Kami?</h5>
                                            <p>Lebih dari sekadar jasa, kami adalah partner produksi terbaik Anda.</p>
                                            <ul class="list-unstyled">
                                                <li>✅ Tim ahli & berpengalaman</li>
                                                <li>🚚 Pengiriman cepat & aman</li>
                                                <li>📞 Layanan support 24/7</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="row col-12 section px-3">
                            <div class="col-lg-4 col-sm-12">
                                <h4 class="font-weight-bold mb-3">Pilih Paket Sesuai Kebutuhan Anda</h4>
                                <p class="mb-2">Kami menyediakan beberapa pilihan paket layanan dengan fitur dan harga yang berbeda-beda, sesuai kebutuhan Anda.</p>
                                <ul class="pl-3">
                                    <li><strong>Basic</strong> – Cocok untuk penggunaan personal ringan.</li>
                                    <li><strong>Standard</strong> – Direkomendasikan untuk pengguna reguler.</li>
                                    <li><strong>Platinum</strong> – Fitur lengkap dan performa lebih tinggi.</li>
                                    <li><strong>Premium</strong> – Untuk kebutuhan profesional & skala besar.</li>
                                </ul>
                                <p class="mt-3">Klik tombol <strong>Purchase</strong> di bawah paket pilihan Anda untuk melakukan pemesanan.</p>
                            </div>

                            <div class="col-lg-8 col-sm-12">
                                <div class="card" id="pricing">
                                    <div class="card-body">
                                        <div class="table-responsive pricing pt-2">
                                            <table id="my-table" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center prc-wrap"></th>
                                                    <th class="text-center prc-wrap">
                                                        <div class="prc-box">
                                                        <div class="h3 pt-4">$19<small> / Per month</small>
                                                        </div> <span class="type">Basic</span>
                                                        </div>
                                                    </th>
                                                    <th class="text-center prc-wrap">
                                                        <div class="prc-box active">
                                                        <div class="h3 pt-4">$39<small> / Per month</small>
                                                        </div> <span class="type">Standard</span>
                                                        </div>
                                                    </th>
                                                    <th class="text-center prc-wrap">
                                                        <div class="prc-box">
                                                        <div class="h3 pt-4">$119<small> / Per month</small>
                                                        </div> <span class="type">Platinum</span>
                                                        </div>
                                                    </th>
                                                    <th class="text-center prc-wrap">
                                                        <div class="prc-box">
                                                        <div class="h3 pt-4">$219<small> / Per month</small>
                                                        </div> <span class="type">Premium</span>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="text-center" scope="row">New Movies</th>
                                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                    <td class="text-center child-cell active"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" scope="row">Streamit Special</th>
                                                    <td class="text-center child-cell"><i class="ri-close-line i_close"></i>
                                                    </td>
                                                    <td class="text-center child-cell active"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" scope="row">Sofbox series</th>
                                                    <td class="text-center child-cell"><i class="ri-close-line i_close"></i>
                                                    </td>
                                                    <td class="text-center child-cell active"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" scope="row">Xamin TV shows</th>
                                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                    <td class="text-center child-cell active"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" scope="row">Prokit HD shows</th>
                                                    <td class="text-center child-cell">SD (480p)</td>
                                                    <td class="text-center child-cell active">HD (720p)</td>
                                                    <td class="text-center child-cell">FHD (1080p)</td>
                                                    <td class="text-center child-cell">FHD (1080p)</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" scope="row">Unlimited Graphina plug-in</th>
                                                    <td class="text-center child-cell"><i class="ri-close-line i_close"></i>
                                                    </td>
                                                    <td class="text-center child-cell active"><i class="ri-close-line i_close"></i>
                                                    </td>
                                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                    <td class="text-center child-cell"><i class="ri-check-line ri-2x"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center"><i class="ri-close-line i_close"></i>
                                                    </td>
                                                    <td class="text-center"> <a href="#" class="btn btn-primary mt-3">Purchase</a>
                                                    </td>
                                                    <td class="text-center"> <a href="#" class="btn btn-primary mt-3">Purchase</a>
                                                    </td>
                                                    <td class="text-center"> <a href="#" class="btn btn-primary mt-3">Purchase</a>
                                                    </td>
                                                    <td class="text-center"> <a href="#" class="btn btn-primary mt-3">Purchase</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Grid Titles -->
                        <section class="bg-light">
                            <div class="container">
                                <h2 class="section-heading text-center p-5">Kenapa Memilih Kami?</h2>
                                <div class="row text-center">
                                    <div class="col-md-3 mb-4">
                                        <i class="las la-microchip fa-3x text-primary font-size-40 mb-3"></i>
                                        <h5>Teknologi Modern</h5>
                                        <p>Kami menggunakan mesin terbaru untuk hasil PCB dan CNC yang presisi dan konsisten.</p>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <i class="las la-stopwatch fa-3x text-success font-size-40 mb-3"></i>
                                        <h5>Proses Cepat</h5>
                                        <p>Pesanan Anda kami proses dengan cepat tanpa mengorbankan kualitas produksi.</p>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <i class="las la-tools fa-3x text-warning font-size-40 mb-3"></i>
                                        <h5>Custom Sesuai Kebutuhan</h5>
                                        <p>Anda bebas menentukan ukuran, bahan, dan spesifikasi sesuai keperluan proyek Anda.</p>
                                    </div>
                                    <div class="col-md-3 mb-4">
                                        <i class="las la-hand-holding-usd fa-3x text-info font-size-40 mb-3"></i>
                                        <h5>Harga Transparan</h5>
                                        <p>Estimasi harga langsung terlihat tanpa biaya tersembunyi, cocok untuk budgeting proyek Anda.</p>
                                    </div>
                                </div>
                            </div>
                        </section>


                        <!-- Image Feature -->
                        <section class="section">
                            <div class="container">
                                <h2 class="section-heading">Title Heading</h2>
                                <div class="row">
                                    <div class="col-md-4 mb-4">
                                        <div class="card" style="height: 250px;"></div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="card" style="height: 250px;"></div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <div class="card p-4">
                                            <p>Text inside a card</p>
                                            <button class="btn btn-sm btn-dark">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Testimonials -->
                        <section class="section bg-light">
                            <div class="container">
                                <h2 class="section-heading">Section Heading</h2>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="card p-4">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <div>⭐⭐⭐⭐⭐</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="card p-4">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            <div>⭐⭐⭐⭐⭐</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                   

                    


                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper End-->

    <?php
        $controller = $this->router->fetch_class();
        $method = $this->router->fetch_method();
    ?>

    <?php if (!in_array($method, ['login', 'register', 'forgot_password', 'reset_password'])): ?>
        <!-- Footer -->
        <footer class="iq-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="../backend/privacy-policy.html">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="../backend/terms-of-service.html">Terms of Use</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-6 text-right">
                        <span class="mr-1">
                            <script>
                                document.write(new Date().getFullYear())
                            </script>©
                        </span> <a href="#" class=""><?= get_website_name() ?></a>.
                    </div>
                </div>
            </div>
        </footer>
    <?php endif; ?>


    <script src="<?= base_url('public/template_assets/js/backend-bundle.min.js') ?>"></script>

    <!-- Table Treeview JavaScript -->
    <script src="<?= base_url('public/template_assets/js/table-treeview.js') ?>"></script>

    <!-- Chart Custom JavaScript -->
    <script src="<?= base_url('public/template_assets/js/customizer.js') ?>"></script>

    <!-- Chart Custom JavaScript -->
    <script async src="<?= base_url('public/template_assets/js/chart-custom.js') ?>"></script>
    <!-- Chart Custom JavaScript -->
    <script async src="<?= base_url('public/template_assets/js/slider.js') ?>"></script>

    <!-- app JavaScript -->
    <script src="<?= base_url('public/template_assets/js/app.js') ?>"></script>

    <script src="<?= base_url('public/template_assets/vendor/moment.min.js') ?>"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const target = document.querySelector(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            if (window.location.hash) {
                const target = document.querySelector(window.location.hash);
                if (target) {
                    setTimeout(() => {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }, 300);
                }
            }
        });
    </script>


</body>

</html>