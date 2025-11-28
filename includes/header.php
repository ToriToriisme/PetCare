<?php
// Nếu không có session thì start
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// BASE URL tuyệt đối (đi từ htdocs)
$BASE = isset($BASE_URL) ? rtrim($BASE_URL, '/') : '';

// Trạng thái login
$isLoggedIn = isset($_SESSION['user_id']);
if (isset($isGuestPage) && $isGuestPage) {
    $isLoggedIn = false;
}
?>

<header class="site-header">
  <div class="container">
    <nav class="nav">
      <!-- Brand -->
      <a href="<?= $BASE ?>/index.php" class="logo">
        🐾 PETCARE
      </a>

      <!-- Main navigation -->
      <ul class="menu">
        <li><a href="<?= $BASE ?>/index.php">Trang chủ</a></li>
        <li><a href="<?= $BASE ?>/introduce.php">Giới thiệu</a></li>
        <li><a href="<?= $BASE ?>/services.php">Dịch vụ</a></li>
        <li><a href="<?= $BASE ?>/doctors.php">Bác sĩ</a></li>
        <li><a href="<?= $BASE ?>/blog-list.php">Tin tức</a></li>
        <li><a href="<?= $BASE ?>/contact.php">Liên hệ</a></li>
      </ul>

      <!-- Actions: search + user -->
      <div class="nav-user-actions">
        <form action="<?= $BASE ?>/includes/search.php" method="GET" class="search-form">
          <input type="text" name="q" placeholder="Tìm dịch vụ..." aria-label="Nhập từ khóa tìm kiếm">
          <button type="submit" class="search-btn">🔍</button>
        </form>

        <?php if ($isLoggedIn): ?>
          <a href="<?= $BASE ?>/user/history.php" class="nav-link-secondary">Lịch sử</a>
          <a href="<?= $BASE ?>/user/profile.php" class="nav-link-secondary">
            Tài khoản
          </a>
          <a href="<?= $BASE ?>/user/logout.php" class="nav-link-secondary" style="color:red;">
            Đăng xuất
          </a>
        <?php else: ?>
          <a href="<?= $BASE ?>/user/login.php" class="btn small">Đăng nhập / Đăng ký</a>
        <?php endif; ?>
      </div>
    </nav>
  </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.querySelector('.search-form');
    const searchInput = searchForm ? (searchForm.querySelector('input[name="q"]') || searchForm.querySelector('input[name="keyword"]')) : null;

    if (searchForm && searchInput) {
        searchForm.addEventListener('submit', function(event) {
            const keyword = searchInput.value.trim();
            if (keyword === "") {
                event.preventDefault();
                alert("Vui lòng nhập từ khóa tìm kiếm.");
            }
        });
    }
});
</script>