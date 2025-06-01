
<div class="wrapper">
    <section class="login-content">
        <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
                <div class="col-lg-8">
                    <div class="card auth-card">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center auth-content">
                            <div class="col-lg-6 bg-<?= ($blog_status == 'new') ? 'primary' : 'warning' ?> content-left">
                                <div class="p-3">
                                    <div class="col-12 pl-0">
                                        <h4 class="mb-3 text-<?= ($blog_status == 'new') ? 'white' : 'dark' ?>">Blog Berhasil Dibuat!</h4>
                                    </div>
                                    <img src="<?= base_url('public/template_assets/images/login/mail.png') ?>" class="img-fluid" width="80" alt="">
                                    <div class="col-12 pl-0">
                                        <h5 class="d-inline-block text-truncate text-<?= ($blog_status == 'new') ? 'white' : 'dark' ?> mt-3" style="max-width: 200px;">Blog : <?= $blog['title'] ?></h5>
                                    </div>
                                    <small class="cnf-mail mb-1" style="line-height: 1.2;">Terima kasih! Blog Anda telah berhasil diterima dan saat ini sedang menunggu persetujuan dari admin. Blog Anda akan ditinjau terlebih dahulu sebelum dipublikasikan.</small>
                                    <div class="d-inline-block w-100">
                                        <a href="<?= base_url('blog') ?>" class="btn btn-white mt-3">Periksa daftar blog anda</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 content-right">
                                <img src="<?= base_url('public/template_assets/images/login/01.png') ?>" class="img-fluid image-right" alt="">
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>