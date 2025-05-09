
<div class="wrapper">
    <section class="login-content">
        <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
                <div class="col-lg-8">
                    <div class="card auth-card">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center auth-content">
                            <div class="col-lg-6 bg-danger content-left">
                                <div class="p-3">
                                    <img src="<?= base_url('public/template_assets/images/login/mail.png') ?>" class="img-fluid" width="80" alt="">
                                    <h2 class="mt-3 mb-0 text-white">Failed !</h2>
                                    <small class="cnf-mail mb-1" style="line-height: 1.2;">Kami mohon maaf, transaksi Anda tidak berhasil. Silakan periksa kembali metode pembayaran Anda atau coba ulangi proses pembayaran. Jika kendala berlanjut, hubungi layanan pelanggan kami untuk bantuan lebih lanjut.</small>
                                    <div class="d-inline-block w-100">
                                        <a href="<?= base_url('customer/order_detail/' . encrypt_id($order['order_id'])) . '?from=list' ?>" class="btn btn-white mt-3">
                                            <i class="las la-angle-left"></i>
                                            Periksa Detail Pesanan
                                        </a>
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