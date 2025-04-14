<div class="iq-sidebar  sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center">
        <a href="../backend/index.html" class="header-logo">
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
                <li class="">
                    <a href="../backend/index.html" class="svg-icon">
                        <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span class="ml-4">Dashboards</span>
                    </a>
                </li>
                <li class=" ">
                    <a href="#user" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="las la-user-friends font-size-32"></i>
                        <span class="ml-4">User Details</span>
                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                    </a>
                    <ul id="user" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">

                        <!-- <li class="<?= in_array(uri_string(), ['administrator/user_list', 'administrator/user_list_role/']) ? 'active' : '' ?>">
                            <a href="<?= base_url('administrator/user_list') ?>">
                                <i class="las la-minus"></i><span>User List</span>
                            </a>
                        </li> -->
                        <li class="<?= strpos(uri_string(), 'administrator/user_list') === 0 ? 'active' : '' ?>">
                            <a href="<?= base_url('administrator/user_list') ?>">
                                <i class="las la-minus"></i><span>User List</span>
                            </a>
                        </li>
                        <li class="<?= uri_string() === 'administrator/add_new_user' ? 'active' : '' ?>">
                            <a href="<?= base_url('administrator/add_new_user') ?>">
                                <i class="las la-minus"></i><span>User Add</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="pt-5 pb-2"></div>
    </div>
</div>