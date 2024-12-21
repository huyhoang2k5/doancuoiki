<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đặt Tour Đà Nẵng</title>

</head>
<style>
  /* Reset mặc định */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: Arial, sans-serif;
  }

  /* Header */
  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.3);
    /* Màu đen với 30% độ trong suốt */
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    height: 80px;
  }

  header.scrolled {
    background-color: #222222;
    /* Khi cuộn, đổi nền tối hơn */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Bóng đổ nhẹ */
  }

  header img {
    height: 80px;
    width: 150px;
    margin-left: 80px;
  }

  li a img {
    width: 60px;
    height: auto;
  }

  /* Menu chính */
  .nav-menu {
    flex-grow: 1;
    display: flex;

  }

  nav ul {
    margin-right: 250px;
    list-style: none;
    display: flex;
    justify-content: space-around;
    align-items: center;
    white-space: nowrap;
    /* Không cho xuống dòng */
  }

  nav ul li {
    margin: 0 10px;
  }

  nav ul li a {
    color: aliceblue;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    font-family: Arial, sans-serif;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 5px 50px;
    gap: 5px;
    /* Khoảng cách giữa icon và text */
    transition: color 0.3s ease;
    margin: 20px;

  }

  nav ul li a i {
    font-size: 20px;
  }

  /* Hiệu ứng hover */
  nav ul li a:hover {
    color: #007bff;
    /* Màu chữ khi hover */
  }

  nav ul li a::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: #007bff;
    /* Màu gạch chân */
    transition: width 0.3s ease;
  }

  nav ul li a:hover::after {
    width: 100%;
  }

  /* Menu trên di động */
  .nav-menu {
    display: none;
    /* Mặc định ẩn menu trên di động */
    flex-direction: column;
    position: absolute;
    top: 80px;
    /* Ngay dưới header */
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.9);
    /* Nền đen trong suốt */
    z-index: 1000;
    padding: 10px;
  }

  .nav-menu.active {
    display: flex;
    /* Hiển thị menu khi active */
  }

  .nav-menu ul {
    flex-direction: column;
    align-items: flex-start;
  }

  .nav-menu ul li {
    margin: 10px 0;
  }

  .nav-menu ul li a {
    font-size: 16px;
    /* Tăng kích thước chữ trên di động */
    padding: 10px;
  }

  /* Nút toggle menu */
  .menu-toggle {
    display: flex;
    /* Hiển thị nút toggle menu */
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin-right: 20px;
  }

  .menu-toggle span {
    height: 3px;
    width: 25px;
    background: white;
    margin: 4px 0;
    transition: all 0.3s ease;
  }

  /* Trạng thái toggle khi active */
  .menu-toggle.active span:nth-child(1) {
    transform: rotate(45deg);
    position: relative;
    top: 8px;
  }

  .menu-toggle.active span:nth-child(2) {
    opacity: 0;
  }

  .menu-toggle.active span:nth-child(3) {
    transform: rotate(-45deg);
    position: relative;
    bottom: 8px;
  }

  /* Menu trên màn hình lớn */
  @media (min-width: 768px) {
    .menu-toggle {
      display: none;
      /* Ẩn toggle trên màn hình lớn */
    }

    .nav-menu {
      display: flex;
      /* Hiển thị menu ngang trên desktop */
      flex-direction: row;
      position: relative;
      top: 0;
      background-color: transparent;
    }

    .nav-menu ul {
      flex-direction: row;
      align-items: center;
    }
  }







  /* Đặt kiểu cơ bản cho dropdown */
  .login-dropdown {
    position: relative;
    margin-right: 8%;
  }

  /* Ẩn menu mặc định */
  .login-dropdown .dropdown-menu {
    display: none;
    /* Ẩn menu khi không hover */
    position: absolute;
    top: 100%;
    /* Đặt ngay dưới phần tử cha */
    left: 50%;
    transform: translateX(-50%);
    /* Căn giữa menu */
    width: 180px;
    /* Kích thước menu */
    background-color: #fff;
    border-radius: 8px;
    /* Bo góc mềm mại */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    /* Bóng đổ nhẹ */
    opacity: 0;
    visibility: hidden;
    /* Ẩn menu hoàn toàn khi không hover */
    transition: opacity 0.3s ease, visibility 0.3s ease;
  }

  /* Hiển thị menu khi hover vào li */
  .login-dropdown:hover .dropdown-menu {
    display: block;
    opacity: 1;
    visibility: visible;
    /* Hiển thị menu khi hover */
  }

  /* Kiểu dáng của các mục trong menu */
  .dropdown-item a,
  .dropdown-item button {
    display: block;
    padding: 8px 16px;
    /* Giảm chiều cao của mục */
    color: #333;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
    /* Hiệu ứng chuyển màu */
    font-size: 14px;
    font-weight: 600;
    background-color: #f9f9f9;
    border: none;
    border-radius: 4px;
    /* Bo góc nhẹ cho các mục */
    margin: 4px 0;
    /* Giảm khoảng cách giữa các mục */
  }

  /* Hiệu ứng hover trên mục menu */
  .dropdown-item a:hover,
  .dropdown-item button:hover {
    background-color: #007bff;
    color: #fff;
    transform: translateX(5px);
    /* Di chuyển nhẹ khi hover */
  }

  /* Thêm hiệu ứng focus cho các mục */
  .dropdown-item a:focus,
  .dropdown-item button:focus {
    outline: none;
    border: 2px solid #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }

  /* Đặt khoảng cách giữa các nút "Đăng xuất" và "Trang cá nhân" gần nhau */
  .dropdown-item a:last-child,
  .dropdown-item button:last-child {
    margin-top: 5px;
    /* Tạo khoảng cách nhỏ giữa các nút */
  }

  .active {
    color: #007bff;
  }
</style>

<body>
  <header>
    <div class="logo">
      <a href=""><img src="{{ asset('storage/header/logo.png') }}" alt="Logo"></a>
    </div>
    <div class="menu-toggle" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <nav>
      <div class="nav-menu">

        @if (Auth::check() && !Auth::user()->is_admin)
      <ul class="menu">
        <li><a href="{{Route('home')}}" class="{{ Request::routeIs('home') ? 'active' : '' }}"><i
          class="fa-solid fa-house"></i>Trang chủ</a></li>
        <li><a href="{{Route('user.tour')}}" class="{{ Request::routeIs('user.tour') ? 'active' : '' }}"><i
          class="fa-solid fa-map"></i> Tours</a></li>
        <li><a href="{{Route('user.location')}}" class="{{ Request::routeIs('user.location') ? 'active' : '' }}"><i
          class="fa-solid fa-star"></i>Địa điểm</a></li>
        <li><a href="{{Route('user.lienhe')}}" class="{{ Request::routeIs('user.lienhe') ? 'active' : '' }}"><i
          class="fa-solid fa-phone"></i>Liên hệ</a></li>
        <li><a href="{{Route('user.introduct')}}" class="{{ Request::routeIs('user.introduct') ? 'active' : '' }}"><i
          class="fa-solid fa-info-circle"></i>Giới thiệu</a></li>
        <li class="dropdown login-dropdown" style="color:#FFFFFF">
        <a class="login-icon">
          <i class="fa-solid fa-user-circle" style="font-size: 35px;"></i>
        </a>
        <ul class="dropdown-menu" style="width: 150px">
          <li class="dropdown-item" style="margin: 0;">
          <a href="{{ route('user.profile', ['id' => Auth::user()->id]) }}" style="font-size: 14px;">
            Trang cá nhân
          </a>
          </li>
          <li class="divider" style="margin: 0;"></li>
          <li class="dropdown-item" style="margin: 0;">
          <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit">
            Đăng Xuất
            </button>
          </form>
          </li>
        </ul>
        </li>

      </ul>

    @elseif(Auth::check() && Auth::user()->is_admin)
    <ul class="menu">
      <li><a href="{{Route('home')}}" class="{{ Request::routeIs('home') ? 'active' : '' }}"><i
        class="fa-solid fa-house"></i>Trang chủ</a></li>
      <li><a href="{{Route('user.tour')}}" class="{{ Request::routeIs('user.tour') ? 'active' : '' }}"><i
        class="fa-solid fa-map"></i> Tours</a></li>
      <li><a href="{{Route('user.location')}}" class="{{ Request::routeIs('user.location') ? 'active' : '' }}"><i
        class="fa-solid fa-star"></i>Địa điểm</a></li>
      <li><a href="{{Route('user.lienhe')}}" class="{{ Request::routeIs('user.lienhe') ? 'active' : '' }}"><i
        class="fa-solid fa-phone"></i>Liên hệ</a></li>
      <li><a href="{{Route('user.introduct')}}" class="{{ Request::routeIs('user.introduct') ? 'active' : '' }}"><i
        class="fa-solid fa-info-circle"></i>Giới thiệu</a></li>
      <li class="dropdown login-dropdown" style="color:#FFFFFF">
      <a class="login-icon">
        <i class="fa-solid fa-user-circle" style="font-size: 35px;"></i>
      </a>
      <ul class="dropdown-menu" style="width: 150px">
        <li class="dropdown-item" style="margin: 0;">
        <a href="{{ route('user.profile', ['id' => Auth::user()->id]) }}" style="font-size: 14px;">
          Trang cá nhân
        </a>
        </li>
        <li class="dropdown-item" style="margin: 0;">
        <a href="{{ route('dashboard') }} " style="font-size: 14px;">
          Trang điều khiển
        </a>
        </li>
        <li class="divider" style="margin: 0;"></li>
        <li class="dropdown-item" style="margin: 0;">
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
          @csrf
          <button type="submit">
          Đăng Xuất
          </button>
        </form>
        </li>
      </ul>
      </li>

    </ul>
  @else
  <ul class="menu">
    <li><a href="{{Route('common')}}" class="{{ Request::routeIs('common') ? 'active' : '' }}"><i
      class="fa-solid fa-house"></i>Trang chủ</a></li>
    <li><a href="{{Route('guest.tour')}}" class="{{ Request::routeIs('guest.tour') ? 'active' : '' }}"><i
      class="fa-solid fa-map"></i> Tours</a></li>
    <li><a href="{{Route('guest.location')}}" class="{{ Request::routeIs('guest.location') ? 'active' : '' }}"><i
      class="fa-solid fa-star"></i>Địa điểm</a></li>
    <li><a href="{{Route('guest.lienhe')}}" class="{{ Request::routeIs('guest.lienhe') ? 'active' : '' }}"><i
      class="fa-solid fa-phone"></i>Liên hệ</a></li>
    <li><a href="{{Route('guest.introduct')}}"
      class="{{ Request::routeIs('guest.introduct') ? 'active' : '' }}"><i
      class="fa-solid fa-info-circle"></i>Giới thiệu</a></li>
    <li class="dropdown login-dropdown" style="color:#FFFFFF">
    <a class="login-icon" href="{{ route('login') }}">
      <i class="fa-duotone fa-solid fa-user-plus" style="font-size: 25px;"></i>
    </a>
    </li>
  </ul>
@endif
      </div>
    </nav>
  </header>
</body>
<script>
  function toggleMenu() {
    const nav = document.querySelector(".nav-menu");
    nav.classList.toggle("active");
  }
</script>
<script>
  window.addEventListener("scroll", function () {
    const header = document.querySelector("header");
    if (window.scrollY > 50) {
      header.classList.add("scrolled"); // Thêm lớp 'scrolled' khi cuộn
    } else {
      header.classList.remove("scrolled"); // Xóa lớp 'scrolled' khi trở về trên cùng
    }
  });
</script>

<script>
  // Lấy tất cả các liên kết trong menu
  const menuLinks = document.querySelectorAll('.menu li a');

  // Kiểm tra trạng thái được lưu trong localStorage
  const activeLink = localStorage.getItem('activeLink');
  if (activeLink) {
    // Gán class active cho mục được lưu
    menuLinks.forEach(link => link.classList.remove('active'));
    document.querySelector(.menu li a[href = "${activeLink}"]).classList.add('active');
  }

  // Thêm sự kiện click vào từng liên kết
  menuLinks.forEach(link => {
    link.addEventListener('click', function (event) {
      // Lưu đường dẫn của liên kết vào localStorage
      localStorage.setItem('activeLink', this.getAttribute('href'));

      // Xóa class active khỏi tất cả các mục
      menuLinks.forEach(item => item.classList.remove('active'));

      // Thêm class active cho liên kết được nhấp
      this.classList.add('active');
    });
  });
</script>

</html>