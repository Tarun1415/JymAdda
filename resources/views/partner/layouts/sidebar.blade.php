<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="/" class="b-brand text-primary">
        <!-- ========   Change your logo from here   ============ -->
        <img src="/images/logo2.png" class="img-fluid" alt="logo">
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item {{ request()->is('partner/dashboard') ? 'active' : '' }}">
          <a href="/partner/dashboard" class="pc-link">
            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>

        <li class="pc-item pc-caption">
          <label>GYM List Part</label>
          <i class="ti ti-dashboard"></i>
        </li>
        <li class="pc-item {{ request()->is('partner/gymlist-dashboard', 'partner/gyms-*') ? 'active' : '' }}">
          <a href="/partner/gymlist-dashboard" class="pc-link">
            <span class="pc-micon"><i class="ti ti-typography"></i></span>
            <span class="pc-mtext">GYM List Dashboard</span>
          </a>
        </li>
        <li class="pc-item {{ request()->routeIs('Partnerjym.gallery.*') ? 'active' : '' }}">
          <a href="{{ route('Partnerjym.gallery.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-color-swatch"></i></span>
            <span class="pc-mtext">GYM Galary List</span>
          </a>
        </li>
        {{-- <li class="pc-item">
          <a href="../elements/icon-tabler.html" class="pc-link">
            <span class="pc-micon"><i class="ti ti-plant-2"></i></span>
            <span class="pc-mtext">Icons</span>
          </a>
        </li> --}}

        <li class="pc-item pc-caption">
          <label>User Management </label>
          <i class="ti ti-news"></i>
        </li>
        {{-- <li class="pc-item">
          <a href="../pages/login.html" class="pc-link">
            <span class="pc-micon"><i class="ti ti-lock"></i></span>
            <span class="pc-mtext">Login</span>
          </a>
        </li> --}}
        <li class="pc-item {{ request()->routeIs('Partnerjym.members.*') ? 'active' : '' }}">
          <a href="{{ route('Partnerjym.members.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-users"></i></span>
            <span class="pc-mtext">GYM User List</span>
          </a>
        </li>

        <li class="pc-item pc-caption">
          <label>Subscription & Billing</label>
          <i class="ti ti-credit-card"></i>
        </li>
        <li class="pc-item {{ request()->routeIs('partner.pricing') ? 'active' : '' }}">
          <a href="{{ route('partner.pricing') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-credit-card"></i></span>
            <span class="pc-mtext">Subscription Plan</span>
          </a>
        </li>

        <li class="pc-item pc-caption">
          <label>User Contact List</label>
          <i class="ti ti-brand-chrome"></i>
        </li>
        {{-- <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link"><span class="pc-micon"><i class="ti ti-menu"></i></span><span class="pc-mtext">Menu
              levels</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="pc-submenu">
            <li class="pc-item"><a class="pc-link" href="#!">Level 2.1</a></li>
            <li class="pc-item pc-hasmenu">
              <a href="#!" class="pc-link">Level 2.2<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
              <ul class="pc-submenu">
                <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                <li class="pc-item pc-hasmenu">
                  <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                  <ul class="pc-submenu">
                    <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                    <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="pc-item pc-hasmenu">
              <a href="#!" class="pc-link">Level 2.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
              <ul class="pc-submenu">
                <li class="pc-item"><a class="pc-link" href="#!">Level 3.1</a></li>
                <li class="pc-item"><a class="pc-link" href="#!">Level 3.2</a></li>
                <li class="pc-item pc-hasmenu">
                  <a href="#!" class="pc-link">Level 3.3<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                  <ul class="pc-submenu">
                    <li class="pc-item"><a class="pc-link" href="#!">Level 4.1</a></li>
                    <li class="pc-item"><a class="pc-link" href="#!">Level 4.2</a></li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
        </li> --}}
        <li class="pc-item {{ request()->routeIs('Partnerjym.enquiries.index') ? 'active' : '' }}">
          <a href="{{ route('Partnerjym.enquiries.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-messages"></i></span>
            <span class="pc-mtext">User Contact Us</span>
          </a>
        </li>
      </ul>
      {{-- <div class="card text-center">
        <div class="card-body">
          <img src="../assets/images/img-navbar-card.png" alt="images" class="img-fluid mb-2">
          <h5>Upgrade To Pro</h5>
          <p>To get more features and components</p>
          <a href="https://codedthemes.com/item/berry-bootstrap-5-admin-template/" target="_blank"
          class="btn btn-success">Buy Now</a>
        </div>
      </div> --}}
    </div>
  </div>
</nav>