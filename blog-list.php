<?php include('config/db.php'); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Tin tức - Pet Care</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <?php include('includes/header.php'); ?>

  <style>
    .blog-list { max-width: 1000px; margin: 50px auto; padding: 0 15px; }
    .blog-item { display: flex; gap: 20px; margin-bottom: 40px; border-bottom: 1px solid #ddd; padding-bottom: 20px; }
    .blog-item img { width: 250px; height: 150px; object-fit: cover; border-radius: 10px; }
    .blog-item .content { flex: 1; }
    .blog-item .content h2 { font-size: 24px; margin: 0 0 10px; color: #0097a7; }
    .blog-item .content p { margin: 0 0 10px; color: #555; }
    .blog-item .content .meta { font-size: 14px; color: #888; margin-bottom: 10px; }
    .read-more { color: #00bcd4; text-decoration: none; font-weight: 600; }
    .read-more:hover { text-decoration: underline; }
  </style>
</head>
<body>


<main class="blog-list">
  <h1>Danh sách bài viết</h1>

  <!-- Bài viết 1 -->
  <div class="blog-item">
    <img src="assets/img/blog/blog1.png" alt="Chăm sóc mùa hè cho thú cưng">
    <div class="content">
      <h2>5 Bước Chăm Sóc Toàn Diện Cho Thú Cưng Mùa Hè</h2>
      <div class="meta">18/11/2025</div>
      <p>Mùa hè là thời điểm thú cưng dễ bị say nắng, mất nước và các vấn đề da liễu. Hãy theo dõi 5 bước chăm sóc toàn diện để thú cưng luôn khỏe mạnh.</p>
      <a href="blog.php?id=1" class="read-more">Xem chi tiết →</a>
    </div>
  </div>

  <!-- Bài viết 2 -->
  <div class="blog-item">
    <img src="assets/img/blog/blog2.jpg" alt="Chế độ dinh dưỡng cho chó">
    <div class="content">
      <h2>Chế Độ Dinh Dưỡng Chuẩn Cho Chó Mọi Lứa Tuổi</h2>
      <div class="meta">10/10/2025</div>
      <p>Bài viết này hướng dẫn cách xây dựng chế độ dinh dưỡng hợp lý giúp chó phát triển khỏe mạnh, từ chó con đến chó trưởng thành.</p>
      <a href="blog.php?id=2" class="read-more">Xem chi tiết →</a>
    </div>
  </div>

</main>

<?php include('includes/footer.php'); ?>


</body>
</html>
