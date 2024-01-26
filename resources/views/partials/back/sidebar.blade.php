    @php
    
      if(Auth::user()){
        if(!empty(Auth::user()->img)){
          $proimg = asset('assets/images/company/profiles/' .Auth::user()->img );
        }else{
          $proimg = URL::asset('assets/images/placeholder.jpg');
        }
      }else{
        $proimg = URL::asset('assets/images/placeholder.jpg');
      }
    
    @endphp

    
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{  $proimg }} " alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">{{ Auth::user()->name ?? 'User' }}</span>
                  <span class="text-secondary text-small">{{ auth()->check() ? implode(', ', auth()->user()->getRoleNames()->toArray()) : 'Guest' }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item {{ Request::is('/home') ? 'active' : '' }}">
              <a class="nav-link" href="/home">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item {{ Request::is('/users*') || Request::is('/roles*') || Request::is('/permissions*') ? 'active' : '' }}">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Manage Users</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-group menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link {{ Request::is('/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Users</a></li>
                  <li class="nav-item"> <a class="nav-link {{ Request::is('/roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">Roles</a></li>
                  @can('view-permissions')
                  <li class="nav-item"> <a class="nav-link {{ Request::is('/permissions*') ? 'active' : '' }}" href="{{ route('permissions.index') }}">Permissions</a></li>
                  @endcan
                </ul>
              </div>
            </li>
       

            <li class="nav-item {{ Request::is('/leads*') || Request::is('/leadresources*') || Request::is('/leadstatus*') ? 'active' : '' }}">
              <a class="nav-link" data-bs-toggle="collapse" href="#manageLeads" aria-expanded="false" aria-controls="manageLeads">
                <span class="menu-title">Manage Leads</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="manageLeads">
                <ul class="nav flex-column sub-menu">
                 
                  @can('view-lead-status')
                    <li class="nav-item"> <a class="nav-link {{ request()->is('leadstatus/*') ? 'active' : '' }}" href="{{ route('leadstatus.index') }}">Lead Status</a></li>
                  @endcan
                  @can('view-lead-resources')
                    <li class="nav-item"> <a class="nav-link {{ request()->is('/leadresources/*') ? 'active' : '' }}" href="{{ route('leadresources.index') }}">Lead Resources</a></li>
                  @endcan
                  @can('view-lead')
                    <li class="nav-item"> <a class="nav-link {{ request()->is('/leads/*') ? 'active' : '' }}" href="{{ route('leads.index') }}">Leads</a></li>
                  @endcan
                </ul>
              </div>
            </li>
         
            <li class="nav-item {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
              <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Forms</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
           
            
            
          </ul>
        </nav>