<!-- Wrapper Start -->
<style>
    .dragover {
        border: 2px dashed #007bff;
        background-color: #f0f8ff;
    }
    .hidden {
        display: none;
    }
</style>



<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card bottom-right shadow-showcase">
                        <?= form_open_multipart('blog/edit_blog/' . encrypt_id($blog['blog_id'])) ?>
                        <div class="card-header border-bottom-0 mb-5">
                            <div class="float-left">
                                <h4 class="card-title d-flex align-items-center"><a href="<?= base_url('blog/blog_list') ?>"><i class="las la-angle-left font-size-20 mr-3"></i></a> Edit Blog: <span class="d-inline-block text-truncate" style="max-width: 100px;"><?= $blog['title'] ?></span></h4>
                            </div>
                            <div class="float-right">
                            <div class="d-flex align-items-center">
                                <div class="form-group mb-0 mr-2">
                                    <button type="submit" class="btn btn-sm bg-info-light d-flex align-items-center">
                                        <span class="">Edit</span>
                                    </button>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row col-12 col-lg-10 mb-2 p-0">
                                <div class="form-group col-lg-2 mb-0">
                                    <label for="thumbnail">Thumbnail <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group col-lg-10 mb-0">
                                    <div class="uploader-file file-drag">
                                        <input type="file" name="thumbnail" accept="image/*" class="file-upload" style="display: none;" />
                                        <label class="file-label">
                                            <span class="start-one">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                <div class="row d-flex justify-content-center">
                                                    <?php if ($blog['thumbnail'] && file_exists('public/' . $blog['thumbnail'])) { ?>
                                                        <img src="<?= base_url('public/' . $blog['thumbnail']) ?>" alt="Thumbnail" class="file-image img-fluid" style="max-width: 100px;">
                                                    <?php } else { ?>
                                                        <span class="not-image text-danger">Please select image</span>
                                                    <?php } ?>
                                                </div>
                                                <span class="d-block">Select a file or drag here</span>
                                                <span class="file-upload-btn btn btn-primary text-white mt-2">Select a file</span>
                                            </span>           
                                        </label>

                                        <?php if (!empty($errors['thumbnail'])): ?>
                                            <div class="invalid-feedback d-block"><?= $errors['thumbnail'] ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row col-12 col-lg-10 mb-3 p-0">
                                <div class="form-group col-lg-2 mb-0">
                                    <label for="title">Blog Title <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group col-lg-10 mb-0">
                                    <input type="text" class="form-control border-radius-5 max-height-40 <?= !empty($errors['title']) ? 'is-invalid' : '' ?>" name="title" id="title" value="<?= isset($old['title']) ? $old['title'] : $blog['title'] ?>">
                                    <?php if (!empty($errors['title'])): ?>
                                        <div class="invalid-feedback"><?= $errors['title'] ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row col-12 col-lg-10 mb-2 p-0">
                                <div class="form-group col-lg-2 mb-0">
                                    <label for="content">Blog Content <span class="text-danger">*</span></label>
                                </div>
                                <div class="form-group col-lg-10 mb-0">
                                    <textarea contenteditable="true" name="content" id="content" class="<?= !empty($errors['content']) ? 'is-invalid' : '' ?>" cols="30" rows="10"><?= isset($old['content']) ? $old['content'] : $blog['content'] ?></textarea>
                                    <?php if (!empty($errors['content'])): ?>
                                        <div class="invalid-feedback"><?= $errors['content'] ?></div>
                                    <?php endif; ?>
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

<script>
    const containers = document.querySelectorAll('.file-drag');

    containers.forEach(container => {
        const label = container.querySelector('.file-label');
        const input = container.querySelector('.file-upload');
        const image = container.querySelector('.file-image');
        const notImage = container.querySelector('.not-image');
        const uploadBtn = container.querySelector('.file-upload-btn');

        uploadBtn.addEventListener('click', function (e) {
            e.preventDefault();
            input.click();
        });

        input.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) previewFile(file, image, notImage);
        });

        label.addEventListener('dragover', (e) => {
            e.preventDefault();
            label.classList.add('dragover');
        });

        label.addEventListener('dragleave', (e) => {
            e.preventDefault();
            label.classList.remove('dragover');
        });

        label.addEventListener('drop', (e) => {
            e.preventDefault();
            label.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            input.files = e.dataTransfer.files;
            if (file) previewFile(file, image, notImage);
        });
    });

    function previewFile(file, image, notImage) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                image.src = e.target.result;
                image.classList.remove('hidden');
                notImage.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            image.classList.add('hidden');
            notImage.classList.remove('hidden');
        }
    }


    let uploadedImages = [];

    ClassicEditor
        .create(document.querySelector('#content'), {
            ckfinder: {
                uploadUrl: '<?= base_url('blog/blog_content_images') ?>'
            }
        })
        .then(editor => {
            console.log(`Editor initialized for #content`);
            let previousData = editor.getData();

            editor.model.document.on('change:data', () => {
                const currentData = editor.getData();
                detectImageDeletion(previousData, currentData);
                previousData = currentData;
            });

            // Tangkap gambar baru dari response upload
            editor.plugins.get('FileRepository').on('uploadComplete', (evt, data) => {
                const url = data.response.url;
                const filename = getFilenameFromUrl(url);
                uploadedImages.push(filename);
                console.log(`Image uploaded: ${filename}`);
            });
        })
        .catch(error => {
            console.error(error);
        });


    function detectImageDeletion(previousData, currentData) {
        const previousImages = extractImageSources(previousData);
        const currentImages = extractImageSources(currentData);

        previousImages.forEach(imageSrc => {
            if (!currentImages.includes(imageSrc)) {
                const filename = getFilenameFromUrl(imageSrc);
                console.log(`Image deleted: ${filename}`);
                fetch('<?= base_url('blog/blog_content_images_delete') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            filename: filename
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log(`Image ${filename} deleted successfully`);
                        } else {
                            console.error(`Failed to delete image ${filename}:`, data.message);
                        }
                    })
                    .catch(error => {
                        console.error(`Error while deleting image ${filename}`, error);
                    });
            }
        });
    }

    function getFilenameFromUrl(url) {
        const parts = url.split('/');
        return parts.pop();
    }



    function extractImageSources(data) {
        const imgTags = data.match(/<img[^>]+src="([^">]+)"/g) || [];
        const sources = imgTags.map(tag => {
            const match = tag.match(/src="([^">]+)"/);
            return match ? match[1] : null;
        }).filter(src => src);

        return sources;
    }


    window.addEventListener('beforeunload', function (e) {
        if (uploadedImages.length > 0) {
            navigator.sendBeacon('<?= base_url('blog/delete_temp_images') ?>', JSON.stringify({
                filenames: uploadedImages
            }));
        }
    });
</script>
