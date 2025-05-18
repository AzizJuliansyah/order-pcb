<!-- Wrapper Start -->
<style>

    .messages-card {
        display: flex;
        flex-direction: column;
        height: 83vh; /* atau sesuai kebutuhan */
        overflow: hidden;
    }
    .list-card {
        display: flex;
        flex-direction: column;
        height: 83vh; /* atau sesuai kebutuhan */
        overflow: hidden;
    }

    .chat-messages {
        flex-grow: 1;
        overflow-y: auto;
    }
    .chat-list {
        flex-grow: 1;
        overflow-y: auto;
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



<div class="wrapper">
    <div class="content-page" style="margin-top: -30px">
        <div class="container-fluid">
            <main class="content">
                <div class="container p-0">
                    <div class="card" style="height: 85vh;">
                        <div class="row g-0">
                            <div class="col-12 col-lg-5 col-xl-3 border-right d-none d-lg-block">
                                <div class="list-card">
                                    <div class="px-4 d-none d-md-block">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <input type="text" class="form-control my-3" placeholder="Search...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-list">
                                        <?php foreach ($customers as $customer): ?>
                                            <a href="#" class="list-group-item list-group-item-action border-0">
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
                                </div>
                            </div>
                            <div class="col-12 col-lg-7 col-xl-9 d-flex flex-column h-100">
                                <div class="messages-card">
                                    <div class="py-2 px-4 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="position-relative">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle" alt="Sharon Lessman" width="40" height="40">
                                            </div>
                                            <div class="flex-grow-1 pl-3">
                                                <strong>Sharon Lessman</strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="chat-messages p-2">
                                        <div class="text-center m-2">
                                            <small>Date</small>
                                        </div>

                                        <div class="chat-message-right pb-4">
                                            <div>
                                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            </div>
                                            <small class="flex-shrink-1 bg-light rounded py-2 px-2 mr-2">
                                                    Lorem ipsum dolor sit amet, vis erat denique in, dicunt prodesset te vix.
                                                <div class="small d-flex justify-content-end time">2:33 am</div>
                                            </small>
                                        </div>

                                        <div class="chat-message-left pb-4">
                                            <div>
                                                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            </div>
                                            <small class="flex-shrink-1 bg-light rounded py-2 px-2 ml-2">
                                                    tes
                                                <div class="small d-flex justify-content-end time">2:33 am</div>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="flex-grow-0 pt-2 px-3 border-top">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="message-input" placeholder="Type your message..." aria-label="Type your message..." aria-describedby="basic-addon5">
                                            <div class="input-group-append">
                                                <span class="input-group-text bg-primary" id="basic-addon5"><i class="las la-paper-plane font-size-20"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<!-- Wrapper End-->
