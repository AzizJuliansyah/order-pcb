<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= get_website_name() ?> | Order Detail # <?= $order['order_code'] ?> PDF</title>
    <link rel="shortcut icon" href="<?= base_url('public/' . get_website_logo()) ?>">
    <style>
        body {
            position: relative;
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 400px;
            opacity: 0.1;
            transform: translate(-50%, -50%);
            z-index: -1;
         }
        .text-uppercase {
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
   <img src="<?= base_url('public/' . get_website_logo()) ?>" class="watermark" alt="Watermark">
   <div class="row">
      <h1>Invoice # <?= $order['order_code'] ?></h1>
      <table style="width: 100%; border: none;">
         <tr>
            <td style="width: 60px;">
               <div style="width: 60px; height: 60px; border-radius: 50%; overflow: hidden;">
                  <img src="<?= $profile_img_path ?>" style="width: 100%; height: 100%; object-fit: cover;">
               </div>
            </td>
            <td style="padding-left: 12px; vertical-align: middle;">
               <h6 style="margin: 0 0 4px 0; font-size: 16px;"><?= $user_info['nama'] ?></h6>
               <small style="font-size: 12px; color: #555;"><?= $user_info['email'] ?></small>
            </td>
         </tr>
      </table>


      <div class="row">
         <table>
            <thead>
               <tr>
                  <th style="border: 1px solid #999; padding: 8px; text-align: left;"><small><strong>Order Date</strong></small></th>
                  <th style="border: 1px solid #999; padding: 8px; text-align: left;"><small><strong>Order Status</strong></small></th>
                  <th style="border: 1px solid #999; padding: 8px; text-align: left;"><small><strong>Order Code</strong></small></th>
                  <th style="border: 1px solid #999; padding: 8px; text-align: left;"><small><strong>Billing Address</strong></small></th>
                  <th style="border: 1px solid #999; padding: 8px; text-align: left;"><small><strong>Shipping Address</strong></small></th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td style="border: 1px solid #999; padding: 8px; text-align: left;"><small><?= format_bulan($order['date_created']) ?></small></td>
                  <td style="border: 1px solid #999; padding: 8px; text-align: left;">
                     <?php if ($order['payment_status'] == 'payment_pending'): ?>
                        <p>Menunggu Pembayaran</p>
                     <?php elseif ($order['payment_status'] == 'payment_process'): ?>
                        <p>Pembayaran Diproses</p>
                     <?php elseif ($order['payment_status'] == 'payment_success'): ?>
                        <p style="margin-bottom: -3px;">Pembayaran Berhasil</p>
                     <?php elseif ($order['payment_status'] == 'payment_cancelled'): ?>
                        <p>Pembayaran Dibatalkan</p>
                     <?php else: ?>
                        <p>Status Tidak Diketahui</p>
                     <?php endif; ?>
                     <?php if (!empty($order['payment_info'])) { ?>
                        <?php $payment_info = json_decode($order['payment_info'], true); ?>
                        <small><?= format_bulan($payment_info['payment_time']) ?></small>
                     <?php } ?>

                     <?php if ($order['order_status'] == 'order_pending'): ?>
                        <p>Pesanan Menunggu</p>
                     <?php elseif ($order['order_status'] == 'order_confirmed'): ?>
                        <p>Pesanan Diterima</p>
                     <?php elseif ($order['order_status'] == 'order_processing'): ?>
                        <p>Pesanan Diproses</p>
                     <?php elseif ($order['order_status'] == 'order_completed'): ?>
                        <p>Pesanan Selesai</p>
                     <?php elseif ($order['order_status'] == 'order_cancelled'): ?>
                        <p>Pesanan Dibatalkan</p>
                     <?php elseif ($order['order_status'] == 'order_refunded'): ?>
                        <p>Pesanan di refund</p>
                     <?php elseif ($order['order_status'] == 'order_failed'): ?>
                        <p>Pesanan gagal</p>
                     <?php else: ?>
                        <p>Status Tidak Diketahui</p>
                     <?php endif; ?>
                  </td>
                  <td style="border: 1px solid #999; padding: 8px; text-align: center;">
                     <small>
                        <strong># <?= $order['order_code'] ?></strong>
                     </small>
                  </td>
                  <td style="border: 1px solid #999; padding: 8px; text-align: left;">
                     <small class="mb-0 limited-text">
                        <?= $user_info['alamat_lengkap'] ?? '-' ?>, <?= $user_info['kode_pos'] ?? '-' ?>, <?= $user_info['kecamatan'] ?? '-' ?>, <?= $user_info['kota'] ?? '-' ?>, <?= $user_info['provinsi'] ?? '-' ?><br>                                                               
                        Nama: <?= $user_info['nama'] ?? '-' ?><br>
                        Kontak: <?= $user_info['nomor'] ?? '-' ?><br>
                     </small>
                  </td>
                  <td style="border: 1px solid #999; padding: 8px; text-align: left;">
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

      <div class="row">
         <?php if (!empty($pcb_items)) : ?>
            <h3>Order PCB</h3>
            <table>
               <thead>
                  <tr>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;">#</th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: left;"><small><strong>Product Type</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>Gerber File</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>B.O.M File</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>Pick and Place File</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>Lead Free</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>Functional Test</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>Quantity</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>Leadtime</strong></small></th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $no = 1;
                     foreach ($pcb_items as $item) :
                     $product_info = json_decode($item->product_info, true);
                  ?>
                  <tr>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;"><?= $no++ ?></td>
                     <td style="width: 40%;border: 1px solid #999; padding: 8px; text-align: left;">
                        <h3 class="text-uppercase"><?= htmlspecialchars($item->product_type) ?></h3>
                        <small class="limited-text" onclick="showFullText(this)" data-fulltext="<?= htmlspecialchars($product_info['note']) ?>">
                           <?= htmlspecialchars($product_info['note'] ?? '-') ?>
                        </small>
                     </td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;">
                        <?php if (!empty($product_info['gerberfile'])) { ?>
                           <a href="<?= base_url('public/' . $product_info['gerberfile']) ?>" download>Yes</a>
                        <?php } elseif ($product_info['gerberfile'] == null) { ?>
                           <span>No</span>
                        <?php } else { ?>
                           <span>Error</span>
                        <?php } ?>
                     </td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;">
                        <?php if (!empty($product_info['bomfile'])) { ?>
                           <a href="<?= base_url('public/' . $product_info['bomfile']) ?>" download>Yes</a>
                        <?php } elseif ($product_info['bomfile'] == null) { ?>
                           <span>No</span>
                        <?php } else { ?>
                           <span>Error</span>
                        <?php } ?>
                     </td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;">
                        <?php if (!empty($product_info['pickandplacefile'])) { ?>
                           <a href="<?= base_url('public/' . $product_info['pickandplacefile']) ?>" download>Yes</a>
                        <?php } elseif ($product_info['pickandplacefile'] == null) { ?>
                           <span>No</span>
                        <?php } else { ?>
                           <span>Error</span>
                        <?php } ?>
                     </td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;">
                        <?php if ($product_info['leadfree'] == 1) { ?>
                           <strong>Yes</strong>
                        <?php } elseif ($product_info['leadfree'] == 0) { ?>
                           <strong>No</strong>
                        <?php } else { ?>
                           <strong>Error</strong>
                        <?php } ?>
                     </td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;">
                        <?php if ($product_info['functionaltest'] == 1) { ?>
                           <strong>Yes</strong>
                        <?php } elseif ($product_info['functionaltest'] == 0) { ?>
                           <strong>No</strong>
                        <?php } else { ?>
                           <strong>Error</strong>
                        <?php } ?>
                     </td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;"><?= htmlspecialchars($product_info['quantity'] ?? '-') ?></td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;"><?= htmlspecialchars($product_info['leadtime'] ?? '-') ?> Days</td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         <?php endif; ?>


         <?php if (!empty($cnc_items)) : ?>
            <h3>Order CNC</h3>
            <table>
               <thead>
                  <tr>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;">#</th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: left;"><small><strong>Product Type</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>3D File</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>2D File</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>Material</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>Finishing</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>Quantity</strong></small></th>
                     <th style="border: 1px solid #999; padding: 8px; text-align: center;"><small><strong>Leadtime</strong></small></th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $no = 1;
                     foreach ($cnc_items as $item) :
                     $product_info = json_decode($item->product_info, true);
                  ?>
                  <tr>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;"><?= $no++ ?></td>
                     <td style="width: 40%;border: 1px solid #999; padding: 8px; text-align: left;">
                        <h3 class="text-uppercase"><?= htmlspecialchars($item->product_type) ?></h3>
                        <small>
                           <?= htmlspecialchars($product_info['note'] ?? '-') ?>
                        </small>
                     </td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;">
                        <?php if (!empty($product_info['3dfile'])) { ?>
                           <a href="<?= base_url('public/' . $product_info['3dfile']) ?>" download>Yes</a>
                        <?php } elseif ($product_info['3dfile'] == null) { ?>
                           <span>No</span>
                        <?php } else { ?>
                           <span>Error</span>
                        <?php } ?>
                     </td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;">
                        <?php if (!empty($product_info['2dfile'])) { ?>
                           <a href="<?= base_url('public/' . $product_info['2dfile']) ?>" download>Yes</a>
                        <?php } elseif ($product_info['2dfile'] == null) { ?>
                           <span>No</span>
                        <?php } else { ?>
                           <span>Error</span>
                        <?php } ?>
                     </td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;"><?= get_cnc_material_name($product_info['material'] ?? '-') ?></td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;"><?= get_cnc_finishing_name($product_info['finishing'] ?? '-') ?></td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;"><?= htmlspecialchars($product_info['quantity'] ?? '-') ?></td>
                     <td style="border: 1px solid #999; padding: 8px; text-align: center;"><?= htmlspecialchars($product_info['leadtime'] ?? '-') ?> Days</td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         <?php endif; ?>
      </div>

      <div style="display: flex; justify-content: flex-end; width: 100%;">
         <table style="border-collapse: collapse; width: auto; min-width: 220px; margin-left: auto;">
            <thead>
               <tr>
                  <th style="border: 1px solid #999; padding: 8px; text-align: left;"><strong>Payment Details</strong></th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td style="padding: 8px; text-align: left;">
                     <h4 style="margin-bottom: -2px;">Sub Total</h4>
                     <span><?= $order['total_price'] == 0 ? '-' : 'Rp. ' . number_format($order['total_price'], 2, ',', '.') ?></span>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 8px; text-align: left;">
                     <h4 style="margin-bottom: -2px;">Discount</h4>
                     <span>-</span>
                  </td>
               </tr>
               <tr>
                  <td style="padding: 8px; text-align: left;">
                     <h3 style="margin-bottom: -2px;"><strong>Total</strong></h3>
                     <span><?= $order['total_price'] == 0 ? '-' : 'Rp. ' . number_format($order['total_price'], 2, ',', '.') ?></span>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </div>
</body>
</html>