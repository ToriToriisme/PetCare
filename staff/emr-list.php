<?php
session_start();
require_once '../config/db.php'; // Kết nối Database

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// --- ĐỒNG BỘ AVATAR TỪ DATABASE ---
$stmt = $conn->prepare("SELECT name, specialty, image FROM doctors WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Xử lý hiển thị ảnh
$avatar_url = "../" . ($user['image'] ?? 'assets/img/default-avatar.png');
if (!file_exists($avatar_url) || empty($user['image'])) {
    $avatar_url = "https://ui-avatars.com/api/?name=" . urlencode($user['name']) . "&background=random&size=128";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kho Bệnh Án - PetCare Staff</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/staff-style.css">
    <style>
        .search-box { display: flex; gap: 10px; margin-bottom: 20px; }
        .search-box input { flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 8px; }
        .btn-search { background: var(--primary); color: white; border: none; padding: 0 20px; border-radius: 8px; cursor: pointer; }
    </style>
</head>
<body>

<div class="admin-layout">
    <aside class="sidebar">
        <div class="brand">🐾 PetCare <span class="badge">Doctor</span></div>
        
        <a href="staff-profile.php" class="user-panel" style="text-decoration: none;">
            <img src="<?php echo $avatar_url; ?>" alt="Avatar">
            <div class="info">
                <p>Xin chào,</p>
                <h4><?php echo htmlspecialchars($user['name']); ?></h4>
                <small style="color:#b0bec5; font-size: 12px;"><?php echo htmlspecialchars($user['specialty']); ?></small>
            </div>
        </a>

        <ul class="menu">
            <li><a href="dashboard.php">📅 Lịch hẹn hôm nay</a></li>
            <li class="active"><a href="emr-list.php">📝 Bệnh án điện tử</a></li>
            <li><a href="schedule.php">🕒 Lịch làm việc</a></li>
            <li><a href="logout.php" class="logout">Đăng xuất</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <header class="top-bar">
            <h2>Kho Lưu Trữ Bệnh Án</h2>
            <div class="date-display">Dữ liệu toàn hệ thống</div>
        </header>

        <div class="schedule-section"> <div class="search-box">
                <input type="text" placeholder="Tìm theo tên khách hàng, SĐT hoặc tên thú cưng...">
                <button class="btn-search">🔍 Tìm kiếm</button>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Ngày khám</th>
                            <th>Mã HS</th>
                            <th>Thú cưng</th>
                            <th>Chẩn đoán</th>
                            <th>Bác sĩ</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>18/11/2025</td>
                            <td>#BA001</td>
                            <td>🐶 Miu (Chó)</td>
                            <td>Viêm da dị ứng</td>
                            <td>BS. Đào Văn Duy</td>
                            <td><a href="#" class="btn-action view" style="text-decoration:none">👁️ Xem lại</a></td>
                        </tr>
                        <tr>
                            <td>15/11/2025</td>
                            <td>#BA005</td>
                            <td>🐱 Bông (Mèo)</td>
                            <td>Rối loạn tiêu hóa</td>
                            <td>BS. Nguyễn Diễm Thùy</td>
                            <td><a href="#" class="btn-action view" style="text-decoration:none">👁️ Xem lại</a></td>
                        </tr>
                        <tr>
                            <td>10/11/2025</td>
                            <td>#BA012</td>
                            <td>🐶 Lu (Chó)</td>
                            <td>Gãy xương chân trước</td>
                            <td>BS. Phạm Quang Thảo</td>
                            <td><a href="#" class="btn-action view" style="text-decoration:none">👁️ Xem lại</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    // --- ĐỒNG BỘ DARK MODE ---
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
    }
</script>

</body>
</html>