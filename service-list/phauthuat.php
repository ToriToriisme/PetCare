<?php 
include('../config/db.php'); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Phẫu Thuật & Cấp Cứu Thú Cưng - Pet Care</title>
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
    --heading-font: 'Montserrat', sans-serif;
    --body-font: 'Poppins', sans-serif;
}

body {
    font-family: var(--body-font);
    background: var(--bg-light);
    color: var(--text-dark);
    margin: 0;
    line-height: 1.8;
}

.service-detail-container {
    max-width: 950px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Hero Banner */
.hero-banner-service {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: #fff;
    text-align: center;
    padding: 40px 20px;
    margin-bottom: 70px;
    border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
}
.hero-banner-service h1 {
    font-family: var(--heading-font);
    font-size: 48px;
    font-weight: 800;
}
.hero-banner-service p {
    font-size: 20px;
    opacity: 0.9;
}

/* Service Card */
.services-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 15px;
}
.section-title {
    font-size: 32px;
    color: var(--primary-dark);
    font-weight: 700;
    text-align: center;
    margin-bottom: 30px;
    font-family: var(--heading-font);
}
.service-card {
    background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
    border-radius: 20px;
    padding: 25px 20px;
    box-shadow: 0 10px 25px rgba(0,188,212,0.15);
    text-align: center;
    margin-bottom: 40px;
    transition: transform 0.3s, box-shadow 0.3s;
}
.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,188,212,0.25);
}
.service-card img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto 15px;
    border: 3px solid var(--primary-color);
}
.service-card h3 {
    font-size: 24px;
    color: var(--primary-dark);
    font-weight: 700;
    margin-bottom: 10px;
}
.service-card p {
    font-size: 16px;
    color: #333;
    line-height: 1.6;
}

/* Long Form Section */
.long-form-section {
    background-color: var(--bg-card);
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
    margin-bottom: 70px;
}
.detail-heading {
    font-family: var(--heading-font);
    font-size: 30px;
    font-weight: 700;
    color: var(--primary-dark);
    text-align: center;
    margin-bottom: 50px;
}
.step-content-block {
    display: flex;
    gap: 40px;
    margin-bottom: 50px;
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
    flex: 1;
}
.step-text h4 {
    font-family: var(--heading-font);
    font-size: 24px;
    color: var(--primary-dark);
    font-weight: 700;
    margin-bottom: 20px;
    border-bottom: 3px solid var(--accent-color);
    padding-bottom: 5px;
    display: inline-block;
}
.step-text p {
    font-size: 16px;
    color: #333;
    margin-bottom: 10px;
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
    width: 45%;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

/* CTA */
.cta-header-box {
    text-align: center;
    background: linear-gradient(45deg, #ffe0b2, #ffcc80);
    border-radius: 25px;
    padding: 60px 40px;
    margin-top: 60px;
    margin-bottom: 80px;
    box-shadow: 0 15px 35px rgba(255,179,0,0.3);
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
    line-height: 1.6;
    margin-bottom: 30px;
}
.primary-btn {
    display: inline-block;
    background: #ff9800;
    color: #fff;
    padding: 15px 40px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 18px;
    text-decoration: none;
}
.primary-btn:hover {
    background: #f57c00;
}
</style>
</head>
<body>

<?php include('../includes/header.php'); ?>

<main class="services-container">

<h1 class="section-title">Phẫu Thuật & Cấp Cứu Thú Cưng</h1>

<div class="service-card">
    <img src="../assets/img/service/service6.png" alt="Phẫu Thuật Thú Cưng">
    <h3>An Toàn – Đội Ngũ Bác Sĩ Uy Tín</h3>
    <p>Mọi ca phẫu thuật và cấp cứu đều được thực hiện bởi <strong>bác sĩ chuyên khoa giàu kinh nghiệm</strong>, với thiết bị hiện đại, giám sát sát sao để đảm bảo an toàn tối đa cho thú cưng.</p>
</div>

<div class="service-detail-container">
<div class="long-form-section">
<h2 class="detail-heading"><i class="fas fa-user-md"></i> Năng lực & Quy trình chuyên nghiệp</h2>

<div class="step-content-block">
<div class="step-number-lg">01.</div>
<div class="step-text">
<h4>Chẩn đoán & Đánh giá toàn diện</h4>
<div class="step-media-content">
<img src="../assets/img/service-list/pt1.png" alt="Chẩn đoán trước phẫu thuật">
<div class="media-text-wrapper">
<p>Bác sĩ tiến hành <strong>khám lâm sàng toàn diện</strong>, siêu âm, xét nghiệm để đánh giá sức khỏe và chuẩn bị kế hoạch phẫu thuật tối ưu.</p>
<p>Đảm bảo <strong>an toàn tuyệt đối</strong> ngay cả với các ca cấp cứu khẩn cấp.</p>
</div>
</div>
</div>
</div>

<div class="step-content-block">
<div class="step-number-lg">02.</div>
<div class="step-text">
<h4>Thực hiện phẫu thuật bởi chuyên gia</h4>
<div class="step-media-content reverse">
<img src="../assets/img/service-list/pt2.png" alt="Phẫu thuật chuyên nghiệp">
<div class="media-text-wrapper">
<p>Đội ngũ bác sĩ giàu kinh nghiệm thực hiện <strong>phẫu thuật triệt sản, nội tạng, chỉnh hình, lấy dị vật</strong> theo tiêu chuẩn y khoa.</p>
<p>Mọi thao tác đều <strong>vô trùng tuyệt đối</strong>, đảm bảo giảm thiểu rủi ro và stress cho thú cưng.</p>
</div>
</div>
</div>
</div>

<div class="step-content-block">
<div class="step-number-lg">03.</div>
<div class="step-text">
<h4>Hậu phẫu & Theo dõi 24/7</h4>
<div class="step-media-content">
<img src="../assets/img/service-list/pt3.png" alt="Theo dõi hậu phẫu">
<div class="media-text-wrapper">
<p>Thú cưng được <strong>theo dõi sát sao sau phẫu thuật</strong> tại phòng hồi sức, quản lý đau và tình trạng sinh tồn.</p>
<p>Bác sĩ luôn sẵn sàng hỗ trợ qua điện thoại/Zalo, đảm bảo thú cưng hồi phục nhanh và an toàn.</p>
</div>
</div>
</div>
</div>

<div class="step-content-block">
<div class="step-number-lg">04.</div>
<div class="step-text">
<h4>Quản lý hồ sơ & Chăm sóc dài hạn</h4>
<div class="step-media-content reverse">
<img src="../assets/img/service-list/pt4.png" alt="Hồ sơ & chăm sóc">
<div class="media-text-wrapper">
<p>Mọi ca phẫu thuật được lưu hồ sơ chi tiết: loại phẫu thuật, thuốc sử dụng, ngày thực hiện.</p>
<p>Chúng tôi cung cấp hướng dẫn chăm sóc tại nhà và lịch tái khám theo dõi sức khỏe để duy trì an toàn lâu dài.</p>
</div>
</div>
</div>
</div>

</div>

<div class="cta-header-box">
<h4>Đảm Bảo An Toàn – Tăng Độ Tin Cậy</h4>
<p>Liên hệ ngay với Pet Care để được tư vấn chuyên nghiệp về các ca phẫu thuật và cấp cứu. Đội ngũ bác sĩ giàu kinh nghiệm luôn sẵn sàng!</p>
<a href="<?= $BASE_URL ?>/user/booking.php" class="primary-btn"><i class="fas fa-phone-alt"></i> Liên Hệ Ngay</a>
</div>

</div>
</main>

<?php include('../includes/footer.php'); ?>

</body>
</html>
