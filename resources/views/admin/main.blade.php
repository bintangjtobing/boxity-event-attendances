@include('admin.common.header')

<body class="layout-light side-menu overlayScroll" onload="realtimeClock()">
    <div class="mobile-search">
        <form class="search-form">
            <span data-feather="search"></span>
            <input class="form-control mr-sm-2 box-shadow-none" type="text" placeholder="Search...">
        </form>
    </div>

    <div class="mobile-author-actions"></div>
    <header class="header-top">
        @include('admin.common.topbar')
    </header>
    <main class="main-content">

        @include('admin.common.sidebar')

        <div class="contents">

            {!! $content !!}

        </div>
        @include('admin.common.footer')
    </main>
    <div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
    </div>
    <div class="overlay-dark-sidebar"></div>

    @include('admin.common.script')
</body>

</html>
