
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid p-0">
                <div class="row m-sm-0 px-3">
                    <div class="col-lg-7 col-sm-12">
                        <div class="card border-radius-5">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="ordertab-1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pcb-tab" data-toggle="tab" href="#pcb" role="tab" aria-controls="pcb-tab" aria-selected="true">PCB</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="cnc-tab" data-toggle="tab" href="#cnc" role="tab" aria-controls="cnc-tab" aria-selected="false">CNC</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="ordertabcontent-2">
                                    <div class="tab-pane fade show active" id="pcb" role="tabpanel" aria-labelledby="pcb-tab">
                                        <?= form_open_multipart('index/order_pcb_form', ['id' => 'file-upload-form']) ?>
                                            <div class="form-group mt-5">
                                                <div class="row">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="gerberfile">Gerber File</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <div class="input-group mb-2">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input <?= !empty($errors['gerberfile']) ? 'is-invalid' : '' ?>" accept=".zip,.rar" name="gerberfile" id="gerberfile">
                                                                <label class="custom-file-label" for="gerberfile">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <?php if (!empty($errors['gerberfile'])): ?>
                                                            <small class="text-danger"><?= $errors['gerberfile'] ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="bomfile">B.O.M File</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <div class="input-group mb-2">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input <?= !empty($errors['bomfile']) ? 'is-invalid' : '' ?>" accept=".txt,.csv" name="bomfile" id="bomfile">
                                                                <label class="custom-file-label" for="bomfile">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <?php if (!empty($errors['bomfile'])): ?>
                                                            <small class="text-danger"><?= $errors['bomfile'] ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="pickandplacefile">Pick and Place File</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <div class="input-group mb-2">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input <?= !empty($errors['pickandplacefile']) ? 'is-invalid' : '' ?>" accept=".txt,.csv" name="pickandplacefile" id="pickandplacefile">
                                                                <label class="custom-file-label" for="pickandplacefile">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <?php if (!empty($errors['pickandplacefile'])): ?>
                                                            <small class="text-danger"><?= $errors['pickandplacefile'] ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4">
                                                <div class="row">
                                                    <div class="col-8 col-md-3" style="margin-bottom: -13px">
                                                        <label for="leadfree">Lead Free</label>
                                                    </div>
                                                    <div class="col-4 col-md-9">
                                                        <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                                            <div class="custom-switch-inner">
                                                                <input type="checkbox" class="custom-control-input" id="leadfree" name="leadfree" id="leadfree" value="1" <?= set_checkbox('leadfree', '1', isset($old['leadfree']) && $old['leadfree'] == '1') ?>>
                                                                <label class="custom-control-label" for="leadfree" data-on-label="Yes" data-off-label="No">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <?php if (!empty($errors['leadfree'])): ?>
                                                            <div class="invalid-feedback"><?= $errors['leadfree'] ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 col-md-3" style="margin-bottom: -13px">
                                                        <label for="functionaltest">Functional Test</label>
                                                    </div>
                                                    <div class="col-4 col-md-9">
                                                        <div class="custom-control custom-switch custom-switch-text custom-control-inline">
                                                            <div class="custom-switch-inner">
                                                                <input type="checkbox" class="custom-control-input" id="functionaltest" name="functionaltest" id="functionaltest" value="1" <?= set_checkbox('functionaltest', '1', isset($old['functionaltest']) && $old['functionaltest'] == '1') ?>>
                                                                <label class="custom-control-label" for="functionaltest" data-on-label="Yes" data-off-label="No">
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <?php if (!empty($errors['functionaltest'])): ?>
                                                            <div class="invalid-feedback"><?= $errors['functionaltest'] ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4">
                                                <div class="row mb-2">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="note">Note</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <textarea class="form-control border-radius-5 <?= !empty($errors['note']) ? 'is-invalid' : '' ?>" name="note" id="note" rows="5"><?= isset($old['note']) ? $old['note'] : '' ?></textarea>
                                                        <?php if (!empty($errors['note'])): ?>
                                                            <div class="invalid-feedback"><?= $errors['note'] ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="quantity">Quantity</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <select name="quantity" class="form-control border-radius-5 max-height-40 <?= !empty($errors['quantity']) ? 'is-invalid' : '' ?>" >
                                                            <option value="default" selected disabled>Pilih quantity</option>
                                                            <?php
                                                                for ($i = 5; $i <= 100; $i += 5) {
                                                                    $selected = (!empty($old['quantity']) && $old['quantity'] == $i) ? 'selected' : '';
                                                                    echo "<option value=\"$i\" $selected>$i</option>";
                                                                }
                                                            ?>
                                                        </select>
            
                                                        <?php if (!empty($errors['quantity'])): ?>
                                                            <div class="invalid-feedback"><?= $errors['quantity'] ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="functionaltest">Lime Time</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <div class="input-group w-100 w-lg-25">
                                                            <input type="number" min="1" max="999" class="form-control <?= !empty($errors['leadtime']) ? 'is-invalid' : '' ?> border-radius-top-left-5 border-radius-bottom-left-5 max-height-40" name="leadtime" id="leadtime" value="<?= isset($old['leadtime']) ? $old['leadtime'] : '' ?>" aria-label="leadtime" aria-describedby="basic-addon4">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text border-left-0 border-radius-top-right-5 border-radius-bottom-right-5">
                                                                    Days
                                                                </span>
                                                            </div>
                                                            <?php if (!empty($errors['leadtime'])): ?>
                                                                <div class="invalid-feedback"><?= $errors['leadtime'] ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4">
                                                <div class="float-right">
                                                    <button type="submit" class="btn btn-outline-primary rounded-pill">Save to cart</button>
                                                </div>
                                            </div>
                                        <?= form_close() ?>
                                    </div>
                                    <div class="tab-pane fade" id="cnc" role="tabpanel" aria-labelledby="cnc-tab">
                                        <?= form_open_multipart('index/order_pcb_form', ['id' => 'file-upload-form']) ?>
                                        
                                            <div class="form-group mt-5">
                                                <div class="row">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="gerberfile">Gerber File</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <div class="input-group mb-2">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input <?= !empty($errors['gerberfile']) ? 'is-invalid' : '' ?>" accept=".zip,.rar" name="gerberfile" id="gerberfile">
                                                                <label class="custom-file-label" for="gerberfile">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <?php if (!empty($errors['gerberfile'])): ?>
                                                            <small class="text-danger"><?= $errors['gerberfile'] ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="bomfile">B.O.M File</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <div class="input-group mb-2">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input <?= !empty($errors['bomfile']) ? 'is-invalid' : '' ?>" accept=".txt,.csv" name="bomfile" id="bomfile">
                                                                <label class="custom-file-label" for="bomfile">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <?php if (!empty($errors['bomfile'])): ?>
                                                            <small class="text-danger"><?= $errors['bomfile'] ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="pickandplacefile">Pick and Place File</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <div class="input-group mb-2">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input <?= !empty($errors['pickandplacefile']) ? 'is-invalid' : '' ?>" accept=".txt,.csv" name="pickandplacefile" id="pickandplacefile">
                                                                <label class="custom-file-label" for="pickandplacefile">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <?php if (!empty($errors['pickandplacefile'])): ?>
                                                            <small class="text-danger"><?= $errors['pickandplacefile'] ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4">
                                                <div class="row mb-2">
                                                    <div class="col-8 col-md-3" style="margin-bottom: -13px">
                                                        <label for="material">Material</label>
                                                    </div>
                                                    <div class="col-4 col-md-9">
                                                        <select name="material" class="form-control border-radius-5 max-height-40 <?= !empty($errors['material']) ? 'is-invalid' : '' ?>" >
                                                            <option value="default" selected disabled>Pilih material</option>
                                                            <?php foreach ($cnc_material as $index => $item) { ?>
                                                                <option value="<?= $item['id'] ?>" <?= (isset($old['material']) && $item['id'] == $old['material']) ? 'selected' : '' ?>><?= get_cnc_material_name($item['id']) ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <?php if (!empty($errors['material'])): ?>
                                                            <div class="invalid-feedback"><?= $errors['material'] ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8 col-md-3" style="margin-bottom: -13px">
                                                        <label for="finishing">Finishing</label>
                                                    </div>
                                                    <div class="col-4 col-md-9">
                                                        <select name="finishing" class="form-control border-radius-5 max-height-40 <?= !empty($errors['finishing']) ? 'is-invalid' : '' ?>" >
                                                            <option value="default" selected disabled>Pilih Finishing</option>
                                                            <?php foreach ($cnc_finishing as $index => $item) { ?>
                                                                <option value="<?= $item['id'] ?>" <?= (isset($old['finishing']) && $item['id'] == $old['finishing']) ? 'selected' : '' ?>><?= get_cnc_finishing_name($item['id']) ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <?php if (!empty($errors['finishing'])): ?>
                                                            <div class="invalid-feedback"><?= $errors['finishing'] ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4">
                                                <div class="row mb-2">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="note">Note</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <textarea class="form-control border-radius-5 <?= !empty($errors['note']) ? 'is-invalid' : '' ?>" name="note" id="note" rows="5"><?= isset($old['note']) ? $old['note'] : '' ?></textarea>
                                                        <?php if (!empty($errors['note'])): ?>
                                                            <div class="invalid-feedback"><?= $errors['note'] ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="quantity">Quantity</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <select name="quantity" class="form-control border-radius-5 max-height-40 <?= !empty($errors['quantity']) ? 'is-invalid' : '' ?>" >
                                                            <option value="default" selected disabled>Pilih quantity</option>
                                                            <?php
                                                                for ($i = 5; $i <= 100; $i += 5) {
                                                                    $selected = (!empty($old['quantity']) && $old['quantity'] == $i) ? 'selected' : '';
                                                                    echo "<option value=\"$i\" $selected>$i</option>";
                                                                }
                                                            ?>
                                                        </select>
            
                                                        <?php if (!empty($errors['quantity'])): ?>
                                                            <div class="invalid-feedback"><?= $errors['quantity'] ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="functionaltest">Lime Time</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <div class="input-group w-100 w-lg-25">
                                                            <input type="number" min="1" max="999" class="form-control <?= !empty($errors['leadtime']) ? 'is-invalid' : '' ?> border-radius-top-left-5 border-radius-bottom-left-5 max-height-40" name="leadtime" id="leadtime" value="<?= isset($old['leadtime']) ? $old['leadtime'] : '' ?>" aria-label="leadtime" aria-describedby="basic-addon4">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text border-left-0 border-radius-top-right-5 border-radius-bottom-right-5">
                                                                    Days
                                                                </span>
                                                            </div>
                                                            <?php if (!empty($errors['leadtime'])): ?>
                                                                <div class="invalid-feedback"><?= $errors['leadtime'] ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4">
                                                <div class="float-right">
                                                    <button type="submit" class="btn btn-outline-primary rounded-pill">Save to cart</button>
                                                </div>
                                            </div>
                                        <?= form_close() ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-12">
                        <div class="card border-radius-5">
                            <div class="card-body">
                                <h5 class="card-title mb-0">Cart <i class="las la-shopping-cart"></i></h5>

                                <!-- Order PCB -->
                                <h6 class="mt-3">Order PCB</h6>
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Lead Free</th>
                                                <th>Functional Test</th>
                                                <th>Qty</th>
                                                <th>Lead Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            
                                            foreach ($carts as $index => $cart): 
                                                if ($cart->product_type !== 'pcb') continue;

                                                $product_info = json_decode($cart->product_info, true);
                                            ?>
                                            <tr>
                                                <td><?= $index +1 ?></td>
                                                <td>
                                                    <?php if ($product_info['leadfree'] == 1) { ?>
                                                        <span class="badge border border-primary text-primary">Yes</span>
                                                    <?php } elseif ($product_info['leadfree'] == 0) { ?>
                                                        <span class="badge border border-danger text-danger">No</span>
                                                    <?php } else { ?>
                                                        <span class="badge border border-dark text-danger">Error</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($product_info['functionaltest'] == 1) { ?>
                                                        <span class="badge border border-primary text-primary">Yes</span>
                                                    <?php } elseif ($product_info['functionaltest'] == 0) { ?>
                                                        <span class="badge border border-danger text-danger">No</span>
                                                    <?php } else { ?>
                                                        <span class="badge border border-dark text-danger">Error</span>
                                                    <?php } ?>
                                                </td>
                                                <td><?= htmlspecialchars($product_info['quantity'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($product_info['leadtime'] ?? '-') ?> Days</td>
                                                <td>
                                                    <div class="form-group">
                                                                <button type="button" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#delete<?= $index + 1 ?>">
                                                                    <i class="las la-trash-alt font-size-16 mt-1 mr-0"></i>
                                                                </button>
                                                                <div id="delete<?= $index + 1 ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete<?= $index + 1 ?>Title" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                        <div class="modal-content border-radius-10">
                                                                            <div class="modal-header border-bottom-0">
                                                                                <h5 class="modal-title" id="delete<?= $index + 1 ?>Title">Hapus Item</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <?= form_open('superadmin/delete_item_cart', ['id' => 'hapusItemForm']) ?>
                                                                                <input type="hidden" name="item_cart_id" value="<?= encrypt_id($index + 1) ?>">
                                                                                    <div class="d-flex align-items-center">
                                                                                        <div class="form-group">
                                                                                            <img src="<?= base_url('public/local_assets/images/logo_danger_2.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                                        </div>
                                                                                        <div class="form-group ml-4">
                                                                                            <div class="row">
                                                                                                <h6>Yakin ingin menghapus item?</h6>
                                                                                                <span>Item akan <span class="text-danger">terhapus</span> secara pemranen!</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="float-right">
                                                                                        <button type="submit" class="btn btn-outline-danger">Hapus Item</button>
                                                                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                <?= form_close() ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Order CNC -->
                                <h6 class="mt-4">Order CNC</h6>
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Lead Free</th>
                                                <th>Functional Test</th>
                                                <th>Qty</th>
                                                <th>Lead Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            foreach ($carts as $index => $cart): 
                                                if ($cart->product_type !== 'cnc') continue;

                                                $product_info = json_decode($cart->product_info, true);
                                            ?>
                                            <tr>
                                                <td><?= $index +1 ?></td>
                                                <td><?= htmlspecialchars($product_info['leadfree'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($product_info['functionaltest'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($product_info['quantity'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($product_info['leadtime'] ?? '-') ?></td>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <button type="submit" class="btn btn-outline-primary rounded-pill w-100 mt-3">Order</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper End-->

    <!-- <script>
        document.querySelectorAll('.custom-file-input').forEach(function (input) {
            input.addEventListener('change', function (e) {
                const labelWrapper = e.target.closest('.custom-file-label-wrapper');
                const fileTextSpan = labelWrapper.querySelector('.file-text');
                const defaultLabel = fileTextSpan.getAttribute('data-default-label') || "Select File";

                const fileName = e.target.files[0]?.name || defaultLabel;
                fileTextSpan.textContent = fileName;
            });
        });
    </script> -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInputs = document.querySelectorAll('.custom-file-input');

            fileInputs.forEach(function(input) {
                input.addEventListener('change', function(e) {
                    const fileName = e.target.files[0]?.name || 'Choose file';
                    const label = e.target.nextElementSibling;
                    if (label && label.classList.contains('custom-file-label')) {
                        label.textContent = fileName;
                    }
                });
            });
        });
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

    $(document).on('shown.bs.modal', '.modal', function () {
        refreshModalCSRF(this);
    });

</script>