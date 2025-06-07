<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card bottom-right shadow-showcase">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between breadcrumb-content">
                                <div class="p-0">
                                    <strong class="row ml-1 p-0">Action Terpilih :</strong>
                                    <div class="row d-flex flex-wrap align-items-center ml-1">
                                        <div class="border-right btn-new mr-3 pr-3">
                                            <?= form_open('blog/ubah_status_blog') ?>
                                            <div class="dropdown dropdown-project">
                                                <div class="dropdown-toggle" id="dropdownMenuButton03" data-toggle="dropdown">
                                                    <div class="btn bg-body">
                                                        <span class="h6">Ubah Blog Status</span>
                                                        <i class="ri-arrow-down-s-line ml-2 mr-0"></i>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-left p-3" style="min-width: 300px;" aria-labelledby="dropdownMenuButton03">

                                                    <?php
                                                    $statuses = [
                                                        'blog_status' => ['pending', 'approved', 'rejected']
                                                    ];
                                                    ?>

                                                    <?php foreach ($statuses as $type => $list): ?>
                                                        <label class="font-weight-bold text-uppercase mb-2"><?= str_replace('_', ' ', $type) ?></label>
                                                        <?php foreach ($list as $status): ?>
                                                            <div class="form-check mb-1">
                                                                <input class="form-check-input" type="radio" name="<?= $type ?>" id="<?= $type . '_' . $status ?>" value="<?= $status ?>"
                                                                    <?= (isset($_GET[$type]) && $_GET[$type] === $status) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="<?= $type . '_' . $status ?>">
                                                                    <?= ucfirst(str_replace('_', ' ', $status)) ?>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        <div class="form-check mb-1">
                                                            <input class="form-check-input" type="radio" name="<?= $type ?>" id="<?= $type ?>_none" value="" checked>
                                                            <label class="form-check-label text-muted" for="<?= $type ?>_none">
                                                                Tidak diubah
                                                            </label>
                                                        </div>
                                                        <hr>
                                                    <?php endforeach; ?>

                                                    <div class="text-right">
                                                        <div class="form-group m-1">
                                                            <button type="button" class="btn btn-sm bg-primary" data-toggle="modal" data-target="#ubahStatusOrderBulk" onclick="tampilkanStatusTerpilih()">
                                                                Ubah Status Blog
                                                            </button>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div id="ubahStatusOrderBulk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ubahStatusBlogBulkTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content border-radius-10">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title" id="ubahStatusBlogBulkTitle">Ubah Status Blog Sejumlah: <span id="selected-count-ubahStatus">0</span> Blog</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" value="" name="ubahStatus_blog_ids_bulk" id="ubahStatus_blog_ids_bulk">
                                                            <div class="d-flex align-items-center">
                                                                <div class="form-group">
                                                                    <img src="<?= base_url('public/local_assets/images/logo_danger_1.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                </div>
                                                                <div class="form-group ml-4">
                                                                    <div class="">
                                                                        <p class="h6">Yakin ingin mengubah status blog?</p>
                                                                        <span>
                                                                            Title <strong class="text-danger" id="selected-blog-title-ubahStatus">...</strong>
                                                                        </span>
                                                                        <p>
                                                                            <span>
                                                                                Blog Status: <strong class="text-danger" id="selected-blog-status-ubahStatus">...</strong>
                                                                            </span>
                                                                        </p>
                                                                        <div class="form-group" id="reason-group" style="display: none;">
                                                                            <label for="reason">Alasan Penolakan:</label>
                                                                            <textarea class="form-control <?= !empty($errors['reason_rejected']) ? 'is-invalid' : '' ?>" name="reason_rejected" id="reason" rows="3">
                                                                                <?= (isset($old['reason_rejected'])) ? $old['reason_rejected'] : '' ?>
                                                                            </textarea>
                                                                            <?php if (!empty($errors['reason_rejected'])): ?>
                                                                                <div class="invalid-feedback"><?= $errors['reason_rejected'] ?></div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <span>Akan <span class="text-danger">terubah</span> status blog nya!</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="float-right">
                                                                <button type="submit" class="btn btn-outline-warning text-dark">Ubah Status blog</button>
                                                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?= form_close() ?>
                                        </div>
                                        <div class="form-group m-1">
                                            <button type="button" class="btn btn-sm bg-danger" data-toggle="modal" data-target="#deleteBulk">
                                                <i class="las la-trash-alt font-size-16 mt-1 mr-0"></i>
                                            </button>
                                            <div id="deleteBulk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteBulkTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                    <div class="modal-content border-radius-10">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title" id="deleteBulkTitle">Hapus Sejumlah: <span id="selected-count-delete">0</span> Blog</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?= form_open('blog/bulk_delete_blog', ['id' => 'hapusOrderFormBulk']) ?>
                                                            <input type="hidden" value="" name="delete_blog_ids_bulk" id="delete_blog_ids_bulk">
                                                            <div class="d-flex align-items-center">
                                                                <div class="form-group">
                                                                    <img src="<?= base_url('public/local_assets/images/logo_danger_2.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                </div>
                                                                <div class="form-group ml-4">
                                                                    <div class="row">
                                                                        <h6>Yakin ingin menghapus blog?</h6>
                                                                        <span>
                                                                            Blog Title <strong class="text-danger" id="selected-blog-codes-delete">...</strong> akan
                                                                            <span class="text-danger">terhapus</span> secara permanen!
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="float-right">
                                                                <button type="submit" class="btn btn-outline-danger">Hapus blog</button>
                                                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
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
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card bottom-right shadow-showcase">
                        <div class="card-header d-flex justify-content-between">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped mt-4" role="grid"
                                    aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr class="ligth">
                                            <th>#</th>
                                            <th>
                                                <input type="checkbox" class="checkbox-input" id="select-all">
                                            </th>
                                            <th>Title</th>
                                            <th>Profile</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Blog Created Date</th>
                                            <th style="min-width: 100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($blogs as $index => $item) { ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td>
                                                    <input type="checkbox"
                                                        class="checkbox-input single-checkbox"
                                                        name="blog_ids[]"
                                                        value="<?= encrypt_id($item['blog_id']) ?>"
                                                        data-title="<?= $item['title'] ?>">
                                                </td>
                                                <td>
                                                    <h6 class="card-title d-inline-block text-truncate mb-0" style="max-width: 115px;"><?= $item['title'] ?></h6>
                                                </td>
                                                <td>
                                                    <?php if ($item['foto'] != null) { ?>
                                                        <img src="<?= base_url('public/' . $item['foto']) ?>" class="img-fluid rounded-circle avatar-40" alt="image">
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="img-fluid rounded-circle avatar-40" alt="image">
                                                    <?php } ?>
                                                </td>
                                                <td><?= $item['nama'] ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <?php if ($item['status'] == 'approved') { ?>
                                                            <span class="badge border border-success text-success">Approved</span>
                                                        <?php } elseif ($item['status'] == 'pending') { ?>
                                                            <span class="badge border border-warning text-warning">Pending</span>
                                                        <?php } elseif ($item['status'] == 'rejected') { ?>
                                                            <span class="badge border border-danger text-danger">Rejected</span>
                                                        <?php } else { ?>
                                                            <span class="badge border border-secondary text-secondary">Draft</span>
                                                        <?php } ?>

                                                        <?php if ($item['status'] == 'rejected') { ?>
                                                            <div class="form-group mb-0">
                                                                <button type="button" class="btn btn-sm bg-outline-light" data-toggle="modal" data-target="#reason_rejected<?= $index + 1 ?>">
                                                                    <i class="las la-eye font-size-20 mr-0"></i>
                                                                </button>
                                                                <div id="reason_rejected<?= $index + 1 ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="reason_rejected<?= $index + 1 ?>Title" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                        <div class="modal-content border-radius-10">
                                                                            <div class="modal-header border-bottom-0">
                                                                                <h5 class="modal-title d-flex align-items-center" id="reason_rejected<?= $index + 1 ?>Title">Blog : <span class="d-inline-block text-truncate ml-2" style="max-width: 300px;"><?= $item['title'] ?></span></h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label for="reason">Reason Rejected:</label>
                                                                                    <textarea class="form-control" rows="3" readonly><?= $item['reason_rejected'] ?></textarea>
                                                                                </div>
                                                                                    <div class="float-right">
                                                                                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                                                                                    </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                                <td><?= format_bulan($item['date_created']) ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="<?= base_url('blog/view_blog/' . $item['slug']) ?>" class="btn btn-sm bg-primary-light d-flex align-items-center mr-2">
                                                            <span class="text-primary mr-1">View</span>
                                                            <i class="las la-eye font-size-20 text-primary mr-0"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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
    function updateBlogIdsHidden() {
        const selected = document.querySelectorAll('.single-checkbox:checked');

        const blogIds = [];
        const blogTitles = [];

        selected.forEach(cb => {
            blogIds.push(cb.value);
            let title = cb.dataset.title;
            let shortTitle = title.length > 20 ? title.substring(0, 20) + '...' : title;
            blogTitles.push('#' + shortTitle);
        });

        document.getElementById('delete_blog_ids_bulk').value = JSON.stringify(blogIds);
        const displayblogTitlesDelete = blogTitles.length ? blogTitles.join(', ') : '...';
        document.getElementById('selected-blog-codes-delete').textContent = displayblogTitlesDelete;
        const countTextDelete = document.getElementById('selected-count-delete');
        if (countTextDelete) countTextDelete.textContent = blogTitles.length;

        document.getElementById('ubahStatus_blog_ids_bulk').value = JSON.stringify(blogIds);
        const displayblogTitlesUbahStatus = blogTitles.length ? blogTitles.join(', ') : '...';
        document.getElementById('selected-blog-title-ubahStatus').textContent = displayblogTitlesUbahStatus;
        const countTextUbahStatus = document.getElementById('selected-count-ubahStatus');
        if (countTextUbahStatus) countTextUbahStatus.textContent = blogTitles.length;
    }

    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.single-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateBlogIdsHidden();
    });

    document.querySelectorAll('.single-checkbox').forEach(cb => {
        cb.addEventListener('change', updateBlogIdsHidden);
    });

    updateBlogIdsHidden();

    function tampilkanStatusTerpilih() {
        let blog = document.querySelector('input[name="blog_status"]:checked');

        let blogText = blog && blog.value ? blog.value.replace(/_/g, ' ') : 'Tidak diubah';

        // Masukkan ke modal
        const targetElement = document.getElementById('selected-blog-status-ubahStatus');
        targetElement.innerHTML = `<strong>${blogText}</strong>`;
    }

    document.querySelectorAll('input[name="blog_status"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            const reasonGroup = document.getElementById('reason-group');
            reasonGroup.style.display = this.value === 'rejected' ? 'block' : 'none';
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

    $(document).on('shown.bs.modal', '.modal', function() {
        refreshModalCSRF(this);
    });
</script>