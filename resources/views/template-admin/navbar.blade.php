<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('env') }}/udinus.png" width="30px" srcset="">

            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">SATGAS UDINUS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('kegiatans') ? 'active' : '' }}">
            <a href="/kegiatans" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Kegiatan</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('dokumens') ? 'active' : '' }}">
            <a href="/dokumens" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dokumen</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('galeris') ? 'active' : '' }}">
            <a href="/galeris" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Galeri</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('lapor') ? 'active' : '' }}">
            <a href="/lapor" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Lapor</div>
            </a>
        </li>
    </ul>
    
</aside>
