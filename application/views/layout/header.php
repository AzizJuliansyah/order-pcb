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

    <link rel="stylesheet" href="<?= base_url('public/local_assets/css/local.css?v=1.0.0') ?>">

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