<nav class="navbar navbar-vertical navbar-expand-lg">
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                <!-- Course Section -->
                <li class="nav-item">
                    <hr class="navbar-vertical-line">
                    <div class="nav-item-wrapper">
                        <a class="nav-link dropdown-indicator label-1 {{ request()->routeIs('courses.*') ? '' : 'collapsed' }}"
                            href="#nv-course" role="button" data-bs-toggle="collapse"
                            aria-expanded="{{ request()->routeIs('courses.*') ? 'true' : 'false' }}"
                            aria-controls="nv-course">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon-wrapper">
                                    <span class="fas fa-caret-right dropdown-indicator-icon"></span>
                                </div>
                                <span class="nav-link-icon"><span data-feather="book-open"></span></span>
                                <span class="nav-link-text">Course</span>
                            </div>
                        </a>

                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse {{ request()->routeIs('courses.*') ? 'show' : '' }}"
                                data-bs-parent="#navbarVerticalCollapse" id="nv-course">
                                <li class="collapsed-nav-item-title d-none">Course Actions</li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('courses.create') ? 'active' : '' }}"
                                        href="{{ route('courses.create') }}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-icon"><span data-feather="plus-circle"></span></span>
                                            <span class="nav-link-text">Create Course</span>
                                        </div>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('courses.index') ? 'active' : '' }}"
                                        href="{{ route('courses.index') }}">
                                        <div class="d-flex align-items-center">
                                            <span class="nav-link-icon"><span data-feather="list"></span></span>
                                            <span class="nav-link-text">All Courses</span>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="navbar-vertical-footer">
        <button
            class="btn navbar-vertical-toggle border-0 fw-semibold w-100 white-space-nowrap d-flex align-items-center">
            <span class="uil uil-left-arrow-to-left fs-8"></span>
            <span class="uil uil-arrow-from-right fs-8"></span>
            <span class="navbar-vertical-footer-text ms-2">Collapsed View</span>
        </button>
    </div>
</nav>
