<!-- Wrapper Start -->
<style>

    .messages-card {
        display: flex;
        flex-direction: column;
        height: 100%; /* atau sesuai kebutuhan */
        overflow: hidden;
    }
    .iq-sidebar-toggle {
        display: flex;
        flex-direction: column;
        height: 50vh; /* atau sesuai kebutuhan */
        overflow: hidden;
    }

    .chat-messages {
        flex-grow: 1;
        overflow-y: auto;
    }
    .chat-list {
        flex-grow: 1;
        overflow: auto;
    }

    .chat-message-left {
        display: flex;
        flex-shrink: 0;
        margin-right: auto;
        max-width: 70%;
    }

    .chat-message-right {
        display: flex;
        flex-shrink: 0;
        flex-direction: row-reverse;
        margin-left: auto;
        max-width: 70%;
    }

    @media (max-width: 576px) {
        .chat-message-left {
            max-width: 90% !important;
        }
        .chat-message-right {
            max-width: 90% !important;
        }
    }
    .time {
        margin-top: -10px;
    }
    .image-upload-wrapper.disabled {
        cursor: not-allowed !important;
        border-color: #d6d6d6 !important;
        color: #bcbcbc !important;
    }

    .image-upload-wrapper.disabled i {
        color: #bcbcbc !important;
    }

    .hover-effect {
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    .hover-effect:hover {
        background-color: #343a40;
        color: #fff;
        border-color: #343a40;
    }
    .hover-effect:hover i {
        color: #fff;
    }
</style>



<div class="iq-sidebar  sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center">
            <div class="d-flex align-items-center">
                <?php if (has_access(['1'])) { ?>
                    <a href="<?= base_url('superadmin/dashboard') ?>" class="text-dark mr-2">
                        <i class="las la-home font-size-20"></i>
                    </a>
                 <?php } elseif (has_access(['2'])) { ?>
                    <a href="<?= base_url('admin/dashboard') ?>" class="text-dark mr-2">
                        <i class="las la-home font-size-20"></i>
                    </a>
                 <?php } elseif (has_access(['3'])) { ?>
                    <a href="<?= base_url('operator/dashboard') ?>" class="text-dark mr-2">
                        <i class="las la-home font-size-20"></i>
                    </a>
                 <?php } elseif (has_access(['4'])) { ?>
                    <a href="<?= base_url('customerservice/dashboard') ?>" class="text-dark mr-2">
                        <i class="las la-home font-size-20"></i>
                    </a>
                 <?php } elseif (has_access(['5'])) { ?>
                    <a href="<?= base_url('customer/dashboard') ?>" class="text-dark mr-2">
                        <i class="las la-home font-size-20"></i>
                    </a>
                 <?php } ?>
                <div class="flex-grow-1">
                    <input type="text" id="chat-search" class="form-control my-3" placeholder="Search...">
                </div>
            </div>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu chat-list">
                <?php foreach ($users as $customer): ?>
                    <li class="">
                    <a href="#" class="list-group-item list-group-item-action border-0 chat-user"
                        data-user-id="<?= $customer['id'] ?>"
                        data-user-role-nama="<?= get_user_role($customer['role_id']) ?>"
                        data-nama="<?= $customer['nama'] ?>"
                        data-foto="<?= base_url('public/' . ($customer['foto'] ?? 'local_assets/images/user_default.png')) ?>">

                        <?php if ($customer['unread_count'] > 0): ?>
                            <div class="badge bg-success float-right ml-2"><?= $customer['unread_count'] ?></div>
                        <?php endif; ?>
                        <div class="d-flex align-items-start">
                            <?php if ($customer['foto'] != null) { ?>
                                    <img src="<?= base_url('public/' . $customer['foto']) ?>" class="rounded-circle mr-1" alt="<?= $customer['nama'] ?>" width="40" height="40">
                            <?php } else { ?>
                                    <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="rounded-circle mr-1" alt="<?= $customer['nama'] ?>" width="40" height="40">
                            <?php } ?>
                            <div class="flex-grow-1 ml-3">
                                <strong class="d-inline-block text-truncate" style="max-width: 115px;">
                                    <?= $customer['nama'] ?>
                                </strong>
                                <div class="small"><?= get_user_role($customer['role_id']) ?></div>
                            </div>
                        </div>
                    </a>
                    </li>
                <?php endforeach; ?>
                <li id="no-results" class="text-center text-muted mt-3" style="display: none;">
                    <i class="las la-search-minus font-size-20"></i> Tidak ada hasil yang cocok.
                </li>
            </ul>
        </nav>
        <div class="pt-5 pb-2"></div>
    </div>
</div>

<div class="wrapper">
    <div class="content-page" style="margin-top: -20px">
        <div class="container-fluid">
           <div class="card bottom-right shadow-showcase" style="height: 80vh;">
                <div class="messages-card">
                    <div class="py-1 px-4 border-bottom">
                        <div class="d-flex align-items-center">
                            <a href="#" id="back-to-empty-chat" class="text-dark mr-2">
                               <i class="las la-angle-left font-size-20"></i>
                            </a>
                            <img id="chat-header-foto" src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="rounded-circle" alt="Foto" width="40" height="40">
                            <div class="flex-grow-1 pl-3">
                                <strong id="chat-header-nama-mobile" class="d-none d-md-block"></strong>
                                <strong id="chat-header-nama-desktop" class="d-inline-block text-truncate d-block d-sm-none" style="max-width: 145px;"></strong>
                                <div class="small" style="margin-top: -12px;" id="chat-header-role"></div>
                            </div>

                        </div>
                    </div>

                    <div id="empty-chat-info" class="text-center text-muted p-5">
                        <i class="las la-comments text-muted mt-5 mb-2" style="font-size: 8rem;"></i>
                        <div>Silakan pilih pengguna untuk memulai percakapan.</div>
                    </div>
                    <div id="image-preview-container" class="p-2 justify-content-center align-items-center position-relative" style="height: 100%; display: none;">
                        <img id="image-preview" class="img-fluid rounded" style="max-height: 300px;" />
                        <button id="cancel-image-preview" class="btn btn-sm btn-danger position-absolute" style="top: 5px; right: 5px;">
                            <i class="las la-times mr-0 pr-0"></i>
                        </button>
                    </div>

                    <div class="chat-messages p-2" id="chat-messages">
                    </div>

                    <div id="new-message-alert" style="
                        display: none;
                        position: fixed;
                        bottom: 20px;
                        right: 20px;
                        color: #212529;
                        padding: 10px 10px;
                        border-radius: 50px;
                        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                        cursor: pointer;
                        z-index: 9999;
                        display: flex;
                        align-items: center;
                    " class="bg bg-white">
                    <div class="d-flex flex-column">
                        <i class="las la-angle-double-down font-size-20"></i>
                        <span class="badge bg-success mt-2" id="new-message-count">0</span>
                    </div>
                    </div>


                    <div class="flex-grow-0 py-1 px-3 border-top">
                        <form id="chat-form" enctype="multipart/form-data">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="badge border border-dark text-dark rounded-circle mr-2 image-upload-wrapper hover-effect" style="cursor: pointer;">
                                    <i class="las la-image upload-button font-size-20" style="margin-top: 3px;"></i>
                                    <input class="file-upload d-none" type="file" name="foto" id="chat-photo" accept="image/*" onchange="previewNewPhoto(this)">
                                </div>

                                <div class="input-group">
                                    <textarea
                                        class="form-control"
                                        id="message-input"
                                        name="message"
                                        placeholder="Type your message..."
                                        rows="1"
                                        style="overflow-y: auto; resize: none; max-height: 80px;"
                                    ></textarea>

                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text bg-primary" id="send-message"><i class="las la-paper-plane font-size-20"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->


<script>
    let activeUserId = null;
    let lastMessageCount = 0;
    let hasMarkedRead = false;
    let lastSearchValue = '';
    const textarea = document.getElementById('message-input');

    textarea.addEventListener('input', function () {
        this.style.height = 'auto';

        const maxHeight = parseInt(window.getComputedStyle(this).getPropertyValue('max-height'));
        this.style.height = Math.min(this.scrollHeight, maxHeight) + 'px';
    });

    const searchInput = document.getElementById('chat-search');

    searchInput.addEventListener('input', function () {
        lastSearchValue = this.value.toLowerCase();
        filterChatList(lastSearchValue);
    });
    function filterChatList(searchValue) {
        const users = document.querySelectorAll('#iq-sidebar-toggle li:not(#no-results)');
        let visibleCount = 0;

        users.forEach(user => {
            const nama = user.querySelector('[data-nama]').dataset.nama.toLowerCase();
            const role = user.querySelector('[data-user-role-nama]').dataset.userRoleNama.toLowerCase();

            if (nama.includes(searchValue) || role.includes(searchValue)) {
                user.style.display = '';
                visibleCount++;
            } else {
                user.style.display = 'none';
            }
        });

        document.getElementById('no-results').style.display = (visibleCount === 0) ? '' : 'none';
    }



    $(document).ready(function () {
        const activeChatData = localStorage.getItem('activeChatRoom');
        if (activeChatData) {
            const chat = JSON.parse(activeChatData);
            if (chat.userId) {
                loadMessages(chat.userId, chat.userRole, chat.nama, chat.foto, false, true);
                setTimeout(() => {
                    $(`.chat-user[data-user-id="${chat.userId}"]`).closest('li').addClass('active');
                }, 300);
            }
        } else {
            $('#message-input').prop('disabled', true);
            $('#send-message').prop('disabled', true);
            $('.image-upload-wrapper input[type="file"]').prop('disabled', true);
            $('.image-upload-wrapper').addClass('disabled');
            $('#new-message-alert').hide();
        }
    });

    $('.chat-list').on('click', '.chat-user', function (e) {
        e.preventDefault();
        const userId = $(this).data('user-id');
        const userRole = $(this).data('user-role-nama');
        const nama = $(this).data('nama');
        const foto = $(this).data('foto');

        loadMessages(userId, userRole, nama, foto, true, true);
        
        $('.chat-list li').removeClass('active');
        $(this).closest('li').addClass('active');

        $('#message-input').prop('disabled', false);
        $('#send-message').prop('disabled', false);
        $('.image-upload-wrapper input[type="file"]').prop('disabled', false);
        $('.image-upload-wrapper').removeClass('disabled');

        localStorage.setItem('activeChatRoom', JSON.stringify({
            userId: userId,
            userRole: userRole,
            nama: nama,
            foto: foto
        }));
    });
    
    function loadMessages(userId, userRole = null, nama = null, foto = null, scrollOnLoad = false, isManual = false) {
        if (isManual) {
            $('#empty-chat-info').hide();

            if (nama && userRole && foto) {
                $('#chat-header-nama-mobile').text(nama);
                $('#chat-header-nama-desktop').text(nama);
                $('#chat-header-role').text(userRole);
                $('#chat-header-foto').attr('src', foto);
            }
        }

        $.post("<?= base_url('chat/load_messages') ?>", { user_id: userId }, function (response) {
            const res = JSON.parse(response);
            const userAtBottom = isUserAtBottom();

            const newMessageCount = res.unread_count;
            const isNewMessage = newMessageCount > 0;

            if (isManual) {
                activeUserId = userId;
                hasMarkedRead = false;
            }

            if (activeUserId === userId) {
                $('#chat-messages').html(res.messages);
                if (scrollOnLoad || userAtBottom) {
                    scrollToBottom();
                    $('#new-message-alert').hide();
                } else if (isNewMessage) {
                    $('#new-message-count').text(newMessageCount);
                    $('#new-message-alert').show();
                } else {
                    $('#new-message-alert').hide();
                }
            }
        });
    }

    function updateUnreadCounts() {
         $.get("<?= base_url('chat/get_unread_counts') ?>", function(data) {
             const users = JSON.parse(data);
             const activeChat = JSON.parse(localStorage.getItem('activeChatRoom'));
            const activeUserId = activeChat ? activeChat.userId : null;

             let chatListHTML = '';

             users.forEach(user => {
                 const fotoUrl = user.foto ? `<?= base_url('public/') ?>${user.foto}` : `<?= base_url('public/local_assets/images/user_default.png') ?>`;
                 const roleNama = user.role_nama ?? '';
                 const isActive = activeUserId == user.id ? 'active' : '';

                 chatListHTML += `
                    <li class="${isActive}">
                        <a href="#" class="list-group-item list-group-item-action border-0 chat-user"
                            data-user-id="${user.id}"
                            data-user-role-nama="${roleNama}"
                            data-nama="${user.nama}"
                            data-foto="${fotoUrl}">
                            ${user.unread_count > 0 ? `<div class="badge bg-success float-right ml-2">${user.unread_count}</div>` : ''}
                            <div class="d-flex align-items-start">
                                <img src="${fotoUrl}" class="rounded-circle mr-1" width="40" height="40">
                                <div class="flex-grow-1 ml-3">
                                    <strong class="d-inline-block text-truncate" style="max-width: 115px;">${user.nama}</strong>
                                    <div class="small">${roleNama}</div>
                                </div>
                            </div>
                        </a>
                     </li>
                 `;
             });

             $('.chat-list').html(chatListHTML + $('#no-results')[0].outerHTML);

             filterChatList(lastSearchValue);
         });
    }

    




    $(document).ready(function () {
        $('#chat-form').on('submit', function (e) {
            e.preventDefault();

            const msg = $('#message-input').val();
            const file = $('#chat-photo')[0].files[0];

            if (!msg.trim() && !file) return;

            const formData = new FormData(this);
            formData.append('receiver_id', activeUserId);

            $.ajax({
                url: "<?= base_url('chat/send_message') ?>",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function () {
                    $('#message-input').val('');
                    $('#chat-photo').val('');
                    $('#image-preview').attr('src', '');
                    $('#image-preview-container').hide();
                    $('#chat-messages').show();
                    loadMessages(activeUserId, true);
                }
            });
        });

        $('#message-input').on('keydown', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                $('#chat-form').submit();
            }
        });
    });

    function previewNewPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#image-preview').attr('src', e.target.result);
                $('#image-preview-container').css('display', 'flex');
                $('#chat-messages').hide();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#cancel-image-preview').on('click', function () {
        $('#image-preview').attr('src', '');
        $('#image-preview-container').css('display', 'none');
        $('#chat-messages').show();
    });



    
    function isUserAtBottom() {
        const container = document.getElementById('chat-messages');
        return container.scrollHeight - container.scrollTop <= container.clientHeight + 50;
    }
    function scrollToBottom() {
        const chatBottom = document.getElementById('chat-bottom');
        if (chatBottom) {
            chatBottom.scrollIntoView({ behavior: 'smooth' });
        }
    }
    function markMessagesAsRead() {
        $.post("<?= base_url('chat/mark_as_read') ?>", {
            sender_id: activeUserId
        });
    }
    document.getElementById('chat-messages').addEventListener('scroll', function () {
        if (isUserAtBottom() && !hasMarkedRead) {
            markMessagesAsRead();
            hasMarkedRead = true;
        }
    });
    $('#chat-messages').on('scroll', function () {
        if (isUserAtBottom()) {
            $('#new-message-alert').hide();
            markMessagesAsRead();
        }
    });
    $('#new-message-alert').on('click', function () {
        scrollToBottom();
        $(this).hide();
    });


    $('#back-to-empty-chat').on('click', function (e) {
        e.preventDefault();

        localStorage.removeItem('activeChatRoom');

        $('#chat-header-foto').attr('src', '<?= base_url('public/local_assets/images/user_default.png') ?>');
        $('#chat-header-nama-desktop').text('');
        $('#chat-header-nama-mobile').text('');
        $('#chat-header-role').text('');

        $('#chat-messages').html('');
        $('#empty-chat-info').show();

        $('#message-input').val('').prop('disabled', true);
        $('#send-message').prop('disabled', true);
        $('#new-message-alert').hide();

        $('.chat-list li').removeClass('active');
        activeUserId = null;

        $('.image-upload-wrapper input[type="file"]').prop('disabled', true);
        $('.image-upload-wrapper').addClass('disabled');
    });

    setInterval(() => {
        if (activeUserId) {
            loadMessages(activeUserId, null, null, null, false, false);
        }

        updateUnreadCounts();
    }, 3000);

</script>