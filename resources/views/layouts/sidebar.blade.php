<?php
// set collapsed class
function isCollapsed($controllerName)
{
    $c_con_array = explode('.', Route::currentRouteName());
    $current_controller = $c_con_array[0];
    if ($current_controller != $controllerName) {
        echo 'collapsed';
    }
}
// set active class in li tag
function isActiveLI($controllerName)
{
    $c_con_array = explode('.', Route::currentRouteName());
    $current_controller = $c_con_array[0];
    if ($current_controller == $controllerName) {
        echo 'active';
    }
}
// set show class in a tag
function isShow($controllerName)
{
    $c_con_array = explode('.', Route::currentRouteName());
    $current_controller = $c_con_array[0];
    if ($current_controller == $controllerName) {
        echo 'show';
    }
}
// set active class
function isActive($routeName)
{
    if (Route::currentRouteName() == $routeName) {
        echo 'active';
    }
}
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      {{-- <i class="fas fa-laugh-wink"></i> --}}
    </div>
    <div class="sidebar-brand-text mx-3">Inventory Management</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ isActiveLI('dashboard') }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>


  {{-- Nav item -users --}}
  @can(['user-edit', 'user-list', 'user-create', 'user-delete'])
    <li class="nav-item {{ isActiveLI('users') }}">
      <a class="nav-link {{ isCollapsed('users') }}" href="#" data-toggle="collapse" data-target="#userMenu"
        aria-expanded="true" aria-controls="userMenu">
        <i class="fas fa-user"></i>
        <span>Users</span>
      </a>
      <div id="userMenu" class="collapse {{ isShow('users') }}" aria-labelledby="headingTwo"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">User Components:</h6>
          @can(['user-edit', 'user-list', 'user-delete'])
            <a class="collapse-item {{ isActive('users.index') }}" href="{{ route('users.index') }}"><i
                class="fas fa-list mr-2 text-primary"></i>Users List</a>
          @endcan
          @can('user-create')
            <a class="collapse-item {{ isActive('users.create') }}" href="{{ route('users.create') }}"><i
                class="fas fa-plus-square mr-2 text-success"></i>Add User</a>
          @endcan
        </div>
      </div>
    </li>
  @endcan


  {{-- Nav item -permission management --}}
  @can(['permission-edit', 'permission-list', 'permission-create', 'permission-delete'])
    <li class="nav-item {{ isActiveLI('permissions') }}">
      <a class="nav-link {{ isCollapsed('permissions') }}" href="{{ route('permissions.index') }}">
        <i class="fas fa-user-shield"></i>
        <span>Permission Management</span>
      </a>
    </li>
  @endcan


  {{-- Nav item -role managements --}}
  @can(['role-edit', 'role-list', 'role-create', 'role-delete'])
    <li class="nav-item {{ isActiveLI('roles') }}">
      <a class="nav-link {{ isCollapsed('roles') }}" href="{{ route('roles.index') }}">
        <i class="fas fa-user-shield"></i>
        <span>Role Management</span>
      </a>
    </li>
  @endcan

  {{-- Nav item - Raw Materials --}}
  <li class="nav-item {{ isActiveLI('raw-materials') }}">
    <a class="nav-link {{ isCollapsed('raw-materials') }}" href="#" data-toggle="collapse"
      data-target="#rawMaterialsMenu" aria-expanded="true" aria-controls="rawMaterialsMenu">
      <i class="fas fa-tools"></i>
      <span>Raw Materials</span>
    </a>
    <div id="rawMaterialsMenu" class="collapse {{ isShow('raw-materials') }}" aria-labelledby="headingTwo"
      data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Raw Material Components:</h6>
        <a class="collapse-item {{ isActive('raw-materials.index') }}" href="{{ route('raw-materials.index') }}"><i
            class="fas fa-warehouse mr-2 text-primary"></i>Inventory</a>
        <a class="collapse-item {{ isActive('raw-materials.create') }}" href="{{ route('raw-materials.create') }}"><i
            class="fas fa-plus mr-2 text-primary"></i>Request Raw Material</a>
        <a class="collapse-item {{ isActive('raw-materials.queue-list') }}"
          href="{{ route('raw-materials.queue-list') }}"><i class="fas fa-list mr-2 text-success"></i>Queue List</a>
      </div>
    </div>
  </li>

  {{-- Nav item - Finish Modules --}}
  <li class="nav-item {{ isActiveLI('finish-modules') }}">
    <a class="nav-link {{ isCollapsed('finish-modules') }}" href="#" data-toggle="collapse"
      data-target="#finishModulesMenu" aria-expanded="true" aria-controls="finishModulesMenu">
      <i class="fas fa-check"></i>
      <span>Finish Modules</span>
    </a>
    <div id="finishModulesMenu" class="collapse {{ isShow('finish-modules') }}" aria-labelledby="headingTwo"
      data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Finish Module Components:</h6>
        <a class="collapse-item {{ isActive('finish-modules.index') }}" href="{{ route('finish-modules.index') }}"><i
            class="fas fa-warehouse mr-2 text-primary"></i>Inventory</a>
        <a class="collapse-item {{ isActive('finish-modules.index') }}" href="{{ route('finish-modules.index') }}"><i
            class="fas fa-plus mr-2 text-primary"></i>Create Finish Request</a>
        <a class="collapse-item {{ isActive('finish-modules.create') }}"
          href="{{ route('finish-modules.create') }}"><i class="fas fa-list mr-2 text-success"></i>Queue List</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
