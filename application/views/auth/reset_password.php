
<div class="d-flex justify-content-center align-items-center"  style="min-height: 100vh;">
    <div class="card bottom-right p-3 shadow-showcase border-radius-5 w-100 ml-1 mr-1" style="max-width: 450px;">
        <div class="card-header border-bottom-0 p-0">
            <div class="d-flex justify-content-center">
                <div class="image mb-2 position-relative d-inline-block">
                <img src="<?= base_url('public/' . get_website_logo()) ?>" alt="profile" class="img-fluid rounded-circle avatar-100 text-center">
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <h4>Forgot Your Password?</h4>
            </div>
            <div class="d-flex justify-content-center text-center mt-2">
                <p class="font-size-14">Enter your new password and you can login again</p>
            </div>
            
        </div>
        <?= form_open('auth/reset_password/' . $token) ?>
        <!-- sudah ada csrf bawaan ci3 -->
        <div class="card-body">
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

            <div class="form-group">
                <label for="vpassword">Verify Password:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-user-lock font-size-20"></i></span>
                    </div>
                    <input type="password" class="form-control <?= !empty($errors['vpassword']) ? 'is-invalid' : '' ?> max-height-40" name="vpassword" id="vpassword" value="<?= isset($old['vpassword']) ? $old['vpassword'] : '' ?>" aria-label="New Password" aria-describedby="basic-addon4">
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
        </div>

        <div class="card-footer bg-transparent border-top-0">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-100 border-radius-5 mt-2">
                    Reset Password
                </button>
            </div>

                <div class="d-flex justify-content-center">
                    <div class="d-flex align-items-center font-size-14 mt-1">
                        <i class="las la-angle-left"></i>
                        <h6 class="mr-2"></h6>
                        <a class="text-dark" href="<?= base_url('auth/login') ?>">Back to login</a>
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
