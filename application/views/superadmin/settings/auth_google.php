<!-- Wrapper Start -->
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
                                                <td><?= $item['item'] ?></td>
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
                                                                                    <?= form_open('superadmin/edit_settings', ['id' => 'EditSettingsForm' . $item['id']]) ?>
                                                                                    <input type="hidden" name="settings_id" value="<?= encrypt_id($item['id']) ?>">
                                                                                    <div class="form-group">
                                                                                        <label for="item<?= $item['id'] ?>">Credential:</label>
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-prepend">
                                                                                                <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-key font-size-20"></i></span>
                                                                                            </div>
                                                                                            <input type="text" class="form-control <?= !empty($errors['item']) ? 'is-invalid' : '' ?> max-height-40" name="item" id="item<?= $item['id'] ?>" value="<?= isset($old['item']) ? $old['item'] : $item['item'] ?>" aria-label="New Password" aria-describedby="basic-addon4">
                                                                                            <?php if (!empty($errors['item'])): ?>
                                                                                                <div class="invalid-feedback"><?= $errors['item'] ?></div>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="float-right">
                                                                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-outline-primary">Edit Credential</button>
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