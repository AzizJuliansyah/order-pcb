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


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ancizar+Serif:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">  

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
        
        h1 {
            font-family: "Ancizar Serif", serif;
            font-size: 4rem;
            font-weight: 600;
        }

        @media (max-width: 576px) {
            .mobile-truncate-3 {
                font-size: 12px; /* atur ukuran font sesuai kebutuhan */
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }
        .mobile-truncate-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
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
                <div class="iq-sidebar-logo d-flex align-items-center mb-0 p-0">
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
                        <ul class="navbar-nav ml-auto navbar-list align-items-center">
                            <li class="nav-item nav-icon nav-item-icon dropdown text-underline">
                                <a href="<?= base_url('') ?>#products" class="">
                                    <strong>Product</strong>
                                </a>
                            </li>
                            <li class="nav-item nav-icon nav-item-icon dropdown text-underline">
                                <a href="<?= base_url('') ?>#pricing" class="">
                                    <strong>Pricing</strong>
                                </a>
                            </li>
                            <li class="nav-item nav-icon nav-item-icon dropdown text-underline">
                                <a href="<?= base_url('') ?>#portfolio" class="">
                                    <strong>Portfolio</strong>
                                </a>
                            </li>
                            <?php if ($this->session->userdata('user_id')) { ?>
                                <li class="nav-item nav-icon nav-item-icon dropdown text-underline">
                                    <?php if ($role_id == 1) { ?>
                                        <a href="<?= base_url('superadmin/dashboard') ?>" class="">
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
                                        <a href="<?= base_url('admin/dashboard') ?>" class="">
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
                                        <a href="<?= base_url('operator/dashboard') ?>" class="">
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
                                        <a href="<?= base_url('customerservice/dashboard') ?>" class="">
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
                                        <a href="<?= base_url('customer/dashboard') ?>" class="">
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
                                <li class="nav-item nav-icon nav-item-icon dropdown mb-2">
                                    <a href="<?= base_url('auth/login') ?>" class="">
                                        <span class="btn btn-outline-light text-dark d-flex align-items-center">
                                            <span>Login</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item nav-icon nav-item-icon dropdown border-0 mb-2">
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
        <div class="content-page">
            <div class="container-fluid">
                <div class="col-12 col-md-6">
                    <form method="get" action="<?= base_url('blog') ?>">
                        <div class="input-group mb-3">
                            <input type="text" name="q" class="form-control" placeholder="Cari judul blog..." value="<?= htmlspecialchars($keyword ?? '') ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                    <h5>Artikel Terbaru & Informasi Terkini</h5>
                    <p class="text-muted">Kami menghadirkan kumpulan blog yang memuat wawasan, panduan, dan kabar terbaru untuk Anda. Silakan telusuri blog-blog pilihan berikut.</p>
                </div>
                <div class="col-12 mx-1">
                    <div id="grid" class="item-content animate__animated animate__fadeIn active" data-toggle-extra="tab-content">
                        <?php if (!empty($blogs)): ?>
                            <div class="row">
                                <?php foreach ($blogs as $index => $item) { ?>
                                    <div class="col-6 col-lg-2 col-md-3 p-0">
                                        <div class="card m-1">
                                            <div class="card-body p-0">
                                                <div class="text-center">
                                                    <img src="<?= !empty($item['thumbnail']) ? base_url('public/' . $item['thumbnail']) : base_url('public/local_assets/images/notfound_image.png') ?>" alt="Thumbnail" class="img-fluid rounded-top">
                                                </div>
                                                <div class="p-2">
                                                    <a href="<?= base_url('blog/view_blog/' . $item['slug']) ?>">
                                                        <h6 class="mobile-truncate-3"><?= htmlspecialchars($item['title']) ?></h6>
                                                    </a>
                                                    <div class="d-flex justify-content-end mt-2">
                                                        <a href="<?= base_url('blog/view_blog/' . $item['slug']) ?>" class="btn btn-sm bg-primary-light d-flex align-items-center font-size-12 mr-2">
                                                            <span class="text-primary font-size-12 mr-1">View</span>
                                                            <i class="las la-angle-right font-size-14 text-primary mr-0"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                
                            </div>
                            <?php else: ?>
                                    <div class="text-center my-5 py-5">
                                        <i class="las la-box-open text-muted" style="font-size: 8rem;"></i>
                                        <h5 class="mt-3 text-muted">Belum ada blog yang dibuat</h5>
                                        <p class="text-muted">Semua blog yang baru dibuat akan ditampilkan di sini.</p>
                                    </div>
                            <?php endif; ?>
                            

                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="d-flex flex-column flex-md-row justify-content-center justify-content-md-between align-items-center text-center text-md-start gap-2">
                        <small class="text-muted">
                            Menampilkan <?= $start ?>–<?= $end ?> blog dari total <?= $total ?> blog
                        </small>
                        <div>
                            <?= $pagination ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Wrapper End-->

    <script>
        // Fade in animation
        function checkFadeIn() {
            const fadeElements = document.querySelectorAll('.fade-in');
            
            fadeElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('visible');
                }
            });
        }

        window.addEventListener('scroll', checkFadeIn);
        window.addEventListener('load', checkFadeIn);

        
    </script>

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
                            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                            <li class="list-inline-item"><a href="#">Terms of Use</a></li>
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

</body>

</html>