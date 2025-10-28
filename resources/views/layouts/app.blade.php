<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">

<head>
    @include('layouts.includes.head')
    @include('layouts.includes.rtl-handler')
    @stack('styles')

</head>


<body>
    <main class="main" id="top">
        {{-- Sidebar --}}
        @include('layouts.includes.sidebar')

        {{-- Topbar --}}
        @include('layouts.includes.topbar')

        <div class="content">
            {{-- Main Content --}}
            @yield('content')

            {{-- Footer --}}
            @include('layouts.includes.footer')
        </div>
    </main>

    @include('layouts.includes.scripts')
    @stack('scripts')

</body>

</html>
