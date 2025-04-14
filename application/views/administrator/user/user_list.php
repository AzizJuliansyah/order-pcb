<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row m-1">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Details</li>
                        <li class="breadcrumb-item active" aria-current="page">User Add</li>
                    </ol>
                </nav>
            </div>
            <div class="row mt-3">
                <?php foreach ($role_list as $item) { ?>
                    <a href="#" class="<?= ($item['role_id'] == 1) ? 'col-lg-12 col-md-12' : 'col-md-6 col-lg-6' ?>">
                        <div class="card mb-2">
                            <div class="card-body">
                                <h4 class="card-title"><?= $item['jabatan'] ?></h4>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in. a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->