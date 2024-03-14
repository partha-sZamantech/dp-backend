  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/backend/dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">DP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{ Cache::get('bnSiteSettings')->site_name }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset(config('appconfig.commonImagePath').'user.png') }}" class="user-image" alt="Admin Image">
              <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset(config('appconfig.commonImagePath').'user.png') }}" class="img-circle" alt="User Image">

                <p>
                  {{ auth()->user()->name }} - {{ Str::title(auth()->user()->designation) }}
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                  <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                      Logout
                  </a>

                  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>