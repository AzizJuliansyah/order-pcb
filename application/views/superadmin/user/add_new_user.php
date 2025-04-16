
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid">
                <div class="row m-1">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item active" aria-current="page">User Management</li>
                            <li class="breadcrumb-item active" aria-current="page">User Add</li>
                        </ol>
                    </nav>
                </div>
                <?= form_open_multipart('superadmin/add_new_user') ?>
                <div class="row mt-3">
                    <div class="col-xl-3 col-lg-4">
                        <div class="card bottom-right shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                <h4 class="card-title">Add New User</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="crm-profile-img-edit position-relative">
                                        <img id="newPhotoPreview" src="" alt="Preview" class="crm-profile-pic rounded-circle avatar-100">
                                        <div class="crm-p-image bg-primary">
                                            <i class="las la-pen upload-button"></i>
                                            <input class="file-upload d-none" type="file" name="foto" accept="image/*" onchange="previewNewPhoto(this)">
                                        </div>
                                    </div>
                                    <div class="img-extension mt-3">
                                        <div class="d-inline-block align-items-center">
                                            <span>Only</span>
                                            <a href="javascript:void();">.jpg</a>
                                            <a href="javascript:void();">.png</a>
                                            <a href="javascript:void();">.jpeg</a>
                                            <span>allowed</span>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="mr-2" name="default_profile_image" type="checkbox">Gunakan foto default</label>
                                        </div>
                                        <div class="checkbox">
                                            <label><input class="mr-2" name="is_active" value="1" <?= set_checkbox('is_active', '1', isset($old['is_active']) && $old['is_active'] == '1') ?> type="checkbox">User Active</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>User Role:</label>
                                    <select name="role" id="role" class="selectpicker form-control <?= !empty($errors['role']) ? 'is-invalid' : '' ?>" data-style="py-0">
                                        <option disabled selected>Pilih role</option>
                                        <?php foreach ($role_list as $item) { ?>
                                            <option value="<?= $item['role_id'] ?>" <?= (isset($old['role']) && $item['role_id'] == $old['role']) ? 'selected' : '' ?>>
                                                <?= $item['jabatan'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php if (!empty($errors['role'])): ?>
                                        <div class="invalid-feedback"><?= $errors['role'] ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="card bottom-right shadow-showcase">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                <h4 class="card-title">New User Information</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="new-user-info">
                                    <div class=" row align-items-center">
                                        <div class="form-group col-sm-12">
                                            <label for="nama">Nama Lengkap:</label>
                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['nama']) ? 'is-invalid' : '' ?>" name="nama" id="nama" value="<?= isset($old['nama']) ? $old['nama'] : '' ?>" placeholder="Nama lengkap..">
                                            <?php if (!empty($errors['nama'])): ?>
                                                <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div class="form-group col-sm-6">
                                            <label for="nomor">Nomor Telepon/Whatsapp:</label>
                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['nomor']) ? 'is-invalid' : '' ?>" name="nomor" id="nomor" value="<?= isset($old['nomor']) ? $old['nomor'] : '' ?>" placeholder="Nomor whatsapp..">
                                            <?php if (!empty($errors['nomor'])): ?>
                                                <div class="invalid-feedback"><?= $errors['nomor'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="tanggal_lahir">Tanggal Lahir:</label>
                                            <input type="date" class="form-control border-radius-5 max-height-40 <?= !empty($errors['tanggal_lahir']) ? 'is-invalid' : '' ?>" name="tanggal_lahir" id="tanggal_lahir" value="<?= isset($old['tanggal_lahir']) ? $old['tanggal_lahir'] : '' ?>">
                                            <?php if (!empty($errors['tanggal_lahir'])): ?>
                                                <div class="invalid-feedback"><?= $errors['tanggal_lahir'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <hr>
                                    <h5 class="mb-3">Addres</h5>
                                    <div class="row align-items-center">

                                        <div class="form-group col-sm-6">
                                            <label for="provinsi">Provinsi:</label>
                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['provinsi']) ? 'is-invalid' : '' ?>" name="provinsi" id="provinsi" value="<?= isset($old['provinsi']) ? $old['provinsi'] : '' ?>" placeholder="Provinsi..">
                                            <?php if (!empty($errors['provinsi'])): ?>
                                                <div class="invalid-feedback"><?= $errors['provinsi'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="kota">Kota:</label>
                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['kota']) ? 'is-invalid' : '' ?>" name="kota" id="kota" value="<?= isset($old['kota']) ? $old['kota'] : '' ?>" placeholder="Kota..">
                                            <?php if (!empty($errors['kota'])): ?>
                                                <div class="invalid-feedback"><?= $errors['kota'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="kecamatan">Kecamatan:</label>
                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['kecamatan']) ? 'is-invalid' : '' ?>" name="kecamatan" id="kecamatan" value="<?= isset($old['kecamatan']) ? $old['kecamatan'] : '' ?>" placeholder="Kecamatan..">
                                            <?php if (!empty($errors['kecamatan'])): ?>
                                                <div class="invalid-feedback"><?= $errors['kecamatan'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="kode_pos">Kode Pos:</label>
                                            <input type="number" class="form-control border-radius-5 max-height-40 <?= !empty($errors['kode_pos']) ? 'is-invalid' : '' ?>" name="kode_pos" id="kode_pos" value="<?= isset($old['kode_pos']) ? $old['kode_pos'] : '' ?>" placeholder="Kode pos..">
                                            <?php if (!empty($errors['kode_pos'])): ?>
                                                <div class="invalid-feedback"><?= $errors['kode_pos'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label>Alamat Lengkap:</label>
                                            <textarea class="form-control <?= !empty($errors['alamat_lengkap']) ? 'is-invalid' : '' ?>" name="alamat_lengkap" id="alamat_lengkap" rows="5" style="line-height: 22px;" placeholder="Alamat lengkap.."><?= isset($old['alamat_lengkap']) ? $old['alamat_lengkap'] : '' ?></textarea>
                                            <?php if (!empty($errors['alamat_lengkap'])): ?>
                                                <div class="invalid-feedback"><?= $errors['alamat_lengkap'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5 class="mb-3">Security</h5>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="email">Alamat Email:</label>
                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" name="email" id="email" value="<?= isset($old['email']) ? $old['email'] : '' ?>" placeholder="User email..">
                                            <?php if (!empty($errors['email'])): ?>
                                                <div class="invalid-feedback"><?= $errors['email'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="password">Password:</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control border-radius-top-left-5 border-radius-bottom-left-5 <?= !empty($errors['password']) ? 'is-invalid' : '' ?> max-height-40" name="password" id="password" value="<?= isset($old['password']) ? $old['password'] : '' ?>" placeholder="User password.." aria-label="New Password" aria-describedby="basic-addon4">
                                                <div class="input-group-append">
                                                    <span class="input-group-text border-left-0 border-radius-top-right-5 border-radius-bottom-right-5" onclick="togglePassword('password', 'toggleIconPassword')">
                                                        <i class="las la-eye font-size-20" id="toggleIconPassword"></i>
                                                    </span>
                                                </div>
                                                <?php if (!empty($errors['password'])): ?>
                                                    <div class="invalid-feedback"><?= $errors['password'] ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="repeat_password">Repeat Password:</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control border-radius-top-left-5 border-radius-bottom-left-5 <?= !empty($errors['repeat_password']) ? 'is-invalid' : '' ?> max-height-40" name="repeat_password" id="repeat_password" value="<?= isset($old['repeat_password']) ? $old['repeat_password'] : '' ?>" placeholder="Repeat password" aria-label="Repeat Password" aria-describedby="basic-addon4">
                                                <div class="input-group-append">
                                                    <span class="input-group-text border-left-0 border-radius-top-right-5 border-radius-bottom-right-5" onclick="togglePassword('repeat_password', 'toggleIconRepeatPassword')">
                                                        <i class="las la-eye font-size-20" id="toggleIconRepeatPassword"></i>
                                                    </span>
                                                </div>
                                                <?php if (!empty($errors['repeat_password'])): ?>
                                                    <div class="invalid-feedback"><?= $errors['repeat_password'] ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-outline-primary">
                                        <div class="d-flex align-items-center">
                                            <i class="las la-user-plus font-size-20"></i>
                                            <span>Add New User</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
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

    function previewNewPhoto(input) {
        const preview = document.getElementById('newPhotoPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>