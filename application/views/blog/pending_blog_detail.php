<style>
    .ck-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }

    .sticky-button {
            position: fixed;
            top: 80px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #764ba2, #667eea);
            border: none;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(238, 90, 82, 0.4);
            z-index: 1000;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .sticky-button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 25px rgba(238, 90, 82, 0.6);
        }

        .sticky-button:active {
            transform: scale(0.95);
        }

        /* Popup Content */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1001;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .popup-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .popup-content {
            position: fixed;
            top: 80px;
            right: 80px;
            width: 350px;
            max-width: calc(100vw - 40px);
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
            padding: 0;
            transform: translateY(-20px) scale(0.9);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            overflow: hidden;
        }

        .popup-overlay.active .popup-content {
            transform: translateY(0) scale(1);
        }

        .popup-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
            position: relative;
        }

        .popup-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .close-button {
            position: absolute;
            top: 15px;
            right: 15px;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }

        .close-button:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .popup-body {
            padding: 25px;
        }

        .popup-body h3 {
            color: #2c3e50;
            margin-bottom: 12px;
            font-size: 16px;
        }

        .popup-body p {
            color: #666;
            line-height: 1.5;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .popup-body ul {
            color: #666;
            padding-left: 20px;
            margin-bottom: 15px;
        }

        .popup-body li {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .popup-button {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            width: 100%;
        }

        .popup-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .popup-content {
                width: calc(100vw - 20px);
                right: 10px;
                top: 60px;
            }
            
            .sticky-button {
                right: 15px;
                top: 15px;
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }

</style>

<div class="wrapper">
    <div class="content-page">
        <div class="container-fluid">
            <div class="d-flex flex-column align-items-center mb-5">
                <div class="card p-0 border-radius-5 mb-0 mb-1 w-100" style="max-width: 700px;">
                    <div class="card-header border-bottom-0 p-0">
                        <div class="text-center">
                            <?php if ($blog['thumbnail'] && file_exists('public/' . $blog['thumbnail'])) { ?>
                                <img src="<?= base_url('public/' . $blog['thumbnail']) ?>" alt="Thumbnail" class="img-fluid">
                            <?php } else { ?>
                                <span class="text-muted">No Thumbnail</span>
                            <?php } ?>
                        </div>
                        <div class="form-group mb-0 mt-2 mx-2">
                            <h4 class="mb-2"><?= $blog['title'] ?></h4>
                        </div>
                    </div>
                </div>
                <div class="card p-0 border-radius-5 w-100" style="max-width: 700px;">
                        <div class="form-group mt-2 mx-2">
                            <div class="ck-content">
                                <?= $blog['content'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="sticky-button" onclick="togglePopup()">
                <i class="las la-info-circle"></i>
            </button>

            <!-- Popup Overlay -->
            <div class="popup-overlay" id="popupOverlay" onclick="closePopup()">
                <div class="popup-content" onclick="event.stopPropagation()">
                    <div class="popup-header">
                        <h2 class="popup-title text-white">Informasi Blog</h2>
                        <button class="close-button" onclick="closePopup()">×</button>
                    </div>
                    <div class="popup-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <?php if ($blog['status'] == 'pending'): ?>
                                <span class="badge badge-warning font-size-12 mr-2">Menunggu Persetujuan</span>
                            <?php elseif ($blog['status'] == 'approved'): ?>
                                <span class="badge badge-success font-size-12 mr-2">Persetujuan Diterima</span>
                            <?php elseif ($blog['status'] == 'rejected'): ?>
                                <span class="badge badge-dark font-size-12 mr-2">Persetujuan Ditolak</span>
                            <?php else: ?>
                                <span class="badge badge-light font-size-12 mr-2">Status Tidak Diketahui</span>
                            <?php endif; ?>
                            <div class="small"><?= format_bulan($blog['date_created']) ?></div>
                        </div>
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

                         <?= form_open('blog/submit_blog_status/' . encrypt_id($blog['blog_id'])) ?>
                         <div class="form-group">
                            <label>Status:</label><br>
                            <div class="row">
                                <div class="col-6">
                                    <label class="btn btn-outline-success flex-grow-1">
                                        <input type="radio" name="status" value="approved" id="approved"
                                            class="<?= !empty($errors['status']) ? 'is-invalid' : '' ?>"
                                            <?= ($blog['status'] ?? '') === 'approved' ? 'checked' : '' ?>
                                            autocomplete="off" required> Approved
                                    </label>
                                </div>
                                <div class="col-6">
                                    <label class="btn btn-outline-danger flex-grow-1">
                                        <input type="radio" name="status" value="rejected" id="rejected"
                                            class="<?= !empty($errors['status']) ? 'is-invalid' : '' ?>"
                                            <?= ($blog['status'] ?? '') === 'rejected' ? 'checked' : '' ?>
                                            autocomplete="off" required> Rejected
                                    </label>
                                </div>

                                <?php if (!empty($errors['status'])): ?>
                                    <div class="invalid-feedback"><?= $errors['status'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group" id="reason-group" style="display: none;">
                            <label for="reason">Alasan Penolakan:</label>
                            <textarea class="form-control <?= !empty($errors['reason_rejected']) ? 'is-invalid' : '' ?>" name="reason_rejected" id="reason" rows="3"><?= (isset($old['reason_rejected'])) ? $old['reason_rejected'] : $blog['reason_rejected'] ?></textarea>
                            <?php if (!empty($errors['reason_rejected'])): ?>
                                <div class="invalid-feedback"><?= $errors['reason_rejected'] ?></div>
                            <?php endif; ?>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const reasonGroup = document.getElementById('reason-group');
                                const rejectedRadio = document.getElementById('rejected');

                                if (rejectedRadio.checked) {
                                    reasonGroup.style.display = 'block';
                                } else {
                                    reasonGroup.style.display = 'none';
                                }
                                
                                document.querySelectorAll('input[name="status"]').forEach(function(radio) {
                                    radio.addEventListener('change', function() {
                                        reasonGroup.style.display = this.value === 'rejected' ? 'block' : 'none';
                                    });
                                });
                            });
                        </script>


                
                        <button type="submit" class="popup-button" onclick="closePopup()">
                            Submit Status
                        </button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function togglePopup() {
            const overlay = document.getElementById('popupOverlay');
            overlay.classList.toggle('active');
        }

        function closePopup() {
            const overlay = document.getElementById('popupOverlay');
            overlay.classList.remove('active');
        }

        // Close popup with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePopup();
            }
        });

        // Add scroll effect to button
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            const button = document.querySelector('.sticky-button');
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > lastScrollTop) {
                // Scrolling down
                button.style.transform = 'scale(0.9)';
            } else {
                // Scrolling up
                button.style.transform = 'scale(1)';
            }
            lastScrollTop = scrollTop;
        });
</script>
