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
                    <div class="col-lg-12">
                        <div class="card bottom-right shadow-showcase">
                            <div class="card-body">
                                <?= form_open('blog/pending_blog    ', ['method' => 'post']) ?>
                                    <div class="row breadcrumb-content">
                                        <div class="flex-grow-1 mb-2 ml-2">
                                            <div class="iq-search-bar">
                                                <div class="searchbox">
                                                    <input type="text" class="text search-input" name="q" placeholder="Cari nama/email/judul blog..." value="<?= html_escape($search_keyword) ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 mb-2 ml-2">
                                            <div class="d-flex align-items-center">
                                                <input type="date" class="form-control border-radius-5 max-height-40" name="dari" value="<?= html_escape($dari) ?>">
                                                <strong class="ml-2 mr-2">-</strong>
                                                <input type="date" class="form-control border-radius-5 max-height-40" name="sampai" value="<?= html_escape($sampai) ?>">
                                            </div>
                                        </div>
                                    
                                        <div class="flex-grow-1 mb-2 ml-2">
                                            <div class="list-grid-toggle d-flex align-items-center">
                                                <div class="active">
                                                    <button type="submit" class="grid-icon border-0 mr-2 ml-2"><i class="ri-search-line mr-0"></i></button>
                                                </div>
                                                <div data-toggle-extra="tab" data-target-extra="#grid" class="active">
                                                    <div class="grid-icon mr-2">
                                                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div data-toggle-extra="tab" data-target-extra="#list">
                                                    <div class="grid-icon">
                                                        <svg  width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <line x1="21" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="3" y2="18"></line>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="grid" class="item-content animate__animated animate__fadeIn active" data-toggle-extra="tab-content">
                    <div class="row">
                        <?php if (!empty($blogs)): ?>
                            <?php foreach ($blogs as $index => $item) { ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="card card-block card-stretch card-height bottom-right shadow-showcase">
                                        <div class="card-header border-bottom-0 p-0">
                                            <div class="iq-header-title ml-2 mt-2 mr-2">
                                                <div class="d-flex justify-content-between mb-0">
                                                    <div class="d-flex align-items-star">
                                                        <div class="mr-3">
                                                            <?php if ($item['foto'] != null) { ?>
                                                                <img src="<?= base_url('public/' . $item['foto']) ?>" class="img-fluid rounded-circle avatar-40" alt="image">
                                                            <?php } else { ?>
                                                                <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="img-fluid rounded-circle avatar-40" alt="image">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="text-left">
                                                            <div class="iq-header-title p-0 mb-0">
                                                                <h6 class="card-title d-inline-block text-truncate mb-0" style="max-width: 115px;"><?= $item['nama'] ?></h6>
                                                            </div>
                                                            <small class="d-inline-block text-truncate mb-0" style="max-width: 115px; margin-top: -25px;"><?= $item['email'] ?></small>
                                                        </div>
                                                    </div>
                                                    <p class="font-size-12 mb-0"><?= date('d M Y', strtotime($item['date_created'])) ?></p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="card-body text-left p-0">                            
                                            <div class="form-group rounded">
                                                <p class="mx-3 mb-0">Title blog :</p>
                                                <h6 class="card-title mx-3 mb-2"><?= $item['title'] ?></h6>
                                                <div class="border-top ml-3 mr-3">
                                                    <div class="mt-2 d-flex justify-content-between align-items-center">
                                                        <div class="d-flex align-items-center">
                                                            <?php if ($item['status'] == 'pending'): ?>
                                                                <span class="badge badge-warning font-size-12 m-2">Menunggu Persetujuan</span>
                                                            <?php elseif ($item['status'] == 'approved'): ?>
                                                                <span class="badge badge-success font-size-12 m-2">Persetujuan Diterima</span>
                                                            <?php elseif ($item['status'] == 'rejected'): ?>
                                                                <span class="badge badge-dark font-size-12 m-2">Persetujuan Ditolak</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-light font-size-12 m-2">Status Tidak Diketahui</span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <a href="<?= base_url('blog/pending_blog_detail/' . $item['slug']) . '?from=pending_blog' ?>" class="btn btn-primary btn-sm d-flex align-items-center pr-0">
                                                            <span class="">Detail Blog</span>
                                                            <i class="las la-angle-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            
                        <?php else: ?>
                            <div class="col-12">
                                <div class="text-center my-5 py-5">
                                    <i class="las la-box-open text-muted" style="font-size: 8rem;"></i>
                                    <h5 class="mt-3 text-muted">Belum ada blog yang dibuat</h5>
                                    <p class="text-muted">Semua blog yang baru dibuat akan ditampilkan di sini.</p>
                                </div>
                            </div>
                        <?php endif; ?>
                        

                    </div>
                </div>
                <div id="list" class="item-content animate__animated animate__fadeIn" data-toggle-extra="tab-content">
                    <?php if (!empty($blogs)): ?>
                        <div class="table-responsive rounded bg-white mb-4">
                            <table class="table mb-0 table-borderless tbl-server-info">
                                <tbody>
                                    <?php foreach ($blogs as $index => $item) { ?>
                                        <tr>
                                            <td>
                                                <div class="media align-items-center">
                                                    <?php if ($item['foto'] != null) { ?>
                                                        <img src="<?= base_url('public/' . $item['foto']) ?>" class="img-fluid rounded-circle avatar-40" alt="image">
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="img-fluid rounded-circle avatar-40" alt="image">
                                                    <?php } ?>
                                                    <h6 class="card-title d-inline-block text-truncate ml-3 mb-0" style="max-width: 115px;"><?= $item['nama'] ?></h6>
                                                </div>
                                            </td>
                                            <td><small class="d-inline-block text-truncate mb-0" style="max-width: 115px"><?= $item['email'] ?></small></td>
                                            <td>
                                                <h6 class="card-title d-inline-block text-truncate mb-0" style="max-width: 115px;"><?= $item['title'] ?></h4>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <?php if ($item['status'] == 'pending'): ?>
                                                        <span class="badge badge-warning font-size-12 m-2">Menunggu Persetujuan</span>
                                                    <?php elseif ($item['status'] == 'approved'): ?>
                                                        <span class="badge badge-success font-size-12 m-2">Persetujuan Diterima</span>
                                                    <?php elseif ($item['status'] == 'rejected'): ?>
                                                        <span class="badge badge-dark font-size-12 m-2">Persetujuan Ditolak</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-light font-size-12 m-2">Status Tidak Diketahui</span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('blog/pending_blog_detail/' . $item['slug']) . '?from=pending_blog' ?>" class="btn btn-primary btn-sm pr-0">
                                                    Detail Pesanan
                                                    <i class="las la-angle-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="col-12">
                            <div class="text-center my-5 py-5">
                                <i class="las la-box-open text-muted" style="font-size: 8rem;"></i>
                                <h5 class="mt-3 text-muted">Belum ada blog yang dibuat</h5>
                                <p class="text-muted">Semua blog yang baru dibuat akan ditampilkan di sini.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <?= $pagination_links ?>
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
