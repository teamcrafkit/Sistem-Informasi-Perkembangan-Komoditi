<div>
    <!-- Brand Logo -->
    <a href="./" class="brand-link  navbar-primary text-white">
      <img src="/images/logo.png" alt="Logo"  class="brand-image">
      <span class="brand-text font-weight-light">SI PKTP</span>
    </a>
   <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ $users->getAvatar() }}" alt="user-img" class="img-circle elevation-2">
        </div>
        <div class="info">
          <a href="./" class="d-block">{{ $users->nama }}</a>
        </div>
      </div>
     <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          @hasanyrole($roles)
          <li class="nav-item has-treeview"> 
            <a href="{{ route('dashboard') }}" class="nav-link {{request()->segment(2) == 'dashboard' ? 'active' : ''}}">
              <i class="remixicon-home-4-line nav-icon"></i>
              <p>Dashboard</p>
            </a> 
          </li>
          
          @endhasanyrole
          @if (count($navigations) > 0)
            @foreach ($navigations as $navigation)
                @can($navigation->permission_name)
                    <li class="nav-item{{ $navigation->menuOpen() }}">
                        <a href="{{ $navigation->url != NULL ? url($navigation->url) : 'javascript: void(0);' }}" class="nav-link{{ $navigation->children->count() > 0 ? $navigation->urlActiveParentChild() : $navigation->urlActive($navigation->url) }}">
                            <i class="{{ $navigation->icon }} nav-icon"></i>
                            <p> {{ $navigation->name }}</p>
                            @if ($navigation->children->count() > 0)
                              <i class="remixicon-arrow-left-s-line right"></i>
                            @endif
                        </a>
                        @if (count($navigation->children) > 0)
                          <ul class="nav nav-treeview ">
                            @foreach ($navigation->children as $child)
                                @can($child->permission_name) 
                                  <li class="nav-item">
                                      <a href="{{ url($child->url) }}" class="nav-link{{  $navigation->urlActive($child->url) }}">
                                      <i class="{{ $child->icon }} nav-icon"></i>
                                        <p>{{ $child->name }}</p>
                                      </a>
                                  </li>
                                @endcan
                            @endforeach
                          </ul>
                        @endif
                    </li>
                @endcan
            @endforeach
          @endif
        </ul>
      </nav>
       <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</div>