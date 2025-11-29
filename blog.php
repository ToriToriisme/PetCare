<?php
include('config/db.php'); // file config DB: chứa DB_HOST, DB_USER, DB_PASS, DB_NAME

// Lấy ID bài viết từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kết nối DB
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$conn) {
    die("Kết nối DB thất bại: " . mysqli_connect_error());
}

// Lấy bài viết theo ID
$sql = "SELECT * FROM blogs WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Bài viết không tồn tại!");
}

$post = mysqli_fetch_assoc($result);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($post['title']) ?> - Pet Care</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .blog-container { max-width: 900px; margin: 50px auto; padding: 0 15px; line-height: 1.8; font-size: 17px; color: #333; }
    .blog-title { font-size: 38px; font-weight: 600; margin-bottom: 10px; color: #00838f; }
    .blog-meta { font-size: 15px; color: #666; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;}
    .blog-image { width: 100%; max-height: 450px; object-fit: cover; border-radius: 15px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    .blog-content p { margin-bottom: 25px; text-align: justify; } 
    .blog-content h2, .blog-content h3 { color: #00bcd4; margin-top: 40px; margin-bottom: 15px; font-weight: 500; border-left: 5px solid #ffb300; padding-left: 15px;}
    .blog-content ul { margin-left: 25px; margin-bottom: 25px; list-style-type: disc; } 
    .blog-content ul li { margin-bottom: 10px; line-height: 1.6; }

    @media(max-width:768px){ 
        .blog-title{ font-size:30px; } 
        .blog-image{ max-height:250px; } 
        .blog-container { font-size: 16px; margin-top: 30px; }
    }
  </style>
</head>
<body>

<?php include('includes/header.php'); ?>

<main class="blog-container">
  <h1 class="blog-title"><?= htmlspecialchars($post['title']) ?></h1>
  <div class="blog-meta">
    <i class="far fa-calendar-alt" style="margin-right: 5px;"></i> Ngày đăng: <?= date('d/m/Y', strtotime($post['created_at'])) ?>
  </div>
  <img src="<?= htmlspecialchars($post['image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="blog-image">
  <div class="blog-content">
      <?= $post['content'] ?>
  </div>
</main>

<?php include('includes/footer.php'); ?>
</body>
</html>
