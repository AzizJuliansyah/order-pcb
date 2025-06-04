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
    </style>

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --text-muted: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            overflow-x: hidden;
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            align-items: center;
            position: relative;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="circuit" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M20,20 L80,20 L80,80 L20,80 Z" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.2)"/><circle cx="80" cy="80" r="2" fill="rgba(255,255,255,0.2)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23circuit)"/></svg>') repeat;
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            max-width: 600px;
        }

        .cta-button {
            background: white;
            color: var(--primary-color);
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            color: var(--primary-color);
            text-decoration: none;
        }

        /* Section Styles */
        .section {
            padding: 5rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-muted);
            font-size: 1.1rem;
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Features Section */
        .features-section {
            background: var(--light-color);
        }

        .feature-card {
            background: white;
            padding: 1rem;
            border-radius: 15px;
            text-align: center;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .feature-text {
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Pricing Section */
        .pricing-card {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            position: relative;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .pricing-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .pricing-card.featured {
            border-color: var(--primary-color);
            transform: scale(1.05);
        }

        .pricing-card.featured::before {
            content: 'POPULER';
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-color);
            color: white;
            padding: 8px 25px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .price {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 1rem 0;
        }

        .price-unit {
            font-size: 1rem;
            color: var(--text-muted);
            font-weight: normal;
        }

        .pricing-features {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }

        .pricing-features li {
            padding: 0.5rem 0;
            color: var(--text-muted);
        }

        .pricing-features li i {
            color: var(--primary-color);
            margin-right: 0.5rem;
        }

        .pricing-button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }

        .pricing-button:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        /* Gallery Section */
        .gallery-section {
            background: var(--light-color);
        }

        

        .slide-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .slide-description {
            opacity: 0.9;
        }
        
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            position: relative;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="circuit-cta" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M20,20 L80,20 L80,80 L20,80 Z" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.2)"/><circle cx="80" cy="80" r="2" fill="rgba(255,255,255,0.2)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23circuit-cta)"/></svg>') repeat;
            opacity: 0.3;
        }

        .cta-content {
            position: relative;
            z-index: 2;
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        /* .carousel-inner {
            width: 100%;
            height: 400px;
            overflow: hidden;
        }
        .carousel-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        } */

        .carousel-item img {
            aspect-ratio: 16 / 9;
            width: 100%;
            object-fit: cover;
        }

        .cta-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .cta-buttons {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .cta-btn {
            display: inline-block;
            background: white;
            color: var(--primary-color);
            padding: 15px 30px;
            margin: 10px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            min-width: 140px;
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            color: var(--primary-color);
            text-decoration: none;
        }

        .cta-btn i {
            margin-right: 8px;
        }

        .register-btn {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .register-btn:hover {
            background: white;
            color: var(--primary-color);
        }

        /* Footer */
        .footer {
            background: var(--dark-color);
            color: white;
            padding: 3rem 0 1rem 0;
        }

        .footer-content {
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-brand {
            margin-bottom: 2rem;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .footer-logo i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-right: 10px;
        }

        .footer-logo span {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .footer-brand .brand-name {
            color: var(--primary-color);
            font-weight: 700;
        }

        .footer-contact {
            list-style: none;
            padding: 0;
        }

        .footer-contact li {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .footer-contact i {
            width: 20px;
            margin-right: 10px;
            color: var(--primary-color);
        }

        .footer-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--primary-color);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 1rem;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }

        .payment-methods {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 1rem;
        }

        .payment-icon {
            background: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 1.2rem;
            color: var(--dark-color);
        }

        .footer-bottom {
            padding-top: 1rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .pricing-card.featured {
                transform: none;
                margin-top: 2rem;
            }
            
            .gallery-arrow {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Animation */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .blog-slider {
            overflow: hidden;
            position: relative;
        }

        .slider-track {
            display: flex;
            transition: transform 0.5s ease;
            width: 100%;
        }

        .slide {
            flex: 0 0 100%;
            max-width: 100%;
            flex-wrap: wrap;
        }

        
        .pagination-info {
            color: #6c757d;
            font-size: 14px;
        }
        
        .view-all-link {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }
        
        .view-all-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        
        .nav-arrow {
            width: 40px;
            height: 40px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            margin: 0 5px;
        }
        
        .nav-arrow:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
        }
        
        .nav-arrow.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f8f9fa;
        }
        
        .nav-arrow.disabled:hover {
            background: #f8f9fa;
            border-color: #dee2e6;
        }
        
        .nav-arrow svg {
            width: 16px;
            height: 16px;
            color: #6c757d;
        }
        
        .controls-section {
            margin-top: 20px;
        }
        
        @media (max-width: 992px) {
            .blog-card {
                flex: 0 0 50%;
            }
        }
        
        @media (max-width: 768px) {
            .blog-card {
                flex: 0 0 50%;
            }
        }
        
        @media (max-width: 576px) {
            .blog-card {
                flex: 0 0 50%;
            }
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
                                <a href="#products" class="">
                                    <strong>Product</strong>
                                </a>
                            </li>
                            <li class="nav-item nav-icon nav-item-icon dropdown text-underline">
                                <a href="#pricing" class="">
                                    <strong>Pricing</strong>
                                </a>
                            </li>
                            <li class="nav-item nav-icon nav-item-icon dropdown text-underline">
                                <a href="#portfolio" class="">
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
        <div class="content-page p-0">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 p-0">

                        <section class="section mb-4" style="background-image: url('public/local_assets/images/background.jpg'); background-size: cover; background-position: center;">
                            <div class="container" style="height:  78vh;">
                                <div class="row">
                                    <div class="col-md-6 mt-5">
                                        <div class="hero-content">
                                            <h1 class="hero-title fade-in text-dark">PCB & CNC Professional Services</h1>
                                            <p class="hero-subtitle fade-in text-dark" style='font-family: "Ancizar Serif", serif;'>Solusi terdepan untuk kebutuhan PCB custom dan layanan CNC berkualitas tinggi dengan teknologi modern dan presisi tinggi.</p>
                                            <a href="#pricing" class="cta-button fade-in">Mulai Order Sekarang</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <img src="<?= base_url('public/local_assets/images/illustrator.png') ?>" class="img-fluid d-none d-md-block" alt="Illustration" width="100%">
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="section about-section" id="products">
                            <div class="container">
                                <div class="row align-items-center mb-5">
                                    <div class="col-lg-6">
                                        <div class="about-image fade-in">
                                            <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?w=600&h=400&fit=crop&auto=format" alt="PCB Manufacturing" class="img-fluid rounded shadow-lg">
                                            <div class="image-overlay">
                                                <div class="overlay-content">
                                                    <h4>PCB Manufacturing</h4>
                                                    <p>Teknologi terdepan untuk hasil presisi tinggi</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="about-content fade-in">
                                            <h2 class="about-title">Printed Circuit Board (PCB)</h2>
                                            <p class="about-description">
                                                PCB adalah fondasi dari setiap perangkat elektronik modern. Kami menyediakan layanan manufaktur PCB dengan berbagai spesifikasi, mulai dari single layer hingga multi-layer complex design.
                                            </p>
                                            <div class="about-features">
                                                <div class="feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>Single & Multi-layer PCB</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>Material berkualitas tinggi (FR4, Aluminum, Flexible)</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>Presisi hingga 0.1mm trace width</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>Surface Mount Technology (SMT) ready</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-lg-6 order-lg-2">
                                        <div class="about-image fade-in">
                                            <img src="https://images.unsplash.com/photo-1565106430482-8f6e74349ca1?w=600&h=400&fit=crop&auto=format" alt="CNC Machining" class="img-fluid rounded shadow-lg">
                                            <div class="image-overlay">
                                                <div class="overlay-content">
                                                    <h4>CNC Machining</h4>
                                                    <p>Precision engineering untuk komponen custom</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 order-lg-1">
                                        <div class="about-content fade-in">
                                            <h2 class="about-title">Computer Numerical Control (CNC)</h2>
                                            <p class="about-description">
                                                Layanan CNC machining kami menghadirkan presisi tinggi untuk kebutuhan komponen custom Anda. Dari prototyping hingga production scale, kami siap membantu mewujudkan desain Anda.
                                            </p>
                                            <div class="about-features">
                                                <div class="feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>3-axis, 4-axis, dan 5-axis machining</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>Material: Aluminum, Steel, Brass, Plastic</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>Toleransi ±0.01mm</span>
                                                </div>
                                                <div class="feature-item">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>Surface finishing & coating options</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Features Section -->
                        <section class="section features-section" id="features">
                            <div class="container">
                                <h2 class="section-title fade-in">Keunggulan Layanan Kami</h2>
                                <p class="section-subtitle fade-in">Mengapa memilih layanan PCB dan CNC dari kami</p>
                                
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="feature-card fade-in">
                                            <div class="feature-icon">
                                                <i class="las la-microchip"></i>
                                            </div>
                                            <h3 class="feature-title">Teknologi Modern</h3>
                                            <p class="feature-text">Menggunakan mesin CNC dan peralatan PCB terbaru dengan presisi tinggi untuk hasil yang sempurna.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="feature-card fade-in">
                                            <div class="feature-icon">
                                                <i class="las la-bolt"></i>
                                            </div>
                                            <h3 class="feature-title">Pengerjaan Cepat</h3>
                                            <p class="feature-text">Waktu pengerjaan yang efisien tanpa mengorbankan kualitas, dengan sistem tracking order real-time.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="feature-card fade-in">
                                            <div class="feature-icon">
                                                <i class="las la-shield-alt"></i>
                                            </div>
                                            <h3 class="feature-title">Kualitas Terjamin</h3>
                                            <p class="feature-text">Standar kualitas internasional dengan quality control ketat di setiap tahap produksi.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="feature-card fade-in">
                                            <div class="feature-icon">
                                                <i class="las la-headset"></i>
                                            </div>
                                            <h3 class="feature-title">Support 24/7</h3>
                                            <p class="feature-text">Tim support yang siap membantu Anda kapan saja dengan respon cepat dan solusi terbaik.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="feature-card fade-in">
                                            <div class="feature-icon">
                                                <i class="las la-shipping-fast"></i>
                                            </div>
                                            <h3 class="feature-title">Pengiriman Cepat</h3>
                                            <p class="feature-text">Jaringan pengiriman ke seluruh Indonesia dengan packaging aman dan tracking lengkap.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="feature-card fade-in">
                                            <div class="feature-icon">
                                                <i class="las la-tags"></i>
                                            </div>
                                            <h3 class="feature-title">Harga Kompetitif</h3>
                                            <p class="feature-text">Harga terbaik di kelasnya dengan berbagai paket yang dapat disesuaikan dengan budget Anda.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Pricing Section -->
                        <section class="section" id="pricing">
                            <div class="container">
                                <h2 class="section-title fade-in">Paket Harga</h2>
                                <p class="section-subtitle fade-in">Pilih paket yang sesuai dengan kebutuhan proyek Anda</p>
                                
                                <div class="row justify-content-center">
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="pricing-card fade-in">
                                            <h3>PCB Basic</h3>
                                            <div class="price">Rp 50K<span class="price-unit">/pcs</span></div>
                                            <ul class="pricing-features">
                                                <li><i class="las la-check"></i> Single Layer PCB</li>
                                                <li><i class="las la-check"></i> Ukuran maksimal 10x10cm</li>
                                                <li><i class="las la-check"></i> Material FR4 standar</li>
                                                <li><i class="las la-check"></i> Solder mask hijau</li>
                                                <li><i class="las la-check"></i> Pengerjaan 3-5 hari</li>
                                            </ul>
                                            <a href="#" class="pricing-button">Pilih Paket</a>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="pricing-card featured fade-in">
                                            <h3>PCB Professional</h3>
                                            <div class="price">Rp 120K<span class="price-unit">/pcs</span></div>
                                            <ul class="pricing-features">
                                                <li><i class="las la-check"></i> Double Layer PCB</li>
                                                <li><i class="las la-check"></i> Ukuran maksimal 15x15cm</li>
                                                <li><i class="las la-check"></i> Material FR4 premium</li>
                                                <li><i class="las la-check"></i> Pilihan warna solder mask</li>
                                                <li><i class="las la-check"></i> Via plating</li>
                                                <li><i class="las la-check"></i> Pengerjaan 2-3 hari</li>
                                            </ul>
                                            <a href="#" class="pricing-button">Pilih Paket</a>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="pricing-card fade-in">
                                            <h3>CNC Machining</h3>
                                            <div class="price">Rp 200K<span class="price-unit">/jam</span></div>
                                            <ul class="pricing-features">
                                                <li><i class="las la-check"></i> Presisi tinggi ±0.01mm</li>
                                                <li><i class="las la-check"></i> Berbagai material</li>
                                                <li><i class="las la-check"></i> 3D CAD support</li>
                                                <li><i class="las la-check"></i> Finishing berkualitas</li>
                                                <li><i class="las la-check"></i> Quality inspection</li>
                                            </ul>
                                            <a href="#" class="pricing-button">Pilih Paket</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="section" style="background-image: url('public/local_assets/images/bg2.jpg'); background-size: cover; background-position: center;">
                            <div class="container">
                                <div class="row align-items-center">
                                    <div class="col-lg-8">
                                        <div class="cta-content fade-in">
                                            <h1 class="cta-title text-white">Siap Memulai Proyek Anda?</h1>
                                            <p class="cta-subtitle text-white">Bergabunglah dengan ribuan customer yang telah mempercayakan kebutuhan PCB dan CNC mereka kepada kami. Dapatkan akses ke dashboard khusus untuk tracking order dan konsultasi gratis.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="cta-buttons fade-in">
                                            <a href="#" class="cta-btn login-btn">
                                                <i class="fas fa-sign-in-alt"></i>
                                                Login
                                            </a>
                                            <a href="#" class="cta-btn register-btn">
                                                <i class="fas fa-user-plus"></i>
                                                Register
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Gallery Section -->
                        <section class="section gallery-section" id="portfolio">
                            <div class="container">
                                <h2 class="section-title fade-in">Portfolio Karya Kami</h2>
                                <p class="section-subtitle fade-in">Lihat hasil kerja berkualitas tinggi yang telah kami kerjakan</p>
                                
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 fade-in">
                                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <?php foreach ($carousel_images as $index => $image): ?>
                                                    <li data-target="#carouselExampleCaptions" data-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></li>
                                                <?php endforeach; ?>
                                            </ol>

                                            <div class="carousel-inner rounded">
                                                <?php foreach ($carousel_images as $index => $image): ?>
                                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                        <img src="<?= base_url('public/' . $image->images) ?>" class="d-block w-100" alt="carousel">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h4 class="text-white"><?= htmlspecialchars($image->heading) ?></h4>
                                                            <p><?= htmlspecialchars($image->sub_heading) ?></p>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
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
                                </div>
                            </div>
                        </section>


                        <!-- Blog Section -->
                        <section class="section" id="blog">
                            <div class="container">
                                <h2 class="section-title fade-in">Blog Kami</h2>
                                <p class="section-subtitle fade-in">Lihat hasil karya tulis yang telah kami kerjakan</p>
                                <div class="row mx-1">
                                
                                    <div class="blog-slider overflow-hidden position-relative">
                                        <div class="slider-track d-flex transition" id="sliderWrapper">
                                            <?php foreach ($blogs as $i => $item): ?>
                                                <?php if ($i % 8 === 0): ?>
                                                    <?php if ($i > 0): ?>
                                                        </div> <!-- Tutup slide sebelumnya -->
                                                    <?php endif; ?>
                                                    <div class="slide d-flex flex-wrap"> <!-- Buka slide baru -->
                                                <?php endif; ?>

                                                <div class="blog-card col-6 col-lg-3 p-0">
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

                                                <?php if ($i === count($blogs) - 1): ?>
                                                    </div> <!-- Tutup slide terakhir -->
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    
                                    <div class="controls-section col-12">
                                        <div class="row d-flex justify-content-between align-items-center">
                                            <div class="col-md-6">
                                                <div class="text-center text-md-left">
                                                    <span class="pagination-info">Menampilkan <span id="currentStart">1</span>-<span id="currentEnd">8</span> dari <span id="totalBlogs">16</span> blog</span>
                                                    <br>
                                                    <a href="<?= base_url('blog') ?>" class="view-all-link">Lihat semua daftar blog</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-center text-md-right">
                                                    <div class="d-inline-flex">
                                                        <div class="nav-arrow" id="prevBtn">
                                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="nav-arrow" id="nextBtn">
                                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

        // Smooth scrolling for CTA button
        document.querySelector('.cta-button').addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('#pricing').scrollIntoView({
                behavior: 'smooth'
            });
        });

        class BlogSlider {
            constructor() {
                this.slider = document.getElementById('sliderWrapper');
                this.prevBtn = document.getElementById('prevBtn');
                this.nextBtn = document.getElementById('nextBtn');
                this.currentStart = document.getElementById('currentStart');
                this.currentEnd = document.getElementById('currentEnd');
                this.totalBlogs = document.getElementById('totalBlogs');
                
                this.currentSlide = 0;
                this.itemsPerSlide = 8; // Always 8 items per slide
                this.totalItems = document.querySelectorAll('.blog-card').length;
                this.totalSlides = Math.ceil(this.totalItems / this.itemsPerSlide);
                
                this.init();
            }
            
            init() {
                this.updatePagination();
                this.updateNavigation();
                
                this.prevBtn.addEventListener('click', () => this.prev());
                this.nextBtn.addEventListener('click', () => this.next());
            }
            
            prev() {
                if (this.currentSlide > 0) {
                    this.currentSlide--;
                    this.updateSlider();
                    this.updatePagination();
                    this.updateNavigation();
                }
            }
            
            next() {
                if (this.currentSlide < this.totalSlides - 1) {
                    this.currentSlide++;
                    this.updateSlider();
                    this.updatePagination();
                    this.updateNavigation();
                }
            }
            
            updateSlider() {
                const translateX = -(this.currentSlide * 100);
                this.slider.style.transform = `translateX(${translateX}%)`;
            }
            
            updatePagination() {
                const start = (this.currentSlide * this.itemsPerSlide) + 1;
                const end = Math.min((this.currentSlide + 1) * this.itemsPerSlide, this.totalItems);
                
                this.currentStart.textContent = start;
                this.currentEnd.textContent = end;
                this.totalBlogs.textContent = this.totalItems;
            }
            
            updateNavigation() {
                this.prevBtn.classList.toggle('disabled', this.currentSlide === 0);
                this.nextBtn.classList.toggle('disabled', this.currentSlide >= this.totalSlides - 1);
            }
        }
        
        // Initialize slider when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            new BlogSlider();
        });
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