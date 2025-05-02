<div class="iq-sidebar  sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center">
        <a href="<?= base_url('') ?>" class="header-logo">
            <img src="<?= base_url('public/' . get_website_logo()) ?>" alt="logo">
            <h3 class="logo-title light-logo"><?= get_website_name() ?></h3>
        </a>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <?php if (has_access(['1'])) { ?>
                    <li class="<?= set_active(['superadmin/dashboard'], 'active', null) ?>">
                        <a href="<?= base_url('superadmin/dashboard') ?>">
                            <i class="las la-tachometer-alt font-size-32"></i>
                            <span class="ml-4">Dashboards</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="#settings" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="las la-cog font-size-32"></i>
                            <span class="ml-4 mr-1">Settings</span>
                            <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                            <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                        </a>
                        <ul id="settings" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="<?= set_active(['superadmin/ui_ux'], 'active', null) ?>">
                                <a href="<?= base_url('superadmin/ui_ux') ?>">
                                    <i class="las la-minus"></i><span>UI / UX</span>
                                </a>
                            </li>
                            <li class="<?= set_active(['superadmin/auth_google'], 'active', null) ?>">
                                <a href="<?= base_url('superadmin/auth_google') ?>">
                                    <i class="las la-minus"></i><span>Auth Google</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="">
                        <a href="#user" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="las la-user-friends font-size-32"></i>
                            <span class="ml-4 mr-1">User Management</span>
                            <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                            <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                        </a>
                        <ul id="user" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="<?= set_active(['user_list', 'user_list_role']) ?>">
                                <a href="<?= base_url('superadmin/user_list') ?>">
                                    <i class="las la-minus"></i><span>User List</span>
                                </a>
                            </li>
                            <li class="<?= set_active(['superadmin/add_new_user'], 'active', null) ?>">
                                <a href="<?= base_url('superadmin/add_new_user') ?>">
                                    <i class="las la-minus"></i><span>User Add</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if (has_access(['2'])) { ?>
                    <li class="<?= set_active(['admin/dashboard'], 'active', null) ?>">
                        <a href="<?= base_url('admin/dashboard') ?>">
                            <i class="las la-tachometer-alt font-size-32"></i>
                            <span class="ml-4">Dashboards</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="#ordersettings" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="las la-sliders-h font-size-32"></i>
                            <span class="ml-4 mr-1">Order Settings</span>
                            <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                            <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                        </a>
                        <ul id="ordersettings" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="<?= set_active(['admin/order_settings_cnc'], 'active', null) ?>">
                                <a href="<?= base_url('admin/order_settings_cnc') ?>">
                                    <i class="las la-minus"></i><span>CNC</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="#order" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="las la-clipboard-list font-size-32"></i>
                            <span class="ml-4 mr-1">Data Order</span>
                            <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                            <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                        </a>
                        <ul id="order" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="<?= set_active(['admin/order_management'], 'active', null) ?>">
                                <a href="<?= base_url('admin/order_management') ?>">
                                    <i class="las la-minus"></i><span>Order Management</span>
                                </a>
                            </li>
                            <li class="<?= set_active(['order_list', 'order_detail']) ?>">
                                <a href="<?= base_url('admin/order_list') ?>">
                                    <i class="las la-minus"></i><span>Order List</span>
                                </a>
                            </li>
                            <li class="<?= set_active(['order_list_today', 'order_detail']) ?>">
                                <a href="<?= base_url('admin/order_list_today') ?>">
                                    <i class="las la-minus"></i><span>Order List Today</span>
                                </a>
                            </li>

                        </ul>
                    </li>
                <?php } ?>
                <?php if (has_access(['3'])) { ?>
                    <li class="<?= set_active(['operator/dashboard'], 'active', null) ?>">
                        <a href="<?= base_url('operator/dashboard') ?>">
                            <i class="las la-tachometer-alt font-size-32"></i>
                            <span class="ml-4">Dashboards</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="#orderdata" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="las la-clipboard-list font-size-32"></i>
                            <span class="ml-4 mr-1">Data Order</span>
                            <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                            <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                        </a>
                        <ul id="orderdata" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="<?= set_active(['order_list', 'order_detail']) ?>">
                                <a href="<?= base_url('operator/order_list') ?>">
                                    <i class="las la-minus"></i><span>Order List</span>
                                </a>
                            </li>
                            <li class="<?= set_active(['order_list_today', 'order_detail']) ?>">
                                <a href="<?= base_url('operator/order_list_today') ?>">
                                    <i class="las la-minus"></i><span>Order List Today</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (has_access(['4'])) { ?>
                    <li class="<?= set_active(['customerservice/dashboard'], 'active', null) ?>">
                        <a href="<?= base_url('customerservice/dashboard') ?>">
                            <i class="las la-tachometer-alt font-size-32"></i>
                            <span class="ml-4">Dashboards</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (has_access(['5'])) { ?>
                    <li class="<?= set_active(['customer/dashboard'], 'active', null) ?>">
                        <a href="<?= base_url('customer/dashboard') ?>">
                            <i class="las la-tachometer-alt font-size-32"></i>
                            <span class="ml-4">Dashboards</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <div class="pt-5 pb-2"></div>
    </div>
</div>