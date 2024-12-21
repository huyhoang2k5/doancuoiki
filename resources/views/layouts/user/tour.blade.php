@extends('layouts.user.main')
@section('contain')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<style>
    * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f2f5;
    color: #333;
    font-size: 14px; /* Căn chỉnh font-size cho tất cả trang */
}

.container {
    display: flex;
    gap: 2%; /* 20px */
}

/* Sidebar Styling */
.sidebar {
    width: 30%; /* 300px */
    padding: 2%; /* 20px */
    background-color: #fff;
    border-radius: 10px; /* 10px */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    height: 80%; /* 800px */
    margin-top: 5%; /* 50px */
    margin-left: 2%; /* 100px */
    padding-left: 5%; /* 50px */
}

.sidebar h2 {
    font-size: 22px;
    margin-bottom: 5%;
    color: #007bff;
}

.filter-group {
    margin-bottom: 5%;
}

.filter-group h3 {
    font-size: 18px;
    color: #555;
    margin-bottom: 2%; /* 10px */
}

.filter-group label {
    display: block;
    margin-bottom: 4%; /* 8px */
    font-size: 15px;
    color: #555;
}

.filter-group input[type="checkbox"] {
    margin-right: 4%; /* 8px */
}

/* Tour List Styling */
.tour-list {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    gap: 20px; /* 20px */
}

.tour-item {
    display: flex;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
    max-width: 105%;
    width: 120%; /* 900px */ 
}

.tour-item:hover {
    transform: translateY(-5px); /* 5px */
}

.tour-item img {
    width: 215px; /* 215px */
    height: 165px; /* 165px */
    object-fit: cover;
    padding-left: 2%; /* 20px */
    padding-top: 1.5%; /* 15px */
    border-radius: 15px; /* 15px */
}

.tour-details {
    padding: 1.5%; /* 15px */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex-grow: 1;
}

.top-row,
.mid-row,
.bottom-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.top-row .tour-code,
.top-row .tour-time {
    font-size: 14px;
    color: #555;
}

.mid-row h3 {
    font-size: 22px;
    color: #333;
}

.mid-row .tour-price {
    font-size: 18px;
    color: #007bff;
    font-weight: bold;
}

.bottom-row .tour-rating {
    font-size: 18px;
    color: #ffc107;
}

button {
    padding: 8px 12px; /* 8px 12px */
    font-size: 15px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 5px; /* 5px */
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

/* Thêm Mới phần đổ xuống */
.tour-list1 {
    width: 100%; /* 200px */
    margin: 5%; /* 20px */
}

.tour-section {
    margin-bottom: 5%; /* 10px */
}

.section-title {
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
}

.tour-items {
    list-style: none;
    padding: 0;
    margin: 5px 0; /* 5px */
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease;
}

.tour-items li {
    padding: 5px 0; /* 5px */
    font-size: 14px;
}

.tour-items.show {
    max-height: 200px; /* 200px */
}

/* Màn hình dưới 1200px - Điều chỉnh layout */
@media (max-width: 1200px) {
    .container {
        flex-direction: column;
        padding: 10px; /* 10px */
    }

    .sidebar {
        width: 100%;
        margin: 0 auto 20px; /* 20px */
    }

    .tour-list {
        width: 100%;
    }

    .tour-item {
        width: 100%;
        flex-direction: column;
        height: auto;
    }

    .tour-item img {
        width: 100%;
        height: auto;
        padding: 0;
        border-radius: 10px 10px 0 0;
    }

    .tour-details {
        padding: 10px; /* 10px */
    }
}

/* Màn hình dưới 768px - Mobile First */
@media (max-width: 768px) {
    body {
        font-size: 14px; /* 14px */
    }

    .container {
        flex-direction: column;
    }

    .sidebar {
        padding: 15px; /* 15px */
        font-size: 14px; /* 14px */
    }

    .tour-item {
        flex-direction: column;
        height: auto;
    }

    .tour-item img {
        width: 100%;
        height: 200px; /* 200px */
    }

    .tour-details {
        padding: 10px; /* 10px */
    }

    .top-row .tour-code,
    .top-row .tour-time {
        font-size: 12px; /* 12px */
    }

    .mid-row h3 {
        font-size: 18px; /* 18px */
    }

    .mid-row .tour-price {
        font-size: 16px; /* 16px */
    }
}

/* Màn hình dưới 480px - Mobile nhỏ */
@media (max-width: 480px) {
    .container {
        padding: 10px; /* 10px */
    }

    .sidebar {
        font-size: 12px; /* 12px */
    }

    .filter-group label {
        font-size: 12px; /* 12px */
    }

    .tour-item {
        flex-direction: column;
        height: auto;
    }

    .tour-item img {
        height: 150px; /* 150px */
    }

    .tour-details {
        padding: 8px; /* 8px */
    }

    .mid-row h3 {
        font-size: 16px; /* 16px */
    }

    .mid-row .tour-price {
        font-size: 14px; /* 14px */
    }

    button {
        font-size: 12px; /* 12px */
        padding: 6px 10px; /* 6px 10px */
    }
}

.btn-danhmuc {
    width: 100%; /* 200px */
    height: 50%; /* 50px */
}

</style>



<div style="margin-top:100px">

</div>

<div class="container">
    <!-- Nút mở Offcanvas -->
    <button class="btn btn-primary d-md-none mb-3 btn-danhmuc" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
        Danh Mục &nbsp; <i class="bi bi-filter-circle-fill"></i>
    </button>

    <!-- Sidebar chính cho màn hình lớn -->
    <div class="sidebar d-none d-md-block">


        <div class="filter-group">
            <h2>Chọn mức giá</h2>
            <label><input type="checkbox" class="price-filter" data-min="0" data-max="1000000"> Giá dưới
                1.000.000đ</label>
            <label><input type="checkbox" class="price-filter" data-min="1000000" data-max="3000000"> 1.000.000đ - 3.000.000đ</label>
            <label><input type="checkbox" class="price-filter" data-min="3000000" data-max="5000000"> 3.000.000đ - 5.000.000đ</label>
            <label><input type="checkbox" class="price-filter" data-min="5000000" data-max="7000000"> 5.000.000đ - 7.000.000đ</label>
            <label><input type="checkbox" class="price-filter" data-min="7000000" data-max="9000000"> 7.000.000đ - 9.000.000đ</label>
            <label><input type="checkbox" class="price-filter" data-min="9000000"> Giá trên 9.000.000đ</label>
        </div>
    </div>

    <!-- Offcanvas Sidebar (for smaller screens) -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Danh mục</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h3 class="section-title" onclick="toggleSection('domestic_mobile')">Điểm đến yêu thích</h3>
            <ul id="domestic_mobile" class="tour-items">
                <li>Cầu Rồng</li>
                <li>Biển Mỹ Khê</li>
                <li>Bà Nà Hill</li>
            </ul>
            <h3 class="section-title" onclick="toggleSection('international_mobile')">Trải Nghiệm Du Lịch</h3>
            <ul id="international_mobile" class="tour-items">
                <li>Khám phá ẩm thực</li>
                <li>Cẩm nang du lịch</li>
                <li>Lưu ý</li>
            </ul>
            <h3>Chọn mức giá</h3>
            <label><input type="checkbox" class="price-filter" data-min="0" data-max="1000000"> Giá dưới
                1.000.000đ</label>
            <label><input type="checkbox" class="price-filter" data-min="1000000" data-max="3000000"> 1.000.000đ - 3.000.000đ</label>
            <label><input type="checkbox" class="price-filter" data-min="3000000" data-max="5000000"> 3.000.000đ - 5.000.000đ</label>
            <label><input type="checkbox" class="price-filter" data-min="5000000" data-max="7000000"> 5.000.000đ - 7.000.000đ</label>
            <label><input type="checkbox" class="price-filter" data-min="7000000" data-max="9000000"> 7.000.000đ - 9.000.000đ</label>
            <label><input type="checkbox" class="price-filter" data-min="9000000"> Giá trên 9.000.000đ</label>
        </div>
    </div>

    <div class="tour-list">
        @yield('part-in-tour')
    </div>
</div>
</div>


<!-- Tour List -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const priceFilters = document.querySelectorAll(".price-filter");
    const tourItems = document.querySelectorAll(".tour-item");

    // Lắng nghe sự kiện thay đổi trên mỗi checkbox
    priceFilters.forEach(filter => {
        filter.addEventListener("change", filterTours);
    });

    function filterTours() {
        // Thu thập các khoảng giá được chọn
        let selectedRanges = Array.from(priceFilters)
            .filter(filter => filter.checked)
            .map(filter => ({
                min: parseInt(filter.getAttribute("data-min")) || 0,
                max: parseInt(filter.getAttribute("data-max")) || Infinity
            }));

        // Nếu không có khoảng giá nào được chọn, hiển thị tất cả các tour
        if (selectedRanges.length === 0) {
            tourItems.forEach(tour => {
                tour.style.display = "flex";  // Hiển thị tất cả các tour
            });
            return;
        }

        // Duyệt qua mỗi tour và kiểm tra giá của nó có thuộc bất kỳ khoảng giá nào đã chọn không
        tourItems.forEach(tour => {
            const price = parseInt(tour.getAttribute("data-price"));
            const isVisible = selectedRanges.some(range => price >= range.min && price <= range.max);
            tour.style.display = isVisible ? "flex" : "none";  // Hiển thị nếu thuộc một trong các khoảng giá
        });
    }
});

</script>

<script>
    function changeImage(src) {
        document.getElementById("mainImage").src = src;
    }

    function showTab(tabId) {
        const tabs = document.querySelectorAll(".tab-content");
        tabs.forEach(tab => tab.style.display = "none");
        document.getElementById(tabId).style.display = "block";
    }

    function toggleContent(element) {
        const content = element.querySelector('.accordion-content');
        const arrow = element.querySelector('.arrow');
        content.style.display = content.style.display === 'none' || content.style.display === '' ? 'block' : 'none';
        element.classList.toggle('open');
    }
</script>
<script>
    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        section.classList.toggle("show");
    }
</script>
@endsection
