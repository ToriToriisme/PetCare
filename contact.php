<?php 
include('config/db.php'); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Liên hệ - PetCare</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    .contact-section, .map-section {
      padding: 40px 0;
    }
    .contact-section h2, .map-section h3 {
      margin-bottom: 20px;
    }
    .contact-section p {
      font-size: 18px;
      margin: 10px 0;
    }
    .map-section iframe {
      width: 100%;
      height: 450px;
      border: 0;
    }
  </style>

<?php include('includes/header.php'); ?>

<body>

<main class="container">

  <section class="section contact-section">
    <div class="container">
      <h2>Liên hệ với PetCare</h2>
      <p><b>Địa chỉ:</b> 123 Nguyễn Văn Cừ, Q.5, TP.HCM</p>
      <p><b>Hotline:</b> 090 123 456</p>
      <p><b>Giờ làm việc:</b> 8:00 - 20:00 hàng ngày</p>
    </div>
  </section>

  <section class="section map-section">
    <div class="container">
      <h3>Bản đồ</h3>
      <iframe 
  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d383.30292712029666!2d108.217992!3d16.059061!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31421838f58c0fd3%3A0x347033e3ed04c04b!2zUGV0Q2FyZSDEkOG6oWkgTeG7uSBUaOG7iyBZIMSRw7k!5e0!3m2!1svi!2s!4v1700000000000"
  width="100%" 
  height="350" 
  style="border:0;" 
  allowfullscreen="" 
  loading="lazy">
</iframe>

    </div>
  </section>

</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
