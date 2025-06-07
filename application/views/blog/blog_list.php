<!-- Wrapper Start -->
<style>
    .dragover {
        border: 2px dashed #007bff;
        background-color: #f0f8ff;
    }
</style>



<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card top-left shadow-showcase">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Blogs by You</h4>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="form-group mb-0 mr-2">
                                    <a href="<?= base_url('blog') ?>" class="btn btn-sm bg-info-light d-flex align-items-center">
                                        <span class="d-none d-md-block">See all Blogs</span>
                                        <i class="las la-eye font-size-20 ml-1"></i>
                                    </a>
                                </div>
                                <div class="form-group mb-0 mr-2">
                                    <a href="<?= base_url('blog/new_blog') ?>" class="btn btn-sm bg-primary-light d-flex align-items-center">
                                        <span class="d-none d-md-block">Make new Blog</span>
                                        <i class="las la-plus font-size-20 ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table data-table table-striped mt-4" role="grid"
                                    aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr class="ligth">
                                            <th>#</th>
                                            <th>Thumbnail</th>
                                            <th>Title</th>
                                            <th>status</th>
                                            <th>Date Published</th>
                                            <th>Last Updated</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($blogs as $index => $item) { ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td>
                                                    <?php if ($item['thumbnail'] && file_exists('public/' . $item['thumbnail'])) { ?>
                                                        <img src="<?= base_url('public/' . $item['thumbnail']) ?>" alt="Thumbnail" class="img-fluid" style="max-width: 100px;">
                                                    <?php } else { ?>
                                                        <span class="text-muted">No Thumbnail</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <h6 class="card-title d-inline-block text-truncate mb-0" style="max-width: 115px;"><?= $item['title'] ?></h6>
                                                </td>
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
                                                <td><?= $item['date_published'] ? date('d M Y', strtotime($item['date_published'])) : '-' ?></td>
                                                <td><?= date('d M Y', strtotime($item['date_updated'])) ?></td>
                                                <td><?= date('d M Y', strtotime($item['date_created'])) ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="<?= base_url('blog/view_blog/' . $item['slug']) ?>" class="btn btn-sm bg-primary-light d-flex align-items-center mr-2">
                                                            <span class="text-primary mr-1">View</span>
                                                            <i class="las la-eye font-size-20 text-primary mr-0"></i>
                                                        </a>
                                                        <a href="<?= base_url('blog/edit_blog/' . encrypt_id($item['blog_id'])) ?>" class="btn btn-sm bg-warning-light d-flex align-items-center mr-2">
                                                            <span class="text-dark mr-1">Edit</span>
                                                            <i class="las la-edit font-size-20 text-dark mr-0"></i>
                                                        </a>
                                                        <div class="form-group mb-0">
                                                            <button type="button" class="btn btn-sm bg-danger-light d-flex align-items-center" data-toggle="modal" data-target="#delete_blog<?= $index + 1 ?>">
                                                                <span class="text-danger mr-1">Hapus</span>
                                                                <i class="las la-trash-alt font-size-20 mr-0"></i>
                                                            </button>
                                                            <div id="delete_blog<?= $index + 1 ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete_blog<?= $index + 1 ?>Title" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                                    <div class="modal-content border-radius-10">
                                                                        <div class="modal-header border-bottom-0">
                                                                            <h5 class="modal-title" id="delete_blog<?= $index + 1 ?>Title">Hapus Blog: <span class="text-truncate" style="max-width: 200px;"><?= $item['title'] ?></span></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <?= form_open('blog/delete_blog', ['id' => 'hapusItemrForm']) ?>
                                                                                <input type="hidden" name="blog_id" value="<?= encrypt_id($item['blog_id']) ?>">
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="form-group">
                                                                                        <img src="<?= base_url('public/local_assets/images/logo_danger_2.png') ?>" class="img-fluid mr-2" width="120" alt="">
                                                                                    </div>
                                                                                    <div class="form-group ml-4">
                                                                                        <div class="row">
                                                                                            <h6>Yakin ingin menghapus Blog?</h6>
                                                                                            <span>Blog dengan judul <strong class="text-danger"><span class="text-truncate" style="max-width: 200px;"><?= $item['title'] ?></span></strong> akan <span class="text-danger">terhapus</span> secara pemranen!</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="float-right">
                                                                                    <button type="submit" class="btn btn-outline-danger">Hapus Blog</button>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Wrapper End-->
<script>const base_url = "<?= base_url() ?>";</script>

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
