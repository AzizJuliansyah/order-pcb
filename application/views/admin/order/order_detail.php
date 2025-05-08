<!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-12">
                        <div class="card bottom-right shadow-showcase">
                           <div class="card-body">
                              <div class="d-flex justify-content-between">
                                 <div class="form-group">
                                    <?php
                                       $from = $this->input->get('from');
                                       $back_url = base_url('admin/order_list');

                                       if ($from == 'management') {
                                          $back_url = base_url('admin/order_management');
                                       } elseif ($from == 'list') {
                                          $back_url = base_url('admin/order_list');
                                       } elseif ($from == 'list_today') {
                                          $back_url = base_url('admin/order_list_today');
                                       }
                                    ?>
                                    <a href="<?= $back_url ?>" class="d-flex align-items-center">
                                       <i class="las la-angle-left font-size-20"></i>
                                       <h5>Kembali</h5>
                                    </a>
                                 </div>
                                 <div class="form-group">
                                    <?= form_open('admin/terima_order', ['id' => 'TerimaOrderForm']) ?>
                                       <?php if (!empty($order['total_price'])) { ?>
                                          <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#TerimaOrder">
                                             Orderan Diterima
                                          </button>
                                       <?php } else { ?>
                                          <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#TerimaOrder">
                                             Terima Orderan
                                          </button>
                                       <?php } ?>
                                       <div id="TerimaOrder" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="TerimaOrderTitle" aria-hidden="true">
                                          <div class="modal-dialog modal-dialog-scrollable" role="document">
                                          <div class="modal-content border-radius-10">
                                                <div class="modal-header">
                                                   <h4 class="card-title mb-0">Invoice# <?= $order['order_code'] ?></h4>
                                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">×</span>
                                                   </button>
                                                </div>
                                                <div class="modal-body">
                                                   <input type="hidden" name="order_id" value="<?= encrypt_id($order['order_id']) ?>">
                                                   
                                                   <div class="form-group">
                                                      <h6 class="card-title mb-0">Admin : <?= get_admin_name($order['admin']) ?></h6>
                                                   </div>

                                                   <div class="form-group">
                                                      <label for="total_price" class="font-size-14" style="margin-bottom: -13px;">Total Price :</label>
                                                      <div class="input-group mb-2">
                                                         <div class="input-group-prepend">
                                                            <span class="input-group-text border-radius-top-left-5 border-radius-bottom-left-5" id="basic-addon4">Rp.</span>
                                                         </div>
                                                         <?php if (!empty($order['total_price'])) { ?>
                                                            <input type="text" class="form-control <?= !empty($errors['total_price']) ? 'is-invalid' : '' ?> border-radius-top-right-5 border-radius-bottom-right-5  max-height-40" name="total_price" id="total_price" value="<?= number_format($order['total_price'], 2, ',', '.') ?>" disabled>
                                                         <?php } else { ?>
                                                            <input type="text" class="form-control <?= !empty($errors['total_price']) ? 'is-invalid' : '' ?> border-radius-top-right-5 border-radius-bottom-right-5  max-height-40" name="total_price" id="total_price" value="<?= number_format($order['total_price'], 2, ',', '.') ?>">
                                                         <?php } ?>
                                                         <?php if (!empty($errors['total_price'])): ?>
                                                            <div class="invalid-feedback"><?= $errors['total_price'] ?></div>
                                                         <?php endif; ?>
                                                      </div>
                                                   </div>

                                                   <div class="col-12 mt-2 mb-2">
                                                      <div class="divider-text">
                                                         <span>Operator</span>
                                                      </div>
                                                   </div>
                                                      
                                                   <div class="form-group">
                                                      <?php foreach ($operator as $index => $item) { ?>
                                                         <div class="form-check">
                                                            <label for="operator<?= $item['id'] ?>">
                                                               <input type="radio" class="form-check-input" name="operator_id" id="operator<?= $item['id'] ?>" value="<?= encrypt_id($item['id']) ?>" <?= ($order['operator'] == $item['id']) ? 'checked' : '' ?>>
                                                               <?= $item['nama'] ?>
                                                            </label>
                                                         </div>
                                                      <?php } ?>
                                                   </div>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                   <?php if (!empty($order['operator'])) { ?>
                                                      <button type="submit" class="btn btn-outline-secondary">Ganti Operator</button>
                                                   <?php } else { ?>
                                                      <button type="submit" class="btn btn-outline-success">Terima Orderan</button>
                                                   <?php } ?>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    <?= form_close() ?>
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
                              <div class="d-flex align-items-center justify-content-center">
                                 <button type="button" class="btn btn-outline-warning mr-2" data-toggle="modal" data-target="#Shippingstatus"></i>Shipping Status</button>
                                 <div id="Shippingstatus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ShippingstatusTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                       <div class="modal-content border-radius-10">
                                          <div class="modal-header">
                                             <h4 class="card-title text-dark mb-0">Invoice# <?= $order['order_code'] ?></h4>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <div class="form-group">
                                                <h6 class="card-title text-dark mb-0">Operator : <?= get_admin_name($order['operator']) ?></h6>
                                             </div>

                                             <div class="col-12">
                                                <div class="divider-text">
                                                   <span>History Shipping Status</span>
                                                </div>
                                             </div>
                                                      
                                             <div class="form-group mt-3 ml-3">
                                                <div class="profile-line m-0 d-flex align-items-center justify-content-between position-relative">
                                                   <ul class="list-inline p-0 m-0 w-100">
                                                      <?php if (!empty($shipping_status_list)): ?>
                                                         <?php foreach ($shipping_status_list as $item): ?>
                                                            <li>
                                                               <div class="row align-items-top">
                                                                  <div class="col-md-12">
                                                                     <div class="media profile-media pb-3 align-items-top">
                                                                        <div class="profile-dots border-primary mt-1"></div>
                                                                        <div class="ml-4">
                                                                           <h6 style="margin-bottom: -8px;">
                                                                              <?= get_shipping_status_name($item['shipping_id']) ?>
                                                                           </h6>
                                                                           <small class="text-muted">
                                                                              <?= format_bulan($item['date']) ?>
                                                                           </small>
                                                                        </div>
                                                                     </div>   
                                                                  </div>
                                                               </div>
                                                            </li>
                                                         <?php endforeach; ?>
                                                      <?php else: ?>
                                                         <div class="col-12">
                                                            <div class="text-center">
                                                                  <i class="las la-box-open text-muted" style="font-size: 5rem;"></i>
                                                                  <h6 class="text-muted">Belum ada history pengiriman</h6>
                                                                  <small class="text-muted">Semua history yang masuk akan ditampilkan di sini.</small>
                                                            </div>
                                                         </div>
                                                      <?php endif; ?>
                                                   </ul>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="invoice-btn">
                                    <a href="<?= base_url('index/order_detail_download_pdf/' . encrypt_id($order['order_id'])) ?>" class="btn btn-primary-dark"><i class="las la-file-download font-size-20"></i>PDF</a>
                                 </div>
                              </div>
                           </div>
                           <div class="card-body">
                                 <div class="row">
                                    <div class="col-sm-12">
                                       <div class="d-flex justify-content-start">
                                          <div class="form-group mr-3">
                                             <?php if ($user_info['foto'] != null) { ?>
                                                <div class="profile-img position-relative">
                                                   <img src="<?= base_url('public/' . $user_info['foto']) ?>" class="logo-invoice img-fluid" alt="profile-image">
                                                </div>
                                             <?php } else { ?>
                                                <div class="profile-img position-relative">
                                                   <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="logo-invoice img-fluid" alt="profile-image">
                                                </div>
                                             <?php } ?>
                                          </div>
                                          <div class="form-group">
                                             <h6><?= $user_info['nama'] ?></h6>
                                             <small><?= $user_info['email'] ?></small>
                                          </div>
                                          </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="table-responsive-sm">
                                             <table class="table">
                                                <thead>
                                                   <tr>
                                                      <th scope="col"><small><strong>Order Date</strong></small></th>
                                                      <th scope="col"><small><strong>Order Status</strong></small></th>
                                                      <th scope="col"><small><strong>Order Code</strong></small></th>
                                                      <th scope="col"><small><strong>Billing Address</strong></small></th>
                                                      <th scope="col"><small><strong>Shipping Address</strong></small></th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <tr>
                                                         <td><small><?= format_bulan($order['date_created']) ?></small></td>
                                                         <td>
                                                            <?php if ($order['payment_status'] == 'payment_pending'): ?>
                                                               <span class="badge badge-warning font-size-12 m-2">Menunggu Pembayaran</span>
                                                            <?php elseif ($order['payment_status'] == 'payment_process'): ?>
                                                               <span class="badge badge-primary font-size-12 m-2">Pembayaran Diproses</span>
                                                            <?php elseif ($order['payment_status'] == 'payment_success'): ?>
                                                               <span class="badge badge-success font-size-12 m-2">Pembayaran Berhasil</span>
                                                            <?php elseif ($order['payment_status'] == 'payment_cancelled'): ?>
                                                               <span class="badge badge-dark font-size-12 m-2">Pembayaran Dibatalkan</span>
                                                            <?php else: ?>
                                                               <span class="badge badge-light font-size-12 m-2">Status Tidak Diketahui</span>
                                                            <?php endif; ?>

                                                            <?php if ($order['order_status'] == 'order_pending'): ?>
                                                               <span class="badge border border-warning text-warning font-size-12 m-2">Pesanan Menunggu</span>
                                                            <?php elseif ($order['order_status'] == 'order_confirmed'): ?>
                                                               <span class="badge border border-secondary text-secondary font-size-12 m-2">Pesanan Diterima</span>
                                                            <?php elseif ($order['order_status'] == 'order_processing'): ?>
                                                               <span class="badge border border-primary text-primary font-size-12 m-2">Pesanan Diproses</span>
                                                            <?php elseif ($order['order_status'] == 'order_completed'): ?>
                                                               <span class="badge border border-success text-success font-size-12 m-2">Pesanan Selesai</span>
                                                            <?php elseif ($order['order_status'] == 'order_cancelled'): ?>
                                                               <span class="badge border border-danger text-danger font-size-12 m-2">Pesanan Dibatalkan</span>
                                                            <?php elseif ($order['order_status'] == 'order_refunded'): ?>
                                                               <span class="badge border border-info text-info font-size-12 m-2">Pesanan di refund</span>
                                                            <?php elseif ($order['order_status'] == 'order_failed'): ?>
                                                               <span class="badge border border-dark text-dark font-size-12 m-2">Pesanan gagal</span>
                                                            <?php else: ?>
                                                               <span class="badge border border-light text-light font-size-12 m-2">Status Tidak Diketahui</span>
                                                            <?php endif; ?>
                                                         </td>
                                                         <td>
                                                            <small class="d-flex align-items-center">
                                                               <strong class="mr-1">#</strong>
                                                               <strong><?= $order['order_code'] ?></strong>
                                                            </small>
                                                         </td>
                                                         <td>
                                                            <small class="mb-0 limited-text">
                                                               <?= $user_info['alamat_lengkap'] ?? '-' ?>, <?= $user_info['kode_pos'] ?? '-' ?>, <?= $user_info['kecamatan'] ?? '-' ?>, <?= $user_info['kota'] ?? '-' ?>, <?= $user_info['provinsi'] ?? '-' ?><br>
                                                               
                                                               Nama: <?= $user_info['nama'] ?? '-' ?><br>
                                                               Kontak: <?= $user_info['nomor'] ?? '-' ?><br>
                                                            </small>
                                                         </td>
                                                         <td>
                                                            <?php $shipping_info = json_decode($order['shipping_info'], true) ?? []; ?>
                                                            <small class="mb-0 limited-text">
                                                               <?= $shipping_info['alamat_lengkap'] ?? '-' ?>, <?= $shipping_info['kode_pos'] ?? '-' ?>, <?= $shipping_info['kecamatan'] ?? '-' ?>, <?= $shipping_info['kota'] ?? '-' ?>, <?= $shipping_info['provinsi'] ?? '-' ?><br>
                                                               
                                                               Nama: <?= $shipping_info['nama'] ?? '-' ?><br>
                                                               Kontak: <?= $shipping_info['nomor'] ?? '-' ?><br>
                                                            </small>
                                                         </td>
                                                   </tr>
                                                </tbody>
                                             </table>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <?php if (!empty($pcb_items)) : ?>
                                    <div class="col-sm-12">
                                       <h5 class="mb-3">Order PCB</h5>
                                       <div class="table-responsive-sm">
                                             <table class="table table-sm">
                                                <thead>
                                                   <tr>
                                                         <th class="text-center" scope="col">#</th>
                                                         <th scope="col"><small><strong>Product Type</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>Gerber File</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>B.O.M File</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>Pick and Place File</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>Lead Free</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>Functional Test</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>Quantity</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>Leadtime</strong></small></th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <?php $no = 1; foreach ($pcb_items as $item) :
                                                         $product_info = json_decode($item->product_info, true);
                                                   ?>
                                                   <tr>
                                                         <th class="text-center"><?= $no++ ?></th>
                                                         <td style="width: 40%">
                                                            <h6 class="mb-0 text-uppercase"><?= htmlspecialchars($item->product_type) ?></h6>
                                                            <small class="limited-text" onclick="showFullText(this)" data-fulltext="<?= htmlspecialchars($product_info['note']) ?>">
                                                               <?= htmlspecialchars($product_info['note'] ?? '-') ?>
                                                            </small>
                                                         </td>
                                                         <td class="text-center">
                                                            <?php if (!empty($product_info['gerberfile'])) { ?>
                                                               <a href="<?= base_url('public/' . $product_info['gerberfile']) ?>" download class="badge border border-primary text-primary d-flex align-items-center">Yes <i class="las la-file-download font-size-20"></i></a>
                                                            <?php } elseif ($product_info['gerberfile'] == null) { ?>
                                                               <span class="badge border border-danger text-danger">No</span>
                                                            <?php } else { ?>
                                                               <span class="badge border border-dark text-danger">Error</span>
                                                            <?php } ?>
                                                         </td>
                                                         <td class="text-center">
                                                            <?php if (!empty($product_info['bomfile'])) { ?>
                                                               <a href="<?= base_url('public/' . $product_info['bomfile']) ?>" download class="badge border border-primary text-primary d-flex align-items-center">Yes <i class="las la-file-download font-size-20"></i></a>
                                                            <?php } elseif ($product_info['bomfile'] == null) { ?>
                                                               <span class="badge border border-danger text-danger">No</span>
                                                            <?php } else { ?>
                                                               <span class="badge border border-dark text-danger">Error</span>
                                                            <?php } ?>
                                                         </td>
                                                         <td class="text-center">
                                                            <?php if (!empty($product_info['pickandplacefile'])) { ?>
                                                               <a href="<?= base_url('public/' . $product_info['pickandplacefile']) ?>" download class="badge border border-primary text-primary d-flex align-items-center">Yes <i class="las la-file-download font-size-20"></i></a>
                                                            <?php } elseif ($product_info['pickandplacefile'] == null) { ?>
                                                               <span class="badge border border-danger text-danger">No</span>
                                                            <?php } else { ?>
                                                               <span class="badge border border-dark text-danger">Error</span>
                                                            <?php } ?>
                                                         </td>
                                                         <td class="text-center">
                                                            <?php if ($product_info['leadfree'] == 1) { ?>
                                                               <strong>Yes</strong>
                                                            <?php } elseif ($product_info['leadfree'] == 0) { ?>
                                                               <strong>No</strong>
                                                            <?php } else { ?>
                                                               <strong>Error</strong>
                                                            <?php } ?>
                                                         </td>
                                                         <td class="text-center">
                                                            <?php if ($product_info['functionaltest'] == 1) { ?>
                                                               <strong>Yes</strong>
                                                            <?php } elseif ($product_info['functionaltest'] == 0) { ?>
                                                               <strong>No</strong>
                                                            <?php } else { ?>
                                                               <strong>Error</strong>
                                                            <?php } ?>
                                                         </td>
                                                         <td class="text-center"><?= htmlspecialchars($product_info['quantity'] ?? '-') ?></td>
                                                         <td class="text-center"><?= htmlspecialchars($product_info['leadtime'] ?? '-') ?> Days</td>
                                                   </tr>
                                                   <?php endforeach; ?>
                                                </tbody>
                                             </table>
                                       </div>
                                    </div>
                                    <?php endif; ?>


                                    <?php if (!empty($cnc_items)) : ?>
                                    <div class="col-sm-12">
                                       <h5 class="mb-3">Order CNC</h5>
                                       <div class="table-responsive-sm">
                                             <table class="table table-sm">
                                                <thead>
                                                   <tr>
                                                         <th class="text-center" scope="col">#</th>
                                                         <th scope="col"><small><strong>Product Type</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>3D File</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>2D File</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>Material</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>Finishing</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>Quantity</strong></small></th>
                                                         <th class="text-center" scope="col"><small><strong>Leadtime</strong></small></th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                   <?php $no = 1; foreach ($cnc_items as $item) :
                                                         $product_info = json_decode($item->product_info, true);
                                                   ?>
                                                   <tr>
                                                         <th class="text-center"><?= $no++ ?></th>
                                                         <td style="width: 40%">
                                                            <h6 class="mb-0 text-uppercase"><?= htmlspecialchars($item->product_type) ?></h6>
                                                            <small class="limited-text" onclick="showFullText(this)" data-fulltext="<?= htmlspecialchars($product_info['note']) ?>">
                                                               <?= htmlspecialchars($product_info['note'] ?? '-') ?>
                                                            </small>
                                                         </td>
                                                         <td class="text-center">
                                                            <?php if (!empty($product_info['3dfile'])) { ?>
                                                               <a href="<?= base_url('public/' . $product_info['3dfile']) ?>" download class="badge border border-primary text-primary d-flex align-items-center">Yes <i class="las la-file-download font-size-20"></i></a>
                                                            <?php } elseif ($product_info['3dfile'] == null) { ?>
                                                               <span class="badge border border-danger text-danger">No</span>
                                                            <?php } else { ?>
                                                               <span class="badge border border-dark text-danger">Error</span>
                                                            <?php } ?>
                                                         </td>
                                                         <td class="text-center">
                                                            <?php if (!empty($product_info['2dfile'])) { ?>
                                                               <a href="<?= base_url('public/' . $product_info['2dfile']) ?>" download class="badge border border-primary text-primary d-flex align-items-center">Yes <i class="las la-file-download font-size-20"></i></a>
                                                            <?php } elseif ($product_info['2dfile'] == null) { ?>
                                                               <span class="badge border border-danger text-danger">No</span>
                                                            <?php } else { ?>
                                                               <span class="badge border border-dark text-danger">Error</span>
                                                            <?php } ?>
                                                         </td>
                                                         <td class="text-center"><?= get_cnc_material_name($product_info['material'] ?? '-') ?></td>
                                                         <td class="text-center"><?= get_cnc_finishing_name($product_info['finishing'] ?? '-') ?></td>
                                                         <td class="text-center"><?= htmlspecialchars($product_info['quantity'] ?? '-') ?></td>
                                                         <td class="text-center"><?= htmlspecialchars($product_info['leadtime'] ?? '-') ?> Days</td>
                                                   </tr>
                                                   <?php endforeach; ?>
                                                </tbody>
                                             </table>
                                       </div>
                                    </div>
                                    <?php endif; ?>

                                 </div>
                                 <div class="row mb-3">
                                    <div class="offset-lg-8 col-lg-4">
                                       <div class="or-detail rounded">
                                             <div class="p-3">
                                                <h5 class="mb-3">Payment Details</h5>
                                                <div class="mb-2">
                                                   <h6>Sub Total</h6>
                                                   <p><?= $order['total_price'] == 0 ? '-' : 'Rp. ' . number_format($order['total_price'], 2, ',', '.') ?></p>
                                                </div>
                                                <div>
                                                   <h6>Discount</h6>
                                                   <p>-</p>
                                                </div>
                                             </div>
                                             <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                                <h6>Total</h6>
                                                <h5 class="text-primary font-weight-700"><?= $order['total_price'] == 0 ? '-' : 'Rp. ' . number_format($order['total_price'], 2, ',', '.') ?></h5>
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
   document.querySelectorAll('[data-fulltext]').forEach(el => {
      const fullText = el.getAttribute('data-fulltext');
      const limit = 100;
      if (fullText.length > limit) {
         el.textContent = fullText.substring(0, limit) + '...';
      } else {
         el.textContent = fullText;
      }
   });


   function showFullText(element) {
      const fullText = element.getAttribute('data-fulltext');
      const limit = 100;

      if (element.classList.contains('expanded')) {
         element.classList.remove('expanded');
         if (fullText.length > limit) {
               element.textContent = fullText.substring(0, limit) + '...';
         } else {
               element.textContent = fullText;
         }
      } else {
         element.classList.add('expanded');
         element.textContent = fullText;
      }
   }

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