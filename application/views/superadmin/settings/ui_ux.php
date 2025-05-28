<!-- Wrapper Start -->
<style>
    .dragover {
        border: 2px dashed #007bff;
        background-color: #f0f8ff;
    }
</style>



<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card top-left shadow-showcase">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title"><?= $title ?></h4>
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
                                            <th>Info</th>
                                            <th>Last Updated</th>
                                            <th style="min-width: 100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($settings as $index => $item) { ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td>
                                                    <?php if (!empty($item['item']) && file_exists('./public/' . $item['item'])) { ?>
                                                        <img src="<?= base_url('public/' . $item['item']) ?>" class="img-fluid" width="35">
                                                    <?php } else { ?>
                                                        <?= $item['item'] ?>
                                                    <?php } ?>
                                                </td>
                                                <td><?= $item['info'] ?></td>
                                                <td><?= format_bulan($item['date_updated']) ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#edit_settings<?= $item['id'] ?>">
                                                                <i class="las la-edit font-size-20 mr-0"></i>
                                                            </button>
                                                            <div id="edit_settings<?= $item['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit_settings<?= $item['id'] ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="edit_settings<?= $item['id'] ?>Title">Edit Settings: <?= $item['info'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?php if ($item['id'] == 4) { ?>
                                                                                <?= form_open('superadmin/edit_settings', ['id' => 'EditSettingsForm' . $item['id']]) ?>
                                                                                    <input type="hidden" name="settings_id" value="<?= encrypt_id($item['id']) ?>">
                                                                                    <div class="form-group">
                                                                                        <label for="item<?= $item['id'] ?>">Settings:</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-prepend">   
                                                                                                <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-at font-size-20"></i></span>
                                                                                            </div>
                                                                                            <input type="text" class="form-control <?= !empty($errors['item']) ? 'is-invalid' : '' ?> max-height-40" name="item" id="item<?= $item['id'] ?>" value="<?= isset($old['item']) ? $old['item'] : $item['item'] ?>" aria-label="New Password" aria-describedby="basic-addon4">
                                                                                            <?php if (!empty($errors['item'])): ?>
                                                                                                <div class="invalid-feedback"><?= $errors['item'] ?></div>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="float-right">
                                                                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-outline-primary">Edit Settings</button>
                                                                                    </div>
                                                                                <?= form_close() ?>
                                                                            <?php } elseif ($item['id'] == 3) { ?>
                                                                                <?= form_open_multipart('superadmin/edit_settings', ['id' => 'file-upload-form']) ?>
                                                                                    <input type="hidden" name="settings_id" value="<?= encrypt_id($item['id']) ?>">
                                                                                    <div class="uploader-file file-drag">
                                                                                        <input type="file" name="item" accept="image/*" class="file-upload" style="display: none;" />
                                                                                        <label class="file-label">
                                                                                            <img src="#" alt="Preview" class="file-image hidden mb-2" style="max-width: 100px;">
                                                                                            
                                                                                            <span class="start-one">
                                                                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                                                                <span class="d-block">Select a file or drag here</span>
                                                                                                <span class="not-image hidden d-block text-danger">Please select image</span>
                                                                                                <span class="file-upload-btn btn btn-primary text-white mt-2">Select a file</span>
                                                                                            </span>

                                                                                            
                                                                                        </label>

                                                                                        <?php if (!empty($errors['images'])): ?>
                                                                                            <div class="invalid-feedback d-block"><?= $errors['images'] ?></div>
                                                                                        <?php endif; ?>
                                                                                    </div>

                                                                                    <div class="float-right">
                                                                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-outline-primary">Upload image</button>
                                                                                    </div>
                                                                                <?= form_close() ?>
                                                                            <?php } ?>
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
                <div class="col-12 col-lg-6">
                    <div class="card top-left shadow-showcase">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Carousel Images</h4>
                            </div>
                            <div class="row">
                                <div class="form-group m-1">
                                    <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#tambah_carousel_images">
                                        <i class="las la-plus font-size-20 mr-0"></i>
                                    </button>
                                    <div id="tambah_carousel_images" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambah_carousel_imagesTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                            <div class="modal-content border-radius-10">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="tambah_carousel_imagesTitle">Tambah Carousel Images:</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?= form_open_multipart('superadmin/tambah_carousel_images', ['id' => 'file-upload-form']) ?>
                                                        <div class="uploader-file file-drag">
                                                            <input type="file" name="image" accept="image/*" class="file-upload" style="display: none;" />
                                                            <label class="file-label">
                                                                <img src="#" alt="Preview" class="file-image hidden mb-2" style="max-width: 100px;">
                                                                <span class="start-one">
                                                                    <i class="fa fa-download" aria-hidden="true"></i>
                                                                    <span class="d-block">Select a file or drag here</span>
                                                                    <span class="not-image hidden d-block text-danger">Please select image</span>
                                                                    <span class="file-upload-btn btn btn-primary text-white mt-2">Select a file</span>
                                                                </span>           
                                                            </label>

                                                            <?php if (!empty($errors['images'])): ?>
                                                                <div class="invalid-feedback d-block"><?= $errors['images'] ?></div>
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="heading">Heading:</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control <?= !empty($errors['heading']) ? 'is-invalid' : '' ?> border-radius-5 max-height-40" name="heading" id="heading" value="<?= isset($old['heading']) ? $old['heading'] : '' ?>">
                                                                <?php if (!empty($errors['heading'])): ?>
                                                                    <div class="invalid-feedback"><?= $errors['heading'] ?></div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sub_heading">Sub Heading:</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control <?= !empty($errors['sub_heading']) ? 'is-invalid' : '' ?> border-radius-5 max-height-40" name="sub_heading" id="sub_heading" value="<?= isset($old['sub_heading']) ? $old['sub_heading'] : '' ?>">
                                                                <?php if (!empty($errors['sub_heading'])): ?>
                                                                    <div class="invalid-feedback"><?= $errors['sub_heading'] ?></div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>

                                                        <div class="float-right">
                                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-outline-primary">Tambah Carousel images</button>
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
                                            <th>Images</th>
                                            <th>Heading</th>
                                            <th>Sub Heading</th>
                                            <th>Last Updated</th>
                                            <th style="min-width: 100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($carousel_images as $index => $item) { ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td>
                                                    <?php if (!empty($item['images']) && file_exists('./public/' . $item['images'])) { ?>
                                                        <img src="<?= base_url('public/' . $item['images']) ?>" class="img-fluid" width="35">
                                                    <?php } else { ?>
                                                        <?= $item['images'] ?>
                                                    <?php } ?>
                                                </td>
                                                <td><?= $item['heading'] ?></td>
                                                <td><?= $item['sub_heading'] ?></td>
                                                <td><?= format_bulan($item['date_updated']) ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-group mb-0 mr-1">
                                                            <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#edit_carousel_images<?= $item['id'] ?>">
                                                                <i class="las la-edit font-size-20 mr-0"></i>
                                                            </button>
                                                            <div id="edit_carousel_images<?= $item['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="edit_carousel_images<?= $item['id'] ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="edit_carousel_images<?= $item['id'] ?>Title">Edit Carousel Images: <?= $item['heading'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?= form_open_multipart('superadmin/edit_carousel_images', ['id' => 'file-upload-form']) ?>
                                                                                <input type="hidden" name="carousel_images_id" value="<?= encrypt_id($item['id']) ?>">
                                                                                <div class="uploader-file file-drag">
                                                                                    <input type="file" name="image" accept="image/*" class="file-upload" style="display: none;" />
                                                                                    <label class="file-label">
                                                                                        <img src="#" alt="Preview" class="file-image hidden mb-2" style="max-width: 100px;">
                                                                                        <span class="start-one">
                                                                                            <i class="fa fa-download" aria-hidden="true"></i>
                                                                                            <span class="d-block">Select a file or drag here</span>
                                                                                            <span class="not-image hidden d-block text-danger">Please select image</span>
                                                                                            <span class="file-upload-btn btn btn-primary text-white mt-2">Select a file</span>
                                                                                        </span>           
                                                                                    </label>

                                                                                    <?php if (!empty($errors['images'])): ?>
                                                                                        <div class="invalid-feedback d-block"><?= $errors['images'] ?></div>
                                                                                    <?php endif; ?>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label for="heading">Heading:</label>
                                                                                    <div class="input-group">
                                                                                        <input type="text" class="form-control <?= !empty($errors['heading']) ? 'is-invalid' : '' ?> border-radius-5 max-height-40" name="heading" id="heading" value="<?= isset($old['heading']) ? $old['heading'] : $item['heading'] ?>">
                                                                                        <?php if (!empty($errors['heading'])): ?>
                                                                                            <div class="invalid-feedback"><?= $errors['heading'] ?></div>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="sub_heading">Sub Heading:</label>
                                                                                    <div class="input-group">
                                                                                        <input type="text" class="form-control <?= !empty($errors['sub_heading']) ? 'is-invalid' : '' ?> border-radius-5 max-height-40" name="sub_heading" id="sub_heading" value="<?= isset($old['sub_heading']) ? $old['sub_heading'] : $item['sub_heading'] ?>">
                                                                                        <?php if (!empty($errors['sub_heading'])): ?>
                                                                                            <div class="invalid-feedback"><?= $errors['sub_heading'] ?></div>
                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="float-right">
                                                                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-outline-primary">Edit Carousel images</button>
                                                                                </div>
                                                                            <?= form_close() ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <button type="button" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#delete_carousel_images<?= $index + 1 ?>">
                                                                <i class="las la-trash-alt font-size-16 mt-1 mr-0"></i>
                                                            </button>
                                                            <div id="delete_carousel_images<?= $index + 1 ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete_carousel_images<?= $index + 1 ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="delete_carousel_images<?= $index + 1 ?>Title">Hapus Carousel Images: <?= $item['heading'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?= form_open('superadmin/delete_carousel_images', ['id' => 'hapusItemrForm']) ?>
                                                                            <input type="hidden" name="carousel_images_id" value="<?= encrypt_id($item['id']) ?>">
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="form-group">
                                                                                        <img src="<?= base_url('public/local_assets/images/logo_danger_2.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                                    </div>
                                                                                    <div class="form-group ml-4">
                                                                                        <div class="row">
                                                                                            <h6>Yakin ingin menghapus Carousel Images?</h6>
                                                                                            <span>Carousel Images <strong class="text-danger"><?= $item['heading'] ?></strong> akan <span class="text-danger">terhapus</span> secara pemranen!</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="float-right">
                                                                                    <button type="submit" class="btn btn-outline-danger">Hapus Carousel Images</button>
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

<script>
    const containers = document.querySelectorAll('.file-drag');

containers.forEach(container => {
    const label = container.querySelector('.file-label');
    const input = container.querySelector('.file-upload');
    const image = container.querySelector('.file-image');
    const notImage = container.querySelector('.not-image');
    const uploadBtn = container.querySelector('.file-upload-btn');

    uploadBtn.addEventListener('click', function (e) {
        e.preventDefault();
        input.click();
    });

    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) previewFile(file, image, notImage);
    });

    label.addEventListener('dragover', (e) => {
        e.preventDefault();
        label.classList.add('dragover');
    });

    label.addEventListener('dragleave', (e) => {
        e.preventDefault();
        label.classList.remove('dragover');
    });

    label.addEventListener('drop', (e) => {
        e.preventDefault();
        label.classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        input.files = e.dataTransfer.files;
        if (file) previewFile(file, image, notImage);
    });
});

function previewFile(file, image, notImage) {
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function (e) {
            image.src = e.target.result;
            image.classList.remove('hidden');
            notImage.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    } else {
        image.classList.add('hidden');
        notImage.classList.remove('hidden');
    }
}


</script>
