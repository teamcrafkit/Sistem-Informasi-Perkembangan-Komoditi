<div>
    <nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fe-menu"></i></a>
            </li> 
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    {{-- Logged In As : {{ $role }}               --}}
                    Logged In As : <strong>{{ auth()->user()->roles()->pluck('name')->implode(', ') }} </strong>         
                </a>
            </li>
            <!-- Logout Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link " href="{{ route('admin.logout') }}">
                    <i class="fe-log-out"></i>
                </a> 
            </li> 
        </ul>
    </nav>
</div>