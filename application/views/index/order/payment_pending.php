
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
                                    <img src="<?= base_url('public/local_assets/images/pending_icon.png') ?>" class="img-fluid" width="80" alt="">
                                    <h3 class="text-warning mt-3 mb-0">Pembayaran Tertunda!</h3>
                                    <small class="cnf-mail mb-1" style="line-height: 1.2;">Kami telah menerima permintaan pembayaran Anda, namun statusnya masih tertunda. Mohon selesaikan pembayaran atau cek kembali status transaksi Anda. Pesanan akan kami proses segera setelah pembayaran terkonfirmasi.</small>
                                    <div class="d-inline-block w-100">
                                        <a href="<?= base_url('customer/order_detail/' . encrypt_id($order['order_id'])) . '?from=list' ?>" class="btn btn-warning mt-3">
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

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= get_midtrans_credential(5) ?>"></script>
<script type="text/javascript">
   document.getElementById('pay-button').addEventListener('click', function (e) {
      var snapToken = e.currentTarget.getAttribute('data-snap-token');
      snap.pay(snapToken, {
         onSuccess: function(result){
               console.log('Success:', result);
               window.location.href = '<?= base_url('index/index_payment?status=success&order_id=') ?>' + result.order_id;
         },
         onPending: function(result){
               console.log('Pending:', result);
               window.location.href = '<?= base_url('index/index_payment?status=pending&order_id=') ?>' + result.order_id;
         },
         onError: function(result){
               console.log('Error:', result);
               window.location.href = '<?= base_url('index/index_payment?status=error&order_id=') ?>' + result.order_id;
         },
         onClose: function(){
               console.log('Popup closed without finishing the payment');
         }
      });
   });
</script>