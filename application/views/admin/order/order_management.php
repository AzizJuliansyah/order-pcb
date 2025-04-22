<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row m-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" >
                        <li class="breadcrumb-item active" aria-current="page">Data Order</li>
                        <li class="breadcrumb-item active" aria-current="page">Order Management</li>
                    </ol>
                </nav>
            </div>
            <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="card bottom-right shadow-showcase">
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="border-right btn-new mr-3 pr-3">
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
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton03">
                                                    <?php 
                                                    $statuses = [
                                                        'payment_status' => ['payment_pending', 'payment_process', 'payment_success', 'payment_cancelled'],
                                                        'order_status' => ['order_pending', 'order_processing', 'order_packing', 'order_shipping', 'order_completed', 'order_cancelled', 'order_refunded', 'order_failed']
                                                    ];
                                                    ?>

                                                    <a class="dropdown-item" href="<?= base_url('admin/order_management?q=' . urlencode($search_keyword)) ?>">Semua Status</a>
                                                    <div class="dropdown-divider"></div>

                                                    <?php foreach ($statuses as $type => $list): ?>
                                                        <?php foreach ($list as $status): ?>
                                                            <a class="dropdown-item" href="<?= base_url('admin/order_management?' . $type . '=' . $status . '&q=' . urlencode($search_keyword)) ?>" <?= (isset($_GET[$type]) && $_GET[$type] === $status) ? '<strong>✔</strong> ' : '' ?>>
                                                                <?= ucfirst(str_replace('_', ' ', $status)) ?>
                                                            </a>
                                                        <?php endforeach; ?>
                                                        <div class="dropdown-divider"></div>
                                                    <?php endforeach; ?>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap align-items-center">
                                        <div class="border-right btn-new mr-3 pr-3">
                                            <div class="dropdown dropdown-project">
                                                <div class="dropdown-toggle" id="dropdownMenuButton03" data-toggle="dropdown">
                                                    <div class="btn bg-body">
                                                        <span class="h6">Payment/Order Status</span>
                                                        <i class="ri-arrow-down-s-line ml-2 mr-0"></i>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton03">
                                                    <?php 
                                                    $statuses = [
                                                        'payment_status' => ['payment_pending', 'payment_process', 'payment_success', 'payment_cancelled'],
                                                        'order_status' => ['order_pending', 'order_processing', 'order_packing', 'order_shipping', 'order_completed', 'order_cancelled', 'order_refunded', 'order_failed']
                                                    ];
                                                    ?>
                                                    
                                                    <div class="dropdown-divider"></div>

                                                    <?php foreach ($statuses as $type => $list): ?>
                                                        <?php foreach ($list as $status): ?>
                                                            <a class="dropdown-item" href="<?= base_url('admin/order_management?' . $type . '=' . $status . '&q=' . urlencode($search_keyword)) ?>" <?= (isset($_GET[$type]) && $_GET[$type] === $status) ? '<strong>✔</strong> ' : '' ?>>
                                                                <?= ucfirst(str_replace('_', ' ', $status)) ?>
                                                            </a>
                                                        <?php endforeach; ?>
                                                        <div class="dropdown-divider"></div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-1">
                                            <button type="button" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#deleteBulk">
                                                <i class="las la-trash-alt font-size-16 mt-1 mr-0"></i>
                                            </button>
                                            <div id="deleteBulk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteBulkTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content border-radius-10">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title" id="deleteBulkTitle">Hapus User: <?= $item['nama'] ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?= form_open('superadmin/delete_user', ['order_id' => 'hapusUserFormBulk']) ?>
                                                            <input type="hidden" name="user_id" value="Bulk">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-group">
                                                                        <img src="<?= base_url('public/local_assets/images/logo_danger_2.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                    </div>
                                                                    <div class="form-group ml-4">
                                                                        <div class="row">
                                                                            <h6>Yakin ingin menghapus user?</h6>
                                                                            <span>User <strong class="text-danger"><?= $item['nama'] ?></strong> akan <span class="text-danger">terhapus</span> secara pemranen!</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="float-right">
                                                                    <button type="submit" class="btn btn-outline-danger">Hapus User</button>
                                                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                </div>
                                                            <?= form_close() ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped mt-4" role="grid"
                                    aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr class="ligth">
                                            <th>#</th>
                                            <th>
                                                <input type="checkbox" class="checkbox-input" id="select-all">
                                            </th>
                                            <th>Order Code</th>
                                            <th>Profile</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Join Date</th>
                                            <th style="min-width: 100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $index => $item) { ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><input type="checkbox" class="checkbox-input" id="select-all<?= $item['order_id'] ?>"></td>
                                                <td><h6 class="card-title mb-0">Order# <?= $item['order_code'] ?></h6></td>
                                                <td>
                                                    <?php if ($item['foto'] != null) { ?>
                                                        <img src="<?= base_url('public/' . $item['foto']) ?>" class="img-fluid rounded-circle avatar-40" alt="image">
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="img-fluid rounded-circle avatar-40" alt="image">
                                                    <?php } ?>
                                                </td>
                                                <td><?= $item['nama'] ?></td>
                                                <td><?= $item['email'] ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <?php if ($item['payment_status'] == 'payment_pending'): ?>
                                                            <button type="button" class="btn font-size-12 btn-warning m-2">Menunggu Pembayaran</button>
                                                        <?php elseif ($item['payment_status'] == 'payment_process'): ?>
                                                            <button type="button" class="btn font-size-12 btn-info m-2">Pembayaran Diproses</button>
                                                        <?php elseif ($item['payment_status'] == 'payment_success'): ?>
                                                            <button type="button" class="btn font-size-12 btn-success m-2">Pembayaran Berhasil</button>
                                                        <?php elseif ($item['payment_status'] == 'payment_cancelled'): ?>
                                                            <button type="button" class="btn font-size-12 btn-danger m-2">Pembayaran Dibatalkan</button>
                                                        <?php else: ?>
                                                            <button type="button" class="btn font-size-12 btn-dark m-2">Status Tidak Diketahui</button>
                                                        <?php endif; ?>

                                                        <?php if ($item['order_status'] == 'order_pending'): ?>
                                                            <button type="button" class="btn font-size-12 btn-secondary m-2">Pesanan Menunggu</button>
                                                        <?php elseif ($item['order_status'] == 'order_processing'): ?>
                                                            <button type="button" class="btn font-size-12 btn-primary m-2">Sedang Diproses</button>
                                                        <?php elseif ($item['order_status'] == 'order_packing'): ?>
                                                            <button type="button" class="btn font-size-12 btn-secondary m-2">Sedang Packing</button>
                                                        <?php elseif ($item['order_status'] == 'order_shipping'): ?>
                                                            <button type="button" class="btn font-size-12 btn-warning m-2">Sedang Dikirim</button>
                                                        <?php elseif ($item['order_status'] == 'order_completed'): ?>
                                                            <button type="button" class="btn font-size-12 btn-success m-2">Pesanan Selesai</button>
                                                        <?php elseif ($item['order_status'] == 'order_cancelled'): ?>
                                                            <button type="button" class="btn font-size-12 btn-danger m-2">Pesanan Dibatalkan</button>
                                                        <?php elseif ($item['order_status'] == 'order_refunded'): ?>
                                                            <button type="button" class="btn font-size-12 btn-primary m-2">Pesanan di refund</button>
                                                        <?php elseif ($item['order_status'] == 'order_failed'): ?>
                                                            <button type="button" class="btn font-size-12 btn-danger m-2">Pesanan gagal</button>
                                                        <?php else: ?>
                                                            <button type="button" class="btn font-size-12 btn-dark m-2">Status Tidak Diketahui</button>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td><?= format_bulan($item['date_created']) ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-group m-1">
                                                                <a href="#" type="button" class="btn btn-sm bg-primary">
                                                                    <i class="las la-eye font-size-16 mt-1 mr-0"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#delete<?= $item['order_id'] ?>">
                                                                    <i class="las la-trash-alt font-size-16 mt-1 mr-0"></i>
                                                                </button>
                                                                <div id="delete<?= $item['order_id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete<?= $item['order_id'] ?>Title" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                        <div class="modal-content border-radius-10">
                                                                            <div class="modal-header border-bottom-0">
                                                                                <h5 class="modal-title" id="delete<?= $item['order_id'] ?>Title">Hapus order:# <?= $item['order_code'] ?></h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <?= form_open('admin/delete_order', ['id' => 'hapusorderForm' . $item['order_id']]) ?>
                                                                                <input type="hidden" name="order_id" value="<?= $item['order_id'] ?>">
                                                                                    <div class="d-flex align-items-center">
                                                                                        <div class="form-group">
                                                                                            <img src="<?= base_url('public/local_assets/images/logo_danger_2.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                                        </div>
                                                                                        <div class="form-group ml-4">
                                                                                            <div class="row">
                                                                                                <h6>Yakin ingin menghapus order?</h6>
                                                                                                <span>order <strong class="text-danger"># <?= $item['order_code'] ?></strong> akan <span class="text-danger">terhapus</span> secara pemranen!</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="float-right">
                                                                                        <button type="submit" class="btn btn-outline-danger">Hapus order</button>
                                                                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                <?= form_close() ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Wrapper End-->
<script>const base_url = "<?= base_url() ?>";</script>

<script>
    function togglePassword(id, iconId) {
        const input = document.getElementById(id);
        const icon = document.getElementById(iconId);

        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';

        icon.classList.toggle('la-eye', !isPassword);
        icon.classList.toggle('la-eye-slash', isPassword);
    }


    function refreshModalCSRF(modalSelector = '.modal') {
        $.get(base_url + 'csrf/get', function(res) {
            $(modalSelector).each(function() {
                const modal = $(this);
                const form = modal.find('form');

                if (form.length) {
                    form.each(function() {
                        const oldInput = $(this).find(`input[name="${res.token_name}"]`);

                        if (oldInput.length) {
                            oldInput.val(res.token_hash);
                        } else {
                            const input = `<input type="hidden" name="${res.token_name}" value="${res.token_hash}">`;
                            $(this).prepend(input);
                        }
                    });
                }
            });
        });
    }

    $(document).on('shown.bs.modal', '.modal', function () {
        refreshModalCSRF(this);
    });

</script>