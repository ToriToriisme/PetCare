<?php include('config/db.php'); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Dịch vụ - Pet Care</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .services-container { max-width: 1000px; margin: 50px auto; padding: 0 15px; }
    .section-title { font-size: 32px; color: #0097a7; font-weight: 700; margin-bottom: 20px; text-align: center; }
    .service-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-top: 30px; }
    .service-card { background: linear-gradient(135deg, #e0f7fa, #b2ebf2); border-radius: 20px; padding: 25px 20px; box-shadow: 0 10px 25px rgba(0, 188, 212, 0.15); text-align: center; transition: transform 0.3s, box-shadow 0.3s; }
    .service-card:hover { transform: translateY(-8px); box-shadow: 0 15px 40px rgba(0, 188, 212, 0.25); }
    .service-card img { width: 80px; height: 80px; object-fit: cover; border-radius: 50%; margin-bottom: 15px; }
    .service-card h3 { font-size: 22px; color: #0097a7; margin-bottom: 10px; }
    .service-card p { font-size: 15px; color: #333; line-height: 1.6; }
    @media(max-width:768px){ .service-grid{ grid-template-columns: 1fr; } }
  </style>
</head>
<body>

<?php include('includes/header.php'); ?>


<main class="services-container">
  <h1 class="section-title">Các Dịch Vụ Tại Pet Care</h1>
  
  <div class="service-grid">
    <div class="service-card">
      <img src="assets/img/service/service1.png" alt="Khám & Chẩn đoán">
      <h3>Khám & Chẩn Đoán</h3>
      <p>Khám tổng quát, tư vấn sức khỏe và chẩn đoán bệnh lý bằng các thiết bị hiện đại như X-quang, Siêu âm, xét nghiệm máu.</p>
       <a href="<?= $BASE ?>/service-list/kham.php" class="service-cta-btn">
            Tìm hiểu thêm <i class="fas fa-arrow-right"></i>
        </a>    
    </div>
    
    <div class="service-card">
      <img src="assets/img/service/service2.png" alt="Tiêm phòng & Tẩy giun">
      <h3>Tiêm Phòng & Tẩy Giun</h3>
      <p>Tiêm phòng định kỳ, tẩy giun theo phác đồ chuẩn giúp thú cưng luôn khỏe mạnh và phòng ngừa bệnh tật.</p>
       <a href="<?= $BASE ?>/service-list/tiem.php" class="service-cta-btn">
            Tìm hiểu thêm <i class="fas fa-arrow-right"></i>
        </a>  
    </div>
    
    <div class="service-card">
      <img src="assets/img/service/service3.png" alt="Phẫu thuật & Cấp cứu">
      <h3>Phẫu Thuật & Cấp Cứu</h3>
      <p>Thực hiện các ca phẫu thuật từ đơn giản đến phức tạp, hỗ trợ cấp cứu 24/7 với đội ngũ chuyên môn cao.</p>
       <a href="<?= $BASE ?>/service-list/phauthuat.php" class="service-cta-btn">
            Tìm hiểu thêm <i class="fas fa-arrow-right"></i>
        </a>  
    </div>
    
    <div class="service-card">
      <img src="assets/img/service/service4.png" alt="Spa & Grooming">
      <h3>Spa & Grooming</h3>
      <p>Dịch vụ tắm, cắt tỉa lông, chăm sóc móng, vệ sinh tai mũi chuyên nghiệp, giúp thú cưng luôn sạch sẽ và xinh đẹp.</p>
         <a href="<?= $BASE ?>/service-list/spa.php" class="service-cta-btn">
            Tìm hiểu thêm <i class="fas fa-arrow-right"></i>
        </a>     
    </div>
    
    <div class="service-card">
      <img src="assets/img/service/service5.png" alt="Pet Hotel">
      <h3>Pet Hotel</h3>
      <p>Hệ thống phòng lưu trú cao cấp, sạch sẽ, có giám sát sức khỏe liên tục để thú cưng luôn an tâm khi bạn vắng nhà.</p>
    <a href="<?= $BASE ?>/service-list/hotel.php" class="service-cta-btn">
            Tìm hiểu thêm <i class="fas fa-arrow-right"></i>
        </a>  
    </div>
    
    <div class="service-card">
      <img src="assets/img/service/service6.png" alt="Pet Shop">
      <h3>Pet Shop</h3>
      <p>Cung cấp thức ăn, dinh dưỡng và phụ kiện chất lượng, được lựa chọn bởi các chuyên gia thú y.</p>
       <a href="<?= $BASE ?>/service-list/shop.php" class="service-cta-btn">
            Tìm hiểu thêm <i class="fas fa-arrow-right"></i>
        </a>  
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>


</body>
</html>
