<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đặt Tour Đà Nẵng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: "Arial", sans-serif;
    line-height: 1.6;
    background-color: #f9f9f9;
  }

  /* Cài đặt cho Slider */
  .slider {
    position: relative;
    width: 100%;
    height: 600px;
    /* Chiều cao bằng với chiều cao của màn hình */
    margin: 0;
    overflow: hidden;
    border-radius: 0;
    /* Bỏ bo tròn góc */
  }

  .slides {
    display: flex;
    transition: transform 0.5s ease;
  }

  .slides img {
    width: 100%;
    height: 100vh;
    /* Đảm bảo hình ảnh chiếm toàn bộ chiều cao màn hình */
    object-fit: cover;
    /* Đảm bảo ảnh không bị méo */
  }

  /* Các nút chuyển slide */
  .prev,
  .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 10px;
    margin-top: -22px;
    color: white;
    font-weight: bold;
    font-size: 18px;
    background-color: rgba(0, 0, 0, 0.5);
    user-select: none;
    z-index: 100;
  }

  .next {
    right: 0;
    border-radius: 3px 0 0 3px;
  }

  .prev:hover,
  .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
  }

  /* Chấm tròn chỉ mục cho slider */
  .dots {
    text-align: center;
    position: absolute;
    bottom: 15px;
    width: 100%;
    z-index: 100;
  }

  .dot {
    cursor: pointer;
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.6s ease;
  }

  .dot.active {
    background-color: #717171;
  }

  /* Media Query cho slider trên màn hình nhỏ */
  @media (max-width: 768px) {
    .slider {
      height: 50vh;
      /* Chiều cao slider giảm cho màn hình nhỏ */
    }

    .slides img {
      height: 50vh;
    }
  }

  /*-------Search--------*/

  .search-container {
    display: flex;
    align-items: center;
    border: 2px solid #007bff;
    background: #fff;
    padding: 15px;
    width: 90%;
    max-width: 1500px;
    margin: 50px auto;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    height: 100px;
  }

  .search-item {
    position: relative;
    display: flex;
    align-items: center;
    flex: 1;
    margin-right: 15px;
  }

  .search-item:last-child {
    margin-right: 0;
  }

  .search-icon {
    position: absolute;
    left: 10px;
    color: #007bff;
    font-size: 18px;
  }

  .search-inputNumber,
  .search-inputStart,
  .search-input,
  .search-select,
  .search-date {
    width: 100%;
    padding: 10px 40px;
    font-size: 18px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    transition: border-color 0.3s;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border: 1px solid #007bff;
    font-family: Faustina;
  }
  .search-inputNumber::placeholder ,
  .search-inputStart::placeholder ,
  .search-input::placeholder ,
  .search-select::placeholder {
    color: black; 
  }

  .search-inputNumber:focus,
  .search-inputStart:focus,
  .search-input:focus,
  .search-select:focus,
  .search-date:focus {
    border-color: #007bff;
  }

  .search-select {
    appearance: none;
    background: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%23007bff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>') no-repeat;
    background-position: calc(100% - 10px) center;
    background-size: 16px;
  }

  .search-button {
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s, box-shadow 0.3s;
  }

  .search-button:hover {
    background-color: #0056b3;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
  }

  .search-date {
    cursor: pointer;
  }

  /* Responsive styling */
  @media screen and (max-width: 1200px) {
    .search-container {
      flex-wrap: wrap;
      height: auto;
      /* Adjust height for wrap */
    }

    .search-item {
      margin-bottom: 15px;
      margin-right: 0;
      flex: 1 1 100%;
      /* Full width on smaller screens */
    }

    .search-item:last-child {
      margin-bottom: 0;
    }

    .search-button {
      width: 100%;
      /* Full-width button for small screens */
    }
  }

  @media screen and (max-width: 768px) {
    .search-container {
      padding: 10px;
      /* Reduce padding */
      box-shadow: none;
      /* Simplify shadows */
    }

    .search-inputNumber,
    .search-inputStart,
    .search-input,
    .search-select,
    .search-date {
      font-size: 16px;
      /* Adjust font size */
      padding: 8px 35px;
      /* Reduce padding */
    }

    .search-button {
      font-size: 14px;
      padding: 8px 16px;
    }
  }

  @media screen and (max-width: 480px) {
    .search-container {
      border: 1px solid #007bff;
      /* Simplify border */
    }

    .search-inputNumber,
    .search-inputStart,
    .search-input,
    .search-select,
    .search-date {
      padding: 8px 30px;
      /* Adjust padding for very small screens */
      font-size: 14px;
      /* Reduce font size */
    }
  }

  /* Section giới thiệu */
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f7fa;
  }

  section {
    padding: 40px 20px;
    text-align: center;
  }

  .why-choose {
    background-color: #e9f5ff;
    margin-top: 50px;
    border-top: #007bff 2px solid;
    border-bottom: #007bff 2px solid;
  }

  .why-choose h2,
  .booking-steps h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 20px;
  }

  .features {
    display: flex;
    justify-content: center;
    gap: 200px;
    margin-top: 20px;
  }

  .feature {
    max-width: 200px;
    text-align: center;
  }

  .feature img {
    width: 50px;
    height: 50px;
  }

  .feature h3 {
    font-size: 1.2rem;
    color: #007acc;
    margin: 10px 0;
  }

  .feature p {
    color: #555;
    font-size: 1rem;
  }

  .booking-steps {
    margin-top: 40px;
  }

  .booking-steps p {
    font-size: 1.1rem;
    color: #777;
    margin-bottom: 40px;
  }

  .steps {
    display: flex;
    justify-content: center;
    gap: 200px;
  }

  .step {
    max-width: 150px;
    text-align: center;
    position: relative;
  }

  .step-number {
    position: absolute;
    top: -20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #007acc;
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
  }

  .step img {
    width: 60px;
    height: 60px;
    margin-top: 20px;
  }

  .step h3 {
    font-size: 1.1rem;
    color: #333;
    margin: 15px 0;
  }

  .step p {
    color: #555;
    font-size: 0.95rem;
  }

  /* Responsive Styles */
  @media screen and (max-width: 768px) {
    .features {
      flex-direction: column;
      gap: 40px;
    }

    .steps {
      flex-direction: column;
      gap: 40px;
    }

    .feature {
      max-width: 100%;
    }

    .step {
      max-width: 100%;
    }

    .feature img,
    .step img {
      width: 40px;
      height: 40px;
    }

    .feature h3,
    .step h3 {
      font-size: 1rem;
    }

    .feature p,
    .step p {
      font-size: 0.9rem;
    }

    .step-number {
      width: 35px;
      height: 35px;
      font-size: 1rem;
    }
  }

  @media screen and (max-width: 480px) {
    section {
      padding: 20px;
    }

    .why-choose h2,
    .booking-steps h2 {
      font-size: 1.5rem;
    }

    .features {
      gap: 20px;
    }

    .steps {
      gap: 20px;
    }
  }


  /*--Tour ưu đãi */

  .header {
    font-size: 40px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
    text-align: left;
    margin-top: 50px;
    margin-left: 150px;
  }

  .subtitle {
    font-size: 1em;
    color: #888;
    margin-bottom: 20px;
    text-align: left;
    margin-left: 150px;
  }

  .deals-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    /* Chia layout thành 2 cột */
    gap: 20px;
    margin-left: 5%;
    width: 90%;
  }

  /* Cài đặt cho deal card */
  .deal-card {
    display: flex;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    overflow: hidden;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    height: 160px;
    /* Giảm chiều cao */
    width: 100%;
    /* Chiều rộng thẻ */
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    /* Thêm hiệu ứng zoom và bóng */
  }

  /* Hiệu ứng hover cho deal card */
  .deal-card:hover {
    transform: scale(1.05);
    /* Tăng kích thước thẻ khi hover */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    /* Tăng bóng khi hover */
  }

  /* Cài đặt cho phần hình ảnh deal */
  .deal-image {
    width: 35%;
    /* Giảm chiều rộng phần hình ảnh */
    height: 100%;
    /* Chiều cao 100% */
    position: relative;
  }

  .deal-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: opacity 0.3s ease;
    /* Thêm hiệu ứng mờ dần khi hover */
  }

  /* Cài đặt cho thẻ giảm giá */
  .discount-tag {
    position: absolute;
    top: 5px;
    left: 5px;
    background-color: red;
    color: white;
    font-size: 0.7em;
    /* Giảm kích thước chữ */
    padding: 3px 5px;
    /* Giảm padding */
    border-radius: 3px;
    opacity: 0;
    /* Giấu thẻ giảm giá ban đầu */
    transition: opacity 0.3s ease;
    /* Thêm hiệu ứng mờ dần */
  }

  /* Hiển thị tag giảm giá khi hover */
  .deal-card:hover .discount-tag {
    opacity: 1;
    /* Hiện thẻ giảm giá khi hover */
  }

  /* Cài đặt cho phần nội dung của deal */
  .deal-content {
    padding: 10px;
    /* Giảm padding để làm phần nội dung ngắn hơn */
    width: 65%;
    /* Tăng phần nội dung */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .deal-location,
  .deal-title,
  .stars,
  .price,
  .duration {
    margin-bottom: 3px;
  }

  .deal-location {
    font-size: 0.7em;
    /* Giảm kích thước chữ */
    color: #888;
  }

  .deal-title {
    font-size: 0.9em;
    /* Giảm kích thước chữ */
    font-weight: bold;
    color: #333;
  }

  .stars {
    color: #f1c40f;
    font-size: 0.8em;
    /* Giảm kích thước chữ */
  }

  .price {
    color: #1e88e5;
    font-size: 0.9em;
    /* Giảm kích thước chữ */
    font-weight: bold;
  }

  .old-price {
    color: #888;
    font-size: 0.8em;
    /* Giảm kích thước chữ */
    text-decoration: line-through;
    margin-left: 5px;
  }

  .duration {
    font-size: 0.8em;
    /* Giảm kích thước chữ */
    color: #555;
  }

  /* Hiệu ứng hover cho nội dung */
  .deal-card:hover .deal-content {
    background-color: #f5f5f5;
    /* Thay đổi màu nền của phần nội dung khi hover */
  }

  /* Thêm hiệu ứng khi hover vào giá tiền */
  .deal-card:hover .price {
    color: #ff4d4d;
    /* Đổi màu giá khi hover */
  }



  /* Khuyến Mãi Mùa Hè */
  .tours {
    /* background-color: rgb(255, 244, 200); */
    padding: 50px 20px;
  }

  .tours h2 {
    text-align: left;
    font-size: 40px;
    margin-bottom: 20px;
    margin-left: 150px;
  }

  .tour-container {
    display: flex;
    justify-content: center;
    gap: 20px;
  }

  .login {
    margin-left: 20px;
  }

  .btn-tours {
    color: #fff;
    padding: 15px 25px;
    text-decoration: none;
    border-radius: 5px;
    position: relative;
    top: 200px;
    background: linear-gradient(to left, darkorange 50%, #fff 50%);
    background-size: 200% 100%;
    /* Kích thước nền lớn hơn để tạo hiệu ứng */
    background-position: right bottom;
    /* Bắt đầu từ phải */
    transition: all 0.4s ease;
    /* Thời gian và hiệu ứng chuyển động */
    margin-left: 50px;
  }

  .btn-tours:hover {
    background-position: left bottom;
    color: darkorange;
  }

  .btn {
    background-color: darkorange;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 20px;
  }

  .btn:hover {
    background-color: #0056b3;
  }

  /* Section Địa Danh Nổi Tiếng */

  /* Phần Điểm Đến Ưa Thích */
  .diem-den {
    padding: 20px 0;
    background-color: #f9f9f9;
    margin-bottom: 10px;
  }

  .hang-card {
    display: flex;
    justify-content: space-between;
    /* Tạo khoảng cách đều giữa các card */
    align-items: center;
    gap: 0;
    /* Card nằm sát nhau */
    overflow: hidden;
  }

  .card {
    flex: 1;
    /* Chia đều chiều rộng cho các card */
    position: relative;
    height: 200px;
    /* Chiều cao cố định */
    overflow: hidden;
    cursor: pointer;
    border-radius: 0px;
  }

  .card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* Đảm bảo ảnh phù hợp với khung */
    transition: transform 0.3s ease;
  }

  .card .noi-dung {
    text-align: left;
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 100px;
    background: rgba(0, 0, 0, 0);
    color: white;
    padding-left: 20px;
    margin-top: 200px;
    padding-top: 65px;
    box-sizing: border-box;
    transition: background 0.3s ease;
    background: linear-gradient(to top, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0));
  }

  .card .ten-dia-diem {
    font-size: 16px;
    margin: 0;
    opacity: 1;
    /* Hiển thị mặc định */
    transition: opacity 0.3s ease, transform 0.3s ease;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  }

  .card .chi-tiet {
    font-size: 16px;
    margin: 0;
    opacity: 0;
    /* Ẩn mặc định */
    transform: translateY(20px);
    /* Nằm dưới khung nhìn */
    transition: opacity 0.3s ease, transform 0.3s ease;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  }

  .card:hover .ten-dia-diem {
    opacity: 0;
    /* Ẩn tên địa điểm khi hover */
    transform: translateY(50px);
  }

  .card:hover .chi-tiet {
    opacity: 1;
    /* Hiển thị "Xem chi tiết" */
    transform: translateY(-25px);
  }

  .a_diemden:hover {
    text-decoration: none;
    color: gold;
  }

  .a_diemden {
    text-decoration: none;
    color: white;
  }

  /* Blog khám phá */
  .container11 {
    width: 100%;
    float: left;
    margin-top: 50px;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    margin-bottom: 100px;
    box-sizing: border-box;
    padding-left: 100px;
  }

  /* Tiêu đề chính */
  .title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 10px;
    position: relative;
  }

  .title:after {
    content: "";
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ccc;
    /* Đường kẻ nét đứt */
  }

  /* Bố cục lưới 2 cột */
  .grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    /* Khoảng cách giữa các cột */
  }

  /* Bài viết */
  .blog-item {
    display: flex;
    align-items: center;
    border-bottom: 1px dashed #ccc;
    /* Đường kẻ nét đứt */
    padding-bottom: 15px;
    margin-bottom: 15px;
    width: 500px;
  }

  .blog-item img {
    width: 120px;
    height: 80px;
    object-fit: cover;
    margin-right: 15px;
  }

  .blog-content {
    flex: 1;
  }

  .blog-content h3 {
    font-size: 16px;
    margin: 0;
    color: #333;
  }

  .blog-content p {
    font-size: 12px;
    color: #666;
    margin: 5px 0 0 0;
  }

  .blog-link {
    text-decoration: none;
    color: #666;
  }

  .blog-link .h3:hover {
    text-decoration: none;
    color: gold;
  }


  /* Section Khách Hàng Yêu Thích */
  #favorite-customers {
    padding: 50px 0;
    text-align: center;
    background-image: url('../Image/NenDG.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }

  #favorite-customers h2 {
    margin-bottom: 20px;
  }

  .customer-container {
    display: flex;
    justify-content: center;
    gap: 100px;
    /* Khoảng cách giữa các ô */
    flex-wrap: wrap;
    /* Để ô tự động xuống hàng nếu không đủ chỗ */
  }

  .customer-card {
    background-color: #f4f4f4;
    padding: 20px;
    border-radius: 10px;
    width: 300px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    /* Cột cho từng khách hàng */
    align-items: center;
  }

  .customer-card p {
    text-align: left;
  }

  .customer-info {
    display: flex;
    /* Dạng hàng cho ảnh, tên và số sao */
    align-items: center;
    /* Căn giữa theo chiều dọc */
  }

  .customer-image {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    /* Để ảnh thành hình tròn */
    margin-right: 10px;
    /* Khoảng cách giữa ảnh và tên */
  }

  .rating {
    margin-left: 10px;
    /* Khoảng cách giữa tên và số sao */
  }

  /* css danh gia duoc them moi */
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
  }

  .reviews-section {
    text-align: center;
    padding: 50px;
  }

  .reviews-section h2 {
    font-size: 2em;
    margin-bottom: 10px;
  }

  .reviews-section p {
    font-size: 1.1em;
    color: #666;
    margin-bottom: 30px;
  }

  .review-container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .reviews {
    display: flex;
    overflow: hidden;
    width: 50%;
    border-radius: 20px;
  }

  .review {
    min-width: 100%;
    transition: 0.5s;
    opacity: 0;
    transform: scale(0.8);
    text-align: center;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: none;

  }

  .review.active {
    opacity: 1;
    transform: scale(1);
    display: block;
  }

  .rating {
    font-size: 1.5em;
    color: #ffd700;
    margin: 10px 0;
  }

  .review img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-top: 10px;
  }

  .review h3 {
    font-size: 1.2em;
    margin-top: 10px;
  }

  .prev-btn,
  .next-btn {
    background: none;
    border: none;
    font-size: 2em;
    color: #666;
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
  }

  .prev-btn {
    left: 10px;
  }

  .next-btn {
    right: 10px;
  }

  .prev-btn:hover,
  .next-btn:hover {
    color: #333;
  }

  /*--------Tour giá tốt ---------*/
  .deal-card1 {
    border: 1px solid #ddd;
    background-color: #fff;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
    height: 67vh;
    /* Chiều cao tăng để thêm thông tin */
    width: 25%;
    border-radius: 4px;
  }

  .deal-card1:hover {
    transform: translateY(-5px);
  }

  .deal-card1 img {
    width: 100%;
    height: 200px;
    object-fit: cover;
  }

  .deal-location1 {
    position: absolute;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    top: 165px;
    left: 0px;
    background-color: white;
    color: black;
    padding: 5px 5px;
    font-size: 12px;
    width: 120px;
    height: 40px;
  }

  .deal-location1 i {
    margin-right: 5px;
    /* Khoảng cách giữa icon và chữ */
  }

  .deal-content1 {
    padding: 15px;
    position: relative;
    height: calc(100% - 200px);
    /* Tính toán cho nội dung bên dưới */
  }

  .deal-price {
    color: #d9534f;
    font-size: 1.2rem;
    font-weight: bold;
  }

  .deal-old-price {
    text-decoration: line-through;
    color: gray;
    margin-left: 8px;
    font-size: 0.9rem;
  }

  .deal-info {
    margin: 8px 0;
    color: #555;
    font-size: 0.9rem;
  }

  .card-title {
    font-size: 15px;
  }

  .btn_card1 {
    position: absolute;
    border-radius: 0px;
    bottom: 5px;
    right: 5px;
    font-size: 15px;
    font-weight: bold;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    background-color: #1e88e5;
    display: inline-block;
    padding: 10px 15px;
  }

  .deals-wrapper {
    display: flex;
    justify-content: space-between;
    /* Tất cả card nằm trên một dòng */
    gap: 10px;
  }

  .header1 {
    font-size: 40px;
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
    text-align: left;
    margin-top: 50px;
    margin-left: 50px;
  }

  .a_tour :hover {
    text-decoration: none;
    color: blue;
  }

  .p_card {
    float: right;
    margin-right: 50px;
    font-size: 18px;
    margin-top: 100px;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  }

  .title-row1 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .div_card1 {
    margin-bottom: 15px;
  }

  .giatot {
    margin-top: 10px;
  }

  .subtitle1 {
    height: 20px;
  }
</style>

<body>

  <!-- Slider Section -->
  <div class="slider">
    <div class="slides">
      <img src="{{ asset('storage/./view_user/slider1.jpg') }}" alt="Ảnh 1">
      <img src="{{ asset('storage/./view_user/slider2.jpg') }}" alt="Ảnh 2">
      <img src="{{ asset('storage/./view_user/slider3.jpg') }}" alt="Ảnh 3">
    </div>
    <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
    <a class="next" onclick="changeSlide(1)">&#10095;</a>
    <div class="dots">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
    </div>
  </div>


  <!-- </section>
  <form class="search-form">
    <div class="form-group">
      <label for="tours">Chọn Tours</label>
      <select id="tours">
        <option value="adventure">Tour du lịch mạo hiểm</option>
        <option value="cultural">Tour du lịch văn hóa</option>
        <option value="beach">Tour du lịch bãi biển</option>
      </select>
    </div>
    <div class="form-group">
      <label for="location">Chọn Địa Điểm</label>
      <select id="location">
        <option value="danang">Đà Nẵng</option>
        <option value="hue">Huế</option>
        <option value="hoian">Hội An</option>
      </select>
    </div>
    <div class="form-group">
      <label for="date">Chọn Ngày</label>
      <input type="date" id="date" />
    </div>
    <button type="submit" class="btn">Tìm Kiếm</button>
  </form> -->
  <!-- Section giới thiệu du lịch -->
  <section class="why-choose">
    <h2>Vì sao bạn nên chọn DA NANG TOURS</h2>
    <div class="features">
      <div class="feature">
        <img src="{{ asset('storage/./Image/1571101.png') }}" alt="Giá tốt nhất">
        <h3>Giá tốt nhất cho bạn</h3>
        <p>Có nhiều mức giá đa dạng phù hợp với ngân sách và nhu cầu của bạn</p>
      </div>
      <div class="feature">
        <img src="{{ asset('storage/./Image/3436680.png') }}" alt="Booking dễ dàng">
        <h3>Booking dễ dàng</h3>
        <p>Các bước booking và chăm sóc khách hàng nhanh chóng và thuận tiện</p>
      </div>
      <div class="feature">
        <img src="{{ asset('storage/./Image/6194068.png') }}" alt="Tour du lịch tối ưu">
        <h3>Tour du lịch tối ưu</h3>
        <p>Đa dạng các loại hình tour du lịch với nhiều mức giá khác nhau</p>
      </div>
    </div>
  </section>

  <section class="booking-steps">
    <h2>Booking cùng DA NANG TOURS</h2>
    <p>Chỉ với 3 bước đơn giản và dễ dàng có ngay trải nghiệm tuyệt vời!</p>
    <div class="steps">
      <div class="step">
        <div class="step-number">1</div>
        <img src="{{ asset('storage/./Image/5086786.png') }}" alt="Tìm nơi muốn đến">
        <h3>Nơi muốn đến</h3>
        <p>Bất cứ nơi đâu bạn muốn đến, chúng tôi có tất cả những gì bạn cần</p>
      </div>
      <div class="step">
        <div class="step-number">2</div>
        <img src="{{ asset('storage/./Image/Icon_tai_san_bay3.webp') }}" alt="Đặt vé">
        <h3>Đặt vé</h3>
        <p>DA NANG TOURS sẽ hỗ trợ bạn đặt vé trực tiếp nhanh chóng và thuận tiện</p>
      </div>
      <div class="step">
        <div class="step-number">3</div>
        <img src="{{ asset('storage/./Image/4671.png_860.png') }}" alt="Thanh toán">
        <h3>Thanh toán</h3>
        <p>Hoàn thành bước thanh toán và sẵn sàng cho chuyến đi ngay thôi</p>
      </div>
    </div>
  </section>


  <!-- Search -->
    @yield('search-container')

  <script>
    // Tự động thiết lập giá trị "min" là ngày hôm nay + 1
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);

    const formattedDate = tomorrow.toISOString().split('T')[0];
    document.getElementById('departure-date').setAttribute('min', formattedDate);
  </script>


  <!-- Tour Giá Tốt -->
  <div class="container mt-5 giatot">
    <div class="title-row1">
      <h2 class="header1">Tour Giá Tốt</h2>

      @if (Auth::check())
      <a href="{{Route('user.tour')}}" class="a_tour">
      <p class="p_card">xem thêm tour<i class="bi bi-arrow-right"></i></p>
      </a>

    @else
      <a href="{{Route('guest.tour')}}" class="a_tour">
      <p class="p_card">xem thêm tour<i class="bi bi-arrow-right"></i></p>
      </a>
    @endif
    </div>

    <div class="deals-wrapper">
      <!-- Card 1 -->
      @yield('tour-card')
    </div>
  </div>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">



  <!-- Famous Locations -->
  <section class="diem-den">
    <div class="header">Điểm đến ưa thích</div>
    <div class="hang-card">
      @yield('card')

    </div>
  </section>



  <!-- Footer -->


</body>
<script>
  let currentReview = 0;
  const reviews = document.querySelectorAll('.review');

  function showReview(index) {
    reviews.forEach((review, i) => {
      review.classList.toggle('active', i === index); // Bật lớp "active" chỉ với đánh giá ở vị trí hiện tại
    });
  }

  function nextReview() {
    currentReview = (currentReview + 1) % reviews.length; // Di chuyển đến đánh giá tiếp theo
    showReview(currentReview);
  }

  function prevReview() {
    currentReview = (currentReview - 1 + reviews.length) % reviews.length; // Di chuyển đến đánh giá trước đó
    showReview(currentReview);
  }

  // Hiển thị đánh giá đầu tiên khi tải trang
  showReview(currentReview);
</script>
<script>
  let slideIndex = 0;

  function showSlide(n) {
    const slides = document.querySelector('.slides');
    const dots = document.querySelectorAll('.dot');
    const totalSlides = slides.children.length;

    slideIndex = (n + totalSlides) % totalSlides;
    slides.style.transform = `translateX(-${slideIndex * 100}%)`;

    dots.forEach(dot => dot.classList.remove('active'));
    dots[slideIndex].classList.add('active');
  }

  function changeSlide(n) {
    showSlide(slideIndex + n);
  }

  function currentSlide(n) {
    showSlide(n - 1);
  }

  function autoSlide() {
    changeSlide(1);
    setTimeout(autoSlide, 3000);
  }

  window.onload = autoSlide;
</script>

</html>