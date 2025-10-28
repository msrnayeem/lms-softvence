<script src="{{ asset('popper/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('anchorjs/anchor.min.js') }}"></script>
<script src="{{ asset('is/is.min.js') }}"></script>
<script src="{{ asset('fontawesome/all.min.js') }}"></script>
<script src="{{ asset('lodash/lodash.min.js') }}"></script>
<script src="{{ asset('list.js/list.min.js') }}"></script>
<script src="{{ asset('feather.min.js') }}"></script>
<script src="{{ asset('dayjs/dayjs.min.js') }}"></script>
<script src="{{ asset('prism/prism.js') }}"></script>
<script src="{{ asset('phoenix.js') }}"></script>

<script>
    var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
    var navbarTop = document.querySelector('.navbar-top');
    if (navbarTopStyle === 'darker') {
        navbarTop?.setAttribute('data-navbar-appearance', 'darker');
    }

    var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
    var navbarVertical = document.querySelector('.navbar-vertical');
    if (navbarVertical && navbarVerticalStyle === 'darker') {
        navbarVertical.setAttribute('data-navbar-appearance', 'darker');
    }
</script>
