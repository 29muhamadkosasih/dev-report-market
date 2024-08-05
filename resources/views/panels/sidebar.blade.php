<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <img src="{{ asset('assets/img/favicon/lgo.png') }}" width="55" height="25" alt class="me-3 h-auto" />
        {{-- me-3 ms-3 h-auto text-right width="110" --}}
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        @can('home.index')
        <li class="menu-item {{ (request()->is('home')) ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        @endcan

        @can('report.index')
        <li class="menu-item {{ Route::currentRouteNamed('report.index') ? 'active' : '' }}">
            <a href="{{ route('report.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-report-analytics"></i>
                <div data-i18n="Report">Report</div>
            </a>
        </li>
        @endcan

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Komponen</span>
        </li>

        @can('layout.empty.index')
        <li class="menu-item {{ Route::currentRouteNamed('layout.empty') ? 'active' : '' }}">
            <a href="{{ route('layout.empty') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-mail"></i>
                <div data-i18n="Layout Empty">Layout Empty</div>
            </a>
        </li>
        @endcan

        @can('new-client-call.index')
        <li
            class="menu-item {{ Route::currentRouteNamed('new-client-call.index', 'new-client-call.create','new-client-call.edit') ? 'active' : '' }}">
            <a href="{{ route('new-client-call.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-phone"></i>
                <div data-i18n="Client Call">Client Call</div>
            </a>
        </li>
        @endcan

        @can('visit.index')
        <li
            class="menu-item {{ Route::currentRouteNamed('visit.index', 'visit.create','visit.edit') ? 'active' : '' }}">
            <a href="{{ route('visit.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-compass"></i>
                <div data-i18n="Client Visit">Client Visit</div>
            </a>
        </li>
        @endcan



        @can('quotation-letter.index')
        <li
            class="menu-item {{ Route::currentRouteNamed('quotation-letter.index', 'quotation-letter.create','quotation-letter.edit') ? 'active' : '' }}">
            <a href="{{ route('quotation-letter.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-send"></i>
                <div data-i18n="Qoutation Send">Qoutation Send</div>
            </a>
        </li>
        @endcan

        @can('blasting-email.index')
        <li
            class="menu-item {{ Route::currentRouteNamed('blasting-email.index', 'blasting-email.create','blasting-email.edit') ? 'active' : '' }}">
            <a href="{{ route('blasting-email.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-mail"></i>
                <div data-i18n="Blasting Email">Blasting Email</div>
            </a>
        </li>
        @endcan

        @can('blasting-whatsapp.index')
        <li
            class="menu-item {{ Route::currentRouteNamed('blasting-whatsapp.index', 'blasting-whatsapp.create','blasting-whatsapp.edit') ? 'active' : '' }}">
            <a href="{{ route('blasting-whatsapp.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-brand-whatsapp"></i>
                <div data-i18n="Blasting WhatsApp">Blasting WhatsApp</div>
            </a>
        </li>
        @endcan

        @can('orders.index')
        <li
            class="menu-item {{ Route::currentRouteNamed('orders.index', 'orders.create','orders.edit') ? 'active' : '' }}">
            <a href="{{ route('orders.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-list-check"></i>
                <div data-i18n="Orders">Orders</div>
            </a>
        </li>
        @endcan

        @canany(['coordination.index'])
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Request</span>
        </li>

        @can('coordination.index')
        <li
            class="menu-item {{ Route::currentRouteNamed('coordination.index','coordination.show','coordination.edit') ? 'active' : '' }}">
            <a href="{{ route('coordination.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-registered"></i>
                <div data-i18n="Coordination">Coordination</div>
            </a>
        </li>
        @endcan

        @endcanany

        @canany(['users.index','roles.index','permissions.index'])
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Users Management</span>
        </li>

        @can('users.index')
        <li class="menu-item {{ Route::currentRouteNamed('users.index','users.show','users.edit') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Users">Users</div>
            </a>
        </li>
        @endcan

        @can('roles.index')
        <li class="menu-item {{ Route::currentRouteNamed('roles.index','roles.show','roles.edit') ? 'active' : '' }}">
            <a href="{{ route('roles.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Roles">Roles</div>
            </a>
        </li>
        @endcan


        @can('permissions.index')
        <li
            class="menu-item {{ Route::currentRouteNamed('permissions.index','permissions.show','permissions.edit') ? 'active' : '' }}">
            <a href="{{ route('permissions.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-checkbox"></i>
                <div data-i18n="Permissions">Permissions</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Misc</span>
        </li>
        <li class="menu-item">
            <a href="https://pixinvent.ticksy.com/" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons ti ti-lifebuoy"></i>
                <div data-i18n="Support">Support</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/" target="_blank"
                class="menu-link">
                <i class="menu-icon tf-icons ti ti-file-description"></i>
                <div data-i18n="Documentation">Documentation</div>
            </a>
        </li>

        @endcan

        @endcanany
    </ul>
</aside>
