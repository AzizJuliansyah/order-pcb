<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                <i class="ri-menu-line wrapper-menu"></i>
                <a href="<?= base_url('') ?>" class="header-logo">
                    <h4 class="logo-title text-uppercase"><?= get_website_name() ?></h4>

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
                        <li class="nav-item nav-icon nav-item-icon dropdown">
                            <a href="<?= base_url('chat') ?>" class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#555" viewBox="0 0 24 24">
                                    <path d="M21 6.5a2.5 2.5 0 0 0-2.5-2.5h-13A2.5 2.5 0 0 0 3 6.5v8A2.5 2.5 0 0 0 5.5 17H6v3l4-3h8.5a2.5 2.5 0 0 0 2.5-2.5v-8zM5.5 5h13A1.5 1.5 0 0 1 20 6.5v8a1.5 1.5 0 0 1-1.5 1.5H9.672L7 18v-2.5H5.5A1.5 1.5 0 0 1 4 14.5v-8A1.5 1.5 0 0 1 5.5 5z"/>
                                </svg>
                                <?php if (get_total_unread_count() > 0) { ?>
                                    <div class="small" style="margin-top: -20px; margin-left: -15px;">
                                        <span class="badge bg-success text-white">
                                            <?= get_total_unread_count(); ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            </a>
                        </li>
                        <li class="nav-item nav-icon nav-item-icon dropdown">
                            <a href="#" class="search-toggle dropdown-toggle mr-2 d-flex align-items-center" id="dropdownMenuButton4"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="caption mr-2">
                                    <h6 class="mb-0 line-height font-weight-bold"><?= $user['nama'] ?></h6>
                                </div>
                                <div class="iq-avatar">
                                    <?php if ($user['foto'] != null) { ?>
                                        <img src="<?= base_url('public/' . $user['foto']) ?>" class="avatar-30 rounded-circle" alt="user">
                                    <?php } else { ?>
                                        <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="avatar-30 rounded-circle" alt="user">
                                    <?php } ?>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right border-none p-0" aria-labelledby="dropdownMenuButton">
                                <!-- <li class="dropdown-item d-flex align-items-center" style="max-height: 45px">
                                    <i class="las la-home font-size-20 text-primary"></i>
                                    <a href="<?= base_url('home') ?>">Home</a>
                                </li> -->
                                <?php if (has_access(['1'])) { ?>
                                    <li class="dropdown-item d-flex align-items-center" style="max-height: 45px">
                                        <i class="las la-tachometer-alt font-size-20 text-primary"></i>
                                        <a href="<?= base_url('superadmin/dashboard') ?>">Dashboard</a>
                                    </li>
                                <?php } elseif (has_access(['2'])) { ?>
                                    <li class="dropdown-item d-flex align-items-center" style="max-height: 45px">
                                        <i class="las la-tachometer-alt font-size-20 text-primary"></i>
                                        <a href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
                                    </li>
                                <?php } elseif (has_access(['3'])) { ?>
                                    <li class="dropdown-item d-flex align-items-center" style="max-height: 45px">
                                        <i class="las la-tachometer-alt font-size-20 text-primary"></i>
                                        <a href="<?= base_url('operator/dashboard') ?>">Dashboard</a>
                                    </li>
                                <?php } elseif (has_access(['4'])) { ?>
                                    <li class="dropdown-item d-flex align-items-center" style="max-height: 45px">
                                        <i class="las la-tachometer-alt font-size-20 text-primary"></i>
                                        <a href="<?= base_url('customerservice/dashboard') ?>">Dashboard</a>
                                    </li>
                                <?php } elseif (has_access(['5'])) { ?>
                                    <li class="dropdown-item d-flex align-items-center" style="max-height: 45px">
                                        <i class="las la-tachometer-alt font-size-20 text-primary"></i>
                                        <a href="<?= base_url('customer/dashboard') ?>">Dashboard</a>
                                    </li>
                                <?php } ?>
                                <li class="dropdown-item d-flex align-items-center" style="max-height: 45px">
                                    <i class="las la-shopping-bag font-size-20 text-primary"></i>
                                    <a href="<?= base_url('order') ?>">Order</a>
                                </li>
                                <li class="dropdown-item d-flex align-items-center border-top" style="max-height: 45px">
                                    <i class="las la-user-circle font-size-20 text-primary"></i>
                                    <a href="<?= base_url('user/profile') ?>">My Profile</a>
                                </li>
                                <li class="dropdown-item d-flex align-items-center" style="max-height: 45px">
                                    <i class="las la-user-edit font-size-20 text-primary"></i>
                                    <a href="<?= base_url('user/edit_profile') ?>">Edit Profile</a>
                                </li>
                                <li class="dropdown-item d-flex align-items-center border-top" style="max-height: 45px">
                                    <i class="las la-sign-out-alt font-size-20 text-primary"></i>
                                    <a href="<?= base_url('auth/logout') ?>">Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>