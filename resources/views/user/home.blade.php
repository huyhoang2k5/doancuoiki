@section('tour-card')
@if(isset($tours) && $tours->count())
    @foreach ($tours->sortBy('gia')->take(4) as $item)
        <div class="deal-card1">
            <div class="position-relative">
                <img src="{{ asset('storage/' . $item->hinh_anh) }}" alt="{{ $item->ten_tour }}">
            </div>
            <div class="deal-content1">
                <h5 class="card-title">{{$item->ten_tour}}</h5>
                <p class="deal-info"><i class="bi bi-calendar"></i> {{$item->ngay_bat_dau}} / {{
                    \Carbon\Carbon::parse($item->ngay_bat_dau)
                        ->diffInDays(\Carbon\Carbon::parse($item->ngay_ket_thuc))
                                                                                                                                                                                                                                                            }} ngày</p>
                <p class="deal-info">
                <div class="div_card">
                </div>
                </p>
                <p>
                    <span class="deal-price">{{ number_format($item->gia, 0, '', '.')}}đ</span>
                </p>
                @if (Auth::check())
                    <a href="{{ route('user.tour.show', $item->ma_tour) }}" class="btn btn-primary btn-sm btn_card1">Xem chi
                        tiết</a>
                @else
                    <a href="{{ route('guest.tour.show', $item->ma_tour) }}" class="btn btn-primary btn-sm btn_card1">Xem chi
                        tiết</a>
                @endif

            </div>
        </div>
    @endforeach
@else
    <p>Không có tour nào để hiển thị.</p>
@endif
@endsection

@section('card')
@if(isset($location) && $location->count())
    @foreach ($location->take(5) as $item)
        <div class="card">
            <img src="{{ asset('storage/' . $item->hinh_anh) }}" alt="{{$item->ten_dia_diem}}">
            <div class="noi-dung">
                <p class="ten-dia-diem"><i class="bi bi-geo-alt"></i> &nbsp {{$item->ten_dia_diem}}</p>
                <a class="a_diemden" href="#">
                    @auth
                        <!-- Người dùng đã đăng nhập -->
                        <a href="{{ route('user.location') }}">
                            <p class="chi-tiet">Xem chi tiết<i class="bi bi-caret-right-fill"></i></p>
                        </a>

                    @else
                        <!-- Người dùng chưa đăng nhập -->
                        <a href="{{ route('guest.location') }}">
                            <p class="chi-tiet">Xem chi tiết<i class="bi bi-caret-right-fill"></i></p>
                        </a>
                    @endauth

                </a>
            </div>
        </div>
    @endforeach
@else
    <p>Không có địa điểm nào để hiển thị.</p>
@endif
@endsection

@section('search-container')
<!-- Ô đầu tiên: Text input -->
<div class="search-item" name="wantToGo" id="wantToGo">
    <i class="fas fa-search search-icon"></i>
        <input type="text" name="wantPlace" class="search-input" placeholder="Bạn muốn đi đâu?">
        <div id="data-tourPlace" style="display: none; border: 1px solid #ccc; padding: 10px; position: absolute; background: white;
         max-height: 20rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
         overflow-y: auto;  z-index: 1000;"></div>
</div>

<!-- Ô thứ 2: Dropdown chọn điểm đi -->
<div class="search-item">
    <i class="fas fa-map-marker-alt search-icon"></i>
    <input type="text" name="placeStart" class="search-inputStart" placeholder="Chọn điểm khởi hành">
</div>

<!-- Ô thứ 3: Dropdown chọn điểm đến -->
<div class="search-item">
    <i class="fas fa-user-alt search-icon"></i>
    <input type="number" class="search-inputNumber" placeholder="Chọn số người đi" min="1">
</div>

<!-- Ô thứ 4: Date picker -->
<div class="search-item">
    <input type="date" class="search-date" id="departure-date" min="2024-11-16">
</div>

<Script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></Script>

@if (Auth::check())
    <script>
        $(document).ready(function () {
            $('#wantToGo').on('click', function () {
                const $searchContainer = $(this);
                $.ajax({
                    url: "{{ route('home') }}", // Đảm bảo URL này đúng
                    method: "GET",
                    success: function (response) {

                        let html = '<ul>';
                        response.forEach(function (item) {
                            html += `<li><img src="${item.hinh_anh}" alt="${item.ten_tour}" style="width: 100px; height: 50px; margin-right: 10px;"> ${item.ten_tour}</li>`;
                        });
                        html += '</ul>';
                        $('#data-tourPlace').html(html).show();
                        const containerHeight = $searchContainer.outerHeight();

                        $('#data-tourPlace').css({
                            'display': 'block',
                            'width': '150%',
                            'position': 'absolute',
                            'zIndex': '5',
                            'top': containerHeight + 'px',
                            'left': '0',
                            'border-radius': '5px'
                        });

                        $('#data-tourPlace ul').css({
                            'list-style': 'none', // Loại bỏ dấu chấm đầu dòng
                            'padding': '10px', // Thêm khoảng cách trong
                            'margin': '0', // Bỏ khoảng cách ngoài
                            'background-color': '#f9f9f9' // Màu nền
                        });

                        $('#data-tourPlace ul li').css({
                            'padding': '5px 10px', // Khoảng cách bên trong
                            'border-bottom': '1px solid #ccc', // Đường kẻ dưới mỗi mục
                            'cursor': 'pointer', // Hiển thị biểu tượng trỏ tay khi hover
                            'display': 'grid',
                            'place-items': 'stretch'
                        }).click(function () {
                            // Lấy text của li và đưa vào input
                            const tourName = $(this).text().trim();
                            $('.search-input').val(tourName);
                            $dropdown.hide();
                        });;
                    },
                    error: function () {
                        $('#data-tourPlace').html('Không thể tải dữ liệu').show();
                    }
                });
            });

            $('#wantToGo, #data-tourPlace').on('mouseleave', function () {
                $('#data-tourPlace').hide();
            });
        });

    </script>
@else

@endif

<!-- Nút tìm kiếm -->
<button class="search-button">Tìm kiếm</button>
@endsection

@include('layouts.user.header')
@include('layouts.user.home')
@include('layouts.user.footer')

