<div class="header">
    <div class="user-info">
        <span>{{ Auth::user()->name }}</span>
        <i class="fas fa-user"></i>
        <!-- Thêm dropdown bên trong user-info -->
        <div class="dropdown">
            <a class="dropdown-item" href="">
                <i class="fas fa-home"> </i>
                Trang chủ
            </a>
            <a class="dropdown-item">
            <form action="{{ route('logout') }}" method="POST" style="width: 100%; margin: 0; height:100%">
                @csrf
                <button type="submit"
                    style="all: unset; cursor: pointer; font: inherit; width: 100%; height: 100%;">
                    Đăng Xuất
                </button>
            </form>
            </a>
        </div>
    </div>
</div>