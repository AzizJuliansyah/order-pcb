<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid mb-5">
            <div class="row m-sm-0">
                <div class="col-lg-12 mb-1">
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="<?= base_url('customerservice/order_list') ?>" class="btn bg-secondary-light mb-1"><span class="text-dark d-flex align-items-center">Order List <i class="las la-angle-right font-size-20"></i></span></a>
                        </div>
                        <div class="col-lg-3">
                            <a href="<?= base_url('chat') ?>" class="btn bg-primary-light mb-1"><span class="text-dark d-flex align-items-center">Customer Chats <i class="las la-angle-right font-size-20"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
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
                                            <a href="<?= base_url('admin/order_detail/' . encrypt_id($last_order['order_id'])) . '?from=dashboard' ?>" class="btn btn-primary font-size-14 d-flex align-items-center pr-0">
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
                <div class="col-12 col-lg-8">
                    <!-- <h5 class="card-title mb-0">.</h5> -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 text-lg-center">
                                            <h2><span class="counter"><?= number_format($global_chat_stats['total_chats']) ?></span></h2>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mt-3 mt-md-0">
                                                <h5 class="mb-1">Total Chat Masuk</h5>
                                                <p class="card-text mb-0">
                                                    <small class="text-muted">
                                                        <?= $global_chat_stats['last_created'] ? 'Lastest chat added, ' . time_ago($global_chat_stats['last_created']) : 'Belum ada pesan  ' ?>
                                                    </small>
                                                </p>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="iq-media-group mt-1">
                                                        <?php foreach ($recent_chat_users as $user): ?>
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
                                    <a href="<?= base_url('chat') ?>" class="btn btn-white link-shadow"><span class=" text-primary d-flex align-items-center">Customer Chat <i class="las la-angle-right font-size-20"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 col-lg-6 py-0 mt-3 lastest-chat-list">
                    
                    <h5 class="mb-1">5 Chat Terakhir</h5>
                    <?php foreach ($recent_chat_users as $user): ?>
                        <a href="<?= base_url('chat') ?>" class="card mb-2 py-1 px-2 chat-user"
                            data-user-id="<?= $user['user_id'] ?>"
                            data-user-role-nama="<?= get_user_role($user['role_id']) ?>"
                            data-nama="<?= $user['nama'] ?>"
                            data-foto="<?= base_url('public/' . ($user['foto'] ?? 'local_assets/images/user_default.png')) ?>">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-start">
                                    <?php if ($user['foto'] != null) { ?>
                                            <img src="<?= base_url('public/' . $user['foto']) ?>" class="rounded avatar-60 mr-1" alt="<?= $user['nama'] ?>" width="40" height="40">
                                    <?php } else { ?>
                                            <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="rounded avatar-60 mr-1" alt="<?= $user['nama'] ?>" width="40" height="40">
                                    <?php } ?>
                                    <div class="flex-grow-1 p-0 mb-0 ml-3">
                                        <div class="d-flex align-items-center">
                                            <h6 class="text-dark d-inline-block text-truncate d-block d-sm-none" style="max-width: 115px;"><?= $user['nama'] ?> </h6>
                                            <div class="small ml-2 d-inline-block text-truncate d-block d-sm-none" style="max-width: 95px;">( <?= get_user_role($user['role_id']) ?> )</div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <h6 class="text-dark d-none d-md-block"><?= $user['nama'] ?> </h6>
                                            <div class="small ml-2 d-none d-md-block">( <?= get_user_role($user['role_id']) ?> )</div>
                                        </div>
                                        <?php
                                            $first_line = explode("\n", $user['last_message'])[0];
                                        ?>
                                        <div class="small text-muted d-inline-block text-truncate" style="max-width: 200px;margin-top: -5px">
                                            <?= htmlspecialchars($first_line) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-between align-items-end" style="min-height: 40px;">
                                    <div class="badge bg-success <?= $user['total_unread_counts'] > 0 ? '' : 'invisible' ?>">
                                        <?= $user['total_unread_counts'] ?>
                                    </div>
                                    <div class="small text-muted"><?= date('H:i', strtotime($user['last_chat_time'])) ?></div>
                                </div>

                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
                
                
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->


<script>
    $('.lastest-chat-list').on('click', '.chat-user', function (e) {
        const userId = $(this).data('user-id');
        const userRole = $(this).data('user-role-nama');
        const nama = $(this).data('nama');
        const foto = $(this).data('foto');

        
        

        localStorage.setItem('activeChatRoom', JSON.stringify({
            userId: userId,
            userRole: userRole,
            nama: nama,
            foto: foto
        }));
    });
</script>