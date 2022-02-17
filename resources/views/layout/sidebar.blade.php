
@if(Auth::user()->user_type_id != 2){
    <script>
      window.location = "/auth/login";
    </script>
  }
@endif

<nav class="sidebar">
  <div class="sidebar-header">
    <a href="/admin" class="sidebar-brand">
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
      <li class="nav-item nav-category">Thống kê</li>
      <li class="nav-item {{ active_class(['admin']) }}">
        <a href="{{ url('admin') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Thống kê doanh thu</span>
        </a>
      </li>
      <li class="nav-item nav-category">QL Sản phẩm</li>
      <li class="nav-item {{ active_class(['admin/products']) }}">
        <a href="{{ url('admin/products') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Danh sách sản phẩm</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/producttypes']) }}">
        <a href="{{ url('admin/producttypes') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Danh sách loại sản phẩm</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['admin/colors']) }}">
        <a href="{{ url('admin/colors') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Màu sắc sản phẩm</span>
        </a>

      </li>
      <li class="nav-item {{ active_class(['admin/sizes']) }}">
        <a href="{{ url('admin/sizes') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Kích cỡ sản phẩm</span>
        </a>

      </li>
      <li class="nav-item nav-category">QL Người dùng</li>
      <li class="nav-item {{ active_class(['admin/users']) }}">
        <a href="{{ url('admin/users') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Danh sách người dùng</span>
        </a>
      </li>

      <li class="nav-item nav-category">QL Hóa đơn</li>
      <li class="nav-item {{ active_class(['admin/orders']) }}">
        <a href="{{ url('admin/orders') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Danh sách hóa đơn</span>
        </a>


      </li>
      <li class="nav-item {{ active_class(['admin/orders_status']) }}">
        <a href="{{ url('admin/orders_status') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Danh sách trạng thái hóa đơn</span>
        </a>
      </li>

      

      <li class="nav-item nav-category">QL Mã giảm giá</li>
      <li class="nav-item {{ active_class(['admin/discounts']) }}">
        <a href="{{ url('admin/discounts') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Danh sách mã giảm giá</span>
        </a>
      </li>

     
      <li class="nav-item nav-category">QL Đánh giá</li>
      <li class="nav-item {{ active_class(['admin/comments']) }}">
        <a href="{{ url('admin/comments') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Danh sách đánh giá</span>
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