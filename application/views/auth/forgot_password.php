<div class="d-flex justify-content-center align-items-center"  style="min-height: 100vh;">
    <div class="card bottom-right p-3 shadow-showcase border-radius-5 w-100 ml-1 mr-1" style="max-width: 450px;">
        <div class="card-header border-bottom-0 p-0">
            <div class="d-flex justify-content-center">
            <div class="image mb-2 position-relative d-inline-block">
                           <img src="<?= base_url('public/template_assets/images/logo.svg') ?>" alt="profile" class="img-fluid rounded-circle avatar-100 text-center">
                        </div>
            </div>
            <div class="d-flex justify-content-center">
                <h4>Forgot Your Password?</h4>
            </div>
            <div class="d-flex justify-content-center text-center mt-2">
                <p class="font-size-14">Enter your email and we'll send you a link to reset your password</p>
            </div>
            
        </div>
        <?= form_open('auth/forgot_password') ?>
        <!-- sudah ada csrf bawaan ci3 -->
        <div class="card-body">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-envelope font-size-20"></i></span>
                </div>
                <?php if (!empty($this->session->userdata('user_id'))) { ?>
                    <input type="text" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?> border-radius-top-right-5 border-radius-bottom-right-5 max-height-40" name="email" id="email" value="<?= isset($old['email']) ? $old['email'] : (isset($user['email']) ? $user['email'] : '') ?>" placeholder="Email" aria-label="Email" aria-describedby="basic-addon4">
                <?php } else { ?>
                    <input type="text" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?> border-radius-top-right-5 border-radius-bottom-right-5 max-height-40" name="email" id="email" value="<?= isset($old['email']) ? $old['email'] : '' ?>" placeholder="Email" aria-label="Email" aria-describedby="basic-addon4">
                <?php } ?>
                    <div class="text-success" style="margin-bottom: -40px;">
                        <p class="font-size-14">Email berhasil terkirim, jika email tidak tampil coba periksa spam, atau kirim ulang email</p>
                    </div>
                <?php endif; ?>
                <?php if (!empty($errors['email'])): ?>
                    <div class="invalid-feedback"><?= $errors['email'] ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card-footer bg-transparent border-top-0">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-100 border-radius-5 mt-2">
                    Send Email
                </button>
            </div>

            <?php if (empty($this->session->userdata('user_id'))) { ?>
                <div class="d-flex justify-content-center">
                    <div class="d-flex align-items-center font-size-14 mt-1">
                        <i class="las la-angle-left"></i>
                        <h6 class="mr-2"></h6>
                        <a class="text-dark" href="<?= base_url('auth/login') ?>">Back to login</a>
                    </div>
                </div>
            <?php } else { ?>
                <div class="d-flex justify-content-center">
                    <div class="d-flex align-items-center font-size-14 mt-1">
                        <i class="las la-angle-left"></i>
                        <h6 class="mr-2"></h6>
                        <a class="text-dark" href="<?= base_url('user/profile') ?>">Back to profile</a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?= form_close() ?>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('la-eye');
            icon.classList.add('la-low-vision');
        } else {
            input.type = 'password';
            icon.classList.remove('la-low-vision');
            icon.classList.add('la-eye');
        }
    }
</script>