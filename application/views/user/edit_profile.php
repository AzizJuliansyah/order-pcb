<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row m-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('index/home') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('user/profile') ?>">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card top-left shadow-showcase">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-scroll" id="myTab-two" role="tablist">
                                <?php $active_tab = $this->session->flashdata('active_tab'); ?>

                                <li class="nav-item">
                                    <a class="nav-link <?= (!$active_tab || $active_tab == 'personal-information') ? 'active show' : '' ?>" id="home-tab-two" data-toggle="tab" href="#personal-information" role="tab" aria-selected="<?= (!$active_tab || $active_tab == 'personal-information') ? 'true' : 'false' ?>">
                                        Personal Information
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($active_tab == 'change-pwd') ? 'active show' : '' ?>" id="profile-tab-two" data-toggle="tab" href="#change-pwd" role="tab" aria-selected="<?= ($active_tab == 'change-pwd') ? 'true' : 'false' ?>">
                                        Change Password
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content" id="myTabContent-1">
                                <div class="tab-pane fade <?= (!$active_tab || $active_tab == 'personal-information') ? 'active show' : '' ?>" id="personal-information" role="tabpanel">
                                    <div class="row ml-1 mt-3 mb-5">
                                        <h4 class="card-title">Personal Information</h4>
                                    </div>
                                    <?= form_open_multipart('user/edit_personal_info') ?>
                                    <!-- sudah ada csrf bawaan ci3 -->
                                    <div class="row mb-4">
                                        <div class="col-6">
                                            <div class="profile-img-edit">
                                                <div class="crm-profile-img-edit">
                                                    <p>Foto Lama</p>
                                                    <?php if ($user['foto'] != null) { ?>
                                                        <img class="crm-profile-pic rounded-circle avatar-100" src="<?= base_url('public/' . $user['foto']) ?>" alt="profile-pic">
                                                    <?php } else { ?>
                                                        <img class="crm-profile-pic rounded-circle avatar-100" src="<?= base_url('public/local_assets/images/user_default.png') ?>" alt="profile-pic">
                                                    <?php } ?>
                                                    <div class="crm-p-image bg-primary">
                                                        <i class="las la-pen upload-button"></i>
                                                        <input class="file-upload d-none" type="file" name="foto" accept="image/*" onchange="previewNewPhoto(this)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="profile-img-edit">
                                                <div class="crm-profile-img-edit">
                                                    <p>Foto Baru</p>
                                                    <img id="newPhotoPreview" src="#" alt="Preview" class="crm-profile-pic rounded-circle avatar-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" row align-items-center">
                                        <div class="form-group col-sm-6">
                                            <label for="nama">Nama Lengkap:</label>
                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['nama']) ? 'is-invalid' : '' ?>" name="nama" id="nama" value="<?= (isset($old['nama'])) ? $old['nama'] : $user['nama'] ?>">
                                            <?php if (!empty($errors['nama'])): ?>
                                                <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="email">Alamat Email:</label>
                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" name="email" id="email" value="<?= (isset($old['email'])) ? $old['email'] : $user['email'] ?>" disabled>
                                            <?php if (!empty($errors['email'])): ?>
                                                <div class="invalid-feedback"><?= $errors['email'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="nomor">Nomor Telepon/Whatsapp:</label>
                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['nomor']) ? 'is-invalid' : '' ?>" name="nomor" id="nomor" value="<?= (isset($old['nomor'])) ? $old['nomor'] : $user['nomor'] ?>">
                                            <?php if (!empty($errors['nomor'])): ?>
                                                <div class="invalid-feedback"><?= $errors['nomor'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="tanggal_lahir">Tanggal Lahir:</label>
                                            <input type="date" class="form-control border-radius-5 max-height-40 <?= !empty($errors['tanggal_lahir']) ? 'is-invalid' : '' ?>" name="tanggal_lahir" id="tanggal_lahir" value="<?= (isset($old['tanggal_lahir'])) ? $old['tanggal_lahir'] : $user['tanggal_lahir'] ?>">
                                            <?php if (!empty($errors['tanggal_lahir'])): ?>
                                                <div class="invalid-feedback"><?= $errors['tanggal_lahir'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="col-12 mt-3 mb-5">
                                            <div class="divider-text">
                                                <span>Alamat</span>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="provinsi">Provinsi:</label>
                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['provinsi']) ? 'is-invalid' : '' ?>" name="provinsi" id="provinsi" value="<?= (isset($old['provinsi'])) ? $old['provinsi'] : $user['provinsi'] ?>">
                                            <?php if (!empty($errors['provinsi'])): ?>
                                                <div class="invalid-feedback"><?= $errors['provinsi'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="kota">Kota:</label>
                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['kota']) ? 'is-invalid' : '' ?>" name="kota" id="kota" value="<?= (isset($old['kota'])) ? $old['kota'] : $user['kota'] ?>">
                                            <?php if (!empty($errors['kota'])): ?>
                                                <div class="invalid-feedback"><?= $errors['kota'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="kecamatan">Kecamatan:</label>
                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['kecamatan']) ? 'is-invalid' : '' ?>" name="kecamatan" id="kecamatan" value="<?= (isset($old['kecamatan'])) ? $old['kecamatan'] : $user['kecamatan'] ?>">
                                            <?php if (!empty($errors['kecamatan'])): ?>
                                                <div class="invalid-feedback"><?= $errors['kecamatan'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="kode_pos">Kode Pos:</label>
                                            <input type="number" class="form-control border-radius-5 max-height-40 <?= !empty($errors['kode_pos']) ? 'is-invalid' : '' ?>" name="kode_pos" id="kode_pos" value="<?= (isset($old['kode_pos'])) ? $old['kode_pos'] : $user['kode_pos'] ?>">
                                            <?php if (!empty($errors['kode_pos'])): ?>
                                                <div class="invalid-feedback"><?= $errors['kode_pos'] ?></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label>Alamat Lengkap:</label>
                                            <textarea class="form-control <?= !empty($errors['alamat_lengkap']) ? 'is-invalid' : '' ?>" name="alamat_lengkap" id="alamat_lengkap" rows="5" style="line-height: 22px;"><?= (isset($old['alamat_lengkap'])) ? $old['alamat_lengkap'] : $user['alamat_lengkap'] ?></textarea>
                                            <?php if (!empty($errors['alamat_lengkap'])): ?>
                                                <div class="invalid-feedback"><?= $errors['alamat_lengkap'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary mr-2">
                                        <div class="d-flex align-items-center">
                                            <i class="las la-user-edit font-size-20"></i>
                                            <span>Edit Profile</span>
                                        </div>
                                    </button>
                                    <button type="reset" class="btn iq-bg-danger">Reset Perubahan</button>
                                    <?= form_close() ?>
                                </div>
                                <div class="tab-pane fade <?= ($active_tab == 'change-pwd') ? 'active show' : '' ?>" id="change-pwd" role="tabpanel" aria-labelledby="profile-tab-two">
                                    <div class="row ml-1 mt-3 mb-5">
                                        <h4 class="card-title">Change Password</h4>
                                    </div>
                                    <?= form_open('user/change_password') ?>
                                    <div class="form-group">
                                        <label for="cpassword">Current Password:</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control <?= !empty($errors['cpassword']) ? 'is-invalid' : '' ?> border-radius-top-left-5 border-radius-bottom-left-5" name="cpassword" id="cpassword" value="<?= isset($old['cpassword']) ? $old['cpassword'] : '' ?>" aria-label="Current Password" aria-describedby="basic-addon4">
                                            <div class="input-group-append">
                                                <span class="input-group-text border-left-0 border-radius-top-right-5 border-radius-bottom-right-5" onclick="togglePassword('cpassword', 'toggleIconCPassword')">
                                                    <i class="las la-eye font-size-20" id="toggleIconCPassword"></i>
                                                </span>
                                            </div>
                                            <?php if (!empty($errors['cpassword'])): ?>
                                                <div class="invalid-feedback"><?= $errors['cpassword'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <div class="d-flex align-items-center">
                                                <a href="<?= base_url('auth/forgot_password') ?>" class="font-size-14">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="npassword">New Password:</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control <?= !empty($errors['npassword']) ? 'is-invalid' : '' ?> border-radius-top-left-5 border-radius-bottom-left-5" name="npassword" id="npassword" value="<?= isset($old['npassword']) ? $old['npassword'] : '' ?>" aria-label="New Password" aria-describedby="basic-addon4">
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
                                    <div class="form-group">
                                        <label for="vpassword">Verify Password:</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control <?= !empty($errors['vpassword']) ? 'is-invalid' : '' ?> border-radius-top-left-5 border-radius-bottom-left-5" name="vpassword" id="vpassword" value="<?= isset($old['vpassword']) ? $old['vpassword'] : '' ?>" aria-label="Verify Password" aria-describedby="basic-addon4">
                                            <div class="input-group-append">
                                                <span class="input-group-text border-left-0 border-radius-top-right-5 border-radius-bottom-right-5" onclick="togglePassword('vpassword', 'toggleIconVPassword')">
                                                    <i class="las la-eye font-size-20" id="toggleIconVPassword"></i>
                                                </span>
                                            </div>
                                            <?php if (!empty($errors['vpassword'])): ?>
                                                <div class="invalid-feedback"><?= $errors['vpassword'] ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary mr-2">
                                        <div class="d-flex align-items-center">
                                            <i class="las la-unlock font-size-20"></i>
                                            <span>Ganti Password</span>
                                        </div>
                                    </button>
                                    <button type="reset" class="btn iq-bg-danger">Reset Perubahan</button>
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