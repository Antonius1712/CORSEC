<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ Route('home') }}">
                    <i class="feather icon-file-text"></i>
                    <h2 class="brand-text mb-0">Web Corsec</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @if( Auth()->user()->isAdmin() )
            <li class=" nav-item">
                <a href="{{ Route('admin.home') }}">
                    <i class="feather icon-file"></i>
                    <span class="menu-title" data-i18n="Admin Page">Admin Page</span>
                </a>
            </li>
            @endif
            <li class=" nav-item">
                <a href="index.html">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Sipedas">Sipedas</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Request()->segment(3) == 'document' ? 'active' : '' }}">
                        <a href="{{ Route('sipedas.document.index') }}">
                            <i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="Document">Document</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- <li class=" nav-item">
                <a href="{{ Route('admin.sipedas.master-document.index') }}">
                    <i class="feather icon-file-plus"></i>
                    <span class="menu-title">
                        Sipedas
                    </span>
                </a>
            </li> --}}
        </ul>
    </div>
</div>