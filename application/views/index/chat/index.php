<!-- Wrapper Start -->
<style>

    .messages-card {
        display: flex;
        flex-direction: column;
        height: 83vh; /* atau sesuai kebutuhan */
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

    .chat-message-left,
    .chat-message-right {
        display: flex;
        flex-shrink: 0
    }

    .chat-message-left {
        margin-right: auto;
        max-width: 70%;
    }

    .chat-message-right {
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
</style>



<div class="iq-sidebar  sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center">
            <div class="d-flex align-items-center">
                <div class="flex-grow-1">
                    <input type="text" class="form-control my-3" placeholder="Search...">
                </div>
            </div>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <div class="chat-list">
                                        <?php foreach ($users as $customer): ?>
                                            <a href="#" class="list-group-item list-group-item-action border-0 chat-user"
                                                    data-user-id="<?= $customer['id'] ?>"
                                                    data-user-role-nama="<?= get_user_role($customer['role_id']) ?>"
                                                    data-nama="<?= $customer['nama'] ?>"
                                                    data-foto="<?= base_url('public/' . ($customer['foto'] ?? 'local_assets/images/user_default.png')) ?>">

                                                <?php if ($customer['unread_count'] > 0): ?>
                                                    <div class="badge bg-success float-right mt-2"><?= $customer['unread_count'] ?></div>
                                                <?php endif; ?>
                                                <div class="d-flex align-items-start">
                                                    <?php if ($customer['foto'] != null) { ?>
                                                            <img src="<?= base_url('public/' . $customer['foto']) ?>" class="rounded-circle mr-1" alt="<?= $customer['nama'] ?>" width="40" height="40">
                                                    <?php } else { ?>
                                                            <img src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="rounded-circle mr-1" alt="<?= $customer['nama'] ?>" width="40" height="40">
                                                    <?php } ?>
                                                    <div class="flex-grow-1 ml-3">
                                                        <strong><?= $customer['nama'] ?></strong>
                                                        <div class="small" style="margin-top: -10px;"><?= get_user_role($customer['role_id']) ?></div>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
            </ul>
        </nav>
        <div class="pt-5 pb-2"></div>
    </div>
</div>

<div class="wrapper">
    <div class="content-page" style="margin-top: -30px">
        <div class="container-fluid">
           <div class="card" style="height: 85vh;">
                <div class="messages-card">
                    <div class="py-2 px-4 border-bottom">
                        <div class="d-flex align-items-center">
                            <img id="chat-header-foto" src="<?= base_url('public/local_assets/images/user_default.png') ?>" class="rounded-circle" alt="Foto" width="40" height="40">
                            <div class="flex-grow-1 pl-3">
                                <strong id="chat-header-nama"></strong>
                                <div class="small" style="margin-top: -12px;" id="chat-header-role"></div>
                            </div>

                        </div>
                    </div>

                    <div class="chat-messages p-2" id="chat-messages"></div>

                    <div id="new-message-alert" class="text-center py-1 bg-warning text-dark" style="cursor:pointer; display:none;">
                                        Pesan baru. Klik di sini untuk scroll ↓
                    </div>

                    <div class="flex-grow-0 pt-2 px-3 border-top">
                        <div class="input-group">
                            <input type="text" class="form-control" id="message-input" placeholder="Type your message...">
                            <div class="input-group-append">
                                <button class="input-group-text bg-primary" id="send-message"><i class="las la-paper-plane font-size-20"></i></button>
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
    let activeUserId = null;
    let lastMessageCount = 0;

    $(document).ready(function () {
        const activeChatData = localStorage.getItem('activeChatRoom');
        if (activeChatData) {
            const chat = JSON.parse(activeChatData);
            if (chat.userId) {
                loadMessages(chat.userId, chat.userRole, chat.nama, chat.foto, false);
            }
        }
    });


    $('.chat-list').on('click', '.chat-user', function (e) {
        e.preventDefault();
        const userId = $(this).data('user-id');
        const userRole = $(this).data('user-role-nama');
        const nama = $(this).data('nama');
        const foto = $(this).data('foto');

        loadMessages(userId, userRole, nama, foto, true);

        // Simpan semua info ke localStorage sebagai JSON
        localStorage.setItem('activeChatRoom', JSON.stringify({
            userId: userId,
            userRole: userRole,
            nama: nama,
            foto: foto
        }));
    });


    function loadMessages(userId, userRole = null, nama = null, foto = null, scrollOnLoad = false) {
        activeUserId = userId;

        if (nama && userRole && foto) {
            $('#chat-header-nama').text(nama);
            $('#chat-header-role').text(userRole);
            $('#chat-header-foto').attr('src', foto);
        }

        $.post("<?= base_url('chat/load_messages') ?>", { user_id: userId }, function (data) {
            const chatContainer = document.getElementById('chat-messages');
            const userAtBottom = isUserAtBottom();

            // Hitung jumlah pesan baru
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = data;
            const newMessageCount = tempDiv.querySelectorAll('.chat-message-left, .chat-message-right').length;

            const isNewMessage = newMessageCount > lastMessageCount;

            $('#chat-messages').html(data);
            lastMessageCount = newMessageCount;

            if (scrollOnLoad || userAtBottom) {
                scrollToBottom();
                $('#new-message-alert').hide();
            } else if (isNewMessage) {
                $('#new-message-alert').show(); // Tampilkan peringatan jika ada pesan baru dan user tidak di bawah
            }
        });
    }

    function isUserAtBottom() {
        const container = document.getElementById('chat-messages');
        return container.scrollHeight - container.scrollTop <= container.clientHeight + 50;
    }

    function scrollToBottom() {
        const chatBottom = document.getElementById('chat-bottom');
        if (chatBottom) {
            chatBottom.scrollIntoView({ behavior: 'smooth' });
        }
        markMessagesAsRead();
    }

    function markMessagesAsRead() {
        $.post("<?= base_url('chat/mark_as_read') ?>", {
            sender_id: activeUserId
        });
    }


     function updateUnreadCounts() {
         $.get("<?= base_url('chat/get_unread_counts') ?>", function(data) {
             const users = JSON.parse(data);

             let chatListHTML = '';

             users.forEach(user => {
                 const fotoUrl = user.foto ? `<?= base_url('public/') ?>${user.foto}` : `<?= base_url('public/local_assets/images/user_default.png') ?>`;
                 const roleNama = user.role_nama ?? '';

                 chatListHTML += `
                     <a href="#" class="list-group-item list-group-item-action border-0 chat-user"
                         data-user-id="${user.id}"
                         data-user-role-nama="${roleNama}"
                         data-nama="${user.nama}"
                         data-foto="${fotoUrl}">
                         ${user.unread_count > 0 ? `<div class="badge bg-success float-right mt-2">${user.unread_count}</div>` : ''}
                         <div class="d-flex align-items-start">
                             <img src="${fotoUrl}" class="rounded-circle mr-1" width="40" height="40">
                             <div class="flex-grow-1 ml-3">
                                 <strong>${user.nama}</strong>
                                 <div class="small" style="margin-top: -10px;">${roleNama}</div>
                             </div>
                         </div>
                     </a>
                 `;
             });

             $('.chat-list').html(chatListHTML);
         });
     }



    // Kirim pesan
    function sendMessage() {
        const msg = $('#message-input').val();
        if (!msg || !activeUserId) return;

        $.post("<?= base_url('chat/send_message') ?>", {
            receiver_id: activeUserId,
            message: msg
        }, function () {
            $('#message-input').val('');
            loadMessages(activeUserId, true); // scroll setelah kirim pesan
        });
    }

    $('#send-message').on('click', function () {
        sendMessage();
    });

    $('#message-input').on('keypress', function (e) {
        if (e.which === 13 && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    $('#new-message-alert').on('click', function () {
        scrollToBottom();
        $(this).hide();
    });

    $('#chat-messages').on('scroll', function () {
        if (isUserAtBottom()) {
            $('#new-message-alert').hide();
            markMessagesAsRead();
        }
    });

    // Polling tiap 3 detik tanpa scroll paksa
    setInterval(() => {
        if (activeUserId) {
            loadMessages(activeUserId, false); // tidak scroll saat polling
        }

        updateUnreadCounts();
    }, 3000);

</script>