<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row m-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Details</li>
                        <li class="breadcrumb-item active" aria-current="page">User Add</li>
                    </ol>
                </nav>
            </div>
            <div class="row mt-3">
                <?php foreach ($role_list as $item): ?>
                    <a href="<?= base_url('administrator/user_list_role/' . urlencode(strtolower(str_replace(' ', '-', $item['jabatan']))) ) ?>" class="<?= ($item['role_id'] == 1) ? 'col-lg-12 col-md-12' : 'col-md-6 col-lg-6' ?>">
                        <div class="card bottom-right p-1 shadow-showcase mb-2">
                            <div class="card-body">
                                <div class="d-flex align-items-center text-primary">
                                    <h4 class="card-title text-primary mr-2"><?= $item['jabatan'] ?></h4>
                                    <i class="las la-angle-right font-size-20 mb-2"></i>
                                </div>
                                <div class="d-inline-block">
                                    <p class="card-text text-dark">Jumlah User di Role ini:</p>
                                    <div class="d-flex justify-content-center">
                                        <h3><?= number_format($item['total_user'], 0, ',', '.') ?></h3>
                                    </div>
                                </div>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <?= $item['last_created'] ? 'Last updated ' . time_ago($item['last_created']) : 'Belum ada user' ?>
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
<!-- Wrapper End-->