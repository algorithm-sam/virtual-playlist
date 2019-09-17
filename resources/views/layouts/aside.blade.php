

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('img/avatar5.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ ucwords(Auth::user()->name) }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">
          <div class="text-center">
            {{ucwords(auth()->user()->name)}}
          </div>
        </li>
        <!-- Optionally, you can add icons to the links -->
        
        @if(auth()->user()->type == 'admin')
        <li><a href="{{url('/admin/users')}}"><i class="fa fa-home"></i> <span>Home</span></a></li>
        {{-- <li class="{{$_SERVER['PATH_INFO'] == '/admin/users' ? 'active' : '' }}"><a href="{{route('all_users')}}"><i class="fa fa-users"></i> <span>Users Management</span></a></li> --}}
        <li><a href="{{route('add_base_data')}}"><i class="fa fa-pencil"></i> <span>Manually Add Data</span></a></li>
        <li><a href="/import-data"><i class="fa fa-download"></i> <span>Import Data</span></a></li>
        @endif
        <li><a href="/"><i class="fa fa-eye"></i> <span> View Saved Information</span></a></li>
        <li>
            <a href="#" 
            href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fa fa-power-off"></i> <span>Logout</span>
         </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>