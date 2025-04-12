<div class="d-flex justify-content-center mt-5">
    <div class="card bottom-right p-3 shadow-showcase border-radius-5 w-100" style="max-width: 450px;">
        <div class="card-header border-bottom-0 p-0">
            <div class="d-flex justify-content-center">
                <h3>Forgot Your Password?</h3>
            </div>
        </div>
        <?= form_open('auth/login') ?>
        <!-- sudah ada csrf bawaan ci3 -->
        <div class="card-body">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

            <div class="input-group m-2">
                <div class="input-group-prepend">
                    <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-envelope font-size-20"></i></span>
                </div>
                <input type="text" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?> border-radius-top-right-5 border-radius-bottom-right-5 max-height-40" name="email" id="email" value="<?= isset($old['email']) ? $old['email'] : '' ?>" placeholder="Email" aria-label="Email" aria-describedby="basic-addon4">
                <?php if (!empty($errors['email'])): ?>
                    <div class="invalid-feedback"><?= $errors['email'] ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card-footer border-top-0">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-100 border-radius-5 mt-2">
                    Send Email
                </button>
            </div>

            <div class="d-flex justify-content-center mb-5">
                <div class="d-flex align-items-center mt-1">
                    <h6 class="mr-2">Don't have an account?</h6>
                    <a href="<?= base_url('auth/register') ?>">Register</a>
                </div>
            </div>
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