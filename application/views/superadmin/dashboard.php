<!-- Wrapper Start -->
<style>
.dashboard-wrapper::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    <?php if ($background_dipakai === 'color'): ?>
        background: <?= $background['color'] ?>;
    <?php elseif ($background_dipakai === 'gradient'): ?>
        background: <?= $background['gradient'] ?>;
    <?php elseif ($background_dipakai === 'image'): ?>
        background-image: url('<?= base_url('public/' . $background['image']) ?>');
    <?php endif; ?>
}
</style>


<div class="wrapper dashboard-wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row m-sm-0">
                <div class="col-lg-12 mb-1">
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="<?= base_url('superadmin/ui_ux') ?>" class="btn bg-secondary-light mb-1"><span class="text-dark d-flex align-items-center">UI/UX Settings <i class="las la-angle-right font-size-20"></i></span></a>
                        </div>
                        <div class="col-lg-3">
                            <a href="<?= base_url('superadmin/auth_google') ?>" class="btn bg-primary-light mb-1"><span class="text-dark d-flex align-items-center">Auth Google Settings <i class="las la-angle-right font-size-20"></i></span></a>
                        </div>
                        <div class="col-lg-3">
                            <a href="<?= base_url('superadmin/midtrans_credential') ?>" class="btn bg-info-light mb-1"><span class="text-dark d-flex align-items-center">Midtrans Settings <i class="las la-angle-right font-size-20"></i></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                        <h2><span class="counter"><?= number_format($global_user_stats['total_user']) ?></span></h2>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mt-3 mt-md-0">
                                                <h5 class="mb-1">Total User</h5>
                                                <p class="card-text mb-0">
                                                    <small class="text-muted">
                                                        <?= $global_user_stats['last_created'] ? 'Last added user ' . time_ago($global_user_stats['last_created']) : 'Belum ada user' ?>
                                                    </small>
                                                </p>
                                                <div class="d-flex justify-content-between mt-1">
                                                    <button type="button" class="btn mr-1 bg-success-light">
                                                        Active : 
                                                        <span class="badge badge-success ml-2"><?= number_format($global_user_stats['total_aktif']) ?></span>
                                                    </button>
                                                    <button type="button" class="btn ml-1 bg-danger-light">
                                                        Inactive : 
                                                        <span class="badge badge-danger ml-2"><?= number_format($global_user_stats['total_nonaktif']) ?></span>
                                                    </button>
                                                </div>
                                            </div>                                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-sm-right">
                                    <a href="<?= base_url('superadmin/add_new_user') ?>" class="btn btn-white text-primary link-shadow">Add New User <i class="las la-plus font-size-20"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card-transparent mb-0">
                        <div class="card-header d-flex align-items-center justify-content-between p-0 pb-3">
                            <div class="header-title">
                                <h5 class="card-title">Based Role's</h5>
                            </div>
                            <div class="card-header-toolbar d-flex align-items-center">
                                <div id="top-standard-slick-arrow" class="slick-aerrow-block">
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-unstyled row top-projects standard mb-0">
                                <?php 
                                $role_styles = [
                                    1 => ['icon' => 'las la-crown', 'color' => 'danger'],
                                    2 => ['icon' => 'las la-tools', 'color' => 'primary'],
                                    3 => ['icon' => 'las la-headset', 'color' => 'info'],
                                    4 => ['icon' => 'las la-user-tag', 'color' => 'success'],
                                    5 => ['icon' => 'las la-users', 'color' => 'secondary'],
                                ];
                                ?>
                                <?php foreach ($role_list as $item): ?>
                                    <?php
                                        

                                        $icon = $role_styles[$item['role_id']]['icon'] ?? 'las la-users';
                                        $color = $role_styles[$item['role_id']]['color'] ?? 'text-secondary';
                                    ?>
                                    <li class="col-lg-4">                                    
                                        <div class="card">
                                            <div class="card-body"> 
                                                <h5 class="d-flex align-items-center text-<?= $color ?>"><i class="<?= $icon ?> font-size-32 mr-2"></i><?= $item['jabatan'] ?></h5>
                                                <div class="d-inline-block mt-2 mb-2">
                                                    <div class="d-flex justify-content-center">
                                                        <h3><?= number_format($item['total_user'], 0, ',', '.') ?></h3>
                                                    </div>
                                                    <div class="d-flex justify-content-between mt-1">
                                                        <button type="button" class="btn mr-1 bg-success-light">
                                                            Active : 
                                                            <span class="badge badge-success ml-2"><?= number_format($item['total_aktif']) ?></span>
                                                        </button>
                                                        <button type="button" class="btn ml-1 bg-danger-light">
                                                            Inactive : 
                                                            <span class="badge badge-danger ml-2"><?= number_format($item['total_nonaktif']) ?></span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="iq-media-group mt-1">
                                                        <?php foreach ($recent_users_per_role[$item['role_id']] ?? [] as $user): ?>
                                                            <a href="#" class="iq-media">
                                                            <?php if ($user['foto'] != null) { ?>
                                                                <img src="<?= base_url('public/' . $user['foto']) ?>" class="img-fluid avatar-40 rounded-circle" alt="">
                                                            <?php } else { ?>
                                                                <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="img-fluid avatar-40 rounded-circle" alt="">
                                                            <?php } ?>
                                                            </a>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div>
                                                        <a href="<?= base_url('superadmin/user_list_role/' . urlencode(strtolower(str_replace(' ', '-', $item['jabatan']))) ) ?>" class="btn bg-<?= $color ?>-light d-flex align-items-center">Detail <i class="las la-angle-right font-size-20"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->
