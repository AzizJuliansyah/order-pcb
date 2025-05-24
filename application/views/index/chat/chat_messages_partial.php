<?php
function readable_date($dateStr) {
    $today = date('Y-m-d');
    $yesterday = date('Y-m-d', strtotime('-1 day'));

    if ($dateStr === $today) return 'Hari Ini';
    if ($dateStr === $yesterday) return 'Kemarin';

    return date('d M Y', strtotime($dateStr));
}
?>

<?php foreach ($grouped_messages as $date => $messages): ?>
    <div class="text-center">
        <div class="badge badge-pill border border-light text-muted my-3"><small><?= readable_date($date) ?></small></small>
    </div>

    <?php foreach ($messages as $msg): ?>
        <div class="<?= $msg['sender_id'] == $sender_id ? 'chat-message-right' : 'chat-message-left' ?> pb-1">
            <div>
                <?php
                    $foto = $msg['foto'] ?? null;
                    $src = $foto ? base_url('public/' . $foto) : base_url('public/local_assets/images/user_default.png');
                ?>
                <img src="<?= $src ?>" class="rounded-circle mr-1" width="40" height="40">
            </div>
            <small class="flex-shrink-1  <?= $msg['sender_id'] == $sender_id ? 'bg-success-light' : 'bg-dark-light' ?> text-left text-dark rounded px-2 ml-2 mr-2">
                <?php if ($msg['attachment'] != null && file_exists('public/' . $msg['attachment'])) { ?>
                    <img src="<?= base_url('public/' . $msg['attachment']) ?>" alt="" class="img-fluid rounded mt-1" style="max-width: 100%; max-height: 200px;">
                <?php } ?>
                <div class="text-dark"><?= nl2br(htmlentities($msg['message'])) ?></div>
                <div class="small d-flex justify-content-end text-dark time"><?= date('H:i', strtotime($msg['date_created'])) ?></div>
            </small>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>

<div id="chat-bottom"></div>
