<?php 
include('../config/db.php'); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Khách Sạn Thú Cưng - PetCare</title>

<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --primary-color: #00bcd4;
    --primary-dark: #00838f;
    --accent-color: #ff9800;
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
    background: linear-gradient(135deg, #f1f8e9, #dcedc8);
    border-radius: 20px;
    padding: 25px 20px;
    box-shadow: 0 10px 25px rgba(0, 188, 212, 0.15);
    text-align: center;
    margin-bottom: 50px;
    transition: transform 0.3s, box-shadow 0.3s;
}
.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 188, 212, 0.25);
}
.service-card img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    margin: 0 auto 15px auto;
    border: 3px solid var(--primary-color);
}
.service-card h3 {
    font-size: 24px;
    color: var(--primary-dark);
    margin-bottom: 10px;
    font-weight: 700;
}
.service-card p {
    font-size: 16px;
    color: #333;
    line-height: 1.6;
}

/* Nội dung dài */
.long-form-section {
    background-color: var(--bg-card);
    border-radius: 20px;
    padding: 50px 30px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.08);
    margin-bottom: 70px;
}

.detail-heading {
    font-family: var(--heading-font);
    font-size: 32px;
    font-weight: 700;
    color: var(--primary-dark);
    text-align: center;
    margin-bottom: 50px;
    position: relative;
}
.detail-heading::after {
    content: '';
    display: block;
    width: 60px;
    height: 4px;
    background: var(--accent-color);
    margin: 15px auto 0;
    border-radius: 2px;
}

/* Bố cục step */
.step-content-block {
    display: flex;
    gap: 30px;
    margin-bottom: 60px;
    align-items: flex-start;
    flex-wrap: wrap;
}
.step-number-lg {
    font-family: var(--heading-font);
    font-size: 50px;
    font-weight: 800;
    color: var(--accent-color);
    flex-shrink: 0;
    width: 70px;
    text-align: center;
}
.step-text {
    flex: 1;
    min-width: 250px;
}
.step-text h4 {
    font-family: var(--heading-font);
    font-size: 22px;
    color: var(--primary-dark);
    font-weight: 700;
    margin-bottom: 15px;
    border-bottom: 3px solid var(--accent-color);
    padding-bottom: 5px;
    display: inline-block;
}
.step-media-content {
    display: flex;
    gap: 25px;
    align-items: flex-start;
}
.step-media-content.reverse {
    flex-direction: row-reverse;
}
.step-media-content img {
    width: 40%;
    height: auto;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    flex-shrink: 0;
}
.media-text-wrapper {
    width: 60%;
}

/* CTA */
.cta-header-box {
    text-align: center;
    background: linear-gradient(45deg, #ffe0b2, #ffcc80);
    border-radius: 25px;
    padding: 60px 30px;
    margin-top: 60px;
    margin-bottom: 80px;
    box-shadow: 0 12px 35px rgba(255, 179, 0, 0.25);
}
.cta-header-box h4 {
    font-family: var(--heading-font);
    font-size: 32px;
    font-weight: 800;
    color: var(--primary-dark);
    margin-bottom: 15px;
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
    background: var(--accent-color);
    color: #fff;
    padding: 15px 40px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 18px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(255,152,0,0.4);
}
.primary-btn:hover {
    background: #f57c00;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(255,152,0,0.6);
}

/* Responsive */
@media(max-width:900px){
    .step-content-block { flex-direction: column; }
    .step-media-content, .step-media-content.reverse { flex-direction: column; gap: 20px; }
    .step-media-content img, .media-text-wrapper { width: 100%; max-width: 100%; }
    .step-text h4 { text-align: center; }
}
@media(max-width:576px){
    .section-title { font-size: 26px; }
    .service-card img { width: 100px; height: 100px; }
    .step-number-lg { font-size: 40px; width: 60px; }
    .step-text h4 { font-size: 20px; }
    .cta-header-box h4 { font-size: 24px; }
    .cta-header-box p { font-size: 16px; }
    .primary-btn { padding: 12px 30px; font-size: 16px; }
}
</style>
</head>
<body>

<?php include('../includes/header.php'); ?>

<main class="services-container">

    <h1 class="section-title">Khách Sạn Thú Cưng PetCare</h1>

    <div class="service-card">
        <img src="../assets/img/service/service5.png" alt="Khách sạn thú cưng">
        <h3>Lưu Trú An Toàn & Thoải Mái</h3>
        <p>Chúng tôi cung cấp không gian an toàn, sạch sẽ và thoải mái cho mèo và chó trong thời gian bạn bận rộn. Mỗi bé sẽ được chăm sóc cá nhân hóa theo tính cách, thói quen ăn uống và sức khỏe.</p>
    </div>

    <div class="long-form-section">
        <h2 class="detail-heading"><i class="fas fa-hotel"></i> Quy Trình Nhận Lưu Trú</h2>

        <div class="step-content-block">
            <div class="step-number-lg">01</div>
            <div class="step-text">
                <h4>Liên Hệ & Thông Tin Bé</h4>
                <div class="step-media-content">
                    <img src="../assets/img/service-list/hotel1.png" alt="Liên hệ thông tin bé">
                    <div class="media-text-wrapper">
                        <p>Trước khi nhận lưu trú, vui lòng gọi hoặc nhắn tin để cung cấp thông tin về loài, tuổi, cân nặng, tình trạng sức khỏe và tính cách của bé.</p>
                        <p>Điều này giúp chúng tôi chuẩn bị phòng phù hợp và đảm bảo sự an toàn, thoải mái cho thú cưng.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="step-content-block">
            <div class="step-number-lg">02</div>
            <div class="step-text">
                <h4>Kiểm Tra Sức Khỏe & Phòng Ở</h4>
                <div class="step-media-content reverse">
                    <img src="../assets/img/service-list/hotel2.png" alt="Kiểm tra sức khỏe">
                    <div class="media-text-wrapper">
                        <p>Nhân viên sẽ nhanh chóng kiểm tra sức khỏe tổng quát và xác nhận các yêu cầu dinh dưỡng hoặc đặc biệt.</p>
                        <p>Mỗi bé sẽ được sắp xếp phòng riêng hoặc phù hợp với các bé khác để giảm stress, đảm bảo vui vẻ và an toàn.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="step-content-block">
            <div class="step-number-lg">03</div>
            <div class="step-text">
                <h4>Lưu Trú & Chăm Sóc Hàng Ngày</h4>
                <div class="step-media-content">
                    <img src="../assets/img/service-list/hotel3.png" alt="Lưu trú chăm sóc">
                    <div class="media-text-wrapper">
                        <p>Thú cưng được cho ăn theo chế độ riêng, vui chơi, dạo vận động và kiểm tra sức khỏe hàng ngày.</p>
                        <p>Nhân viên theo dõi hành vi và tương tác, đảm bảo mỗi bé đều được quan tâm chu đáo.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="step-content-block">
            <div class="step-number-lg">04</div>
            <div class="step-text">
                <h4>Trả Bé & Hướng Dẫn Sau Lưu Trú</h4>
                <div class="step-media-content reverse">
                    <img src="../assets/img/service-list/hotel4.png" alt="Trả bé">
                    <div class="media-text-wrapper">
                        <p>Khi đến nhận, chúng tôi sẽ cập nhật tình hình sức khỏe, hành vi, và thói quen sinh hoạt của bé trong thời gian lưu trú.</p>
                        <p>Bạn sẽ nhận được hướng dẫn chăm sóc sau lưu trú để bé luôn khỏe mạnh và hạnh phúc.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="cta-header-box">
        <h4>Liên Hệ Để Nhận Lưu Trú Ngay!</h4>
        <p>Do tính cách và sức khỏe của mỗi bé khác nhau, vui lòng liên hệ trước để chúng tôi chuẩn bị phòng và dịch vụ phù hợp.</p>
        <a href="tel:0901234567" class="primary-btn"><i class="fas fa-phone-alt"></i> Gọi Ngay</a>
        <a href="https://zalo.me/0901234567" class="primary-btn"><i class="fab fa-zalo"></i> Nhắn Zalo</a>
    </div>

</main>

<?php include('../includes/footer.php'); ?>
</body>
</html>
