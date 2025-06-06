<div class="d-flex justify-content-center my-5">
    <div class="card bottom-right p-3 shadow-showcase border-radius-5 m-2 w-100" style="max-width: 450px;">
        <div class="card-header border-bottom-0 p-0">
            <div class="d-flex justify-content-center">
                <h3>Sign In Your Account</h3>
            </div>
            <div class="d-flex justify-content-center">
                <div class="image mb-2 position-relative d-inline-block">
                <img src="<?= base_url('public/' . get_website_logo()) ?>" alt="profile" class="img-fluid rounded-circle avatar-100 text-center">
                </div>
            </div>
            <!-- <div class="d-flex justify-content-center">
                <p>Get started with your free account</p>
            </div> -->

            <div class="d-flex justify-content-center">
                <a href="<?= base_url('auth/login_google') ?>" class="btn btn-outline-primary w-100 border-radius-5 mt-2" style="max-width: 400px;">
                    <div class="d-flex justify-content-center">
                        <div class="d-flex align-items-center">
                            <img src="<?= base_url('public/local_assets/images/logo_google.png') ?>" class="img-fluid mr-2" width="20" alt="">
                            Log In with google
                        </div>
                    </div>
                </a>
            </div>

            <div class="divider-text">
                <span>OR</span>
            </div>

        </div>
        <?= form_open('auth/login') ?>
        <!-- sudah ada csrf bawaan ci3 -->
        <div class="card-body">
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
                    <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4"><i class="las la-lock-open font-size-20"></i></span>
                </div>
                <input type="password" class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?>   max-height-40" name="password" id="password" placeholder="Password" aria-label="Password" aria-describedby="basic-addon4">
                <div class="input-group-append">
                    <span class="input-group-text border-left-0 border-radius-top-right-5 border-radius-bottom-right-5" onclick="togglePassword()">
                        <i class="las la-eye font-size-20" id="toggleIcon"></i>
                    </span>
                </div>
                <?php if (!empty($errors['password'])): ?>
                    <div class="invalid-feedback"><?= $errors['password'] ?></div>
                <?php endif; ?>
            </div>
            <div class="d-flex justify-content-end">
                <div class="d-flex align-items-center">
                    <a href="<?= base_url('auth/forgot_password') ?>" class="font-size-14">Forgot Password?</a>
                </div>
            </div>
        </div>

        <div class="card-footer bg-transparent border-top-0">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-100 border-radius-5 mt-2" style="max-width: 400px;">
                    Log In
                </button>
            </div>

            <div class="d-flex justify-content-center mb-0">
                <div class="d-flex align-items-center mt-1">
                    <h6 class="mr-2">Don't have an account?</h6>
                    <a href="<?= base_url('auth/register') ?>">Register</a>
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



    localStorage.removeItem('activeChatRoom');
</script>