<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">CATEGORY</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column ">
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category/create') }}">ADD CATEGORY</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category') }}">VIEW CATEGORY</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basice" aria-expanded="false" aria-controls="ui-basice">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">PRODUCTS</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basice">
            <ul class="nav flex-column ">
              <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products/create') }}">ADD PRODUCTS</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products') }}">VIEW PRODUCTS</a></li>
            </ul>
          </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/brands') }}">
          <i class="mdi mdi-chart-pie menu-icon"></i>
          <span class="menu-title">BRANDS</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/colors') }}">
          <i class="mdi mdi-chart-pie menu-icon"></i>
          <span class="menu-title">COLORS</span>
        </a>
      </li>
      </li>
    </ul>
  </nav>
