<!-- Wrapper Start -->
<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row m-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('index/home') ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
            <div class="row m-1">
                <div class="col-lg-4">
                    <div class="card card-block card-stretch bottom-right p-1 shadow-showcase">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <?php if ($user['foto'] != null) { ?>
                                    <div class="profile-img position-relative">
                                        <img src="<?= base_url('public/' . $user['foto']) ?>" class="img-fluid rounded avatar-110" alt="profile-image">
                                    </div>
                                <?php } else { ?>
                                    <div class="profile-img position-relative">
                                        <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="img-fluid rounded avatar-110" alt="profile-image">
                                    </div>
                                <?php } ?>
                                <div class="ml-3">
                                    <h5 class="mb-1"><?= $user['nama'] ?></h5>
                                    <p class="mb-2"><?= $role['jabatan'] ?></p>

                                </div>
                            </div>
                            <ul class="list-inline p-0 m-0">
                                <li class="mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="las la-map-marker-alt font-size-20 mr-3"></i>
                                        <p class="mb-0"><?= $user['kota'] ?>, <?= $user['provinsi'] ?></p>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="d-flex align-items-center">
                                        <svg class="svg-icon font-size-20 mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                                        </svg>
                                        <p class="mb-0"><?= date('d F Y', strtotime($user['tanggal_lahir'])) ?></p>
                                        </p>
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="las la-phone font-size-20 mr-3"></i>
                                        <p class="mb-0"><?= $user['nomor'] ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center">
                                        <i class="las la-envelope-open font-size-20 mr-3"></i>
                                        <p class="mb-0"><?= $user['email'] ?></p>
                                    </div>
                                </li>
                            </ul>
                            <a href="<?= base_url('user/edit_profile') ?>" class="btn btn-primary float-right mt-3 font-size-18">Edit Profile</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-block card-stretch card-height bottom-right p-3 shadow-showcase">
                        <div class="card-body">
                            <ul class="d-flex nav nav-pills mb-3 text-center profile-tab" id="profile-pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="pill" href="#alamat" role="tab" aria-selected="false">Education</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#profile4" role="tab" aria-selected="false">Experience</a>
                                </li>
                            </ul>
                            <div class="profile-content tab-content">
                                <div id="alamat" class="tab-pane fade active show">
                                    <div class="profile-line m-0 d-flex align-items-center justify-content-between position-relative">
                                        <ul class="list-inline p-0 m-0 w-100">
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">Provinsi</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media pb-1 align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <p class="mb-1"><?= $user['provinsi'] ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="">Kota / Kabupaten</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media pb-4 align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <p class="mb-1"><?= $user['kota'] ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">Kecamatan</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media pb-1 align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <p class="mb-1"><?= $user['kecamatan'] ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">Kode Pos</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media pb-1 align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <p class=" mb-1"><?= $user['kode_pos'] ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">Alamat Detail</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media pb-0 align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <p class=" mb-1"><?= $user['alamat_lengkap'] ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="profile4" class="tab-pane fade">
                                    <div class="profile-line m-0 d-flex align-items-center justify-content-between position-relative">
                                        <ul class="list-inline p-0 m-0 w-100">
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">2020 - present</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Software Engineer at Mathica Labs</h6>
                                                                <p class="mb-0 font-size-14">Total : 02 + years of experience</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">2018 - 2019</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Junior Software Engineer at Zimcore Solutions</h6>
                                                                <p class="mb-0 font-size-14">Total : 1.5 + years of experience</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-md-3">
                                                        <h6 class="mb-2">2017 - 2018</h6>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="media profile-media align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Junior Software Engineer at Skycare Ptv. Ltd</h6>
                                                                <p class="mb-0 font-size-14">Total : 0.5 + years of experience</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row align-items-top">
                                                    <div class="col-3">
                                                        <h6 class="mb-2">06 Months</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="media profile-media pb-0 align-items-top">
                                                            <div class="profile-dots border-primary mt-1"></div>
                                                            <div class="ml-4">
                                                                <h6 class=" mb-1">Junior Software Engineer at Infosys Solutions</h6>
                                                                <p class="mb-0 font-size-14">Total : Freshers</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
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

<!-- Modal list start -->
<div class="modal fade" role="dialog" aria-modal="true" id="new-project-modal">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-block text-center pb-3 border-bttom">
                <h3 class="modal-title" id="exampleModalCenterTitle01">New Project</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputText01" class="h5">Project Name*</label>
                            <input type="text" class="form-control" id="exampleInputText01" placeholder="Project Name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="exampleInputText2" class="h5">Categories *</label>
                            <select name="type" class="selectpicker form-control" data-style="py-0">
                                <option>Category</option>
                                <option>Android</option>
                                <option>IOS</option>
                                <option>Ui/Ux Design</option>
                                <option>Development</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="exampleInputText004" class="h5">Due Dates*</label>
                            <input type="date" class="form-control" id="exampleInputText004" value="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputText07" class="h5">Assign Members*</label>
                            <input type="text" class="form-control" id="exampleInputText07">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap align-items-ceter justify-content-center mt-2">
                            <div class="btn btn-primary mr-3" data-dismiss="modal">Save</div>
                            <div class="btn btn-primary" data-dismiss="modal">Cancel</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="new-task-modal">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block text-center pb-3 border-bttom">
                <h3 class="modal-title" id="exampleModalCenterTitle">New Task</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputText02" class="h5">Task Name</label>
                            <input type="text" class="form-control" id="exampleInputText02" placeholder="Enter task Name">
                            <a href="#" class="task-edit text-body"><i class="ri-edit-box-line"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label for="exampleInputText2" class="h5">Assigned to</label>
                            <select name="type" class="selectpicker form-control" data-style="py-0">
                                <option>Memebers</option>
                                <option>Kianna Septimus</option>
                                <option>Jaxson Herwitz</option>
                                <option>Ryan Schleifer</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label for="exampleInputText05" class="h5">Due Dates*</label>
                            <input type="date" class="form-control" id="exampleInputText05" value="">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mb-3">
                            <label for="exampleInputText2" class="h5">Category</label>
                            <select name="type" class="selectpicker form-control" data-style="py-0">
                                <option>Design</option>
                                <option>Android</option>
                                <option>IOS</option>
                                <option>Ui/Ux Design</option>
                                <option>Development</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputText040" class="h5">Description</label>
                            <textarea class="form-control" id="exampleInputText040" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputText005" class="h5">Checklist</label>
                            <input type="text" class="form-control" id="exampleInputText005" placeholder="Add List">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-0">
                            <label for="exampleInputText01" class="h5">Attachments</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile003">
                                <label class="custom-file-label" for="inputGroupFile003">Upload media</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap align-items-ceter justify-content-center mt-4">
                            <div class="btn btn-primary mr-3" data-dismiss="modal">Save</div>
                            <div class="btn btn-primary" data-dismiss="modal">Cancel</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="new-user-modal">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block text-center pb-3 border-bttom">
                <h3 class="modal-title" id="exampleModalCenterTitle02">New User</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3 custom-file-small">
                            <label for="exampleInputText01" class="h5">Upload Profile Picture</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="exampleInputText2" class="h5">Full Name</label>
                            <input type="text" class="form-control" id="exampleInputText2" placeholder="Enter your full name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="exampleInputText04" class="h5">Phone Number</label>
                            <input type="text" class="form-control" id="exampleInputText04" placeholder="Enter phone number">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="exampleInputText006" class="h5">Email</label>
                            <input type="text" class="form-control" id="exampleInputText006" placeholder="Enter your Email">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="exampleInputText2" class="h5">Type</label>
                            <select name="type" class="selectpicker form-control" data-style="py-0">
                                <option>Type</option>
                                <option>Trainee</option>
                                <option>Employee</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="exampleInputText2" class="h5">Role</label>
                            <select name="type" class="selectpicker form-control" data-style="py-0">
                                <option>Role</option>
                                <option>Designer</option>
                                <option>Developer</option>
                                <option>Manager</option>
                                <option>BDE</option>
                                <option>SEO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap align-items-ceter justify-content-center mt-2">
                            <div class="btn btn-primary mr-3" data-dismiss="modal">Save</div>
                            <div class="btn btn-primary" data-dismiss="modal">Cancel</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" role="dialog" aria-modal="true" id="new-create-modal">
    <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-block text-center pb-3 border-bttom">
                <h3 class="modal-title" id="exampleModalCenterTitle03">New Task</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputText03" class="h5">Task Name</label>
                            <input type="text" class="form-control" id="exampleInputText03" placeholder="Enter task Name">
                            <a href="#" class="task-edit text-body"><i class="ri-edit-box-line"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="exampleInputText2" class="h5">Assigned to</label>
                            <select name="type" class="selectpicker form-control" data-style="py-0">
                                <option>Memebers</option>
                                <option>Kianna Septimus</option>
                                <option>Jaxson Herwitz</option>
                                <option>Ryan Schleifer</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="exampleInputText2" class="h5">Project Name</label>
                            <select name="type" class="selectpicker form-control" data-style="py-0">
                                <option>Enter your project Name</option>
                                <option>Ui/Ux Design</option>
                                <option>Dashboard Templates</option>
                                <option>Wordpress Themes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputText40" class="h5">Description</label>
                            <textarea class="form-control" id="exampleInputText40" rows="2" placeholder="Textarea"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label for="exampleInputText8" class="h5">Checklist</label>
                            <input type="text" class="form-control" id="exampleInputText8" placeholder="Add List">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-0">
                            <label for="exampleInputText01" class="h5">Attachments</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Upload media</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap align-items-ceter justify-content-center mt-4">
                            <div class="btn btn-primary mr-3" data-dismiss="modal">Save</div>
                            <div class="btn btn-primary" data-dismiss="modal">Cancel</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>