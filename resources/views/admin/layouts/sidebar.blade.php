<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
  <img src="{{ asset('public/images/logo.svg') }}">
</div>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('admin.dashboard') }}" class="nav-link">{{ __('admin.Home') }}</a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <!-- <img src="{{ asset('public/images/logo.svg') }}" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <span class="brand-text font-weight-light">{{ config('app.name', 'Freight Forwarder') }}</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('public/images/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('admin.account') }}" class="d-block">{{ __('admin.Admin') }}</a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              {{ __('admin.Dashboard') }}
            </p>
          </a>
        </li>
        <li class="nav-header">{{ __('admin.Account_Management') }}</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              {{ __('admin.Account') }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.account') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('admin.Account') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.accountpassword') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('admin.Change_Password') }}</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">{{ __('admin.User_Management') }}</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              {{ __('admin.Users') }}
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add User</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="{{ route('admin.userlist', 'seller') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('admin.Sellers') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.userlist', 'buyer') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('admin.Buyers') }}</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">{{ __('admin.Content_Management') }}</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              {{ __('admin.Content_Management') }}
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.cms') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('admin.CMS_Management') }}</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">{{ __('admin.Blog_Management') }}</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              {{ __('admin.Blog_Management') }}
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.cms') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('admin.Blog_List') }}</p>
              </a>
            </li>
          </ul>
        </li>
        
        <li class="nav-header">{{ __('admin.Site_Management') }}</li>
        <li class="nav-item has-treeview">
          <a href="javascript:void(0)" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              {{ __('admin.Site_Management') }}
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.manageoffers') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('admin.Manage_Offers') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.manageevents') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('admin.Manage_Events') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.chatmonitoring') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('admin.Chat_Monitoring') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.transactions') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('admin.Transactions') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.managesubscribers') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('admin.Manage_Subscribers') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="javascript:;" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>{{ __('admin.Site_Settings') }}</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item mb-100">
          <a href="{{ route('admin.logout') }}" class="nav-link">
            <i class="nav-icon far fa-circle text-warning"></i>
            <p>{{ __('admin.Logout') }}</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
