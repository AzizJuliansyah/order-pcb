<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row m-sm-0">
                
                <div class="col-12 mb-2">
                    <h3>Halo, <?= $user['nama'] ?></h5>
                </div>
                <div class="col-12 col-lg-8">
                    <!-- <h5 class="card-title mb-0">.</h5> -->
                    <div class="card">
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
                                <div class="col-sm-4 float-right">
                                    <div class="form-group">
                                        <a href="<?= base_url('order') ?>" class="btn btn-white link-shadow"><span class=" text-primary d-flex align-items-center mb-2">Add New Order <i class="las la-plus font-size-20 ml-2"></i></span></a>
                                        <a href="<?= base_url('customer/history') ?>" class="btn btn-white link-shadow"><span class=" text-primary d-flex align-items-center">History Transaksi</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <div class="card-body text-center p-0" style="margin-bottom: -15px">                            
                            <div class="form-group rounded mb-0">
                                <div class="d-flex align-items-start mb-3 ml-3 mr-3">
                                    <div class="text-left" style="margin-bottom: -20px">
                                        <div class="iq-header-title">
                                            <h5 class="card-title ">Total Harga :</h4>
                                        </div>
                                        <p style="margin-top: -20px">
                                            <?= $last_order['total_price'] == 0 ? '-' : 'Rp. ' . number_format($last_order['total_price'], 2, ',', '.') ?>
                                        </p>
                                    </div>
                                </div>
                                                        
                                <div class="border-top ml-3 mr-3">
                                    <div class="mt-2 d-flex align-items-center">
                                        <button type="button" class="btn btn-outline-warning mr-2" data-toggle="modal" data-target="#ShippingInfo"></i>Shipping Info</button>
                                        <div id="ShippingInfo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ShippingInfoTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content border-radius-10">
                                                <div class="modal-header">
                                                    <h4 class="card-title text-dark mb-0">Invoice# <?= $last_order['order_code'] ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group text-left">
                                                        <h6 class="card-title text-dark mb-0">Operator : <?= get_admin_name($last_order['operator']) ?></h6>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="divider-text">
                                                        <span>History Shipping Status</span>
                                                        </div>
                                                    </div>
                                                            
                                                    <div class="form-group mt-3 ml-3">
                                                        <div class="profile-line m-0 d-flex align-items-center justify-content-between position-relative">
                                                        <ul class="list-inline p-0 m-0 w-100">
                                                            <?php if (!empty($shipping_status_list)): ?>
                                                                <?php foreach ($shipping_status_list as $item): ?>
                                                                    <li>
                                                                    <div class="row align-items-top">
                                                                        <div class="col-md-12">
                                                                            <div class="media profile-media pb-3 align-items-top">
                                                                                <div class="profile-dots border-primary mt-1"></div>
                                                                                <div class="ml-4">
                                                                                <h6 style="margin-bottom: -8px;">
                                                                                    <?= get_shipping_status_name($item['shipping_id']) ?>
                                                                                </h6>
                                                                                <small class="text-muted">
                                                                                    <?= format_bulan($item['date']) ?>
                                                                                </small>
                                                                                </div>
                                                                            </div>   
                                                                        </div>
                                                                    </div>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <div class="col-12">
                                                                    <div class="text-center">
                                                                        <i class="las la-box-open text-muted" style="font-size: 5rem;"></i>
                                                                        <h6 class="text-muted">Belum ada history pengiriman</h6>
                                                                        <small class="text-muted">Semua history yang masuk akan ditampilkan di sini.</small>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <a href="<?= base_url('customer/order_detail/' . encrypt_id($last_order['order_id'])) . '?from=dashboard' ?>" class="btn btn-primary font-size-14 d-flex align-items-center pr-0">
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
                                    <h6 class="text-muted">Belum ada order yang masuk</h6>
                                    <small class="text-muted">Order terakhir yang masuk akan ditampilkan di sini.</small>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                
            </div>
            <div class="row m-sm-0">
                <div class="col-lg-12 mt-2">
                    <div class="card-transparent mb-0">
                        <div class="card-header d-flex align-items-center justify-content-between p-0 mb-1">
                            <div class="header-title">
                                <h5 class="card-title mb-0">Based Payment Status</h5>
                            </div>
                            <div class="card-header-toolbar d-flex align-items-center">
                                <div id="top-payment-slick-arrow" class="slick-aerrow-block">
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-unstyled row top-projects payment mb-0">
                                <?php
                                $payment_styles = [
                                    'payment_pending'   => ['icon' => 'las la-clock',     'color' => 'warning'],
                                    'payment_process'   => ['icon' => 'las la-sync-alt',  'color' => 'primary'],
                                    'payment_success'   => ['icon' => 'las la-check',     'color' => 'success'],
                                    'payment_cancelled' => ['icon' => 'las la-times',     'color' => 'danger'],
                                ];
                                ?>
                                
                                <?php foreach ($payment_stats as $status => $item): ?>
                                    <?php
                                        $icon = $payment_styles[$status]['icon'] ?? 'las la-question';
                                        $color = $payment_styles[$status]['color'] ?? 'secondary';
                                    ?>
                                    <li class="col-lg-4">
                                        <?= form_open('customer/history', ['method' => 'post', 'class' => 'payment-form']) ?>
                                            <input type="hidden" name="payment_status" value="<?= $status ?>">

                                            <div class="card" style="text-align: left;">
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
            <div class="row m-sm-0">
                <div class="col-lg-12">
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
                                        <?= form_open('customer/history', ['method' => 'post', 'class' => 'order-form']) ?>
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

