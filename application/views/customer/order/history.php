<!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card bottom-right shadow-showcase">
                            <div class="card-body">
                                <?= form_open('customer/history', ['method' => 'post']) ?>
                                    <div class="row breadcrumb-content">
                                        <div class="flex-grow-1 mb-2 ml-2">
                                            <div class="d-flex align-items-center">
                                                <input type="date" class="form-control border-radius-5 max-height-40" name="dari" value="<?= html_escape($dari) ?>">
                                                <strong class="ml-2 mr-2">-</strong>
                                                <input type="date" class="form-control border-radius-5 max-height-40" name="sampai" value="<?= html_escape($sampai) ?>">
                                            </div>
                                        </div>
                                    
                                        <div class="flex-grow-1 mb-2 ml-2">
                                            <div class="dropdown dropdown-project">
                                                <div class="dropdown-toggle" id="dropdownMenuButton03" data-toggle="dropdown">
                                                    <div class="btn bg-body">
                                                        <span class="h6">Status :</span>
                                                        <?php if (!empty($selected_payment_status)): ?>
                                                            <?= ucfirst(str_replace('_', ' ', $selected_payment_status)) ?>
                                                        <?php elseif (!empty($selected_order_status)): ?>
                                                            <?= ucfirst(str_replace('_', ' ', $selected_order_status)) ?>
                                                        <?php else: ?>
                                                                    Semua Status
                                                        <?php endif; ?>
                                                        <i class="ri-arrow-down-s-line ml-2 mr-0"></i>
                                                    </div>
                                                </div>

                                                <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="dropdownMenuButton03">
                                                    <div class="mb-2"><strong>Payment Status</strong></div>
                                                        <?php 
                                                                $payment_statuses = ['payment_pending', 'payment_process', 'payment_success', 'payment_cancelled'];
                                                                foreach ($payment_statuses as $status): ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="payment_status" id="payment_<?= $status ?>" value="<?= $status ?>"
                                                                    <?= (!empty($selected_payment_status) && $selected_payment_status == $status) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="payment_<?= $status ?>">
                                                                    <?= ucfirst(str_replace('_', ' ', $status)) ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>

                                                        <div class="dropdown-divider"></div>

                                                        <div class="mb-2"><strong>Order Status</strong></div>
                                                        <?php 
                                                                $order_statuses = ['order_pending', 'order_confirmed', 'order_processing', 'order_completed', 'order_cancelled', 'order_refunded', 'order_failed'];
                                                                foreach ($order_statuses as $status): ?>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="order_status" id="order_<?= $status ?>" value="<?= $status ?>"
                                                                    <?= (!empty($selected_order_status) && $selected_order_status == $status) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="order_<?= $status ?>">
                                                                    <?= ucfirst(str_replace('_', ' ', $status)) ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>

                                                        <div class="dropdown-divider"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 mb-2 ml-2">
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
                                            <div class="iq-header-title ml-2 mt-2 mr-2">
                                                <div class="d-flex justify-content-between mb-0">
                                                    <h5 class="card-title mb-0">Order # <?= $item['order_code'] ?></h5>
                                                    <p class="font-size-12 mb-0"><?= format_bulan($item['date_created']) ?></p>
                                                </div>
                                            </div>
                                            <div class="float-left" style="margin-top: -10px">
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
                                                        <span class="badge border border-info text-info font-size-12 m-2">Pesanan Diterima</span>
                                                    <?php elseif ($item['order_status'] == 'order_processing'): ?>
                                                        <span class="badge border border-primary text-primary font-size-12 m-2">Pesanan Diproses</span>
                                                    <?php elseif ($item['order_status'] == 'order_completed'): ?>
                                                        <span class="badge border border-success text-success font-size-12 m-2">Pesanan Selesai</span>
                                                    <?php elseif ($item['order_status'] == 'order_cancelled'): ?>
                                                        <span class="badge border border-danger text-danger font-size-12 m-2">Pesanan Dibatalkan</span>
                                                    <?php elseif ($item['order_status'] == 'order_refunded'): ?>
                                                        <span class="badge border border-secondary text-secondary font-size-12 m-2">Pesanan di refund</span>
                                                    <?php elseif ($item['order_status'] == 'order_failed'): ?>
                                                        <span class="badge border border-dark text-dark font-size-12 m-2">Pesanan gagal</span>
                                                    <?php else: ?>
                                                        <span class="badge border border-light text-light font-size-12 m-2">Status Tidak Diketahui</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body text-center p-0" style="margin-top: -15px">                            
                                            <div class="form-group rounded">
                                                <div class="d-flex align-items-start m-3">
                                                    <div class="text-left" style="margin-bottom: -20px">
                                                        <div class="iq-header-title">
                                                            <h5 class="card-title ">Total Harga :</h4>
                                                        </div>
                                                        <p style="margin-top: -20px">
                                                            <?= $item['total_price'] == 0 ? '-' : 'Rp. ' . number_format($item['total_price'], 2, ',', '.') ?>
                                                        </p>

                                                    </div>
                                                </div>
                                                    
                                                <div class="border-top ml-3 mr-3">
                                                    <div class="mt-2 d-flex justify-content-end">
                                                        <a href="<?= base_url('customer/order_detail/' . encrypt_id($item['order_id'])) . '?from=history' ?>" class="btn btn-primary font-size-14 d-flex align-items-center pr-0">
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
                                                        <span class="badge border border-info text-info font-size-12 m-2">Pesanan Diterima</span>
                                                    <?php elseif ($item['order_status'] == 'order_processing'): ?>
                                                        <span class="badge border border-primary text-primary font-size-12 m-2">Pesanan Diproses</span>
                                                    <?php elseif ($item['order_status'] == 'order_completed'): ?>
                                                        <span class="badge border border-success text-success font-size-12 m-2">Pesanan Selesai</span>
                                                    <?php elseif ($item['order_status'] == 'order_cancelled'): ?>
                                                        <span class="badge border border-danger text-danger font-size-12 m-2">Pesanan Dibatalkan</span>
                                                    <?php elseif ($item['order_status'] == 'order_refunded'): ?>
                                                        <span class="badge border border-secondary text-secondary font-size-12 m-2">Pesanan di refund</span>
                                                    <?php elseif ($item['order_status'] == 'order_failed'): ?>
                                                        <span class="badge border border-dark text-dark font-size-12 m-2">Pesanan gagal</span>
                                                    <?php else: ?>
                                                        <span class="badge border border-light text-light font-size-12 m-2">Status Tidak Diketahui</span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('customer/order_detail/' . encrypt_id($item['order_id'])) . '?from=history' ?>" class="btn btn-primary font-size-12 pr-0">
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

    