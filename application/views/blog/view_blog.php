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
        .ck-content img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .readable-text {
            font-size: 3rem; /* Ukuran agak besar */
            font-weight: 600; /* Sedikit bold untuk keterbacaan */
            color: #ffffff; /* Warna putih sebagai default */
            text-shadow: 
                2px 2px 4px rgba(0, 0, 0, 0.8),
                -1px -1px 2px rgba(0, 0, 0, 0.5),
                1px -1px 2px rgba(0, 0, 0, 0.5),
                -1px 1px 2px rgba(0, 0, 0, 0.5);
            /* background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.1) 0%, 
                rgba(0, 0, 0, 0.1) 100%); */
            backdrop-filter: blur(2px);
            padding: 8px 12px;
            border-radius: 6px;
            /* border: 1px solid rgba(255, 255, 255, 0.2); */
            line-height: 1.4;
        }
        @media (max-width: 576px) {
            .recommend-blog-section {
                margin: 30px 20px;
            }
        }
        @media (min-width: 576px) {
            .recommend-blog-section {
                margin: 50px 80px;
            }
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
        <div class="text-center" style="position: relative; width: 100%; height: 300px; overflow: hidden;">
            <?php if ($blog['thumbnail'] && file_exists('public/' . $blog['thumbnail'])) { ?>
                <img src="<?= base_url('public/' . $blog['thumbnail']) ?>" alt="Thumbnail"
                    style="width: 100%; height: 100%; object-fit: cover; display: block;">
                <div style="
                    position: absolute;
                    top: 0; left: 0; right: 0; bottom: 0;
                    background: rgba(0, 0, 0, 0.2);
                "></div>
            <?php } else { ?>
                <span class="text-muted">No Thumbnail</span>
            <?php } ?>
        </div>


        <div class="d-flex justify-content-center">
            <div style="max-width: 700px; width: 100%;">
                <div class="mb-4 mx-1" style="z-index: 1; position: relative;">
                    <span class="readable-text text-left"><?= $blog['title'] ?></span>
                    <div class="d-flex justify-content-start">
                        <div class="form-group mr-3">
                        <img src="<?= base_url('public/' . ($user_info['foto'] ?? 'local_assets/images/user_default.png')) ?>" 
                            class="logo-invoice img-fluid" alt="profile-image">
                        </div>
                        <div class="form-group">
                        <h6 class="text-dark"><?= $user_info['nama'] ?></h6>
                        <small><?= $user_info['email'] ?></small>
                        </div>
                    </div>
                </div>

                <!-- Konten Blog -->
                <div class="card p-0 border-radius-5 w-100">
                    <div class="form-group mt-2 mx-2">
                        <div class="ck-content">
                        <?= $blog['content'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="recommend-blog-section">
            <h5 class="text-center mb-4">Rekomendasi Blog</h5>
            <div class="d-flex justify-content-center">
                <div class="row">
                    <?php foreach ($blogs as $i => $item): ?>

                        <div class="col-6 col-lg-3 p-0">
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
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="text-left">
                <a href="<?= base_url('blog') ?>" class="view-all-link">Lihat semua daftar blog</a>
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