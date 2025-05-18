<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <?php 
                $role_styles = [
                    1 => ['icon' => 'las la-crown', 'color' => 'text-danger'],
                    2 => ['icon' => 'las la-tools', 'color' => 'text-primary'],
                    3 => ['icon' => 'las la-headset', 'color' => 'text-info'],
                    4 => ['icon' => 'las la-user-tag', 'color' => 'text-success'],
                ];
                ?>

                <?php foreach ($role_list as $item): ?>
                    <?php
                        

                        $icon = $role_styles[$item['role_id']]['icon'] ?? 'las la-users';
                        $color = $role_styles[$item['role_id']]['color'] ?? 'text-secondary';
                    ?>
                    <a href="<?= base_url('superadmin/user_list_role/' . urlencode(strtolower(str_replace(' ', '-', $item['jabatan']))) ) ?>" class="<?= ($item['role_id'] == 1) ? 'col-lg-12 col-md-12' : 'col-md-6 col-lg-6' ?>">
                        <div class="card bottom-right p-1 shadow-showcase mb-2">
                            <div class="card-body">
                                <div class="d-flex align-items-center <?= $color ?>">
                                    <i class="<?= $icon ?> font-size-32 mr-2"></i>
                                    <h4 class="card-title mr-2 mb-0"><?= $item['jabatan'] ?></h4>
                                    <i class="las la-angle-right font-size-20 mb-1 ml-auto"></i>
                                </div>
                                <div class="d-inline-block mt-2">
                                    <p class="card-text text-dark">Jumlah User di Role ini:</p>
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
                                
                                <p class="card-text mt-2">
                                    <small class="text-muted">
                                        <?= $item['last_created'] ? 'Last added user ' . time_ago($item['last_created']) : 'Belum ada user' ?>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End -->
