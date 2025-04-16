<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Webkit | <?= $title ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('public/template_assets/images/favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('public/template_assets/css/backend-plugin.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/template_assets/css/backend.css?v=1.0.0') ?>">
    <link rel="stylesheet" href="<?= base_url('public/template_assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/template_assets/vendor/remixicon/fonts/remixicon.css') ?>">

    <link rel="stylesheet" href="<?= base_url('public/template_assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/template_assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/template_assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css') ?>">

    <link rel="stylesheet" href="<?= base_url('public/local_assets/css/local.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                    <i class="ri-menu-line wrapper-menu"></i>
                    <a href="../backend/index.html" class="header-logo">
                        <h4 class="logo-title text-uppercase">Webkit</h4>

                    </a>
                </div>
                <div class="navbar-breadcrumb">
                    <h5><?= $title ?></h5>
                </div>
                <div class="d-flex align-items-center">
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-label="Toggle navigation">
                        <i class="ri-menu-3-line"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-list align-items-center">
                            
                            <li class="nav-item nav-icon">
                                <?php if ($this->session->userdata('user_id')) { ?>
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
                                    <?php } ?>
                                <?php } else { ?>
                                    <a href="<?= base_url('auth/login') ?>" class="d-flex align-items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-log-in mr-2">
                                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                            <polyline points="10 17 15 12 10 7"></polyline>
                                            <line x1="15" y1="12" x2="3" y2="12"></line>
                                        </svg>
                                        <span>Login</span>
                                    </a>
                                <?php } ?>
                            </li>
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
                <div class="row m-sm-0 px-3">



                    <p>aa</p>
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
                        </span> <a href="#" class="">Webkit</a>.
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