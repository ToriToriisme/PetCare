<?php 
include('../config/db.php'); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PetShop & Dịch Vụ Chăm Sóc - PetCare</title>

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
    background: linear-gradient(135deg, #fff3e0, #ffe0b2);
    border-radius: 20px;
    padding: 25px 20px;
    box-shadow: 0 10px 25px rgba(255, 152, 0, 0.15);
    text-align: center;
    margin-bottom: 50px;
    transition: transform 0.3s, box-shadow 0.3s;
}
.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(255, 152, 0, 0.25);
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

/* Responsive */
@media(max-width:900px){
    .service-card { margin-bottom: 40px; }
}
@media(max-width:576px){
    .section-title { font-size: 26px; }
    .service-card img { width: 100px; height: 100px; }
    .service-card h3 { font-size: 20px; }
    .service-card p { font-size: 14px; }
}
</style>
</head>
<body>

<?php include('../includes/header.php'); ?>

<main class="services-container">

    <h1 class="section-title">PetShop & Dịch Vụ Chăm Sóc PetCare</h1>

    <!-- Thức ăn cho thú cưng -->
    <div class="service-card">
        <img src="../assets/img/service-list/shop1.png" alt="Thức ăn cho thú cưng">
        <h3>Thức Ăn Cao Cấp</h3>
        <p>Cung cấp đa dạng thức ăn cho mèo và chó, từ hạt dinh dưỡng, pate, thức ăn tươi đến thức ăn chức năng. Tất cả đều đảm bảo an toàn và phù hợp độ tuổi.</p>
    </div>

    <!-- Phụ kiện -->
    <div class="service-card">
        <img src="../assets/img/service-list/shop2.png" alt="Phụ kiện cho thú cưng">
        <h3>Phụ Kiện & Trang Phục</h3>
        <p>Chọn lựa vòng cổ, dây dắt, áo, nơ, thảm và lồng vận chuyển. Đảm bảo chất lượng, an toàn và thoải mái cho thú cưng.</p>
    </div>

    <!-- Đồ chơi -->
    <div class="service-card">
        <img src="../assets/img/service-list/shop3.png" alt="Đồ chơi cho thú cưng">
        <h3>Đồ Chơi & Giải Trí</h3>
        <p>Đồ chơi giúp rèn luyện trí thông minh, giảm stress và duy trì sức khỏe vận động. Bao gồm bóng, xương, puzzle toy, và các trò chơi tương tác.</p>
    </div>

    <!-- Bổ sung dinh dưỡng -->
    <div class="service-card">
        <img src="../assets/img/service-list/shop4.png" alt="Bổ sung dinh dưỡng">
        <h3>Bổ Sung Dinh Dưỡng</h3>
        <p>Vitamin, khoáng chất và thực phẩm chức năng giúp nâng cao hệ miễn dịch, hỗ trợ xương, răng, lông và sức khỏe tổng thể cho mèo & chó.</p>
    </div>

    <!-- Chăm sóc & vệ sinh -->
    <div class="service-card">
        <img src="../assets/img/service-list/shop5.png" alt="Chăm sóc & vệ sinh">
        <h3>Chăm Sóc & Vệ Sinh</h3>
        <p>Sản phẩm tắm, dầu gội, chăm sóc răng miệng, móng và lông. Tất cả được lựa chọn kỹ càng để đảm bảo an toàn và hiệu quả tối đa.</p>
    </div>

    <div class="cta-header-box" style="background: linear-gradient(45deg, #c8e6c9, #a5d6a7); text-align:center; border-radius:25px; padding:50px 30px; margin-top:50px; margin-bottom:50px;">
        <h4>Đến Trực Tiếp PetShop Ngay!</h4>
        <p>Chúng tôi khuyến khích khách hàng tới trực tiếp để nhận tư vấn chuẩn xác và lựa chọn sản phẩm phù hợp với thú cưng của bạn. Nhân viên luôn sẵn sàng giải đáp thắc mắc và hỗ trợ lựa chọn.</p>
        <a href="tel:0901234567" class="primary-btn" style="display:inline-block; background:#ff9800; color:#fff; padding:15px 40px; border-radius:30px; font-weight:700; font-size:18px; text-decoration:none; box-shadow:0 4px 12px rgba(255,152,0,0.4);"><i class="fas fa-phone-alt"></i> Gọi Hỏi Thêm</a>
    </div>

</main>

<?php include('../includes/footer.php'); ?>
</body>
</html>
