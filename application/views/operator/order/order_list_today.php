<!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid">
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="card bottom-right shadow-showcase">
                            <div class="card-body">
                                <?= form_open('operator/order_list', ['method' => 'post']) ?>
                                    <div class="d-flex justify-content-between row breadcrumb-content">
                                        <div class="mb-2 ml-1">
                                            <div class="iq-search-bar">
                                                <div class="searchbox">
                                                    <input type="text" class="text search-input" name="q" placeholder="Cari nama/email/order code..." value="<?= html_escape($search_keyword) ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    
                                        <div class="mb-2 ml-1">
                                                    <div class="list-grid-toggle d-flex align-items-center">
                                                        <div class="active">
                                                            <button type="submit" class="grid-icon border-0 mr-2 ml-2"><i class="ri-search-line mr-0"></i></button>
                                                        </div>
                                                        <div data-toggle-extra="tab" data-target-extra="#grid" class="active">
                                                            <div class="grid-icon mr-2">
                                                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                    <rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <div data-toggle-extra="tab" data-target-extra="#list">
                                                            <div class="grid-icon">
                                                                <svg  width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                    <line x1="21" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="3" y2="18"></line>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </div>
                                    </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="grid" class="item-content animate__animated animate__fadeIn active" data-toggle-extra="tab-content">
                    <div class="row">
                        <?php if (!empty($orders)): ?>
                            <?php foreach ($orders as $index => $item) { ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="card card-block card-stretch card-height bottom-right shadow-showcase">
                                        <div class="card-header border-bottom-0 p-0">
                                            <div class="iq-header-title m-2">
                                                <div class="d-flex justify-content-between">
                                                    <h5 class="card-title mb-0">Order# <?= $item['order_code'] ?></h5>
                                                    <p class="font-size-12"><?= format_bulan($item['date_created']) ?></p>
                                                </div>
                                            </div>
                                            <div class="float-right">
                                                <div class="d-flex align-items-center">
                                                    <?php if ($item['payment_status'] == 'payment_pending'): ?>
                                                        <span class="badge badge-warning font-size-12 m-2">Menunggu Pembayaran</span>
                                                    <?php elseif ($item['payment_status'] == 'payment_process'): ?>
                                                        <span class="badge badge-primary font-size-12 m-2">Pembayaran Diproses</span>
                                                    <?php elseif ($item['payment_status'] == 'payment_success'): ?>
                                                        <span class="badge badge-success font-size-12 m-2">Pembayaran Berhasil</span>
                                                    <?php elseif ($item['payment_status'] == 'payment_cancelled'): ?>
                                                        <span class="badge badge-dark font-size-12 m-2">Pembayaran Dibatalkan</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-light font-size-12 m-2">Status Tidak Diketahui</span>
                                                    <?php endif; ?>

                                                    <?php if ($item['order_status'] == 'order_pending'): ?>
                                                        <span class="badge border border-warning text-warning font-size-12 m-2">Pesanan Menunggu</span>
                                                    <?php elseif ($item['order_status'] == 'order_confirmed'): ?>
                                                        <span class="badge border border-secondary text-secondary font-size-12 m-2">Pesanan Diterima</span>
                                                    <?php elseif ($item['order_status'] == 'order_processing'): ?>
                                                        <span class="badge border border-primary text-primary font-size-12 m-2">Pesanan Diproses</span>
                                                    <?php elseif ($item['order_status'] == 'order_completed'): ?>
                                                        <span class="badge border border-success text-success font-size-12 m-2">Pesanan Selesai</span>
                                                    <?php elseif ($item['order_status'] == 'order_cancelled'): ?>
                                                        <span class="badge border border-danger text-danger font-size-12 m-2">Pesanan Dibatalkan</span>
                                                    <?php elseif ($item['order_status'] == 'order_refunded'): ?>
                                                        <span class="badge border border-info text-info font-size-12 m-2">Pesanan di refund</span>
                                                    <?php elseif ($item['order_status'] == 'order_failed'): ?>
                                                        <span class="badge border border-dark text-dark font-size-12 m-2">Pesanan gagal</span>
                                                    <?php else: ?>
                                                        <span class="badge border border-light text-light font-size-12 m-2">Status Tidak Diketahui</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body text-center p-0">                            
                                                <div class="form-group rounded">
                                                    <div class="d-flex align-items-start m-3">
                                                        <div class="mr-3">
                                                            <?php if ($item['foto'] != null) { ?>
                                                                <img src="<?= base_url('public/' . $item['foto']) ?>" class="img-fluid rounded-circle avatar-60" alt="image">
                                                            <?php } else { ?>
                                                                <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="img-fluid rounded-circle avatar-60" alt="image">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="text-left">
                                                            <div class="iq-header-title">
                                                                <h5 class="card-title mb-0"><?= $item['nama'] ?></h4>
                                                            </div>
                                                            <p class="mb-0"><?= $item['email'] ?></p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="border-top ml-3 mr-3">
                                                        <div class="mt-2 d-flex justify-content-end">
                                                            <a href="<?= base_url('operator/order_detail/' . encrypt_id($item['order_id'])) . '?from=list_today' ?>" class="btn btn-primary font-size-14 d-flex align-items-center pr-0">
                                                                <span class="mr-2">Detail Pesanan</span>
                                                                <i class="las la-angle-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            
                        <?php else: ?>
                            <div class="col-12">
                                <div class="text-center my-5 py-5">
                                    <i class="las la-box-open text-muted" style="font-size: 8rem;"></i>
                                    <h5 class="mt-3 text-muted">Belum ada data order</h5>
                                    <p class="text-muted">Semua order yang masuk akan ditampilkan di sini.</p>
                                </div>
                            </div>
                        <?php endif; ?>
                        

                    </div>
                </div>
                <div id="list" class="item-content animate__animated animate__fadeIn" data-toggle-extra="tab-content">
                    <?php if (!empty($orders)): ?>
                        <div class="table-responsive rounded bg-white mb-4">
                            <table class="table mb-0 table-borderless tbl-server-info">
                                <tbody>
                                    <?php foreach ($orders as $index => $item) { ?>
                                        <tr>
                                            <td>
                                                <div class="media align-items-center">
                                                    <?php if ($item['foto'] != null) { ?>
                                                        <img src="<?= base_url('public/' . $item['foto']) ?>" class="img-fluid rounded-circle avatar-40" alt="image">
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="img-fluid rounded-circle avatar-40" alt="image">
                                                    <?php } ?>
                                                    <h6 class="ml-3"><?= $item['nama'] ?></h5>
                                                </div>
                                            </td>
                                            <td><?= $item['email'] ?></td>
                                            <td>
                                                <h6 class="card-title mb-0">Order Code# <?= $item['order_code'] ?></h4>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <?php if ($item['payment_status'] == 'payment_pending'): ?>
                                                        <span class="badge badge-warning font-size-12 m-2">Menunggu Pembayaran</span>
                                                    <?php elseif ($item['payment_status'] == 'payment_process'): ?>
                                                        <span class="badge badge-primary font-size-12 m-2">Pembayaran Diproses</span>
                                                    <?php elseif ($item['payment_status'] == 'payment_success'): ?>
                                                        <span class="badge badge-success font-size-12 m-2">Pembayaran Berhasil</span>
                                                    <?php elseif ($item['payment_status'] == 'payment_cancelled'): ?>
                                                        <span class="badge badge-dark font-size-12 m-2">Pembayaran Dibatalkan</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-light font-size-12 m-2">Status Tidak Diketahui</span>
                                                    <?php endif; ?>

                                                    <?php if ($item['order_status'] == 'order_pending'): ?>
                                                        <span class="badge border border-warning text-warning font-size-12 m-2">Pesanan Menunggu</span>
                                                    <?php elseif ($item['order_status'] == 'order_confirmed'): ?>
                                                        <span class="badge border border-secondary text-secondary font-size-12 m-2">Pesanan Diterima</span>
                                                    <?php elseif ($item['order_status'] == 'order_processing'): ?>
                                                        <span class="badge border border-primary text-primary font-size-12 m-2">Pesanan Diproses</span>
                                                    <?php elseif ($item['order_status'] == 'order_completed'): ?>
                                                        <span class="badge border border-success text-success font-size-12 m-2">Pesanan Selesai</span>
                                                    <?php elseif ($item['order_status'] == 'order_cancelled'): ?>
                                                        <span class="badge border border-danger text-danger font-size-12 m-2">Pesanan Dibatalkan</span>
                                                    <?php elseif ($item['order_status'] == 'order_refunded'): ?>
                                                        <span class="badge border border-info text-info font-size-12 m-2">Pesanan di refund</span>
                                                    <?php elseif ($item['order_status'] == 'order_failed'): ?>
                                                        <span class="badge border border-dark text-dark font-size-12 m-2">Pesanan gagal</span>
                                                    <?php else: ?>
                                                        <span class="badge border border-light text-light font-size-12 m-2">Status Tidak Diketahui</span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('operator/order_detail/' . encrypt_id($item['order_id'])) . '?from=list_today' ?>" class="btn btn-primary font-size-14 d-flex align-items-center pr-0">
                                                    Detail Pesanan
                                                    <i class="las la-angle-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="text-center my-5 py-5">
                                <i class="las la-box-open text-muted" style="font-size: 8rem;"></i>
                                <h5 class="mt-3 text-muted">Belum ada data order</h5>
                                <p class="text-muted">Semua order yang masuk akan ditampilkan di sini.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <?= $pagination_links ?>
                </div>
                <!-- Page end  -->
            </div>
         </div>
    </div>
    <!-- Wrapper End-->

    