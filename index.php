<?php include('config/db.php'); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Trung Tâm Thú Y PetCare</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

<?php include('includes/header.php'); ?>


<section class="banner-new">
  <div class="container banner-content">
    <div class="banner-text">
      <h1>CHĂM SÓC TỐT NHẤT CHO NGƯỜI BẠN BỐN CHÂN YÊU QUÝ</h1>
      <p>Khám - Điều trị - Tiêm phòng - Tư vấn dinh dưỡng chuyên nghiệp, tận tâm.</p>
      <?php if($isLoggedIn): ?>
        <a href="user/booking.php" class="btn primary-btn">ĐẶT LỊCH NGAY</a>
      <?php else: ?>
        <a href="user/login.php" class="btn primary-btn">ĐĂNG NHẬP / ĐĂNG KÝ</a>
      <?php endif; ?>
    </div> 
    <div class="banner-image">
      <img src="assets/img/doctor-with-golden.png" alt="Bác sĩ thú y chăm sóc chú chó Golden Retriever">
    </div>
  </div>
</section>

<main class="container">
<section class="section intro-section">
  <div class="intro-grid">
    <div class="intro-text">
      <h2 class="section-title-mini">VỀ CHÚNG TÔI</h2>
      <h2 class="section-title">Nâng Tầm Sức Khỏe & Hạnh Phúc Cho Thú Cưng Việt Nam</h2>
      <p>
        Trung Tâm Thú Y <b>PetCare</b> với đội ngũ bác sĩ giàu kinh nghiệm, cơ sở vật chất hiện đại, và phương pháp điều trị tiên tiến nhất. 
        Chúng tôi cam kết mang lại chất lượng dịch vụ tốt nhất, tận tâm nhất cho từng người bạn bốn chân.
      </p>

      <div class="stats-grid">
        <div class="stat-item">
          <span class="stat-number">10+</span>
          <p class="stat-label">Năm kinh nghiệm</p>
        </div>
        <div class="stat-item">
          <span class="stat-number">15K+</span>
          <p class="stat-label">Ca phục hồi thành công</p>
        </div>
        <div class="stat-item">
          <span class="stat-number">24/7</span>
          <p class="stat-label">Đồng hành và hỗ trợ liên tục</p>
        </div>
      </div>
    </div>
    <div class="intro-image-container">
      <img src="assets/img/gallery3.jpg" alt="Phòng khám PetCare" class="intro-main-image">
    </div>
  </div>
</section>
  
  <hr class="section-divider">

  <section class="section service-section">
    <h2 class="section-title-mini">DỊCH VỤ</h2>
    <h2 class="section-title">Dịch Vụ Nổi Bật Tại PetCare</h2>
    <div class="grid service-grid">
      <div class="service-card">
        <div class="service-icon">🔬</div>
        <h3>Khám & Xét nghiệm</h3>
        <p>Kiểm tra sức khỏe định kỳ, chẩn đoán hình ảnh tiên tiến.</p>
        <a href="services.php" class="link">Tìm hiểu →</a>
      </div>
      <div class="service-card">
        <div class="service-icon">💉</div>
        <h3>Tiêm phòng & Điều trị</h3>
        <p>Phác đồ tiêm phòng chuẩn, điều trị nội/ngoại khoa hiệu quả.</p>
        <a href="services.php" class="link">Tìm hiểu →</a>
      </div>
      <div class="service-card">
        <div class="service-icon">🛁</div>
        <h3>Grooming & Spa</h3>
        <p>Dịch vụ tắm, cắt tỉa chuyên nghiệp, giúp thú cưng luôn sạch đẹp.</p>
        <a href="services.php" class="link">Tìm hiểu →</a>
      </div>
    </div>
  </section>

  <hr class="section-divider">

  <section class="section promotion-section-new">
    <div class="container">
      <div class="promotion-header">
        <div class="promo-text-wrap">
          <h2 class="section-title-mini-left">SIÊU ƯU ĐÃI!</h2>
          <p class="promo-subtitle">Duy nhất trong tháng này!</p>
        </div>
        <div class="promo-image-group">
          <img src="assets/img/dog3.png" alt="Chú chó dễ thương" class="promo-dog-img">
        </div>
      </div>

      <div class="grid promotion-grid-new">
        <div class="promo-card-new">
          <div class="hot-tag">HOT!</div>
          <img src="assets/img/dog-tiem.png" alt="Tiêm phòng" class="promo-card-img">
          <h3>Giảm 15% Tiêm Phòng</h3>
          <p>Bảo vệ sức khỏe toàn diện cho thú cưng của bạn.</p>
          <?php if($isLoggedIn): ?>
            <a href="user/booking.php" class="btn primary-btn">ĐẶT LỊCH NGAY</a>
          <?php else: ?>
            <a href="user/login.php" class="btn primary-btn">ĐẶT LỊCH NGAY</a>
          <?php endif; ?>
        </div>

        <div class="promo-card-new light-blue">
          <img src="assets/img/dog-trietsan.png" alt="Triệt sản mèo" class="promo-card-img">
          <h3>Triệt Sản An Toàn</h3>
          <p>Trọn gói chỉ từ 999K, an toàn tuyệt đối.</p>
          <?php if($isLoggedIn): ?>
            <a href="user/booking.php" class="btn primary-btn">ĐẶT LỊCH NGAY</a>
          <?php else: ?>
            <a href="user/login.php" class="btn primary-btn">ĐẶT LỊCH NGAY</a>
          <?php endif; ?>
        </div>

        <div class="promo-card-new light-orange">
          <img src="assets/img/dog-kham.png" alt="Triệt sản chó" class="promo-card-img">
          <h3>Gói chăm sóc toàn diện</h3>
          <p>Tiết kiệm đến 20%, bao gồm khám – tiêm – xét nghiệm.</p>
          <?php if($isLoggedIn): ?>
            <a href="user/booking.php" class="btn primary-btn">ĐẶT LỊCH NGAY</a>
          <?php else: ?>
            <a href="user/login.php" class="btn primary-btn">ĐẶT LỊCH NGAY</a>
          <?php endif; ?>
        </div>

        <div class="promo-card-new light-gray">
        <img src="assets/img/0d.png" alt="0đ" class="promo-card-img">
          <h3>Miễn Phí Khám Tổng Quát</h3>
          <p>Không kèm dịch vụ khác, áp dụng lần đầu.</p>
          <?php if($isLoggedIn): ?>
            <a href="user/booking.php" class="btn primary-btn">ĐẶT LỊCH NGAY</a>
          <?php else: ?>
            <a href="user/login.php" class="btn primary-btn">ĐẶT LỊCH NGAY</a>
          <?php endif; ?>
        </div>
      </div>

      <h2 class="section-title-mini-left" style="margin-top:50px;">SẮP KẾT THÚC!</h2>
      <div class="grid ending-promo-grid">
        <div class="ending-promo-card">
          <div class="ending-card-content">
            <h4>Giảm 20% Tiêm Phòng</h4>
            <p>Bảo vệ sức khoẻ toàn diện</p>
          </div>
          <div class="ending-countdown">
            <span class="countdown-label">LAST</span>
            <span class="countdown-time" data-countdown="true">00:00:00</span>
          </div>
        </div>
        <div class="ending-promo-card">
          <div class="ending-card-content">
            <h4>Giảm Phí Thăm Sóc Cắt Tỉa</h4>
            <p>Chăm sóc & làm đẹp toàn diện</p>
          </div>
          <div class="ending-countdown">
            <span class="countdown-label">LAST</span>
            <span class="countdown-time" data-countdown="true">00:00:00</span>
          </div>
        </div>
        <div class="ending-promo-card">
          <div class="ending-card-content">
            <h4>Giảm Phí Thăm Khám X-Quang</h4>
            <p>Chẩn đoán hình ảnh chuyên sâu</p>
          </div>
          <div class="ending-countdown">
            <span class="countdown-label">LAST</span>
            <span class="countdown-time" data-countdown="true">00:00:00</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <hr class="section-divider">

  <section class="section doctor-section">
    <h2 class="section-title-mini">ĐỘI NGŨ</h2>
    <h2 class="section-title">Các Bác Sĩ Tận Tâm, Chuyên Nghiệp</h2>
    <div class="grid doctor-grid">
      <div class="card doctor-card">
  <img src="assets/img/doctors/doctor-nhan.jpg" alt="BS Phan Thành Đức Nhân">
  <h3>BS. Phan Thành Đức Nhân</h3>
  <p>Chuyên khoa Phẫu thuật – Cấp cứu, Chẩn đoán hình ảnh (Siêu âm, X-Quang). Phụ trách xử lý các ca ngoại khoa và cấp cứu khẩn cấp.</p>
  <a href="doctors.php" class="link">Xem hồ sơ →</a>
</div>

<div class="card doctor-card">
  <img src="assets/img/doctors/doctor-tina.jpg" alt="BS Trần Ti Na">
  <h3>BS. Trần Ti Na</h3>
  <p>Chuyên khoa Xét nghiệm & Chẩn đoán chuyên sâu. Phân tích kết quả máu, nước tiểu và hỗ trợ điều trị các bệnh lý phức tạp.</p>
  <a href="doctors.php" class="link">Xem hồ sơ →</a>
</div>

<div class="card doctor-card">
  <img src="assets/img/doctors/doctor-duy.jpg" alt="BS Đào Văn Duy">
  <h3>BS. Đào Văn Duy</h3>
  <p>Chuyên khoa Nội tổng quát. Khám sức khỏe định kỳ, điều trị bệnh lý nội khoa như tiêu hóa, hô hấp, da liễu và tư vấn dinh dưỡng.</p>
  <a href="doctors.php" class="link">Xem hồ sơ →</a>
</div>

    </div>
  </section>

  <hr class="section-divider">

  <section class="section testimonials">
    <div class="container">
        <h2 class="section-title-mini">PHẢN HỒI KHÁCH HÀNG</h2>
        <h2 class="section-title">Khách Hàng Nói Gì Về PetCare</h2>
        
        <div class="grid testimonial-list-new">
            
            <div class="card testimonial-card light-blue">
                <div class="testimonial-header">
                    <span class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </span>
                    <span class="date-review">25/11/2025</span>
                </div>
                <p class="quote-text">"Dịch vụ tiêm phòng và xét nghiệm máu rất nhanh chóng, chuyên nghiệp. Bác sĩ tư vấn rất rõ ràng về phác đồ chăm sóc cho bé nhà mình."</p>
                <div class="reviewer-info">
                    <span class="reviewer-name">Mai Anh</span>
                    <span class="pet-name">của bé Vàng (Golden)</span>
                </div>
            </div>

            <div class="card testimonial-card light-orange">
                <div class="testimonial-header">
                    <span class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </span>
                    <span class="date-review">20/11/2025</span>
                </div>
                <p class="quote-text">"Phòng khám sạch sẽ, không gian thoáng đãng. Tôi ấn tượng nhất với sự kiên nhẫn của nhân viên khi khám cho mèo cưng nhà tôi."</p>
                <div class="reviewer-info">
                    <span class="reviewer-name">Ngọc Trâm</span>
                    <span class="pet-name">của bé Miu (Mèo Anh)</span>
                </div>
            </div>

            <div class="card testimonial-card light-gray">
                <div class="testimonial-header">
                    <span class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </span>
                    <span class="date-review">15/11/2025</span>
                </div>
                <p class="quote-text">"Mình đã từng dùng dịch vụ phẫu thuật ở đây, mọi thứ diễn ra suôn sẻ, quy trình hậu phẫu cũng được theo dõi rất kỹ lưỡng."</p>
                <div class="reviewer-info">
                    <span class="reviewer-name">Thành Long</span>
                    <span class="pet-name">của bé Kiki (Poodle)</span>
                </div>
            </div>
            
            <div class="card testimonial-card light-blue">
                <div class="testimonial-header">
                    <span class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </span>
                    <span class="date-review">10/11/2025</span>
                </div>
                <p class="quote-text">"Hệ thống nhắc lịch tự động rất tiện lợi, giúp tôi không bao giờ quên lịch tiêm nhắc lại cho bé cún. Yêu thích sự chu đáo này."</p>
                <div class="reviewer-info">
                    <span class="reviewer-name">Hoàng Yến</span>
                    <span class="pet-name">của bé Boss (Husky)</span>
                </div>
            </div>
            
            <div class="card testimonial-card light-orange">
                <div class="testimonial-header">
                    <span class="rating-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </span>
                    <span class="date-review">05/11/2025</span>
                </div>
                <p class="quote-text">"Giá cả phải chăng, thái độ bác sĩ chuyên nghiệp. Luôn là lựa chọn hàng đầu của gia đình tôi mỗi khi thú cưng có vấn đề sức khỏe."</p>
                <div class="reviewer-info">
                    <span class="reviewer-name">Minh Đức</span>
                    <span class="pet-name">của bé Lucky (Mèo Ba Tư)</span>
                </div>
            </div>
<div class="card testimonial-card light-blue">
    <div class="testimonial-header">
        <span class="rating-stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </span>
        <span class="date-review">01/11/2025</span>
    </div>
    <p class="quote-text">"Mình đưa bé đi khám tổng quát định kỳ. Bác sĩ siêu âm rất kỹ và giải thích chi tiết về chế độ dinh dưỡng cho giống chó Bully."</p>
    <div class="reviewer-info">
        <span class="reviewer-name">Gia Hân</span>
        <span class="pet-name">của bé Bon (Bulldog)</span>
    </div>
</div>
       </div> 
        <div class="view-more-action-right">
            <a href="feedback.php" class="btn primary-btn small-btn">
                Xem Thêm & Gửi Đánh Giá <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
            </a>
        </div>
        
    </div>
</section>
</main>

<?php include('includes/footer.php'); ?>

<script>
// Đếm ngược 2 giờ (02:00:00 -> 00:00:00) dùng chung cho 3 thẻ ưu đãi
document.addEventListener('DOMContentLoaded', function () {
  const clocks = document.querySelectorAll('.countdown-time[data-countdown="true"]');
  if (!clocks.length) return;

  const DURATION_MS = 2 * 60 * 60 * 1000; // 2 giờ
  const endTime = Date.now() + DURATION_MS;

  function updateClocks() {
    const now = Date.now();
    let remaining = endTime - now;
    if (remaining <= 0) {
      remaining = 0;
      clearInterval(timerId);
    }

    const totalSeconds = Math.floor(remaining / 1000);
    const hh = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
    const mm = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
    const ss = String(totalSeconds % 60).padStart(2, '0');
    const timeStr = `${hh}:${mm}:${ss}`;

    clocks.forEach(el => el.textContent = timeStr);
  }

  updateClocks();                      // cập nhật ngay khi load
  const timerId = setInterval(updateClocks, 1000); // sau đó cập nhật mỗi giây
});
</script>

</body>
</html>