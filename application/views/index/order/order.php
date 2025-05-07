
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid p-0">
                <div class="row m-sm-0 px-3">
                    <div class="col-lg-7 col-sm-12">
                        <div class="card border-radius-5 bottom-right shadow-showcase">
                            <div class="card-body">
                                <?php
                                    $activeTab = isset($_GET['cnc']) ? 'cnc' : 'pcb';
                                ?>
                                <ul class="nav nav-tabs nav-fill">
                                    <li class="nav-item">
                                        <a class="nav-link <?= $activeTab == 'pcb' ? 'active' : '' ?>" id="pcb-tab" data-toggle="tab" href="#pcb" role="tab" aria-controls="pcb" aria-selected="<?= $activeTab == 'pcb' ? 'true' : 'false' ?>"><strong>PCB <i class="la la-microchip font-size-20"></i></strong></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link <?= $activeTab == 'cnc' ? 'active' : '' ?>" id="cnc-tab" data-toggle="tab" href="#cnc" role="tab" aria-controls="cnc" aria-selected="<?= $activeTab == 'cnc' ? 'true' : 'false' ?>"><strong>CNC <i class="la la-layer-group font-size-20"></i></strong></a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="ordertabcontent-2">
                                    <div class="tab-pane fade <?= $activeTab == 'pcb' ? 'show active' : '' ?>" id="pcb" role="tabpanel" aria-labelledby="pcb-tab">
                                        <?= form_open_multipart('index/order_pcb_form', ['id' => 'file-upload-form']) ?>
                                            <div class="form-group mt-5">
                                                <div class="row">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="gerberfile">Gerber File</label>
                                                        <small for="gerberfile" class="text-danger">( .zip, .rar )</small>
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
                                                        <small for="gerberfile" class="text-danger">( .txt, .csv )</small>
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
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <div class="d-flex flex-md-column flex-row align-items-start" style="margin-bottom: -22px">
                                                            <label for="pickandplacefile" class="mr-1">Pick and Place File</label>
                                                            <small class="text-danger">( .txt, .csv )</small>
                                                        </div>
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
                                                        <label for="functionaltest">Lead Time</label>
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
                                                    <button type="submit" class="btn btn-primary rounded-pill">Save to cart <i class="las la-cart-plus font-size-20"></i></button>
                                                </div>
                                            </div>
                                        <?= form_close() ?>
                                    </div>
                                    <div class="tab-pane fade <?= $activeTab == 'cnc' ? 'show active' : '' ?>" id="cnc" role="tabpanel" aria-labelledby="cnc-tab">
                                        <?= form_open_multipart('index/order_cnc_form', ['id' => 'file-upload-form']) ?>
                                        
                                            <div class="form-group mt-5">
                                                <div class="row">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="3dfile">3D File</label>
                                                        <small for="3dfile" class="text-danger">( .step, .igs )</small>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <div class="input-group mb-2">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input <?= !empty($errors['3dfile']) ? 'is-invalid' : '' ?>" accept=".step,.igs" name="3dfile" id="3dfile">
                                                                <label class="custom-file-label" for="3dfile">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <?php if (!empty($errors['3dfile'])): ?>
                                                            <small class="text-danger"><?= $errors['3dfile'] ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="2dfile">B.O.M File</label>
                                                        <small for="2dfile" class="text-danger">( .pdf, .dwg )</small>
                                                    </div>
                                                    <div class="col-12 col-md-9">
                                                        <div class="input-group mb-2">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input <?= !empty($errors['2dfile']) ? 'is-invalid' : '' ?>" accept=".pdf,.dwg" name="2dfile" id="2dfile">
                                                                <label class="custom-file-label" for="2dfile">Choose file</label>
                                                            </div>
                                                        </div>
                                                        <?php if (!empty($errors['2dfile'])): ?>
                                                            <small class="text-danger"><?= $errors['2dfile'] ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4">
                                                <div class="row mb-2">
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="material">Material</label>
                                                    </div>
                                                    <div class="col-12 col-md-9">
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
                                                    <div class="col-12 col-md-3" style="margin-bottom: -13px">
                                                        <label for="finishing">Finishing</label>
                                                    </div>
                                                    <div class="col-12   col-md-9">
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
                                                        <label for="functionaltest">Lead Time</label>
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
                                                    <button type="submit" class="btn btn-primary rounded-pill">Save to cart <i class="las la-cart-plus font-size-20"></i></button>
                                                </div>
                                            </div>
                                        <?= form_close() ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-12">
                        <div class="card border-radius-5 bottom-right shadow-showcase">
                            <div class="card-body">
                                <h4 class="card-title mb-0">Cart <i class="las la-shopping-cart"></i></h4>

                                <!-- Order PCB -->
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($carts as $index => $item) { ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><strong class="text-uppercase"><?= $item->product_type ?></strong></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-group">
                                                                <a href="#info<?= $index + 1 ?>" class="badge border border-primary text-primary cursor-pointer mr-2" data-toggle="modal" >
                                                                    <i class="las la-eye font-size-20"></i>
                                                                </a>
                                                                <div id="info<?= $index + 1 ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="info<?= $index + 1 ?>Title" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                        <div class="modal-content border-radius-10">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="info<?= $index + 1 ?>Title">Item Info <i class="text-uppercase"><?= $item->product_type ?> #<?= $index + 1 ?></i></h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <?php if ($item->product_type == "pcb") { ?>
                                                                                    <?php $product_info = json_decode($item->product_info, true); ?>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">Gerber file <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if (!empty($product_info['gerberfile'])) { ?>
                                                                                                    <a href="<?= base_url('public/' . $product_info['gerberfile']) ?>" download class="badge border border-primary text-primary d-flex align-items-center">Yes <i class="las la-file-download font-size-20"></i></a>
                                                                                                <?php } elseif ($product_info['gerberfile'] == null) { ?>
                                                                                                    <span class="badge border border-danger text-danger">No</span>
                                                                                                <?php } else { ?>
                                                                                                    <span class="badge border border-dark text-danger">Error</span>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">B.O.M file <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if (!empty($product_info['bomfile'])) { ?>
                                                                                                    <a href="<?= base_url('public/' . $product_info['bomfile']) ?>" download class="badge border border-primary text-primary d-flex align-items-center">Yes <i class="las la-file-download font-size-20"></i></a>
                                                                                                <?php } elseif ($product_info['bomfile'] == null) { ?>
                                                                                                    <span class="badge border border-danger text-danger">No</span>
                                                                                                <?php } else { ?>
                                                                                                    <span class="badge border border-dark text-danger">Error</span>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">Pick and Place file <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if (!empty($product_info['pickandplacefile'])) { ?>
                                                                                                    <a href="<?= base_url('public/' . $product_info['pickandplacefile']) ?>" download class="badge border border-primary text-primary d-flex align-items-center">Yes <i class="las la-file-download font-size-20"></i></a>
                                                                                                <?php } elseif ($product_info['pickandplacefile'] == null) { ?>
                                                                                                    <span class="badge border border-danger text-danger">No</span>
                                                                                                <?php } else { ?>
                                                                                                    <span class="badge border border-dark text-danger">Error</span>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">Lead free <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if ($product_info['leadfree'] == 1) { ?>
                                                                                                    <span class="badge border border-primary text-primary">Yes</span>
                                                                                                <?php } elseif ($product_info['leadfree'] == 0) { ?>
                                                                                                    <span class="badge border border-danger text-danger">No</span>
                                                                                                <?php } else { ?>
                                                                                                    <span class="badge border border-dark text-danger">Error</span>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">Functional test <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if ($product_info['functionaltest'] == 1) { ?>
                                                                                                    <span class="badge border border-primary text-primary">Yes</span>
                                                                                                <?php } elseif ($product_info['functionaltest'] == 0) { ?>
                                                                                                    <span class="badge border border-danger text-danger">No</span>
                                                                                                <?php } else { ?>
                                                                                                    <span class="badge border border-dark text-danger">Error</span>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">Note <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <?php if (!empty($product_info['note'])) { ?>
                                                                                                <small class="limited-text" onclick="showFullText(this)" data-fulltext="<?= htmlspecialchars($product_info['note']) ?>">
                                                                                                    <?= htmlspecialchars($product_info['note']) ?>
                                                                                                </small>
                                                                                            <?php } elseif ($product_info['note'] == null) { ?>
                                                                                                <small class="text-danger">Null</small>
                                                                                            <?php } else { ?>
                                                                                                <small class="text-danger">Error</small>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mt-3">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">Quantity <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if (!empty($product_info['quantity'])) { ?>
                                                                                                    <h6 class="card-title"><?= $product_info['quantity'] ?></h6>
                                                                                                <?php } elseif ($product_info['quantity'] == null) { ?>
                                                                                                    <small class="text-danger">Null</small>
                                                                                                <?php } else { ?>
                                                                                                    <small class="text-danger">Error</small>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">Lead time <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if (!empty($product_info['leadtime'])) { ?>
                                                                                                    <h6 class="card-title"><?= $product_info['leadtime'] ?> Days</h6>
                                                                                                <?php } elseif ($product_info['leadtime'] == null) { ?>
                                                                                                    <small class="text-danger">Null</small>
                                                                                                <?php } else { ?>
                                                                                                    <small class="text-danger">Error</small>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                                <?php if ($item->product_type == "cnc") { ?>
                                                                                    <?php $product_info = json_decode($item->product_info, true); ?>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">3D file <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if (!empty($product_info['3dfile'])) { ?>
                                                                                                    <a href="<?= base_url('public/' . $product_info['3dfile']) ?>" download class="badge border border-primary text-primary d-flex align-items-center">Yes <i class="las la-file-download font-size-20"></i></a>
                                                                                                <?php } elseif ($product_info['3dfile'] == null) { ?>
                                                                                                    <span class="badge border border-danger text-danger">No</span>
                                                                                                <?php } else { ?>
                                                                                                    <span class="badge border border-dark text-danger">Error</span>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">2D file <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if (!empty($product_info['2dfile'])) { ?>
                                                                                                    <a href="<?= base_url('public/' . $product_info['2dfile']) ?>" download class="badge border border-primary text-primary d-flex align-items-center">Yes <i class="las la-file-download font-size-20"></i></a>
                                                                                                <?php } elseif ($product_info['2dfile'] == null) { ?>
                                                                                                    <span class="badge border border-danger text-danger">No</span>
                                                                                                <?php } else { ?>
                                                                                                    <span class="badge border border-dark text-danger">Error</span>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">Material <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if (!empty($product_info['material'])) { ?>
                                                                                                    <h6 class="card-title"><?= get_cnc_material_name($product_info['material']) ?></h6>
                                                                                                <?php } elseif ($product_info['material'] == null) { ?>
                                                                                                    <small class="text-danger">Null</small>
                                                                                                <?php } else { ?>
                                                                                                    <small class="text-danger">Error</small>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">Finishing <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if (!empty($product_info['finishing'])) { ?>
                                                                                                    <h6 class="card-title"><?= get_cnc_finishing_name($product_info['finishing']) ?></h6>
                                                                                                <?php } elseif ($product_info['finishing'] == null) { ?>
                                                                                                    <small class="text-danger">Null</small>
                                                                                                <?php } else { ?>
                                                                                                    <small class="text-danger">Error</small>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">Note <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-6">
                                                                                            <?php if (!empty($product_info['note'])) { ?>
                                                                                                <small class="limited-text" onclick="showFullText(this)" data-fulltext="<?= htmlspecialchars($product_info['note']) ?>">
                                                                                                    <?= htmlspecialchars($product_info['note']) ?>
                                                                                                </small>
                                                                                            <?php } elseif ($product_info['note'] == null) { ?>
                                                                                                <small class="text-danger">Null</small>
                                                                                            <?php } else { ?>
                                                                                                <small class="text-danger">Error</small>
                                                                                            <?php } ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mt-3">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">Quantity <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if (!empty($product_info['quantity'])) { ?>
                                                                                                    <h6 class="card-title"><?= $product_info['quantity'] ?></h6>
                                                                                                <?php } elseif ($product_info['quantity'] == null) { ?>
                                                                                                    <small class="text-danger">Null</small>
                                                                                                <?php } else { ?>
                                                                                                    <small class="text-danger">Error</small>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-8 col-md-6">
                                                                                            <h6 class="card-title">Lead time <div class="float-right">:</div></h6>
                                                                                        </div>
                                                                                        <div class="col-4 col-md-6">
                                                                                            <div class="float-right">
                                                                                                <?php if (!empty($product_info['leadtime'])) { ?>
                                                                                                    <h6 class="card-title"><?= $product_info['leadtime'] ?> Days</h6>
                                                                                                <?php } elseif ($product_info['leadtime'] == null) { ?>
                                                                                                    <small class="text-danger">Null</small>
                                                                                                <?php } else { ?>
                                                                                                    <small class="text-danger">Error</small>
                                                                                                <?php } ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <a href="#delete<?= $index + 1 ?>" class="badge border border-danger text-danger cursor-pointer" data-toggle="modal" >
                                                                    <i class="las la-trash-alt font-size-20"></i>
                                                                </a>
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
                                                                                <?= form_open('index/delete_cart_item', ['id' => 'hapusItemForm']) ?>
                                                                                    <input type="hidden" name="cart_id" value="<?= encrypt_id($item->cart_id) ?>">
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
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="form-group">
                                    <?= form_open('index/checkout', ['id' => 'checkoutForm']) ?>
                                    <button type="button" class="btn btn-success rounded-pill w-100" data-toggle="modal" data-target="#checkout" <?= $cart_item_count == 0 ? 'disabled' : '' ?>>Check Out <i class="las la-shopping-bag font-size-20"></i></button>
                                    <div id="checkout" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="checkoutTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                            <div class="modal-content border-radius-10">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="checkoutTitle">Informasi pengiriman</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <span>Anda melakukan transaksi untuk <strong><?= $cart_item_count ?> Item</strong>, isi informasi pengiriman untuk melanjutkan</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="checkbox">
                                                            <label class="d-flex align-items-center"><input class="mr-2" name="profile_info" type="checkbox" id="useProfile"><h6>Gunakan informasi dari profile</h6></label>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-sm-6">
                                                            <label for="nama" style="margin-bottom: -13px">Nama Penerima: <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['nama']) ? 'is-invalid' : '' ?>" name="nama" id="nama" value="<?= (isset($old['nama'])) ? $old['nama'] : '' ?>">
                                                            <?php if (!empty($errors['nama'])): ?>
                                                                <div class="invalid-feedback"><?= $errors['nama'] ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label for="nomor"style="margin-bottom: -13px">Informasi Kontak: <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['nomor']) ? 'is-invalid' : '' ?>" name="nomor" id="nomor" value="<?= (isset($old['nomor'])) ? $old['nomor'] : '' ?>">
                                                            <?php if (!empty($errors['nomor'])): ?>
                                                                <div class="invalid-feedback"><?= $errors['nomor'] ?></div>
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="col-12 mt-2 mb-2">
                                                            <div class="divider-text">
                                                                <span>Alamat</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-sm-6">
                                                            <label for="provinsi" style="margin-bottom: -13px">Provinsi: <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['provinsi']) ? 'is-invalid' : '' ?>" name="provinsi" id="provinsi" value="<?= (isset($old['provinsi'])) ? $old['provinsi'] : '' ?>">
                                                            <?php if (!empty($errors['provinsi'])): ?>
                                                                <div class="invalid-feedback"><?= $errors['provinsi'] ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label for="kota" style="margin-bottom: -13px">Kota: <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['kota']) ? 'is-invalid' : '' ?>" name="kota" id="kota" value="<?= (isset($old['kota'])) ? $old['kota'] : '' ?>">
                                                            <?php if (!empty($errors['kota'])): ?>
                                                                <div class="invalid-feedback"><?= $errors['kota'] ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label for="kecamatan" style="margin-bottom: -13px">Kecamatan: <small class="text-danger">*</small></label>
                                                            <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['kecamatan']) ? 'is-invalid' : '' ?>" name="kecamatan" id="kecamatan" value="<?= (isset($old['kecamatan'])) ? $old['kecamatan'] : '' ?>">
                                                            <?php if (!empty($errors['kecamatan'])): ?>
                                                                <div class="invalid-feedback"><?= $errors['kecamatan'] ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label for="kode_pos" style="margin-bottom: -13px">Kode Pos: <small class="text-danger">*</small></label>
                                                            <input type="number" class="form-control border-radius-5 max-height-40 <?= !empty($errors['kode_pos']) ? 'is-invalid' : '' ?>" name="kode_pos" id="kode_pos" value="<?= (isset($old['kode_pos'])) ? $old['kode_pos'] : '' ?>">
                                                            <?php if (!empty($errors['kode_pos'])): ?>
                                                                <div class="invalid-feedback"><?= $errors['kode_pos'] ?></div>
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="form-group col-sm-12">
                                                            <label form="alamat" style="margin-bottom: -13px">Alamat Lengkap: <small class="text-danger">*</small></label>
                                                            <textarea class="form-control <?= !empty($errors['alamat_lengkap']) ? 'is-invalid' : '' ?>" name="alamat_lengkap" id="alamat_lengkap" rows="5" style="line-height: 22px;"><?= (isset($old['alamat_lengkap'])) ? $old['alamat_lengkap'] : '' ?></textarea>
                                                            <?php if (!empty($errors['alamat_lengkap'])): ?>
                                                                <div class="invalid-feedback"><?= $errors['alamat_lengkap'] ?></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-success">Checkout</button>
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
        </div>
    </div>
    <!-- Wrapper End-->
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
            const limit = 150;

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


        document.getElementById('useProfile').addEventListener('change', function() {
            if (this.checked) {
                document.getElementById('nama').value = '<?= $user['nama'] ?>';
                document.getElementById('nomor').value = '<?= $user['nomor'] ?>';
                document.getElementById('provinsi').value = '<?= $user['provinsi'] ?>';
                document.getElementById('kota').value = '<?= $user['kota'] ?>';
                document.getElementById('kecamatan').value = '<?= $user['kecamatan'] ?>';
                document.getElementById('kode_pos').value = '<?= $user['kode_pos'] ?>';
                document.getElementById('alamat_lengkap').value = '<?= $user['alamat_lengkap'] ?>';
            } else {
                document.getElementById('nama').value = '';
                document.getElementById('nomor').value = '';
                document.getElementById('provinsi').value = '';
                document.getElementById('kota').value = '';
                document.getElementById('kecamatan').value = '';
                document.getElementById('kode_pos').value = '';
                document.getElementById('alamat_lengkap').value = '';
            }
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