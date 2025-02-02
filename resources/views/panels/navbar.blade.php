<nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme bg-primary"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <h4 class="mt-3" style="color: white;">MARKETING REPORT </h4>
            </div>
        </div>
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="#" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}?background=0D8ABC&color=fff"
                            alt class="h-auto rounded-circle" />
                    </div>
                </a>
                <div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}?background=0D8ABC&color=fff"
                                                alt class="h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-medium d-block">{{ Auth::user()->name }}</span>
                                        <small class="text-muted">{{ Auth::user()->email }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="$('#logout-form').submit();" class="dropdown-item">
                                <i class="ti ti-logout me-2 ti-sm"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
            </li>
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
            </form>
            <!--/ User -->
        </ul>
    </div>
</nav>
