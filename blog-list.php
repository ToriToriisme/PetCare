<?php include('config/db.php'); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Tin tức - Pet Care</title>
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
  /* === Root Variables === */
  :root{
    --primary-color: #00bcd4;
    --primary-dark: #0097a7;
    --secondary-color: #26c6da;
    --bg-light: #f4faff;
    --bg-card: #ffffff;
    --text-dark: #2c3e50;
    --text-light: #5e6d7a;
  }

  *{box-sizing:border-box;margin:0;padding:0}
  body{font-family:'Poppins',sans-serif;background:var(--bg-light);color:var(--text-dark);line-height:1.6}

  /* === Container === */
  .blog-list{max-width:1000px;margin:50px auto;padding:0 15px}
  .blog-list h1{font-size:36px;color:var(--primary-dark);margin-bottom:40px;text-align:center}

  /* === Card bài viết === */
  .blog-item{display:flex;gap:20px;margin-bottom:40px;border-radius:10px;background:var(--bg-card);box-shadow:0 4px 15px rgba(0,0,0,0.05);transition: transform 0.3s, box-shadow 0.3s;padding:15px}
  .blog-item:hover{transform:translateY(-3px);box-shadow:0 8px 20px rgba(0,0,0,0.1)}
  .blog-item img{width:250px;height:150px;object-fit:cover;border-radius:10px}

  /* === Nội dung bài viết === */
  .blog-item .content{flex:1;display:flex;flex-direction:column;justify-content:space-between}
  .blog-item .content h2{font-size:24px;color:var(--primary-dark);margin:0 0 10px}
  .blog-item .content .meta{font-size:14px;color:var(--text-light);margin-bottom:10px}
  .blog-item .content p{margin-bottom:10px;color:var(--text-dark)}

  /* === Read More === */
  .read-more{color:var(--primary-color);text-decoration:none;font-weight:600;transition:color 0.3s}
  .read-more:hover{color:var(--primary-dark)}

  /* === Responsive === */
  @media(max-width:768px){
    .blog-item{flex-direction:column;align-items:center;text-align:center}
    .blog-item img{width:100%;height:auto;max-height:250px;margin-bottom:15px}
    .blog-list h1{font-size:28px}
  }

  /* === Chi tiết bài viết === */
  .blog-container{max-width:900px;margin:50px auto;padding:0 15px;line-height:1.8;font-size:17px;color:var(--text-dark);}
  .blog-title{font-size:38px;font-weight:600;margin-bottom:10px;color:var(--primary-dark);}
  .blog-meta{font-size:15px;color:var(--text-light);margin-bottom:20px;border-bottom:1px solid #eee;padding-bottom:10px;}
  .blog-image{width:100%;max-height:450px;object-fit:cover;border-radius:15px;margin-bottom:30px;box-shadow:0 4px 15px rgba(0,0,0,0.1);}
  .blog-content p{margin-bottom:25px;text-align:justify;}
  .blog-content h2, .blog-content h3{color:var(--primary-color);margin-top:40px;margin-bottom:15px;font-weight:500;border-left:5px solid #ffb300;padding-left:15px;}
  .blog-content ul{margin-left:25px;margin-bottom:25px;list-style-type:disc;}
  .blog-content ul li{margin-bottom:10px;line-height:1.6;}

  @media(max-width:768px){
    .blog-title{font-size:30px}
    .blog-image{max-height:250px}
    .blog-container{font-size:16px;margin-top:30px}
  }

  </style>
</head>
<body>

<?php include('includes/header.php'); ?>

<?php
// Nếu muốn dùng blog-detail cùng file
if(isset($_GET['id'])){
  $id = intval($_GET['id']);
  $post = getSingleResult("SELECT * FROM blogs WHERE id = ?", [$id]);
  if($post):
?>
<main class="blog-container">
  <h1 class="blog-title"><?= htmlspecialchars($post['title']) ?></h1>
  <div class="blog-meta">Ngày đăng: <?= date('d/m/Y', strtotime($post['created_at'])) ?></div>
  <?php if(!empty($post['image'])): ?>
    <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="blog-image">
  <?php endif; ?>
  <div class="blog-content">
      <?= nl2br(htmlspecialchars($post['content'] ?? '')) ?>
  </div>
</main>

<?php
  else:
    // Blog not found, show list instead
    $blogs = getResults("SELECT * FROM blogs ORDER BY created_at DESC LIMIT 5");
?>
<main class="blog-list">
  <h1>Danh sách bài viết</h1>
  <p style="text-align:center;color:#999;">Bài viết không tồn tại.</p>
  <?php
    foreach($blogs as $b):
  ?>
  <div class="blog-item">
    <?php 
      $blogImage = !empty($b['image']) ? htmlspecialchars($b['image']) : 'assets/img/blog/blog1.png';
    ?>
    <img src="<?= $blogImage ?>" alt="<?= htmlspecialchars($b['title']) ?>" 
         onerror="this.src='assets/img/blog/blog1.png'">
    <div class="content">
      <h2><?= htmlspecialchars($b['title']) ?></h2>
      <div class="meta"><?= date('d/m/Y', strtotime($b['created_at'])) ?></div>
      <p><?= nl2br(htmlspecialchars(substr($b['content'] ?? '', 0, 150))) ?>...</p>
      <a href="blog-list.php?id=<?= $b['id'] ?>" class="read-more">Xem chi tiết →</a>
    </div>
  </div>
  <?php 
    endforeach;
  ?>
</main>
<?php
  endif;
} else {
  // Lấy 5 bài mới nhất (chỉ hiển thị danh sách nếu không có id)
  $blogs = getResults("SELECT * FROM blogs ORDER BY created_at DESC LIMIT 5");
?>
<main class="blog-list">
  <h1>Danh sách bài viết</h1>
  <?php
    foreach($blogs as $b):
  ?>
  <div class="blog-item">
    <?php 
      $blogImage = !empty($b['image']) ? htmlspecialchars($b['image']) : 'assets/img/blog/blog1.png';
    ?>
    <img src="<?= $blogImage ?>" alt="<?= htmlspecialchars($b['title']) ?>" 
         onerror="this.src='assets/img/blog/blog1.png'">
    <div class="content">
      <h2><?= htmlspecialchars($b['title']) ?></h2>
      <div class="meta"><?= date('d/m/Y', strtotime($b['created_at'])) ?></div>
      <p><?= nl2br(htmlspecialchars(substr($b['content'] ?? '', 0, 150))) ?>...</p>
      <a href="blog-list.php?id=<?= $b['id'] ?>" class="read-more">Xem chi tiết →</a>
    </div>
  </div>
  <?php 
    endforeach;
  }
  ?>
</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
