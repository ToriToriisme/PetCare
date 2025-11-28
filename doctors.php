<?php
include('config/db.php');
session_start();
$isLoggedIn = isset($_SESSION['user_id']);

// Kết nối DB
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) { die("Kết nối DB thất bại: " . mysqli_connect_error()); }

// Lấy tất cả bác sĩ theo id ASC
$sql = "SELECT * FROM doctors ORDER BY id ASC";
$doctors = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đội Ngũ Bác Sĩ - PetCare</title>
<link rel="stylesheet" href="assets/css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
.expert-list-container { display: flex; flex-direction: column; gap: 40px; margin: 30px auto; max-width: 1000px; }

.expert-item {
    display: flex;
    align-items: flex-start;
    gap: 30px;
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    border-left: 5px solid #00bcd4;
    transition: box-shadow 0.3s;
}
.expert-item:hover { box-shadow: 0 12px 40px rgba(0,188,212,0.1); }

.expert-item.reverse { flex-direction: row-reverse; border-left: none; border-right: 5px solid #00bcd4; }

.expert-image-box { flex-shrink:0; width: 250px; height: 250px; border-radius: 10px; overflow: hidden; box-shadow:0 5px 15px rgba(0,0,0,0.1);}
.expert-img { width:100%; height:100%; object-fit:cover; transition: transform 0.5s; }
.expert-item:hover .expert-img { transform: scale(1.05); }

.expert-info-box { flex-grow:1; }
.expert-degree { display:inline-block; background:#e0f7fa; color:#007c91; padding:4px 10px; border-radius:5px; font-size:13px; font-weight:600; margin-bottom:10px; }
.expert-info-box h3 { font-size:28px; color:#333; margin:0 0 10px; }
.expert-specialty { font-style:italic; color:#ff9800; font-weight:600; margin-bottom:15px; display:block; }
.expert-description { color:#555; line-height:1.6; margin-bottom:15px; }
.expertise-list { list-style: disc; padding-left: 20px; margin-bottom: 20px; }
.expertise-list li { font-size:15px; margin-bottom:5px; color:#333; }
.expert-btn { margin-top:10px; }

@media(max-width:992px){
    .expert-item { flex-direction: column; align-items:center; text-align:center; padding:20px; }
    .expert-item.reverse { flex-direction: column; border-left:5px solid #00bcd4; border-right:none; }
    .expert-image-box { width:180px; height:180px; margin-bottom:15px; }
    .expert-info-box { text-align:center; }
}
@media(max-width:600px){
    .expert-item { padding:15px; }
    .expert-image-box { width:150px; height:150px; }
    .expert-info-box h3 { font-size:24px; }
}
</style>
</head>
<body>
<?php include('includes/header.php'); ?>

<section class="banner-new">
  <div class="container banner-inner-sub">
    <h1>ĐỘI NGŨ CHUYÊN GIA</h1>
    <p>Gặp gỡ những người đồng hành tận tâm, chuyên nghiệp của PetCare.</p>
  </div>
</section>

<main class="container">
  <section class="section expert-list-section">
    <div class="expert-list-container">
      <?php foreach($doctors as $i=>$d): ?>
        <div class="expert-item <?= ($i%2)?'reverse':'' ?>">
          <div class="expert-image-box">
            <?php
              // Gán ảnh theo tên file, nếu trống dùng default
              $imgFile = !empty($d['image']) ? $d['image'] : 'default.jpg';
            ?>
            <img src="assets/img/doctors/<?= htmlspecialchars($imgFile) ?>" 
                 alt="<?= htmlspecialchars($d['name']) ?>" class="expert-img">
          </div>
          <div class="expert-info-box">
            <span class="expert-degree"><?= htmlspecialchars($d['degree'] ?? 'Bác sĩ Thú Y') ?></span>
            <h3><?= htmlspecialchars($d['name']) ?></h3>
            <p class="expert-specialty"><?= htmlspecialchars($d['specialty']) ?></p>
            <p class="expert-description"><?= htmlspecialchars($d['description'] ?? '') ?></p>
            <?php if(!empty($d['services'])): ?>
              <ul class="expertise-list">
                <?php foreach(explode('|', $d['services']) as $s): ?>
                  <li><?= htmlspecialchars($s) ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <a href="<?= $isLoggedIn?'user/booking.php':'user/login.php' ?>" class="btn primary-btn small-btn expert-btn">Đặt lịch</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php include('includes/footer.php'); ?>
</body>
</html>
