<?php 
include('../config/db.php'); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chi Tiết Dịch Vụ Tiêm Phòng & Tẩy Giun - Pet Care</title>
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --primary-color: #00bcd4;
    --primary-dark: #00838f;
    --accent-color: #ffb300;
    --bg-light: #f8fcff;
    --bg-card: #ffffff;
    --text-dark: #212529;
    --text-muted: #495057;
    --heading-font: 'Montserrat', sans-serif;
    --body-font: 'Poppins', sans-serif;
}

body {
    font-family: var(--body-font);
    background: var(--bg-light);
    color: var(--text-dark);
    line-height: 1.8;
    margin: 0;
}

.service-detail-container {
    max-width: 950px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ---------- Hero Banner ---------- */
.hero-banner-service {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: #fff;
    padding: 40px 20px;
    text-align: center;
    margin-bottom: 70px;
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
}
.hero-banner-service h1 {
    font-family: var(--heading-font);
    font-size: 48px;
    font-weight: 800;
    margin-bottom: 10px;
}
.hero-banner-service p {
    font-size: 20px;
    opacity: 0.9;
}

/* ---------- Long Form Section ---------- */
.long-form-section {
    background-color: var(--bg-card);
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
    margin-bottom: 70px;
}
.detail-heading {
    font-family: var(--heading-font);
    font-size: 30px;
    color: var(--primary-dark);
    font-weight: 700;
    text-align: center;
    margin-bottom: 50px;
}

/* ---------- Step Block ---------- */
.step-content-block {
    margin-bottom: 50px;
    padding-bottom: 30px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    gap: 40px;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease;
}
.step-content-block.show {
    opacity: 1;
    transform: translateY(0);
}
.step-content-block:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}
.step-number-lg {
    font-family: var(--heading-font);
    font-size: 60px;
    font-weight: 800;
    color: var(--accent-color);
    flex-shrink: 0;
    width: 80px;
    text-align: center;
}
.step-text {
    flex-grow: 1;
}
.step-text h4 {
    font-family: var(--heading-font);
    font-size: 24px;
    color: var(--primary-dark);
    font-weight: 700;
    margin-top: 15px;
    margin-bottom: 20px;
    border-bottom: 3px solid var(--accent-color);
    padding-bottom: 5px;
    display: inline-block;
}
.step-media-content {
    display: flex;
    gap: 30px;
    align-items: center;
}
.step-media-content.reverse {
    flex-direction: row-reverse;
}
.step-media-content img {
    max-width: 45%;
    height: auto;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}
.step-media-content img:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.media-text-wrapper {
    max-width: 55%;
}

/* ---------- CTA ---------- */
.cta-header-box {
    text-align: center;
    background: linear-gradient(45deg, #ffe0b2, #ffcc80);
    border-radius: 25px;
    padding: 60px 40px;
    margin-top: 60px;
    margin-bottom: 80px;
    box-shadow: 0 15px 35px rgba(255,179,0,0.3);
    transition: transform 0.3s, box-shadow 0.3s;
}
.cta-header-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 40px rgba(255,179,0,0.4);
}
.cta-header-box h4 {
    font-family: var(--heading-font);
    font-size: 32px;
    font-weight: 800;
    color: var(--primary-dark);
    margin-bottom: 10px;
}
.cta-header-box p {
    font-size: 18px;
    color: var(--text-dark);
    font-weight: 500;
    margin-bottom: 30px;
    line-height: 1.6;
}
.primary-btn {
    display: inline-block;
    background: #ff9800;
    color: #fff;
    padding: 15px 40px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 700;
    font-size: 18px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(255,152,0,0.4);
}
.primary-btn:hover {
    background: #f57c00;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(255,152,0,0.6);
}

/* ---------- Responsive ---------- */
@media(max-width:900px){
    .step-content-block { flex-direction: column; align-items: center; }
    .step-number-lg { font-size: 48px; width: auto; }
    .step-media-content, .step-media-content.reverse { flex-direction: column; gap: 20px; }
    .step-media-content img, .media-text-wrapper { max-width: 100%; }
    .step-text h4 { text-align: center; margin-top: 0; }
    .long-form-section { padding: 30px 20px; }
    .hero-banner-service h1 { font-size: 36px; }
    .hero-banner-service p { font-size: 18px; }
}
@media(max-width:576px){ 
    .cta-header-box { padding: 40px 20px; margin-bottom: 50px; }
    .cta-header-box h4 { font-size: 24px; }
    .cta-header-box p { font-size: 16px; }
    .primary-btn { padding: 12px 30px; font-size: 16px; }
    .hero-banner-service h1 { font-size: 30px; }
}
/* CSS Service Card - Dùng cho Tiêm Phòng & Tẩy Giun */
.services-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 15px;
}

.section-title {
    font-size: 32px;
    color: #00838f; /* Xanh đậm */
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
    font-family: 'Montserrat', sans-serif;
}

/* Card chính */
.service-card {
    background: linear-gradient(135deg, #e0f7fa, #b2ebf2); /* gradient nhẹ nhàng */
    border-radius: 20px;
    padding: 25px 20px;
    box-shadow: 0 10px 25px rgba(0, 188, 212, 0.15);
    text-align: center;
    margin-bottom: 40px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 188, 212, 0.25);
}

.service-card img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    margin: 0 auto 15px auto;
    border: 3px solid #00bcd4;
}

.service-card h3 {
    font-size: 24px;
    color: #00838f;
    margin-bottom: 10px;
    font-weight: 700;
    font-family: 'Montserrat', sans-serif;
}

.service-card p {
    font-size: 16px;
    color: #333;
    line-height: 1.6;
}

/* Responsive */
@media(max-width:768px){
    .services-container { margin: 30px auto; padding: 0 10px; }
    .service-card img { width: 80px; height: 80px; }
    .service-card h3 { font-size: 20px; }
    .service-card p { font-size: 15px; }
}

@media(max-width:576px){
    .service-card img { width: 70px; height: 70px; }
    .service-card h3 { font-size: 18px; }
    .service-card p { font-size: 14px; }
}

</style>
</head>
<body>

<?php include('../includes/header.php'); ?>

<main class="services-container">
    <h1 class="section-title">Tiêm Phòng & Tẩy Giun Chủ Động</h1>

    <div class="service-card">
        <img src="../assets/img/service/service8.png" alt="Tiêm Phòng & Tẩy Giun">
        <h3>Bảo Vệ Thú Cưng Toàn Diện</h3>
        <p>Xây dựng lá chắn miễn dịch toàn diện, bảo vệ thú cưng khỏi các bệnh truyền nhiễm nguy hiểm. Phác đồ tiêm phòng & tẩy giun được cá nhân hóa theo độ tuổi và sức khỏe.</p>
    </div>

<div class="service-detail-container">

<div class="long-form-section">
<h2 class="detail-heading"><i class="fas fa-notes-medical"></i> Chi Tiết Quy Trình Phòng Bệnh Chuyên Nghiệp</h2>

<div class="step-content-block">
<div class="step-number-lg">01.</div>
<div class="step-text">
<h4>Khám Sàng Lọc Sức Khỏe Tổng Quát Trước Tiêm Chủng</h4>
<div class="step-media-content">
<img src="../assets/img/service/service7.png" alt="Khám Sàng Lọc">
<div class="media-text-wrapper">
<p>Đây là bước <strong>quan trọng nhất</strong> để đảm bảo quá trình tiêm phòng an toàn và hiệu quả. Bác sĩ tiến hành khám <strong>lâm sàng kỹ lưỡng</strong>, đo thân nhiệt, kiểm tra tình trạng sức khỏe tổng thể.</p>
<p>Chỉ khi thú cưng hoàn toàn khỏe mạnh, không sốt, không dấu hiệu bệnh lý, chúng tôi mới tiến hành tiêm chủng. Chúng tôi sẽ <strong>tư vấn chuyên sâu</strong> về các loại vắc-xin dựa trên độ tuổi, giống loài, môi trường sống.</p>
</div>
</div>
</div>
</div>

<div class="step-content-block">
<div class="step-number-lg">02.</div>
<div class="step-text">
<h4>Thực Hiện Tiêm Chủng Theo Phác Đồ Nghiêm Ngặt</h4>
<div class="step-media-content reverse">
<img src="../assets/img/service/service8.png" alt="Tiêm chủng và hồ sơ">
<div class="media-text-wrapper">
<p>Pet Care sử dụng <strong>vắc-xin chất lượng cao</strong> được bảo quản theo chuẩn <strong>Cold Chain</strong>. Tiêm nhanh, chính xác, giảm thiểu stress cho thú cưng.</p>
<p>Thú cưng được cấp <strong>Sổ/Thẻ Tiêm Chủng</strong> ghi rõ loại vắc-xin, số lô, ngày tiêm, và ngày hẹn tiêm nhắc lại. Theo dõi sức khỏe dài hạn dễ dàng.</p>
</div>
</div>
</div>
</div>

<div class="step-content-block">
<div class="step-number-lg">03.</div>
<div class="step-text">
<h4>Kiểm Soát Ký Sinh Trùng Nội và Ngoại Kỹ Lưỡng</h4>
<div class="step-media-content">
<img src="../assets/img/service/service9.png" alt="Tẩy giun và phòng ngừa">
<div class="media-text-wrapper">
<p>Phòng ngừa ký sinh trùng là yếu tố then chốt. Chúng tôi cung cấp <strong>tẩy giun sán</strong> và <strong>phòng ngừa ve, rận, bọ chét</strong> toàn diện bằng thuốc phổ rộng, an toàn.</p>
<p>Bác sĩ xác định <strong>chu kỳ tẩy giun</strong> phù hợp với từng độ tuổi và theo dõi định kỳ để bảo vệ sức khỏe thú cưng.</p>
</div>
</div>
</div>
</div>

<div class="step-content-block">
<div class="step-number-lg">04.</div>
<div class="step-text">
<h4>Theo Dõi Phản Ứng Sau Tiêm và Nhắc Lịch Tự Động</h4>
<div class="step-media-content reverse">
<img src="../assets/img/service/service10.png" alt="Theo dõi và nhắc lịch">
<div class="media-text-wrapper">
<p>Hướng dẫn chi tiết theo dõi tại nhà, nhận biết và xử lý phản ứng phụ hiếm gặp. Hỗ trợ 24h qua điện thoại/Zalo.</p>
<p>Hệ thống tự động <strong>nhắc lịch tiêm nhắc lại</strong> và tẩy giun qua email hoặc tin nhắn. Giữ miễn dịch liên tục cho thú cưng.</p>
</div>
</div>
</div>
</div>

</div>

<div class="cta-header-box">
<h4>Đừng Chờ Đợi Đến Khi Bệnh!</h4>
<p>Chủ động xây dựng lá chắn miễn dịch cho thú cưng ngay hôm nay. Đặt lịch tư vấn phác đồ tiêm phòng cá nhân hóa với chuyên gia Pet Care!</p>
<a href="<?= $BASE_URL ?>/user/booking.php" class="primary-btn">Đặt Lịch Tư Vấn Tiêm Phòng Ngay</a>
</div>
</div>
</main>

<?php include('../includes/footer.php'); ?>

<script>
    // Animation khi scroll
    const steps = document.querySelectorAll('.step-content-block');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('show');
            }
        });
    }, { threshold: 0.2 });
    steps.forEach(step => observer.observe(step));
</script>

</body>
</html>
