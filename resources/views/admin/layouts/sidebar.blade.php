<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="/" class="b-brand text-primary">
        <img src="/images/logo2.png" class="img-fluid" alt="logo">
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <a href="{{ route('admin.dashboard') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
            <span class="pc-mtext">Admin Dashboard</span>
          </a>
        </li>

        <li class="pc-item pc-caption">
          <label>Platform Management</label>
        </li>
        <li class="pc-item {{ request()->routeIs('admin.gyms.*') ? 'active' : '' }}">
          <a href="{{ route('admin.gyms.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-building"></i></span>
            <span class="pc-mtext">All Platform Gyms</span>
          </a>
        </li>
        <li class="pc-item {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
          <a href="{{ route('admin.partners.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-businessplan"></i></span>
            <span class="pc-mtext">Registered Partners</span>
          </a>
        </li>

        @if(auth()->check() && auth()->user()->role === 'admin')
        <li class="pc-item pc-caption">
          <label>Super Admin Controls</label>
          <i class="ti ti-lock"></i>
        </li>
        <li class="pc-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
          <a href="{{ route('admin.users.index') }}" class="pc-link">
            <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
            <span class="pc-mtext">User Management</span>
          </a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>