
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">User list dari role: <?= $selected_role['jabatan'] ?></h4>
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
                                                            <span class="mt-2 badge border border-primary text-primary font-size-14 mt-2">Active</span>
                                                        <?php } else { ?>
                                                            <span class="mt-2 badge border border-danger text-danger font-size-14 mt-2">Inactive</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?= format_bulan($item['date_created']) ?></td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="form-group m-1">
                                                                <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#detail<?= $item['id'] ?>">
                                                                    <i class="las la-eye font-size-16 mt-1 mr-0"></i>
                                                                </button>
                                                                <div id="detail<?= $item['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detail<?= $item['id'] ?>Title" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                                                        <div class="modal-content border-radius-10">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="detail<?= $item['id'] ?>Title">Detail User: <?= $item['nama'] ?></h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <table class="table table-bordered">
                                                                                    <p class="card-description mt-3"> Personal Info </p>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                                <p>Nama:</p>
                                                                                                <span><?= $item['nama'] ?></span>
                                                                                            </td>
                                                                                            <td colspan="2">
                                                                                                <p>Tanggal Lahir:</p>
                                                                                                <span><?= date('d F Y', strtotime($user['tanggal_lahir'])) ?></span>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="4">
                                                                                                <p>Alamat:</p>
                                                                                                <p><?= $item['provinsi'] ?>, <?= $item['kota'] ?>, <?= $item['kecamatan'] ?>, <?= $item['kode_pos'] ?>, <?= $item['alamat_lengkap'] ?></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                                <p>No Telepon:</p>
                                                                                                <p>{{ $item->no_telepon }}</p>
                                                                                            </td>
                                                                                            <td>
                                                                                                <p>Pendidikan Terakhir:</p>
                                                                                                <p>{{ $item->pendidikan_terakhir }}</p>
                                                                                            </td>
                                                                                            <td>
                                                                                                <p>Angkatan Ke-</p>
                                                                                                <p>{{ $item->angkatan->angkatan ?? 'Unknown' }}</p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="button" class="btn btn-primary">Save changes</button>
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
                                                    </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="row justify-content-between mt-3">
                                    <div id="user-list-page-info" class="col-md-6">
                                        <span>Showing 1 to 5 of 5 entries</span>
                                    </div>
                                    <div class="col-md-6">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-end mb-0">
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div> -->
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