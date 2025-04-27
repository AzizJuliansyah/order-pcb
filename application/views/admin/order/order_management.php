<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row m-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
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
                                <!-- <div class="d-flex flex-wrap align-items-center">
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

                                            <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="dropdownMenuButton03">
                                                <?= form_open('admin/order_management') ?>
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
                                                    $order_statuses = ['order_pending', 'order_processing', 'order_packing', 'order_shipping', 'order_completed', 'order_cancelled', 'order_refunded', 'order_failed'];
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
                                                    <div class="d-flex justify-content-between">
                                                        <button type="reset" class="btn btn-sm btn-light">Reset</button>
                                                        <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                                                    </div>
                                                <?= form_close() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="p-0">
                                    <strong class="row ml-1 p-0">Action Terpilih :</strong>
                                    <div class="row d-flex flex-wrap align-items-center">
                                        <div class="border-right btn-new mr-3 pr-3">
                                            <?= form_open('admin/ubah_status_order') ?>
                                            <div class="dropdown dropdown-project">
                                                <div class="dropdown-toggle" id="dropdownMenuButton03" data-toggle="dropdown">
                                                    <div class="btn bg-body">
                                                        <span class="h6">Ubah Payment/Order Status</span>
                                                        <i class="ri-arrow-down-s-line ml-2 mr-0"></i>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right p-3" style="min-width: 300px;" aria-labelledby="dropdownMenuButton03">

                                                    <?php
                                                    $statuses = [
                                                        'payment_status' => ['payment_pending', 'payment_process', 'payment_success', 'payment_cancelled'],
                                                        'order_status' => ['order_pending', 'order_processing', 'order_packing', 'order_shipping', 'order_completed', 'order_cancelled', 'order_refunded', 'order_failed']
                                                    ];
                                                    ?>

                                                    <?php foreach ($statuses as $type => $list): ?>
                                                        <label class="font-weight-bold text-uppercase mb-2"><?= str_replace('_', ' ', $type) ?></label>
                                                        <?php foreach ($list as $status): ?>
                                                            <div class="form-check mb-1">
                                                                <input class="form-check-input" type="radio" name="<?= $type ?>" id="<?= $type . '_' . $status ?>" value="<?= $status ?>"
                                                                    <?= (isset($_GET[$type]) && $_GET[$type] === $status) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="<?= $type . '_' . $status ?>">
                                                                    <?= ucfirst(str_replace('_', ' ', $status)) ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        <div class="form-check mb-1">
                                                            <input class="form-check-input" type="radio" name="<?= $type ?>" id="<?= $type ?>_none" value="" checked>
                                                            <label class="form-check-label text-muted" for="<?= $type ?>_none">
                                                                Tidak diubah
                                                            </label>
                                                        </div>
                                                        <hr>
                                                    <?php endforeach; ?>

                                                    <div class="text-right">
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#ubahStatusOrderBulk" onclick="tampilkanStatusTerpilih()">
                                                                Ubah Status Order
                                                            </button>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div id="ubahStatusOrderBulk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ubahStatusOrderBulkTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content border-radius-10">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title" id="ubahStatusOrderBulkTitle">Ubah Status Order Sejumlah: <span id="selected-count-ubahStatus">0</span> Order</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" value="" name="ubahStatus_order_ids_bulk" id="ubahStatus_order_ids_bulk">
                                                            <div class="d-flex align-items-center">
                                                                <div class="form-group">
                                                                    <img src="<?= base_url('public/local_assets/images/logo_danger_1.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                </div>
                                                                <div class="form-group ml-4">
                                                                    <div class="">
                                                                        <p class="h6">Yakin ingin mengubah status order?</p>
                                                                        <span>
                                                                            Order Code <strong class="text-danger" id="selected-order-codes-ubahStatus">...</strong>
                                                                        </span>
                                                                        <p style="margin-top: -20px;">
                                                                            <strong class="text-danger" id="selected-order-status-ubahStatus">...</strong>
                                                                        </p>
                                                                        <span>akan <span class="text-danger">terubah</span> status ordernya!
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="float-right">
                                                                <button type="submit" class="btn btn-outline-warning text-dark">Ubah Status order</button>
                                                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?= form_close() ?>
                                        </div>
                                        <div class="form-group m-1">
                                            <button type="button" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#deleteBulk">
                                                <i class="las la-trash-alt font-size-16 mt-1 mr-0"></i>
                                            </button>
                                            <div id="deleteBulk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteBulkTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content border-radius-10">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title" id="deleteBulkTitle">Hapus Sejumlah: <span id="selected-count-delete">0</span> Order</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?= form_open('admin/delete_order', ['id' => 'hapusOrderFormBulk']) ?>
                                                            <input type="hidden" value="" name="delete_order_ids_bulk" id="delete_order_ids_bulk">
                                                            <div class="d-flex align-items-center">
                                                                <div class="form-group">
                                                                    <img src="<?= base_url('public/local_assets/images/logo_danger_2.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                </div>
                                                                <div class="form-group ml-4">
                                                                    <div class="row">
                                                                        <h6>Yakin ingin menghapus order?</h6>
                                                                        <span>
                                                                            Order Code <strong class="text-danger" id="selected-order-codes-delete">...</strong> akan
                                                                            <span class="text-danger">terhapus</span> secara permanen!
                                                                        </span>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card bottom-right shadow-showcase">
                        <div class="card-header d-flex justify-content-between">
                        </div>
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
                                            <th>Order Created Date</th>
                                            <th style="min-width: 100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $index => $item) { ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td>
                                                    <input type="checkbox"
                                                        class="checkbox-input single-checkbox"
                                                        name="order_ids[]"
                                                        value="<?= encrypt_id($item['order_id']) ?>"
                                                        data-code="<?= $item['order_code'] ?>">
                                                </td>
                                                <td>
                                                    <h6 class="card-title mb-0">Order# <?= $item['order_code'] ?></h6>
                                                </td>
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
<!-- Wrapper End-->
<script>
    const base_url = "<?= base_url() ?>";
</script>

<script>
    function updateOrderIdsHidden() {
        const selected = document.querySelectorAll('.single-checkbox:checked');

        const orderIds = [];
        const orderCodes = [];

        selected.forEach(cb => {
            orderIds.push(cb.value);
            orderCodes.push('#' + cb.dataset.code);
        });

        document.getElementById('delete_order_ids_bulk').value = JSON.stringify(orderIds);
        const displayOrderCodesDelete = orderCodes.length ? orderCodes.join(', ') : '...';
        document.getElementById('selected-order-codes-delete').textContent = displayOrderCodesDelete;
        const countTextDelete = document.getElementById('selected-count-delete');
        if (countTextDelete) countTextDelete.textContent = orderCodes.length;

        document.getElementById('ubahStatus_order_ids_bulk').value = JSON.stringify(orderIds);
        const displayOrderCodesUbahStatus = orderCodes.length ? orderCodes.join(', ') : '...';
        document.getElementById('selected-order-codes-ubahStatus').textContent = displayOrderCodesUbahStatus;
        const countTextUbahStatus = document.getElementById('selected-count-ubahStatus');
        if (countTextUbahStatus) countTextUbahStatus.textContent = orderCodes.length;
    }

    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.single-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateOrderIdsHidden();
    });

    document.querySelectorAll('.single-checkbox').forEach(cb => {
        cb.addEventListener('change', updateOrderIdsHidden);
    });

    updateOrderIdsHidden();

    function tampilkanStatusTerpilih() {
        let payment = document.querySelector('input[name="payment_status"]:checked');
        let order = document.querySelector('input[name="order_status"]:checked');

        let paymentText = payment && payment.value ? payment.value.replace(/_/g, ' ') : 'Tidak diubah';
        let orderText = order && order.value ? order.value.replace(/_/g, ' ') : 'Tidak diubah';

        // Masukkan ke modal
        const targetElement = document.getElementById('selected-order-status-ubahStatus');
        targetElement.innerHTML = `<br>Payment Status: <strong>${paymentText}</strong><br>Order Status: <strong>${orderText}</strong>`;
    }
</script>




<script>
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

    $(document).on('shown.bs.modal', '.modal', function() {
        refreshModalCSRF(this);
    });
</script>