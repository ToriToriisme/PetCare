<?php
include('config/db.php');
// session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đội Ngũ Bác Sĩ - PetCare</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include('includes/header.php'); ?>


<section class="banner-sub" style="background-image: url('assets/img/banner-doctors.jpg');">
  <div class="container banner-inner-sub">
    <h1>ĐỘI NGŨ CHUYÊN GIA</h1>
    <p>Gặp gỡ những người bạn đồng hành tận tâm, chuyên nghiệp của PetCare.</p>
  </div>
</section>

<main class="container">
  <section class="section expert-list-section">
    <h2 class="section-title-mini">CHUYÊN MÔN</h2>
    <h2 class="section-title">Chọn Bác Sĩ Theo Dịch Vụ Phù Hợp</h2>
    
    <div class="expert-list-container">
      
      <div class="expert-item">
        <div class="expert-image-box">
            <img src="assets/img/doctors/doctor-duy.jpg" alt="BS Đào Văn Duy" class="expert-img">
        </div>
        <div class="expert-info-box">
            <span class="expert-degree">Thạc sĩ Thú Y (M.V.Sc)</span>
            <h3>BS. Đào Văn Duy</h3>
            <p class="expert-specialty">Chuyên khoa: Khám tổng quát, Điều trị bệnh nội khoa</p>
            <p class="expert-description">
                BS. Duy là chuyên gia về khám sức khỏe định kỳ và chẩn đoán, điều trị các bệnh lý nội khoa phổ biến như tiêu hóa, hô hấp, da liễu. BS. Duy luôn tập trung vào việc tư vấn chăm sóc phòng ngừa và đưa ra phác đồ điều trị tận gốc.
            </p>
            <p class="expertise-heading">Dịch vụ phụ trách chính:</p>
            <ul class="expertise-list no-icon">
                <li>Khám và điều trị nội khoa tổng quát</li>
                <li>Điều trị các bệnh mãn tính</li>
                <li>Tư vấn chế độ dinh dưỡng và lối sống</li>
            </ul>
            <?php if($isLoggedIn): ?>
              <a href="user/booking.php" class="btn primary-btn small-btn expert-btn">Đặt lịch Khám/Điều trị</a>
            <?php else: ?>
              <a href="user/login.php" class="btn primary-btn small-btn expert-btn">Đặt lịch Khám/Điều trị</a>
            <?php endif; ?>
        </div>
      </div>
      
      <div class="expert-item reverse">
        <div class="expert-image-box">
            <img src="assets/img/doctors/doctor-thuy.jpg" alt="BS Nguyễn Diễm Thùy" class="expert-img">
        </div>
        <div class="expert-info-box">
            <span class="expert-degree">Bác sĩ Thú Y (D.V.M)</span>
            <h3>BS. Nguyễn Diễm Thùy</h3>
            <p class="expert-specialty">Chuyên khoa: Tiêm phòng, Tẩy giun & Khám tổng quát</p>
            <p class="expert-description">
                BS. Thùy là người phụ trách chính chương trình Tiêm phòng và Tẩy giun tại PetCare. Chị đảm bảo mọi thú cưng được tiêm chủng đúng phác đồ, cấp sổ sức khỏe đầy đủ và tư vấn phòng ngừa ký sinh trùng hiệu quả. Chị cũng hỗ trợ Khám tổng quát ban đầu.
            </p>
            <p class="expertise-heading">Dịch vụ phụ trách chính:</p>
            <ul class="expertise-list no-icon">
                <li>Tiêm phòng các loại vắc-xin (Dại, Parvo, Care...)</li>
                <li>Cấp phát thuốc tẩy giun, phòng ve rận</li>
                <li>Khám sức khỏe định kỳ và cấp cứu nhẹ</li>
            </ul>
            <?php if($isLoggedIn): ?>
              <a href="user/booking.php" class="btn primary-btn small-btn expert-btn">Đặt lịch Tiêm phòng</a>
            <?php else: ?>
              <a href="user/login.php" class="btn primary-btn small-btn expert-btn">Đặt lịch Tiêm phòng</a>
            <?php endif; ?>
        </div>
      </div>
      
      <div class="expert-item">
        <div class="expert-image-box">
            <img src="assets/img/doctors/doctor-tina.jpg" alt="BS Trần Ti Na" class="expert-img">
        </div>
        <div class="expert-info-box">
            <span class="expert-degree">Thạc sĩ Thú Y (D.V.M)</span>
            <h3>BS. Trần Ti Na</h3>
            <p class="expert-specialty">Chuyên khoa: Xét nghiệm, Chẩn đoán & Bệnh phức tạp</p>
            <p class="expert-description">
                BS. Ti Na chuyên sâu về phân tích kết quả Xét nghiệm (máu, nước tiểu, phân) và chẩn đoán bệnh lý phức tạp ở chó, mèo. Chị giúp đưa ra phác đồ điều trị chính xác dựa trên bằng chứng khoa học từ phòng thí nghiệm.
            </p>
            <p class="expertise-heading">Dịch vụ phụ trách chính:</p>
            <ul class="expertise-list no-icon">
                <li>Phân tích kết quả xét nghiệm chuyên sâu</li>
                <li>Chẩn đoán và điều trị các bệnh truyền nhiễm khó</li>
                <li>Khám tổng quát các ca bệnh cần theo dõi sát sao</li>
            </ul>
           <?php if($isLoggedIn): ?>
              <a href="user/booking.php" class="btn primary-btn small-btn expert-btn">Đặt lịch Xét nghiệm/Chẩn đoán</a>
            <?php else: ?>
              <a href="user/login.php" class="btn primary-btn small-btn expert-btn">Đặt lịch Xét nghiệm/Chẩn đoán</a>
            <?php endif; ?>
        </div>
      </div>

      <div class="expert-item reverse">
        <div class="expert-image-box">
            <img src="assets/img/doctors/doctor-nhan.jpg" alt="BS Phan Thành Đức Nhân" class="expert-img">
        </div>
        <div class="expert-info-box">
            <span class="expert-degree">Thạc sĩ Ngoại khoa (M.S)</span>
            <h3>BS. Phan Thành Đức Nhân</h3>
            <p class="expert-specialty">Chuyên khoa: Phẫu thuật Cấp cứu, Chẩn đoán Hình ảnh (X-Quang, Siêu âm)</p>
            <p class="expert-description">
                BS. Đức Nhân là người thực hiện các kỹ thuật Chẩn đoán Hình ảnh như Siêu âm và X-Quang để xác định dị vật, gãy xương, hoặc các khối u. Anh cũng là người trực tiếp xử lý các ca phẫu thuật cấp cứu và ngoại khoa thông thường (trừ phẫu thuật chuyên sâu).
            </p>
            <p class="expertise-heading">Dịch vụ phụ trách chính:</p>
            <ul class="expertise-list no-icon">
                <li>Phẫu thuật cấp cứu (Tai nạn, chấn thương)</li>
                <li>Thực hiện và đọc kết quả X-Quang, Siêu âm</li>
                <li>Phẫu thuật ngoại khoa thông thường (mổ u bướu)</li>
            </ul>
              <?php if($isLoggedIn): ?>
              <a href="user/booking.php" class="btn primary-btn small-btn expert-btn">Đặt lịch Phẫu thuật/Cấp cứu</a>
            <?php else: ?>
              <a href="user/login.php" class="btn primary-btn small-btn expert-btn">Đặt lịch Phẫu thuật/Cấp cứu</a>
            <?php endif; ?>
        </div>
      </div>
      
      <div class="expert-item">
        <div class="expert-image-box">
            <img src="assets/img/doctors/doctor-thao.jpg" alt="BS Phạm Quang Thảo" class="expert-img">
        </div>
        <div class="expert-info-box">
            <span class="expert-degree">Tiến sĩ Thú Y (Ph.D)</span>
            <h3>BS. Phạm Quang Thảo</h3>
            <p class="expert-specialty">Chuyên khoa: Phẫu thuật Triệt sản, Chỉnh hình & Ngoại khoa chuyên sâu</p>
            <p class="expert-description">
                BS. Quang Thảo là Phẫu thuật viên chính, chuyên trách các ca phức tạp cần kỹ thuật cao như phẫu thuật chỉnh hình (nối xương, điều trị gãy xương) và triệt sản an toàn. Khi cần can thiệp ngoại khoa chuyên khoa, BS. Thảo là lựa chọn hàng đầu.
            </p>
            <p class="expertise-heading">Dịch vụ phụ trách chính:</p>
            <ul class="expertise-list no-icon">
                <li>Phẫu thuật chỉnh hình (Gãy xương)</li>
                <li>Phẫu thuật triệt sản (thiến) an toàn</li>
                <li>Phẫu thuật lấy dị vật phức tạp</li>
            </ul>
            <?php if($isLoggedIn): ?>
              <a href="user/booking.php" class="btn primary-btn small-btn expert-btn">Đặt lịch Phẫu thuật chuyên sâu</a>
            <?php else: ?>
              <a href="user/login.php" class="btn primary-btn small-btn expert-btn">Đặt lịch Phẫu thuật chuyên sâu</a>
            <?php endif; ?>
        </div>
      </div>

    </div>
  </section>
</main>

<?php include('includes/footer.php'); ?>


</body>
</html>