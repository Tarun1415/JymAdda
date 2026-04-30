<nav class="site-nav">
    <div class="container">
        <div class="menu-bg-wrap">
            <div class="site-navigation">

                <!-- Logo with modern design -->
                <div class="logo-container">
                    <a href="/" class="logo">
                        <img src="images/logo2.png" alt="GymHai" class="logo-image">
                        <div class="logo-text">
                            <span class="logo-main">GymHai</span>
                            <span class="logo-sub">Fitness Hub Network</span>
                        </div>
                    </a>

                    <!-- Mobile menu toggle -->
                    <button class="menu-toggle" aria-label="Toggle menu">
                        <span class="toggle-line"></span>
                        <span class="toggle-line"></span>
                        <span class="toggle-line"></span>
                    </button>
                </div>

                <!-- Main Navigation Menu -->
                <div class="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                            <a href="{{ url('/') }}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('gyms.index') ? 'active' : '' }}">
                            <a href="{{ route('gyms.index') }}" class="nav-link">Explore Gyms</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('services') ? 'active' : '' }}">
                            <a href="{{ route('services') }}" class="nav-link">Our Services</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                            <a href="{{ route('about') }}" class="nav-link">About Us</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                            <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                        </li>
                    </ul>

                    <!-- Enhanced CTA Button -->
                    <div class="partner-cta-container">
                        <a href="/partner/register" class="partner-cta-btn">
                            <div class="cta-content">
                                <span class="cta-text">List Your Gym</span>
                            </div>
                            <div class="cta-badge">
                                <span class="badge-text">FREE</span>
                                <span class="badge-icon">🎉</span>
                            </div>
                            <div class="cta-hover-effect"></div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</nav>



<script>
    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const navMenuContainer = document.querySelector('.nav-menu-container');
        const dropdownParents = document.querySelectorAll('.has-children');

        // Toggle mobile menu
        menuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenuContainer.classList.toggle('active');
        });

        // Toggle dropdowns on mobile
        dropdownParents.forEach(parent => {
            const link = parent.querySelector('.nav-link');

            link.addEventListener('click', function(e) {
                if (window.innerWidth <= 991) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Close other open dropdowns
                    dropdownParents.forEach(otherParent => {
                        if (otherParent !== parent && otherParent.classList.contains(
                                'active')) {
                            otherParent.classList.remove('active');
                        }
                    });

                    // Toggle current dropdown
                    parent.classList.toggle('active');
                }
            });
        });

        // Close menu when clicking outside on mobile
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 991 &&
                !e.target.closest('.nav-menu-container') &&
                !e.target.closest('.menu-toggle')) {
                menuToggle.classList.remove('active');
                navMenuContainer.classList.remove('active');
                dropdownParents.forEach(parent => parent.classList.remove('active'));
            }
        });

        // Close menu on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 991) {
                menuToggle.classList.remove('active');
                navMenuContainer.classList.remove('active');
                dropdownParents.forEach(parent => parent.classList.remove('active'));
            }
        });
    });
</script>
