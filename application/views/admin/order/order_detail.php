<!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid">
               <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="card bottom-right shadow-showcase">
                           <div class="card-body">
                              <div class="d-flex justify-content-between">
                                 <div class="form-group">
                                    <a href="<?= base_url('admin/order_list') ?>" class="d-flex align-items-center">
                                       <i class="las la-angle-left font-size-20"></i>
                                       <h5>Kembali</h5>
                                    </a>
                                 </div>
                                 <div class="form-group m-1">
                                    <?php if (!empty($order['operator'])) { ?>
                                       <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#tetapkanOperator">
                                          Ganti operator
                                       </button>
                                    <?php } else { ?>
                                       <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#tetapkanOperator">
                                          Terima dan tetapkan operator
                                       </button>
                                    <?php } ?>
                                    <div id="tetapkanOperator" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tetapkanOperatorTitle" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-scrollable" role="document">
                                       <div class="modal-content border-radius-10">
                                             <div class="modal-header">
                                                <?php if (!empty($order['operator'])) { ?>
                                                   <h5 class="modal-title" id="tetapkanOperatorTitle">Ganti Operator</h5>
                                                <?php } else { ?>
                                                   <h5 class="modal-title" id="tetapkanOperatorTitle">Terima Orderan dan Tetapkan Operator</h5>
                                                <?php } ?>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                   <span aria-hidden="true">×</span>
                                                </button>
                                             </div>
                                             <div class="modal-body">
                                                <?= form_open('admin/tetapkan_operator', ['id' => 'TetapkanOperatorForm']) ?>
                                                <div class="form-group">
                                                   <?php foreach ($operator as $index => $item) { ?>
                                                      <input type="hidden" name="order_id" value="<?= encrypt_id($order['order_id']) ?>">
                                                      <div class="form-check">
                                                         <label for="operator<?= $item['id'] ?>">
                                                            <input type="radio" class="form-check-input" name="operator_id" id="operator<?= $item['id'] ?>" value="<?= encrypt_id($item['id']) ?>" <?= ($order['operator'] == $item['id']) ? 'checked' : '' ?>>
                                                            <?= $item['nama'] ?>
                                                         </label>
                                                      </div>
                                                   <?php } ?>
                                                </div>
                                                   <div class="float-right">
                                                      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                      <?php if (!empty($order['operator'])) { ?>
                                                         <button type="submit" class="btn btn-outline-primary">Ganti Operator</button>
                                                      <?php } else { ?>
                                                         <button type="submit" class="btn btn-outline-primary">Tetapkan Operator</button>
                                                      <?php } ?>
                                                   </div>
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
                </div>
                <div class="row">
                     <div class="col-lg-12">
                        <div class="card card-block card-stretch card-height print rounded">
                           <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                                 <div class="iq-header-title">
                                    <h4 class="card-title mb-0">Invoice# <?= $order['order_code'] ?></h4>
                                 </div>
                                 <div class="invoice-btn">
                                    <button type="button" class="btn btn-primary-dark mr-2"><i class="las la-print"></i> Print
                                       Print</button>
                                    <button type="button" class="btn btn-primary-dark"><i class="las la-file-download"></i>PDF</button>
                                 </div>
                           </div>
                           <div class="card-body">
                                 <div class="row">
                                    <div class="col-sm-12">                                  
                                       <img src="../assets/images/logo.svg" class="logo-invoice img-fluid mb-3" alt="image">
                                       <h5 class="mb-0">Hello, Barry Techs</h5>
                                       <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at
                                             its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as
                                             opposed to using 'Content here, content here', making it look like readable English.</p>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="table-responsive-sm">
                                             <table class="table">
                                                <thead>
                                                   <tr>
                                                         <th scope="col">Order Date</th>
                                                         <th scope="col">Order Status</th>
                                                         <th scope="col">Order ID</th>
                                                         <th scope="col">Billing Address</th>
                                                         <th scope="col">Shipping Address</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <tr>
                                                         <td><?= format_bulan($item['date_created']) ?></td>
                                                         <td>
                                                            <?php if ($order['payment_status'] == 'payment_pending'): ?>
                                                               <button type="button" class="btn font-size-12 btn-warning m-2">Menunggu Pembayaran</button>
                                                            <?php elseif ($order['payment_status'] == 'payment_process'): ?>
                                                               <button type="button" class="btn font-size-12 btn-info m-2">Pembayaran Diproses</button>
                                                            <?php elseif ($order['payment_status'] == 'payment_success'): ?>
                                                               <button type="button" class="btn font-size-12 btn-success m-2">Pembayaran Berhasil</button>
                                                            <?php elseif ($order['payment_status'] == 'payment_cancelled'): ?>
                                                               <button type="button" class="btn font-size-12 btn-danger m-2">Pembayaran Dibatalkan</button>
                                                            <?php else: ?>
                                                               <button type="button" class="btn font-size-12 btn-dark m-2">Status Tidak Diketahui</button>
                                                            <?php endif; ?>

                                                            <?php if ($order['order_status'] == 'order_pending'): ?>
                                                               <button type="button" class="btn font-size-12 btn-secondary m-2">Pesanan Menunggu</button>
                                                            <?php elseif ($order['order_status'] == 'order_processing'): ?>
                                                               <button type="button" class="btn font-size-12 btn-primary m-2">Sedang Diproses</button>
                                                            <?php elseif ($order['order_status'] == 'order_packing'): ?>
                                                               <button type="button" class="btn font-size-12 btn-secondary m-2">Sedang Packing</button>
                                                            <?php elseif ($order['order_status'] == 'order_shipping'): ?>
                                                               <button type="button" class="btn font-size-12 btn-warning m-2">Sedang Dikirim</button>
                                                            <?php elseif ($order['order_status'] == 'order_completed'): ?>
                                                               <button type="button" class="btn font-size-12 btn-success m-2">Pesanan Selesai</button>
                                                            <?php elseif ($order['order_status'] == 'order_cancelled'): ?>
                                                               <button type="button" class="btn font-size-12 btn-danger m-2">Pesanan Dibatalkan</button>
                                                            <?php elseif ($order['order_status'] == 'order_refunded'): ?>
                                                               <button type="button" class="btn font-size-12 btn-primary m-2">Pesanan di refund</button>
                                                            <?php elseif ($order['order_status'] == 'order_failed'): ?>
                                                               <button type="button" class="btn font-size-12 btn-danger m-2">Pesanan gagal</button>
                                                            <?php else: ?>
                                                               <button type="button" class="btn font-size-12 btn-dark m-2">Status Tidak Diketahui</button>
                                                            <?php endif; ?>
                                                         </td>
                                                         <td>
                                                            <div class="d-flex align-items-center">
                                                               <strong class="mr-1">#</strong>
                                                               <strong><?= $order['order_code'] ?></strong>
                                                            </div>
                                                         </td>
                                                         <td>
                                                            <p class="mb-0">PO Box 16122 Collins Street West<br>Victoria 8007 Australia<br>
                                                               Phone: +123 456 7890<br>
                                                               Email: demo@example.com<br>
                                                               Web: www.example.com
                                                            </p>
                                                         </td>
                                                         <td>
                                                            <p class="mb-0">PO Box 16122 Collins Street West<br>Victoria 8007 Australia<br>
                                                               Phone: +123 456 7890<br>
                                                               Email: demo@example.com<br>
                                                               Web: www.example.com
                                                            </p>
                                                         </td>
                                                   </tr>
                                                </tbody>
                                             </table>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <h5 class="mb-3">Order Summary</h5>
                                       <div class="table-responsive-sm">
                                             <table class="table">
                                                <thead>
                                                   <tr>
                                                         <th class="text-center" scope="col">#</th>
                                                         <th scope="col">Item</th>
                                                         <th class="text-center" scope="col">Quantity</th>
                                                         <th class="text-center" scope="col">Price</th>
                                                         <th class="text-center" scope="col">Totals</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <tr>
                                                         <th class="text-center" scope="row">1</th>
                                                         <td>
                                                            <h6 class="mb-0">Web Design</h6>
                                                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                            </p>
                                                         </td>
                                                         <td class="text-center">5</td>
                                                         <td class="text-center">$120.00</td>
                                                         <td class="text-center"><b>$2,880.00</b></td>
                                                   </tr>
                                                   <tr>
                                                         <th class="text-center" scope="row">2</th>
                                                         <td>
                                                            <h6 class="mb-0">Web Design</h6>
                                                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                            </p>
                                                         </td>
                                                         <td class="text-center">5</td>
                                                         <td class="text-center">$120.00</td>
                                                         <td class="text-center"><b>$2,880.00</b></td>
                                                   </tr>
                                                   <tr>
                                                         <th class="text-center" scope="row">3</th>
                                                         <td>
                                                            <h6 class="mb-0">Web Design</h6>
                                                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                            </p>
                                                         </td>
                                                         <td class="text-center">5</td>
                                                         <td class="text-center">$120.00</td>
                                                         <td class="text-center"><b>$2,880.00</b></td>
                                                   </tr>
                                                   <tr>
                                                         <th class="text-center" scope="row">4</th>
                                                         <td>
                                                            <h6 class="mb-0">Web Design</h6>
                                                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                            </p>
                                                         </td>
                                                         <td class="text-center">5</td>
                                                         <td class="text-center">$120.00</td>
                                                         <td class="text-center"><b>$2,880.00</b></td>
                                                   </tr>
                                                </tbody>
                                             </table>
                                       </div>
                                    </div>                              
                                 </div>
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <b class="text-danger">Notes:</b>
                                       <p class="mb-0">It is a long established fact that a reader will be distracted by the readable content of a page
                                             when looking
                                             at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters,
                                             as opposed to using 'Content here, content here', making it look like readable English.</p>
                                    </div>
                                 </div>
                                 <div class="row mt-4 mb-3">
                                    <div class="offset-lg-8 col-lg-4">
                                       <div class="or-detail rounded">
                                             <div class="p-3">
                                                <h5 class="mb-3">Order Details</h5>
                                                <div class="mb-2">
                                                   <h6>Bank</h6>
                                                   <p>Threadneedle St</p>
                                                </div>
                                                <div class="mb-2">
                                                   <h6>Acc. No</h6>
                                                   <p>12333456789</p>
                                                </div>
                                                <div class="mb-2">
                                                   <h6>Due Date</h6>
                                                   <p>12 August 2020</p>
                                                </div>
                                                <div class="mb-2">
                                                   <h6>Sub Total</h6>
                                                   <p>$4597.50</p>
                                                </div>
                                                <div>
                                                   <h6>Discount</h6>
                                                   <p>10%</p>
                                                </div>
                                             </div>
                                             <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                                <h6>Total</h6>
                                                <h3 class="text-primary font-weight-700">$4137.75</h3>
                                             </div>
                                       </div>
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
    const base_url = "<?= base_url() ?>";
</script>

<script>
    function refreshModalCSRF(modalSelector = '.modal') {
        $.get(base_url + 'csrf/get', function(res) {
            $(modalSelector).each(function() {
                const modal = $(this);
                const form = modal.find('form');

                if (form.length) {
                    form.each(function() {
                        const oldInput = $(this).find(`input[name="${res.token_name}"]`);

                        if (oldInput.length) {
                            oldInput.val(res.token_hash);
                        } else {
                            const input = `<input type="hidden" name="${res.token_name}" value="${res.token_hash}">`;
                            $(this).prepend(input);
                        }
                    });
                }
            });
        });
    }

    $(document).on('shown.bs.modal', '.modal', function() {
        refreshModalCSRF(this);
    });
</script>