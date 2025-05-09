<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 col-md-6 col-sm-12">
                    <div class="card top-left shadow-showcase">
                        <div class="card-header">
                            <div class="float-left">
                                <h5 class="card-title mb-0">Shipping Status</h5>
                            </div>
                            <div class="float-right">
                                <div class="form-group">
                                    <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#tambahShippingStatus">
                                        <i class="las la-plus font-size-16 mt-1 mr-0"></i>
                                    </button>
                                    <div id="tambahShippingStatus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahShippingStatusTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content border-radius-10">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="tambahShippingStatusTitle">Tambah Shipping Status</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= form_open('admin/tambah_shipping_status', ['id' => 'TambahShippingStatusForm']) ?>
                                                        <div class="row">
                                                            <div class="form-group col-sm-12">
                                                                <label for="nama">Nama Shipping Status:</label>
                                                                <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['nama']) ? 'is-invalid' : '' ?>" name="nama" id="nama" value="<?= isset($old['nama']) ? $old['nama'] : '' ?>">
                                                                <?php if (!empty($errors['nama'])): ?>
                                                                    <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="float-right">
                                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-outline-primary">Tambah Shipping Status</button>
                                                        </div>
                                                    <?= form_close() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped mt-4" role="grid"
                                    aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr class="ligth">
                                            <th>#</th>
                                            <th>Item</th>
                                            <th style="min-width: 100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($shipping_status as $index => $item) { ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $item['nama'] ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#edit_shipping_status<?= $index + 1 ?>">
                                                                <i class="las la-edit font-size-20 mr-0"></i>
                                                            </button>
                                                            <div id="edit_shipping_status<?= $index + 1 ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit_shipping_status<?= $index + 1 ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="edit_shipping_status<?= $index + 1 ?>Title">Edit Shipping Status: <?= $item['nama'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?= form_open('admin/edit_shipping_status', ['id' => 'Editshipping_statusForm']) ?>
                                                                                <input type="hidden" name="shipping_status_id" value="<?= encrypt_id($item['id']) ?>">
                                                                                <div class="form-group">
                                                                                    <label for="nama<?= $index + 1 ?>">Nama Material:</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-at font-size-20"></i></span>
                                                                                        </div>
                                                                                        <input type="text" class="form-control <?= !empty($errors['nama']) ? 'is-invalid' : '' ?> max-height-40" name="nama" id="nama<?= $index + 1 ?>" value="<?= isset($old['nama']) ? $old['nama'] : $item['nama'] ?>" aria-label="New Password" aria-describedby="basic-addon4">
                                                                                        <?php if (!empty($errors['nama'])): ?>
                                                                                            <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="float-right">
                                                                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-outline-primary">Edit Shipping Status</button>
                                                                                </div>
                                                                            <?= form_close() ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#delete_shipping_status<?= $index + 1 ?>">
                                                                <i class="las la-trash-alt font-size-16 mt-1 mr-0"></i>
                                                            </button>
                                                            <div id="delete_shipping_status<?= $index + 1 ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete_shipping_status<?= $index + 1 ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="delete_shipping_status<?= $index + 1 ?>Title">Hapus Material: <?= $item['nama'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?= form_open('admin/delete_shipping_status', ['id' => 'hapusItemrForm']) ?>
                                                                            <input type="hidden" name="shipping_status_id" value="<?= encrypt_id($item['id']) ?>">
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="form-group">
                                                                                        <img src="<?= base_url('public/local_assets/images/logo_danger_2.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                                    </div>
                                                                                    <div class="form-group ml-4">
                                                                                        <div class="row">
                                                                                            <h6>Yakin ingin menghapus Shipping Status?</h6>
                                                                                            <span>Shipping Status <strong class="text-danger"><?= $item['nama'] ?></strong> akan <span class="text-danger">terhapus</span> secara pemranen!</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="float-right">
                                                                                    <button type="submit" class="btn btn-outline-danger">Hapus Shipping Status</button>
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