<div class="site-menubar">
    <ul class="site-menu">
        <li class="site-menu-item {{ Request::is('admin') ? 'active' : '' }}">
            <a class="animsition-link" href="{{ route('admin.home') }}">
                <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
            </a>
        </li>

        <li class="site-menu-item has-sub {{ Request::is('admin/yearly', 'admin/monthly', 'admin/daily') ? 'active' : '' }}">
            <a href="javascript:void(0)">
                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                <span class="site-menu-title">Achievement</span>
                <span class="site-menu-arrow"></span>
            </a>
            <ul class="site-menu-sub">
                <li class="site-menu-item {{ Request::is('admin/yearly') ? 'active' : '' }}">
                    <a class="animsition-link" href="{{ route('yearly.index') }}">
                        <span class="site-menu-title">Yearly</span>
                    </a>
                </li>

                <li class="site-menu-item {{ Request::is('admin/monthly') ? 'active' : '' }}">
                    <a class="animsition-link" href="{{ route('monthly.index') }}">
                        <span class="site-menu-title">Monthly</span>
                    </a>
                </li>

                <li class="site-menu-item {{ Request::is('admin/daily') ? 'active' : '' }}">
                    <a class="animsition-link" href="{{ route('daily.index') }}">
                        <span class="site-menu-title">Daily</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="site-menu-item has-sub {{ Request::is('admin/inbound/yearly-inbound', 'admin/inbound/monthly-inbound', 'admin/inbound/daily-inbound') ? 'active' : '' }}">
            <a href="javascript:void(0)">
                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                <span class="site-menu-title">Inbound</span>
                <span class="site-menu-arrow"></span>
            </a>
            <ul class="site-menu-sub">
                <li class="site-menu-item {{ Request::is('admin/inbound/daily-inbound') ? 'active' : '' }}">
                    <a class="animsition-link" href="{{ route('daily-inbound.index') }}">
                        <span class="site-menu-title">Daily</span>
                    </a>
                </li>

                <li class="site-menu-item {{ Request::is('admin/inbound/monthly-inbound') ? 'active' : '' }}">
                    <a class="animsition-link" href="{{ route('monthly-inbound.index') }}">
                        <span class="site-menu-title">Monthly</span>
                    </a>
                </li>

                <li class="site-menu-item {{ Request::is('admin/inbound/yearly-inbound') ? 'active' : '' }}">
                    <a class="animsition-link" href="{{ route('yearly-inbound.index') }}">
                        <span class="site-menu-title">Yearly</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>

<div class="site-gridmenu">
    <div>
        <div>
            <ul>
                <li>
                    <a href="apps/mailbox/mailbox.html">
                        <i class="icon md-email"></i>
                        <span>Mailbox</span>
                    </a>
                </li>
                <li>
                    <a href="apps/calendar/calendar.html">
                        <i class="icon md-calendar"></i>
                        <span>Calendar</span>
                    </a>
                </li>
                <li>
                    <a href="apps/contacts/contacts.html">
                        <i class="icon md-account"></i>
                        <span>Contacts</span>
                    </a>
                </li>
                <li>
                    <a href="apps/media/overview.html">
                        <i class="icon md-videocam"></i>
                        <span>Media</span>
                    </a>
                </li>
                <li>
                    <a href="apps/documents/categories.html">
                        <i class="icon md-receipt"></i>
                        <span>Documents</span>
                    </a>
                </li>
                <li>
                    <a href="apps/projects/projects.html">
                        <i class="icon md-image"></i>
                        <span>Project</span>
                    </a>
                </li>
                <li>
                    <a href="apps/forum/forum.html">
                        <i class="icon md-comments"></i>
                        <span>Forum</span>
                    </a>
                </li>
                <li>
                    <a href="index.html">
                        <i class="icon md-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>