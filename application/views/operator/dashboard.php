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
                <div class="col-12 col-lg-4 col-md-6">
                    <h5 class="card-title mb-0">Lastest Order</h5>
                    <div class="card card-block card-stretch card-height bottom-right shadow-showcase">
                        <?php if (!empty($last_order)): ?>
                            <div class="card-header border-bottom-0 p-0">
                                <div class="iq-header-title ml-2 mt-2 mr-2">
                                    <div class="d-flex justify-content-between mb-0">
                                        <h5 class="card-title mb-0">Order # <?= $last_order['order_code'] ?></h5>
                                        <p class="font-size-12 mb-0"><?= format_bulan($last_order['date_created']) ?></p>
                                    </div>
                                </div>
                                <div class="float-right mb-0">
                                    <div class="d-flex align-items-center">
                                        <?php if ($last_order['payment_status'] == 'payment_pending'): ?>
                                            <span class="badge badge-warning font-size-12 m-2">Menunggu Pembayaran</span>
                                        <?php elseif ($last_order['payment_status'] == 'payment_process'): ?>
                                            <span class="badge badge-primary font-size-12 m-2">Pembayaran Diproses</span>
                                        <?php elseif ($last_order['payment_status'] == 'payment_success'): ?>
                                            <span class="badge badge-success font-size-12 m-2">Pembayaran Berhasil</span>
                                        <?php elseif ($last_order['payment_status'] == 'payment_cancelled'): ?>
                                            <span class="badge badge-dark font-size-12 m-2">Pembayaran Dibatalkan</span>
                                        <?php else: ?>
                                            <span class="badge badge-light font-size-12 m-2">Status Tidak Diketahui</span>
                                        <?php endif; ?>
        
                                        <?php if ($last_order['order_status'] == 'order_pending'): ?>
                                            <span class="badge border border-warning text-warning font-size-12 m-2">Pesanan Menunggu</span>
                                        <?php elseif ($last_order['order_status'] == 'order_confirmed'): ?>
                                            <span class="badge border border-info text-info font-size-12 m-2">Pesanan Diterima</span>
                                        <?php elseif ($last_order['order_status'] == 'order_processing'): ?>
                                            <span class="badge border border-primary text-primary font-size-12 m-2">Pesanan Diproses</span>
                                        <?php elseif ($last_order['order_status'] == 'order_completed'): ?>
                                            <span class="badge border border-success text-success font-size-12 m-2">Pesanan Selesai</span>
                                        <?php elseif ($last_order['order_status'] == 'order_cancelled'): ?>
                                            <span class="badge border border-danger text-danger font-size-12 m-2">Pesanan Dibatalkan</span>
                                        <?php elseif ($last_order['order_status'] == 'order_refunded'): ?>
                                            <span class="badge border border-secondary text-secondary font-size-12 m-2">Pesanan di refund</span>
                                        <?php elseif ($last_order['order_status'] == 'order_failed'): ?>
                                            <span class="badge border border-dark text-dark font-size-12 m-2">Pesanan gagal</span>
                                        <?php else: ?>
                                            <span class="badge border border-light text-light font-size-12 m-2">Status Tidak Diketahui</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center p-0">                            
                                <div class="form-group rounded mb-0">
                                    <div class="d-flex align-items-start m-3">
                                        <div class="mr-3">
                                            <?php if ($last_order['foto'] != null) { ?>
                                                <img src="<?= base_url('public/' . $last_order['foto']) ?>" class="img-fluid rounded-circle avatar-60" alt="image">
                                            <?php } else { ?>
                                                <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="img-fluid rounded-circle avatar-60" alt="image">
                                            <?php } ?>
                                        </div>
                                        <div class="text-left">
                                            <div class="iq-header-title">
                                                <h5 class="card-title mb-0"><?= $last_order['nama'] ?></h4>
                                            </div>
                                            <p class="mb-0"><?= $last_order['email'] ?></p>
                                        </div>
                                    </div>
                                                            
                                    <div class="border-top ml-3 mr-3">
                                        <div class="mt-2 d-flex justify-content-end">
                                            <a href="<?= base_url('operator/order_detail/' . encrypt_id($last_order['order_id'])) . '?from=dashboard' ?>" class="btn btn-primary font-size-14 d-flex align-items-center pr-0">
                                                <span class="mr-2">Detail Pesanan</span>
                                                <i class="las la-angle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-12 mt-3">
                                <div class="text-center">
                                    <i class="las la-box-open text-muted" style="font-size: 5rem;"></i>
                                    <h6 class="text-muted">Belum ada order yang ditunjukkan untuk anda</h6>
                                    <small class="text-muted">Order terakhir yang masuk akan ditampilkan di sini.</small>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <!-- <h5 class="card-title mb-0">.</h5> -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 text-lg-center">
                                            <h2><span class="counter"><?= number_format($global_order_stats['total_orders']) ?></span></h2>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mt-3 mt-md-0">
                                                <h5 class="mb-1">Total Order Masuk</h5>
                                                <p class="card-text mb-0">
                                                    <small class="text-muted">
                                                        <?= $global_order_stats['last_created'] ? 'Last added order ' . time_ago($global_order_stats['last_created']) : 'Belum ada order' ?>
                                                    </small>
                                                </p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="iq-media-group mt-1">
                                                        <?php foreach ($recent_order_users as $user): ?>
                                                            <a href="#" class="iq-media">
                                                            <?php if ($user['foto'] != null) { ?>
                                                                <img src="<?= base_url('public/' . $user['foto']) ?>" class="img-fluid avatar-40 rounded-circle" alt="">
                                                            <?php } else { ?>
                                                                <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="img-fluid avatar-40 rounded-circle" alt="">
                                                            <?php } ?>
                                                            </a>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>                                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-sm-right">
                                    <a href="<?= base_url('operator/order_list_today') ?>" class="btn btn-white link-shadow"><span class=" text-primary d-flex align-items-center">Order Today <i class="las la-angle-right font-size-20"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            
            <div class="row m-sm-0">
                <div class="col-lg-12 mt-2">
                    <div class="card-transparent mb-0">
                        <div class="card-header d-flex align-items-center justify-content-between p-0 mb-1">
                            <div class="header-title">
                                <h5 class="card-title mb-0">Based Order Status</h5>
                            </div>
                            <div class="card-header-toolbar d-flex align-items-center">
                                <div id="top-order-slick-arrow" class="slick-aerrow-block">
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-unstyled row top-projects order mb-0">
                                <?php
                                $order_styles = [
                                    'order_pending'     => ['icon' => 'las la-hourglass-start', 'color' => 'warning'],
                                    'order_confirmed'   => ['icon' => 'las la-check-circle',    'color' => 'info'],
                                    'order_processing'  => ['icon' => 'las la-cogs',            'color' => 'primary'],
                                    'order_completed'   => ['icon' => 'las la-clipboard-check', 'color' => 'success'],
                                    'order_cancelled'   => ['icon' => 'las la-times-circle',    'color' => 'danger'],
                                    'order_refunded'    => ['icon' => 'las la-undo',            'color' => 'secondary'],
                                    'order_failed'      => ['icon' => 'las la-exclamation-triangle', 'color' => 'dark'],
                                ];
                                ?>
                                
                                <?php foreach ($order_stats as $status => $item): ?>
                                    <?php
                                        $icon = $order_styles[$status]['icon'] ?? 'las la-question-circle';
                                        $color = $order_styles[$status]['color'] ?? 'secondary';
                                    ?>

                                    <li class="col-lg-4">                               
                                        <?= form_open('operator/order_list', ['method' => 'post', 'class' => 'order-form']) ?>
                                            <input type="hidden" name="order_status" value="<?= $status ?>">

                                            <div class="card">
                                                <div class="card-body"> 
                                                    <h5 class="d-flex align-items-center text-<?= $color ?>">
                                                        <i class="<?= $icon ?> font-size-32 mr-2"></i>
                                                        <?= ucwords(str_replace('_', ' ', $status)) ?>
                                                    </h5>
                                                    <div class="d-inline-block mt-2 mb-2">
                                                        <div class="d-flex justify-content-center">
                                                            <h3><?= number_format($item['total_orders'], 0, ',', '.') ?> Order</h3>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn bg-<?= $color ?>-light"><span class="d-flex align-items-center">Periksa <i class="las la-angle-right font-size-20"></i></span></button>
                                                    </div>
                                                </div>
                                            </div>

                                        <?= form_close() ?>
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

