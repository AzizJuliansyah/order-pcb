
<div class="wrapper">
    <section class="login-content">
        <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
                <div class="col-lg-8">
                    <div class="card auth-card">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center auth-content">
                                <div class="col-lg-6 content-left">
                                    <div class="p-3">
                                        <h4 class="card-title mb-3">Invoice # <?= $order['order_code'] ?></h4>
                                        <img src="<?= base_url('public/local_assets/images/success_icon.png') ?>" class="img-fluid" width="80" alt="">
                                        <h3 class="mt-3 mb-0 text-success">Pembayaran Berhasil!</h3>
                                        <small class="cnf-mail mb-1" style="line-height: 1.2;">Terima kasih! Pesanan Anda akan segera kami proses sesuai ketentuan. Silakan tunggu kabar selanjutnya mengenai status pengiriman atau pemenuhan pesanan Anda.</small>
                                        <div class="d-inline-block w-100">
                                            <a href="<?= base_url('customer/order_detail/' . encrypt_id($order['order_id'])) . '?from=list' ?>" class="btn btn-success mt-3">
                                                <i class="las la-angle-left"></i>
                                                Periksa Detail Pesanan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 content-right">
                                    <img src="<?= base_url('public/local_assets/images/payment_success.jpg') ?>" class="img-fluid image-right" alt="Image by pch.vector on Freepik">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>