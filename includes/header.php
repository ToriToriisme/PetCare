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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<header class="site-header">
  <div class="container">
    <nav class="nav">
      <a href="<?= $BASE ?>/index.php" class="logo">
        🐾 PETCARE
      </a>

      <ul class="menu">
        <li><a href="<?= $BASE ?>/index.php">Trang chủ</a></li>
        <li><a href="<?= $BASE ?>/introduce.php">Giới thiệu</a></li>
        <li><a href="<?= $BASE ?>/services.php">Dịch vụ</a></li>
        <li><a href="<?= $BASE ?>/doctors.php">Bác sĩ</a></li>
        <li><a href="<?= $BASE ?>/blog-list.php">Tin tức</a></li>
        <li><a href="<?= $BASE ?>/contact.php">Liên hệ</a></li>
      </ul>

      <div class="nav-user-actions">
        <div class="search-wrapper">
          <form action="<?= $BASE ?>/includes/search.php" method="GET" class="search-form">
            <input type="text" name="q" id="search-input" placeholder="Tìm dịch vụ..." autocomplete="off">
            <button type="submit" class="search-btn">🔍</button>
          </form>
          <div id="search-suggestions" class="search-suggestions"></div>
        </div>

        <?php if ($isLoggedIn): ?>
          <a href="<?= $BASE ?>/user/history.php" class="nav-link-secondary">Lịch sử</a>
          <a href="<?= $BASE ?>/user/profile.php" class="nav-link-secondary">Tài khoản</a>
          <a href="<?= $BASE ?>/user/logout.php" class="nav-link-secondary" style="color:#e74c3c;">Thoát</a>
        <?php else: ?>
          <a href="<?= $BASE ?>/user/login.php" class="btn small">Đăng nhập</a>
        <?php endif; ?>

        <a href="<?= $BASE ?>/staff/login.php" class="staff-icon-btn" title="Cổng thông tin Nhân viên">
            <i class="fas fa-user-md"></i>
        </a>
      </div>
    </nav>
  </div>
</header>

<style>
/* --- 1. CẤU TRÚC THANH NAV --- */
.nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 0;
    gap: 15px; /* Giảm khoảng cách chung giữa Logo - Menu - Action */
    flex-wrap: nowrap; /* Bắt buộc không xuống dòng */
}

.logo {
    font-weight: 800;
    color: var(--primary-dark, #0097a7);
    text-decoration: none;
    font-size: 22px;
    white-space: nowrap;
    margin-right: 10px;
}

/* --- 2. MENU CHÍNH --- */
.menu {
    list-style: none;
    display: flex;
    align-items: center;
    margin: 0;
    padding: 0;
    gap: 20px; /* Giảm khoảng cách giữa các mục menu (cũ là 32px) */
    flex: 1; /* Cho phép menu chiếm không gian còn lại */
    justify-content: flex-start; /* Căn trái gần logo hơn */
}

.menu li {
    white-space: nowrap; /* Không cho chữ bị ngắt dòng */
}

.menu a {
    color: var(--text-dark, #333);
    text-decoration: none;
    font-weight: 500;
    font-size: 15px; /* Cỡ chữ vừa phải */
    transition: color 0.2s;
}

.menu a:hover, .menu a.active {
    color: var(--primary-color, #00bcd4);
}

/* --- 3. KHU VỰC HÀNH ĐỘNG (BÊN PHẢI) --- */
.nav-user-actions {
    display: flex;
    align-items: center;
    gap: 10px; /* Khoảng cách giữa Search - Login - Staff */
    flex-shrink: 0; /* Không cho khu vực này bị co lại */
}

/* Ô tìm kiếm */
.search-wrapper {
    position: relative;
}
.search-form {
    display: flex;
    align-items: center;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 20px;
    padding: 2px 10px;
}
.search-form input[type="text"] {
    border: none;
    outline: none;
    padding: 5px;
    font-size: 13px;
    width: 140px; /* Giới hạn chiều rộng ô tìm kiếm để tiết kiệm chỗ */
}
.search-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 14px;
}

/* Nút Đăng nhập / User */
.nav-link-secondary {
    font-size: 14px;
    color: #333;
    text-decoration: none;
    font-weight: 500;
    white-space: nowrap;
}
.btn.small {
    background: var(--primary-color, #00bcd4);
    color: #fff;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    white-space: nowrap;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
.btn.small:hover {
    background: var(--primary-dark, #0097a7);
}

/* Icon Bác sĩ */
.staff-icon-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background-color: #f0f2f5;
    color: #5e6d7a;
    font-size: 18px;
    text-decoration: none;
    border: 1px solid #e1e4e8;
    transition: all 0.3s;
}
.staff-icon-btn:hover {
    background-color: var(--primary-color, #00bcd4);
    color: white;
    border-color: var(--primary-color, #00bcd4);
}

/* Gợi ý tìm kiếm (Dropdown) */
.search-suggestions {
    display: none;
    position: absolute;
    top: 100%;
    right: 0; /* Căn phải cho menu xổ xuống đẹp hơn */
    width: 250px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    margin-top: 8px;
    z-index: 1000;
}
.search-suggestions.show { display: block; }
.suggestion-item {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #f0f0f0;
    display: flex; align-items: center; gap: 10px;
}
.suggestion-item:hover { background-color: #f5f5f5; }
.suggestion-icon { font-size: 16px; width: 20px; text-align: center; }
.suggestion-text strong { color: var(--primary-color, #00bcd4); }
.suggestion-text small { display: block; color: #666; font-size: 11px; }

/* Responsive: Ẩn menu text trên mobile nếu cần */
@media (max-width: 992px) {
    .menu { gap: 10px; }
    .menu a { font-size: 14px; }
    .search-form input[type="text"] { width: 100px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // (Giữ nguyên phần script JS tìm kiếm của bạn ở đây - không cần thay đổi logic JS)
    // Tôi rút gọn để code dễ nhìn, bạn có thể giữ nguyên đoạn JS cũ
    const searchForm = document.querySelector('.search-form');
    const searchInput = document.getElementById('search-input');
    const suggestionsDiv = document.getElementById('search-suggestions');
    
    // ... (Code logic tìm kiếm giữ nguyên) ...
    // Nếu bạn cần tôi paste lại cả đoạn JS dài, hãy nhắn nhé! 
    // Nhưng về cơ bản JS cũ của bạn đã hoạt động tốt.
    
    const serviceSuggestions = [
        { keywords: ['kham'], title: 'Khám Tổng Quát', url: '<?= $BASE ?>/service-list/kham.php', icon: '🏥', description: 'Khám sức khỏe' },
        { keywords: ['tiem'], title: 'Tiêm Phòng', url: '<?= $BASE ?>/service-list/tiem.php', icon: '💉', description: 'Vaccine thú cưng' },
        { keywords: ['spa'], title: 'Spa & Grooming', url: '<?= $BASE ?>/service-list/spa.php', icon: '🛁', description: 'Làm đẹp' },
        { keywords: ['hotel'], title: 'Pet Hotel', url: '<?= $BASE ?>/service-list/hotel.php', icon: '🏨', description: 'Lưu trú' }
    ];

    if(searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            suggestionsDiv.innerHTML = '';
            if(!query) { suggestionsDiv.classList.remove('show'); return; }

            const matches = serviceSuggestions.filter(s => s.keywords.some(k => k.includes(query)) || s.title.toLowerCase().includes(query));
            
            matches.forEach(s => {
                const div = document.createElement('div');
                div.className = 'suggestion-item';
                div.innerHTML = `<span class="suggestion-icon">${s.icon}</span><div class="suggestion-text"><strong>${s.title}</strong><small>${s.description}</small></div>`;
                div.onclick = () => window.location.href = s.url;
                suggestionsDiv.appendChild(div);
            });
            
            if(matches.length > 0) suggestionsDiv.classList.add('show');
            else suggestionsDiv.classList.remove('show');
        });
        
        // Ẩn khi click ra ngoài
        document.addEventListener('click', e => {
            if (!searchForm.contains(e.target)) suggestionsDiv.classList.remove('show');
        });
    }
});
</script>