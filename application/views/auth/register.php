<div class="d-flex justify-content-center my-5">
    <div class="card basic-drop-shadow p-3 shadow-showcase border-radius-5 m-2 w-100" style="max-width: 450px;">
        <div class="card-header border-bottom-0 p-0">
            <div class="d-flex justify-content-center">
                <h3>Create Account</h3>
            </div>
            <div class="d-flex justify-content-center">
                <div class="image mb-2 position-relative d-inline-block">
                <img src="<?= base_url('public/' . get_website_logo()) ?>" alt="profile" class="img-fluid rounded-circle avatar-100 text-center">
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <p>Get started with your free account</p>
            </div>

            <div class="d-flex justify-content-center">
                <a href="<?= base_url('auth/login_google') ?>" class="btn btn-outline-primary w-100 border-radius-5 mt-2" style="max-width: 400px;">
                    <div class="d-flex justify-content-center">
                        <div class="d-flex align-items-center">
                            <img src="<?= base_url('public/local_assets/images/logo_google.png') ?>" class="img-fluid mr-2" width="20" alt="">
                            Register with google
                        </div>
                    </div>
                </a>
            </div>

            <div class="divider-text">
                <span>OR</span>
            </div>

        </div>
        <?= form_open('auth/register') ?>
        <div class="card-body">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-user font-size-20"></i></span>
                </div>
                <input type="text" class="form-control <?= !empty($errors['nama']) ? 'is-invalid' : '' ?> border-radius-top-right-5 border-radius-bottom-right-5 max-height-40" name="nama" id="nama" value="<?= isset($old['nama']) ? $old['nama'] : '' ?>" placeholder="Nama Lengkap" aria-label="Nama Lengkap" aria-describedby="basic-addon4">
                <?php if (!empty($errors['nama'])): ?>
                    <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                <?php endif; ?>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-envelope font-size-20"></i></span>
                </div>
                <input type="text" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?> border-radius-top-right-5 border-radius-bottom-right-5 max-height-40" name="email" id="email" value="<?= isset($old['email']) ? $old['email'] : '' ?>" placeholder="Email" aria-label="Email" aria-describedby="basic-addon4">
                <?php if (!empty($errors['email'])): ?>
                    <div class="invalid-feedback"><?= $errors['email'] ?></div>
                <?php endif; ?>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-phone font-size-20"></i></span>
                </div>
                <input type="text" class="form-control <?= !empty($errors['nomor']) ? 'is-invalid' : '' ?> border-radius-top-right-5 border-radius-bottom-right-5 max-height-40" name="nomor" id="nomor" value="<?= isset($old['nomor']) ? $old['nomor'] : '' ?>" placeholder="No Telepon" aria-label="No Telepon" aria-describedby="basic-addon4">
                <?php if (!empty($errors['nomor'])): ?>
                    <div class="invalid-feedback"><?= $errors['nomor'] ?></div>
                <?php endif; ?>
            </div>

            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-lock-open font-size-20"></i></span>
                </div>
                <input type="password" class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?> border-radius-top-right-5 border-radius-bottom-right-5 max-height-40" name="password" id="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon4">
                <div class="input-group-append">
                    <span class="input-group-text border-left-0 border-radius-top-right-5 border-radius-bottom-right-5" onclick="togglePassword('password', 'toggleIconPassword')">
                        <i class="las la-eye font-size-20" id="toggleIconPassword"></i>
                    </span>
                </div>
                <?php if (!empty($errors['password'])): ?>
                    <div class="invalid-feedback"><?= $errors['password'] ?></div>
                <?php endif; ?>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-lock-open font-size-20"></i></span>
                </div>
                <input type="password" class="form-control <?= !empty($errors['repeat_password']) ? 'is-invalid' : '' ?> border-radius-top-right-5 border-radius-bottom-right-5 max-height-40" name="repeat_password" id="repeat_password" placeholder="Repeat Password" aria-label="Repeat Password" aria-describedby="basic-addon4">
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

        <div class="card-footer bg-transparent border-top-0">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-100 border-radius-5 mt-2" style="max-width: 400px;">
                    Create account
                </button>
            </div>

            <div class="d-flex justify-content-center mb-0">
                <div class="d-flex align-items-center mt-1">
                    <h6 class="mr-2">Have an account?</h6>
                    <a href="<?= base_url('auth/login') ?>">Log In</a>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-5">
                <div class="d-flex align-items-center">
                    <h6 class="mr-2">Or back to</h6>
                    <a href="<?= base_url('') ?>">Landing Page</a>
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>

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