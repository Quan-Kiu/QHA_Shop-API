<nav class="sidebar">
  <div class="sidebar-header">
    <a href="" class="sidebar-brand">
      QHA<span>Shop </span><img src="https://res.cloudinary.com/dprqzgmak/image/upload/c_scale,w_20/v1644594761/logo_zv67se.png">
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Products</li>
      <li class="nav-item {{ active_class(['admin/products']) }}">
        <a href="{{ url('admin/products') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Products</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/producttypes']) }}">
        <a href="{{ url('admin/producttypes') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Products Type</span>
        </a>
      </li>
      <li class="nav-item nav-category">User</li>
      <li class="nav-item {{ active_class(['admin/users']) }}">
        <a href="{{ url('admin/users') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">User</span>
        </a>
      </li>

      <li class="nav-item nav-category">Order</li>
      <li class="nav-item {{ active_class(['admin/orders']) }}">
        <a href="{{ url('admin/orders') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Order</span>
        </a>


      </li>
      <li class="nav-item {{ active_class(['admin/orders_status']) }}">
        <a href="{{ url('admin/orders_status') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Order Status</span>
        </a>
      </li>

      

      <li class="nav-item nav-category">Discounts</li>
      <li class="nav-item {{ active_class(['admin/discounts']) }}">
        <a href="{{ url('admin/discounts') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Discount</span>
        </a>
      </li>

      <li class="nav-item nav-category">Color</li>
      <li class="nav-item {{ active_class(['admin/colors']) }}">
        <a href="{{ url('admin/colors') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Color</span>
        </a>

      </li>
      <li class="nav-item {{ active_class(['admin/sizes']) }}">
        <a href="{{ url('admin/sizes') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Size</span>
        </a>

      </li>
      <li class="nav-item nav-category">Comment</li>
      <li class="nav-item {{ active_class(['admin/comments']) }}">
        <a href="{{ url('admin/comments') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Comment</span>
        </a>

      </li>

      
    </ul>
  </div>
</nav>
<nav class="settings-sidebar">
  <div class="sidebar-body">
    <a href="#" class="settings-sidebar-toggler">
      <i data-feather="settings"></i>
    </a>
    <h6 class="text-muted">Sidebar:</h6>
    <div class="form-group border-bottom">
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
          Light
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
          Dark
        </label>
      </div>
    </div>

  </div>
</nav>