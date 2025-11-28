<?php 
include('config/db.php'); // db.php đã tự session_start() nếu cần
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Giới thiệu - PetCare</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    /* ===== Timeline CSS ===== */
   /* ===== Timeline CSS CẢI TIẾN ===== */
.timeline {
  position: relative;
  margin: 50px 0;
  padding-left: 60px; /* rộng hơn để icon không bị chạm */
}

.timeline::before {
  content: '';
  position: absolute;
  left: 20px;
  top: 0;
  bottom: 0;
  width: 4px;
  background: linear-gradient(to bottom, #00bcd4, #4dd0e1);
  border-radius: 2px;
}

.timeline li {
  position: relative;
  margin-bottom: 40px;
  padding-left: 20px;
  list-style: none;
  font-size: 16px;
  color: var(--text-dark);
}

.timeline li::before {
  content: "🐾"; /* Dấu chân thú cưng */
  position: absolute;
  left: -36px;
  top: 0;
  width: 36px;
  height: 36px;
  line-height: 36px;
  font-size: 20px;
  background: #fff;
  border-radius: 50%;
  text-align: center;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  transition: transform 0.3s, background 0.3s, color 0.3s;
  border: 3px solid #00bcd4;
}

.timeline li:hover::before {
  transform: scale(1.4) rotate(15deg);
  color: #fff;
  background: #00bcd4;
  border-color: #0097a7;
}

.timeline li b {
  font-weight: 700;
  color: var(--primary-dark);
  display: block;
  margin-bottom: 5px;
}


    /* ===== Mission / Vision / Slogan ===== */
    .mission-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      margin-top: 30px;
    }
    .mission-grid .card {
      padding: 30px 20px;
      border-radius: 20px;
      background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
      box-shadow: 0 10px 25px rgba(0, 188, 212, 0.15);
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
      position: relative;
    }
    .mission-grid .card::after {
      content: '';
      position: absolute;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: rgba(0, 188, 212, 0.1);
      top: -20px;
      left: calc(50% - 30px);
      z-index: 0;
    }
    .mission-grid .card h3 {
      font-size: 22px;
      color: var(--primary-dark);
      margin-bottom: 15px;
      position: relative;
      z-index: 1;
    }
    .mission-grid .card p {
      font-size: 15px;
      color: var(--text-dark);
      position: relative;
      z-index: 1;
      line-height: 1.6;
    }
    .mission-grid .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 40px rgba(0, 188, 212, 0.25);
    }

    /* ===== Section Divider ===== */
    .section-divider {
      border: none;
      border-top: 1px solid #e0e0e0;
      margin: 40px auto;
      width: 80%;
    }

    /* ===== Banner Sub ===== */
    .banner-sub {
  position: relative;
  height: 300px; /* cao hơn để đủ chỗ ảnh */
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 40px;
  overflow: hidden;
  border-radius: 15px;
}

.banner-sub::before {
  content: '';
  position: absolute;
  inset: 0;
  background-color: rgba(36, 153, 179, 0.3); /* lớp phủ tối nhẹ để chữ nổi bật */
  z-index: 1;
}

.banner-inner-sub {
  position: relative;
  z-index: 2;
  display: flex;
  flex-direction: row; /* chữ + ảnh nằm cạnh nhau */
  align-items: center;
  justify-content: center;
  gap: 30px;
  flex-wrap: wrap;
  color: #fff;
}

.banner-inner-sub img {
  width: 200px;
  max-width: 45%;
  border-radius: 15px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

.banner-inner-sub .text {
  max-width: 500px;
  text-align: left;
}

.banner-inner-sub h1 {
  font-size: 36px;
  margin: 0 0 10px;
  font-weight: 700;
  letter-spacing: 1px;
}

.banner-inner-sub p {
  font-size: 16px;
  margin: 0;
  line-height: 1.5;
}

/* Responsive */
@media(max-width: 768px) {
  .banner-inner-sub {
    flex-direction: column;
    text-align: center;
  }
  .banner-inner-sub img {
    width: 60%;
    max-width: 250px;
  }
  .banner-inner-sub .text {
    max-width: 100%;
  }
}


    /* ===== Responsive ===== */
    @media(max-width: 768px) {
      .mission-grid { grid-template-columns: 1fr; }
      .timeline { padding-left: 20px; }
      .timeline li { padding-left: 25px; }
    }

    /* ===== Introduction & Services ===== */
.intro-section {
    line-height: 1.8; /* giãn dòng để đọc dễ hơn */
    font-size: 16px;
    color: var(--text-dark);
    margin-top: 30px;
}

.intro-section p {
    margin-bottom: 20px;
    transition: transform 0.3s ease, color 0.3s ease;
}

/* Highlight nhẹ khi hover paragraph */
.intro-section p:hover {
    transform: translateX(5px);
    color: #0097a7;
}

/* Subsection title */
.subsection-title {
    font-size: 22px;
    margin: 25px 0 15px;
    color: var(--primary-dark);
    position: relative;
}

/* Thêm đường kẻ sáng tạo bên cạnh title */
.subsection-title::before {
    content: '';
    position: absolute;
    left: -25px;
    top: 50%;
    transform: translateY(-50%);
    width: 6px;
    height: 100%;
    background: linear-gradient(to bottom, #00bcd4, #4dd0e1);
    border-radius: 3px;
}

/* Danh sách dịch vụ */
.service-list {
    list-style: none;
    padding-left: 0;
}

.service-list li {
    background: rgba(0, 188, 212, 0.05);
    margin-bottom: 15px;
    padding: 15px 20px;
    border-radius: 12px;
    transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
}

.service-list li:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    background: rgba(0, 188, 212, 0.15);
}

.service-list li b {
    color: #007c91;
    font-weight: 600;
}

/* Responsive */
@media(max-width: 768px) {
    .intro-section p {
        font-size: 15px;
    }
    .subsection-title::before {
        left: -15px;
    }
    .service-list li {
        padding: 12px 15px;
    }
}

  </style>
</head>
<body>

<?php include('includes/header.php'); ?>


<main class="container">

  <!-- Banner -->
  <section class="banner-sub">
    <div class="banner-inner-sub">
    <img src="assets/img/doctor-with-golden.png" alt="Bác sĩ thú y chăm sóc chú chó Golden Retriever">

      <h1>Chào Mừng Đến Với Pet Care</h1>
      <p>Nơi Sức Khỏe và Hạnh Phúc Của Thú Cưng Được Đặt Lên Hàng Đầu.</p>
    </div>
  </section>

  <!-- Mission / Vision -->
  <section class="section mission-section">
    <h2 class="section-title-mini">SỨ MỆNH & TẦM NHÌN</h2>
    <h2 class="section-title">Giá trị cốt lõi của chúng tôi</h2>
    <div class="mission-grid">
      <div class="card">
        <h3>Sứ Mệnh</h3>
        <p>Đảm bảo mỗi thú cưng đều nhận được sự chăm sóc tốt nhất, sống khỏe mạnh và hạnh phúc.</p>
      </div>
      <div class="card">
        <h3>Mục Tiêu & Phương Pháp</h3>
        <p>Kết hợp y học tiên tiến, thiết bị hiện đại và sự tận tâm trong mọi ca chăm sóc để mang lại chất lượng điều trị cao nhất.</p>
      </div>
      <div class="card">
        <h3>Châm Ngôn</h3>
        <p>“Chăm sóc bằng cả trái tim, chữa lành bằng cả chuyên môn.”</p>
      </div>
      <div class="card">
        <h3>Tầm Nhìn</h3>
        <p>Trở thành chuỗi Trung tâm Thú y & Pet Center được tin cậy hàng đầu tại Việt Nam.</p>
      </div>
    </div>
  </section>

  <hr class="section-divider">

  <!-- Timeline -->
  <section class="section history-section">
    <h2 class="section-title-mini">HÀNH TRÌNH</h2>
    <h2 class="section-title">Dòng thời gian phát triển</h2>
    <ul class="timeline">
      <li><b>2015:</b> Khởi đầu: Thành lập Pet Care với quy mô phòng khám nhỏ, tập trung dịch vụ cơ bản.</li>
      <li><b>2017:</b> Mở rộng Y tế: Đầu tư máy móc y tế chuyên sâu (X-quang, xét nghiệm), nâng cao chẩn đoán.</li>
      <li><b>2019:</b> Phát triển Toàn diện (Pet Center): Thêm Spa & Grooming, Pet Hotel, mô hình toàn diện.</li>
      <li><b>2022:</b> Phục vụ hơn [10,000] lượt khách hàng thân thiết, đạt chứng nhận ISO 9001.</li>
      <li><b>2025:</b> Mục tiêu tương lai: Khai trương chi nhánh mới và áp dụng công nghệ [Hồ sơ điện tử/Telemedicine].</li>
    </ul>
  </section>

  <hr class="section-divider">

  <!-- Introduction & Services -->
 <section class="section intro-section">
    <h2 class="section-title-mini">GIỚI THIỆU CHUYÊN SÂU</h2>
    <h2 class="section-title">Pet Care: Chăm Sóc Toàn Diện Cho Người Bạn Bốn Chân</h2>
    <p>
        Tại Pet Care, chúng tôi được định hình bởi niềm tin cốt lõi: mỗi thú cưng xứng đáng được tận hưởng một cuộc sống khỏe mạnh, hạnh phúc và đầy đủ. Chúng tôi hiểu rõ mối liên kết vô giá giữa bạn và người bạn bốn chân của mình, đó là lý do chúng tôi không ngừng nỗ lực để cung cấp một hệ sinh thái chăm sóc toàn diện. Pet Care tự hào là nơi hội tụ giữa y học thú y tiên tiến nhất** và dịch vụ chăm sóc tận tâm, tạo ra một môi trường an toàn và đáng tin cậy. Đội ngũ bác sĩ và nhân viên của chúng tôi luôn làm việc với sự chuyên nghiệp cao nhất và tình yêu thương vô bờ bến, cam kết đồng hành cùng bạn từ những cột mốc phát triển đầu tiên đến những khoảnh khắc cần sự hỗ trợ y tế chuyên sâu, đảm bảo chất lượng cuộc sống tối ưu cho thú cưng của bạn.
    </p>
    
    <h3 class="subsection-title">Trụ Cột Dịch Vụ Của Chúng Tôi</h3>
    <ul class="service-list">
        <li>
            <b>🩺 Dịch Vụ Y Tế Chuyên Sâu & Công Nghệ Cao:</b> 
            Cung cấp đầy đủ các dịch vụ từ Khám tổng quát định kỳ, chẩn đoán hình ảnh hiện đại (Siêu âm, X-quang), Xét nghiệm chuyên sâu, Tiêm phòng, Tẩy giun theo phác đồ chuẩn, Phẫu thuật (bao gồm phẫu thuật phức tạp và triệt sản) và hỗ trợ Cấp cứu 24/7 (Nếu có) với quy trình vô trùng nghiêm ngặt.
        </li>
        <li>
            <b>🛀 Dịch Vụ Chăm Sóc & Tiện Ích Đẳng Cấp:</b> 
            Đảm bảo sự thoải mái và vẻ ngoài hoàn hảo thông qua Spa & Grooming chuyên nghiệp; Pet Hotel cao cấp với hệ thống phòng lưu trú sạch sẽ, có giám sát y tế liên tục; cùng Pet Shop cung cấp các sản phẩm Dinh dưỡng và Phụ kiện chính hãng được các chuyên gia khuyên dùng.
        </li>
    </ul>
</section>

  <hr class="section-divider">

  <!-- Contact / Call to action -->
  <section class="section contact-section">
    <h2 class="section-title-mini">LIÊN HỆ</h2>
    <h2 class="section-title">Đặt lịch hoặc trải nghiệm dịch vụ ngay</h2>
</main>

<?php include('includes/footer.php'); ?>


</body>
</html>
