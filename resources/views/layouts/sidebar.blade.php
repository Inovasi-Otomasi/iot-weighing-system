<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main">
    <div class="sidenav-header">
        <div class="p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none" aria-hidden="true"
            id="iconSidenav">x</div>
        <div class="navbar-brand d-flex align-items-center m-0">
            <span class="font-weight-bold text-lg text-center">Weighing System</span>
        </div>
    </div>
    <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">
                        <div
                            class="{{ Request::is('/') ? 'text-primary' : '' }} icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <span class="nav-link-text ms-1">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('setup') ? 'active' : '' }}" href="/setup">
                        <div
                            class="{{ Request::is('setup') ? 'text-primary' : '' }} icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-cog"></i>
                        </div>
                        <span class="nav-link-text ms-1">Setup</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('admin_view') ? 'active' : '' }}" href="/admin_view">
                        <div
                            class="{{ Request::is('admin_view') ? 'text-primary' : '' }} icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <span class="nav-link-text ms-1">Admin View</span>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('hmi') ? 'active' : '' }}" href="/hmi?hmi=1">
                        <div
                            class="{{ Request::is('hmi') ? 'text-primary' : '' }} icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <span class="nav-link-text ms-1">HMI</span>
                    </a>
                </li>
            @endif

            {{-- <li class="nav-item">
                <a class="nav-link  {{ Request::is('sku') ? 'active' : '' }}" href="/sku">
                    <div
                        class="{{ Request::is('sku') ? 'text-primary' : '' }} icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-box"></i>
                    </div>
                    <span class="nav-link-text ms-1">SKU</span>
                </a>
            </li> --}}

            {{-- @if (auth()->user()->role == 'operator')
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('hmi') && request('hmi') == 1 ? 'active' : '' }}"
                        href="/hmi?hmi=1">
                        <div
                            class="{{ Request::is('hmi') && request('hmi') == 1 ? 'text-primary' : '' }} icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <span class="nav-link-text ms-1">HMI 1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('hmi') && request('hmi') == 2 ? 'active' : '' }}"
                        href="/hmi?hmi=2">
                        <div
                            class="{{ Request::is('hmi') && request('hmi') == 2 ? 'text-primary' : '' }} icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <span class="nav-link-text ms-1">HMI 2</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('hmi') && request('hmi') == 3 ? 'active' : '' }}"
                        href="/hmi?hmi=3">
                        <div
                            class="{{ Request::is('hmi') && request('hmi') == 3 ? 'text-primary' : '' }} icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <span class="nav-link-text ms-1">HMI 3</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('hmi') && request('hmi') == 4 ? 'active' : '' }}"
                        href="/hmi?hmi=4">
                        <div
                            class="{{ Request::is('hmi') && request('hmi') == 4 ? 'text-primary' : '' }} icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <span class="nav-link-text ms-1">HMI 4</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{ Request::is('hmi') && request('hmi') == 5 ? 'active' : '' }}"
                        href="/hmi?hmi=5">
                        <div
                            class="{{ Request::is('hmi') && request('hmi') == 5 ? 'text-primary' : '' }} icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <span class="nav-link-text ms-1">HMI 5</span>
                    </a>
                </li>
            @endif --}}
            {{-- <li class="nav-item">
                <a class="nav-link  {{ Request::is('devices*') ? 'active' : '' }}" href="/devices">
                    <div
                        class="{{ Request::is('devices*') ? 'text-primary' : '' }} icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-hard-drive"></i>
                    </div>
                    <span class="nav-link-text ms-1">Devices</span>
                </a>
            </li> --}}
        </ul>
    </div>
</aside>
