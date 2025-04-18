<div class="iq-sidebar  sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center">
        <a href="<?= base_url('') ?>" class="header-logo">
            <img src="<?= base_url('public/template_assets/images/logo.svg') ?>" alt="logo">
            <h3 class="logo-title light-logo">Webkit</h3>
        </a>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <?php if (has_access(['1'])) { ?>
                    <li class="<?= strpos(uri_string(), 'superadmin/dashboard') === 0 ? 'active' : '' ?>">
                        <a href="<?= base_url('superadmin/dashboard') ?>">
                            <i class="las la-tachometer-alt font-size-32"></i>
                            <span class="ml-4">Dashboards</span>
                        </a>
                    </li>
                <?php } elseif (has_access(['2'])) { ?>
                    <li class="<?= strpos(uri_string(), 'admin/dashboard') === 0 ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/dashboard') ?>">
                            <i class="las la-tachometer-alt font-size-32"></i>
                            <span class="ml-4">Dashboards</span>
                        </a>
                    </li>
                <?php } elseif (has_access(['3'])) { ?>
                    <li class="<?= strpos(uri_string(), 'operator/dashboard') === 0 ? 'active' : '' ?>">
                        <a href="<?= base_url('operator/dashboard') ?>">
                            <i class="las la-tachometer-alt font-size-32"></i>
                            <span class="ml-4">Dashboards</span>
                        </a>
                    </li>
                <?php } elseif (has_access(['4'])) { ?>
                    <li class="<?= strpos(uri_string(), 'customerservice/dashboard') === 0 ? 'active' : '' ?>">
                        <a href="<?= base_url('customerservice/dashboard') ?>">
                            <i class="las la-tachometer-alt font-size-32"></i>
                            <span class="ml-4">Dashboards</span>
                        </a>
                    </li>
                <?php } elseif (has_access(['5'])) { ?>
                    <li class="<?= strpos(uri_string(), 'customer/dashboard') === 0 ? 'active' : '' ?>">
                        <a href="<?= base_url('customer/dashboard') ?>">
                            <i class="las la-tachometer-alt font-size-32"></i>
                            <span class="ml-4">Dashboards</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (has_access(['1'])) { ?>
                    <li class="">
                        <a href="#settings" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="las la-cog font-size-32"></i>
                            <span class="ml-4 mr-1">Settings</span>
                            <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                            <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                        </a>
                        <ul id="settings" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="<?= strpos(uri_string(), 'superadmin/ui_ux') === 0 ? 'active' : '' ?>">
                                <a href="<?= base_url('superadmin/ui_ux') ?>">
                                    <i class="las la-minus"></i><span>UI / UX</span>
                                </a>
                            </li>
                            <li class="<?= strpos(uri_string(), 'superadmin/auth_google') === 0 ? 'active' : '' ?>">
                                <a href="<?= base_url('superadmin/auth_google') ?>">
                                    <i class="las la-minus"></i><span>Auth Google</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (has_access(['1'])) { ?>
                    <li class="">
                        <a href="#user" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="las la-user-friends font-size-32"></i>
                            <span class="ml-4 mr-1">User Management</span>
                            <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                            <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                        </a>
                        <ul id="user" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">

                            <!-- <li class="<?= in_array(uri_string(), ['superadmin/user_list', 'superadmin/user_list_role/']) ? 'active' : '' ?>">
                                <a href="<?= base_url('superadmin/user_list') ?>">
                                    <i class="las la-minus"></i><span>User List</span>
                                </a>
                            </li> -->
                            <li class="<?= strpos(uri_string(), 'superadmin/user_list') === 0 ? 'active' : '' ?>">
                                <a href="<?= base_url('superadmin/user_list') ?>">
                                    <i class="las la-minus"></i><span>User List</span>
                                </a>
                            </li>
                            <li class="<?= uri_string() === 'superadmin/add_new_user' ? 'active' : '' ?>">
                                <a href="<?= base_url('superadmin/add_new_user') ?>">
                                    <i class="las la-minus"></i><span>User Add</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <div class="pt-5 pb-2"></div>
    </div>
</div>