<?php foreach ($messages as $msg): ?>
    <div class="<?= $msg['sender_id'] == $sender_id ? 'chat-message-right' : 'chat-message-left' ?> pb-4">
        <div>
            <?php
                $foto = $msg['foto'] ?? null;
                $src = $foto ? base_url('public/' . $foto) : base_url('public/local_assets/images/user_default.png');
            ?>
            <img src="<?= $src ?>" class="rounded-circle mr-1" width="40" height="40">
        </div>
        <small class="flex-shrink-1 bg-light rounded px-2 ml-2">
            <?= htmlentities($msg['message']) ?>
            <div class="small d-flex justify-content-end time"><?= date('H:i', strtotime($msg['date_created'])) ?></div>
        </small>
    </div>
<?php endforeach; ?>
<div id="chat-bottom"></div>
