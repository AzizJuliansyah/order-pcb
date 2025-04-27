<!-- Wrapper Start -->
<style>
    #file-drag.dragover {
        border: 2px dashed #007bff;
        background-color: #f0f8ff;
    }
</style>

    </style>

<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row m-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Auth Google Settings</li>
                    </ol>
                </nav>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12">
                    <div class="card top-left shadow-showcase">
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
                                                                                    <div class="uploader-file">
                                                                                        <input id="file-upload" type="file" name="item" accept="image/*" style="display: none;" />
                                                                                        <label id="file-drag" for="file-upload">
                                                                                            <img id="file-image" src="#" alt="Preview" class="hidden mb-2" style="max-width: 100px;">
                                                                                            
                                                                                            <span id="start-one">
                                                                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                                                                <span class="d-block">Select a file or drag here</span>
                                                                                                <span id="notimage" class="hidden d-block text-danger">Please select image</span>
                                                                                                <span id="file-upload-btn" class="btn btn-primary text-white mt-2">Select a file</span>
                                                                                            </span>

                                                                                            <span id="response" class="hidden">
                                                                                                <span id="messages"></span>
                                                                                                <progress class="progress" id="file-progress" value="0" max="100">
                                                                                                    <span>0</span>%
                                                                                                </progress>
                                                                                            </span>
                                                                                        </label>

                                                                                        <?php if (!empty($errors['item'])): ?>
                                                                                            <div class="invalid-feedback d-block"><?= $errors['item'] ?></div>
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
    const fileDrag = document.getElementById('file-drag');
    const fileImage = document.getElementById('file-image');
    const fileUploadBtn = document.getElementById('file-upload-btn');
    const fileUpload = document.getElementById('file-upload');

    fileUploadBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation(); // ini penting agar tidak double trigger
        fileUpload.click();
    });


    // Preview selected file
    function previewFile(file) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                fileImage.src = e.target.result;
                fileImage.classList.remove('hidden');
                notImage.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            fileImage.classList.add('hidden');
            notImage.classList.remove('hidden');
        }
    }

    fileUpload.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            previewFile(file);
        }
    });

    // Handle drag and drop
    fileDrag.addEventListener('dragover', (e) => {
        e.preventDefault();
        e.stopPropagation();
        fileDrag.classList.add('dragover');
    });

    fileDrag.addEventListener('dragleave', (e) => {
        e.preventDefault();
        e.stopPropagation();
        fileDrag.classList.remove('dragover');
    });

    fileDrag.addEventListener('drop', (e) => {
        e.preventDefault();
        e.stopPropagation();
        fileDrag.classList.remove('dragover');

        const file = e.dataTransfer.files[0];
        fileUpload.files = e.dataTransfer.files; // sync to input file
        if (file) {
            previewFile(file);
        }
    });
</script>
