<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title"><a href="<?= base_url('administrator/user_list') ?>"><i class="las la-angle-left mr-2"></i></a> User list dari role: <?= $selected_role['jabatan'] ?></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- <div class="row justify-content-between">
                                        <div class="col-sm-6 col-md-6">
                                            <div id="user_list_datatable_info" class="dataTables_filter">
                                                <form class="mr-3 position-relative">
                                                    <div class="form-group mb-0">
                                                        <input type="search" class="form-control" id="exampleInputSearch" placeholder="Search"
                                                            aria-controls="datatable">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> -->
                                <table id="datatable" class="table data-table table-striped mt-4" role="grid"
                                    aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Profile</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Join Date</th>
                                            <th style="min-width: 100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users_by_role as $index => $item) { ?>
                                            <tr>
                                                <td>
                                                    <?php if ($item['foto'] != null) { ?>
                                                        <img src="<?= base_url('public/' . $item['foto']) ?>" class="avatar-40 rounded-circle" alt="user">
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="avatar-40 rounded-circle" alt="user">
                                                    <?php } ?>
                                                </td>
                                                <td><?= $item['nama'] ?></td>
                                                <td><?= $item['nomor'] ?></td>
                                                <td><?= $item['email'] ?></td>
                                                <td>
                                                    <?php if ($item['is_active'] == '1') { ?>
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#active<?= $item['id'] ?>">
                                                                Active
                                                            </button>
                                                            <div id="active<?= $item['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="active<?= $item['id'] ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="active<?= $item['id'] ?>Title">Ubah status user: <?= $item['nama'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?= form_open('administrator/ubah_status/0') ?>
                                                                            <input type="hidden" name="user_id" value="<?= $item['id'] ?>">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="form-group">
                                                                                    <img src="<?= base_url('public/local_assets/images/logo_danger.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                                </div>
                                                                                <div class="form-group ml-4">
                                                                                    <div class="row">
                                                                                        <h6>Yakin ingin mengubah status ke <span class="text-danger">Inactive</span>?</h6>
                                                                                        <span>Status user <?= $item['nama'] ?> akan terubah menjadi <span class="text-danger">Inactive</span></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="float-right">
                                                                                <button type="submit" class="btn btn-outline-danger">Ubah status ke inactive</button>
                                                                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                            <?= form_close() ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#inactive<?= $item['id'] ?>">
                                                                Inactive
                                                            </button>
                                                            <div id="inactive<?= $item['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="inactive<?= $item['id'] ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="inactive<?= $item['id'] ?>Title">Ubah status user: <?= $item['nama'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?= form_open('administrator/ubah_status/1') ?>
                                                                            <input type="hidden" name="user_id" value="<?= $item['id'] ?>">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="form-group">
                                                                                    <img src="<?= base_url('public/local_assets/images/logo_danger.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                                </div>
                                                                                <div class="form-group ml-4">
                                                                                    <div class="row">
                                                                                        <h6>Yakin ingin mengubah status ke <span class="text-danger">Active</span>?</h6>
                                                                                        <span>Status user <?= $item['nama'] ?> akan terubah menjadi <span class="text-danger">Active</span></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="float-right">
                                                                                <button type="submit" class="btn btn-outline-danger">Ubah status ke Active</button>
                                                                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                            <?= form_close() ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </td>
                                                <td><?= format_bulan($item['date_created']) ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#alamat<?= $item['id'] ?>">
                                                                <i class="las la-eye font-size-16 mt-1 mr-0"></i>
                                                            </button>
                                                            <div id="alamat<?= $item['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="alamat<?= $item['id'] ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="alamat<?= $item['id'] ?>Title">Alamat User: <?= $item['nama'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Alamat:</p>
                                                                            <?php if (
                                                                                !empty($item['provinsi']) ||
                                                                                !empty($item['kota']) ||
                                                                                !empty($item['kecamatan']) ||
                                                                                !empty($item['kode_pos']) ||
                                                                                !empty($item['alamat_lengkap'])
                                                                            ) { ?>
                                                                                <p>
                                                                                    <?= $item['provinsi'] ?><?= $item['provinsi'] ? ', ' : '' ?>
                                                                                    <?= $item['kota'] ?><?= $item['kota'] ? ', ' : '' ?>
                                                                                    <?= $item['kecamatan'] ?><?= $item['kecamatan'] ? ', ' : '' ?>
                                                                                    <?= $item['kode_pos'] ?><?= $item['kode_pos'] ? ', ' : '' ?>
                                                                                    <?= $item['alamat_lengkap'] ?>
                                                                                </p>
                                                                            <?php } else { ?>
                                                                                <span class="text-danger">Belum diisi</span>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#change_password<?= $item['id'] ?>">
                                                                <i class="las la-lock-open font-size-16 mt-1 mr-0"></i>
                                                            </button>
                                                            <div id="change_password<?= $item['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="change_password<?= $item['id'] ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="change_password<?= $item['id'] ?>Title">Change Password User: <?= $item['nama'] ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="npassword">New Password:</label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-user-lock font-size-20"></i></span>
                                                                                    </div>
                                                                                    <input type="password" class="form-control <?= !empty($errors['npassword']) ? 'is-invalid' : '' ?> max-height-40" name="npassword" id="npassword" value="<?= isset($old['npassword']) ? $old['npassword'] : '' ?>" aria-label="New Password" aria-describedby="basic-addon4">
                                                                                    <div class="input-group-append">
                                                                                        <span class="input-group-text border-left-0 border-radius-top-right-5 border-radius-bottom-right-5" onclick="togglePassword('npassword', 'toggleIconNPassword')">
                                                                                            <i class="las la-eye font-size-20" id="toggleIconNPassword"></i>
                                                                                        </span>
                                                                                    </div>
                                                                                    <?php if (!empty($errors['npassword'])): ?>
                                                                                        <div class="invalid-feedback"><?= $errors['npassword'] ?></div>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-outline-primary">Save changes</button>
                                                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
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

<script>
    function togglePassword(id, iconId) {
        const input = document.getElementById(id);
        const icon = document.getElementById(iconId);

        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';

        icon.classList.toggle('la-eye', !isPassword);
        icon.classList.toggle('la-eye-slash', isPassword);
    }
</script>