<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row mt-3">
                <div class="col-6 col-md-6 col-sm-12">
                    <div class="card top-left shadow-showcase">
                        <div class="card-header">
                            <div class="float-left">
                                <h5 class="card-title mb-0">CNC Material</h5>
                            </div>
                            <div class="float-right">
                                <div class="form-group">
                                    <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#tambahCNCMaterial">
                                        <i class="las la-plus font-size-16 mt-1 mr-0"></i>
                                    </button>
                                    <div id="tambahCNCMaterial" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahCNCMaterialTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content border-radius-10">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="tambahCNCMaterialTitle">Tambah CNC Material</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= form_open('admin/tambah_cnc_material', ['id' => 'TambahMaterialForm']) ?>
                                                        <div class="row">
                                                            <div class="form-group col-sm-12">
                                                                <label for="nama">Nama Material:</label>
                                                                <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['nama']) ? 'is-invalid' : '' ?>" name="nama" id="nama" value="<?= isset($old['nama']) ? $old['nama'] : '' ?>" placeholder="Nama Material..">
                                                                <?php if (!empty($errors['nama'])): ?>
                                                                    <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="float-right">
                                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-outline-primary">Tambah Material</button>
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
                                        <?php foreach ($cnc_material as $index => $item) { ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $item['nama'] ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#edit_cnc_material<?= $index + 1 ?>">
                                                                <i class="las la-edit font-size-20 mr-0"></i>
                                                            </button>
                                                            <div id="edit_cnc_material<?= $index + 1 ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit_cnc_material<?= $index + 1 ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="edit_cnc_material<?= $index + 1 ?>Title">Edit CNC Material: <?= $item['nama'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?= form_open('admin/edit_cnc_material', ['id' => 'Editcnc_materialForm']) ?>
                                                                                <input type="hidden" name="material_id" value="<?= encrypt_id($item['id']) ?>">
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
                                                                                    <button type="submit" class="btn btn-outline-primary">Edit CNC Material</button>
                                                                                </div>
                                                                            <?= form_close() ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#delete_cnc_material<?= $index + 1 ?>">
                                                                <i class="las la-trash-alt font-size-16 mt-1 mr-0"></i>
                                                            </button>
                                                            <div id="delete_cnc_material<?= $index + 1 ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete_cnc_material<?= $index + 1 ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="delete_cnc_material<?= $index + 1 ?>Title">Hapus Material: <?= $item['nama'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?= form_open('admin/delete_cnc_material', ['id' => 'hapusItemrForm']) ?>
                                                                            <input type="hidden" name="material_id" value="<?= encrypt_id($item['id']) ?>">
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="form-group">
                                                                                        <img src="<?= base_url('public/local_assets/images/logo_danger_2.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                                    </div>
                                                                                    <div class="form-group ml-4">
                                                                                        <div class="row">
                                                                                            <h6>Yakin ingin menghapus CNC Material?</h6>
                                                                                            <span>CNC Material <strong class="text-danger"><?= $item['nama'] ?></strong> akan <span class="text-danger">terhapus</span> secara pemranen!</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="float-right">
                                                                                    <button type="submit" class="btn btn-outline-danger">Hapus CNC Material</button>
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
                <div class="col-6 col-md-6 col-sm-12">
                    <div class="card top-left shadow-showcase">
                        <div class="card-header">
                            <div class="float-left">
                                <h5 class="card-title mb-0">CNC Finishing</h5>
                            </div>
                            <div class="float-right">
                                <div class="form-group">
                                    <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#tambahCNCfinishing">
                                        <i class="las la-plus font-size-16 mt-1 mr-0"></i>
                                    </button>
                                    <div id="tambahCNCfinishing" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahCNCfinishingTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content border-radius-10">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="tambahCNCfinishingTitle">Tambah CNC Finishing</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= form_open('admin/tambah_cnc_finishing', ['id' => 'TambahfinishingForm']) ?>
                                                        <div class="row">
                                                            <div class="form-group col-sm-12">
                                                                <label for="nama">Nama Finishing:</label>
                                                                <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['nama']) ? 'is-invalid' : '' ?>" name="nama" id="nama" value="<?= isset($old['nama']) ? $old['nama'] : '' ?>" placeholder="Nama Finishing..">
                                                                <?php if (!empty($errors['nama'])): ?>
                                                                    <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="float-right">
                                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-outline-primary">Tambah CNC Finishing</button>
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
                                            <th>Nama</th>
                                            <th style="min-width: 100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cnc_finishing as $index => $item) { ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $item['nama'] ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#edit_cnc_finishing<?= $index + 1 ?>">
                                                                <i class="las la-edit font-size-20 mr-0"></i>
                                                            </button>
                                                            <div id="edit_cnc_finishing<?= $index + 1 ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit_cnc_finishing<?= $index + 1 ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="edit_cnc_finishing<?= $index + 1 ?>Title">Edit CNC Finishing: <?= $item['nama'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?= form_open('admin/edit_cnc_finishing', ['id' => 'Editcnc_finishingForm']) ?>
                                                                                <input type="hidden" name="finishing_id" value="<?= encrypt_id($item['id']) ?>">
                                                                                <div class="form-group">
                                                                                    <label for="nama<?= $index + 1 ?>">Nama Finishing:</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-prepend">
                                                                                            <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-at font-size-20"></i></span>
                                                                                        </div>
                                                                                        <input type="text" class="form-control <?= !empty($errors['nama']) ? 'is-invalid' : '' ?> max-height-40" name="nama" id="nama<?= $index + 1 ?>" value="<?= isset($old['nama']) ? $old['nama'] : $item['nama'] ?>" aria-label="Finishing" aria-describedby="basic-addon4">
                                                                                        <?php if (!empty($errors['nama'])): ?>
                                                                                            <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="float-right">
                                                                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-outline-primary">Edit CNC Finishing</button>
                                                                                </div>
                                                                            <?= form_close() ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#delete_cnc_finishing<?= $index + 1 ?>">
                                                                <i class="las la-trash-alt font-size-16 mt-1 mr-0"></i>
                                                            </button>
                                                            <div id="delete_cnc_finishing<?= $index + 1 ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete_cnc_finishing<?= $index + 1 ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="delete_cnc_finishing<?= $index + 1 ?>Title">Hapus Finishing: <?= $item['nama'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?= form_open('admin/delete_cnc_finishing', ['id' => 'hapusItemrForm']) ?>
                                                                            <input type="hidden" name="finishing_id" value="<?= encrypt_id($item['id']) ?>">
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="form-group">
                                                                                        <img src="<?= base_url('public/local_assets/images/logo_danger_2.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                                    </div>
                                                                                    <div class="form-group ml-4">
                                                                                        <div class="row">
                                                                                            <h6>Yakin ingin menghapus CNC Finishing?</h6>
                                                                                            <span>CNC Finishing <strong class="text-danger"><?= $item['nama'] ?></strong> akan <span class="text-danger">terhapus</span> secara pemranen!</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="float-right">
                                                                                    <button type="submit" class="btn btn-outline-danger">Hapus CNC Finishing</button>
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