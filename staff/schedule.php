<?php
session_start();
require_once '../config/db.php';

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

// --- LOGIC XỬ LÝ LỊCH ---
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$monday_timestamp = strtotime("this week monday") + ($offset * 7 * 24 * 60 * 60);
$sunday_timestamp = $monday_timestamp + (6 * 24 * 60 * 60);
$start_date_str = date('d/m', $monday_timestamp);
$end_date_str = date('d/m', $sunday_timestamp);

$days_of_week = [
    'Mon' => 'Thứ 2', 'Tue' => 'Thứ 3', 'Wed' => 'Thứ 4',
    'Thu' => 'Thứ 5', 'Fri' => 'Thứ 6', 'Sat' => 'Thứ 7', 'Sun' => 'CN'
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch làm việc - PetCare Staff</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/staff-style.css">
    <style>
        /* CSS riêng cho trang Lịch */
        .week-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .schedule-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px; text-align: center; }
        .day-col { background: #fff; border-radius: 8px; padding: 15px 10px; border: 1px solid #eee; transition: 0.3s; }
        .day-name { font-weight: bold; color: var(--primary); margin-bottom: 5px; display: block; }
        .day-date { font-size: 12px; color: #888; margin-bottom: 15px; display: block; }
        
        .shift-box { 
            background: white; border: 1px solid #ddd; padding: 10px; 
            border-radius: 6px; margin-bottom: 10px; cursor: pointer; transition: 0.2s;
            font-size: 13px; display: block; 
        }
        .shift-box input { display: none; }
        .shift-box.selected { background: #e0f2f1; border-color: var(--primary); color: var(--primary); font-weight: bold; }
        
        .btn-save-schedule { 
            background: var(--primary); color: white; border: none; 
            padding: 12px 30px; border-radius: 8px; font-weight: bold; 
            margin-top: 20px; cursor: pointer; 
        }
        .btn-save-schedule:hover { background: #006064; }
        .nav-week-btn { background: #607d8b; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 14px; }

        /* Dark mode overrides cho trang lịch */
        body.dark-mode .day-col { background: #1e1e1e; border-color: #333; }
        body.dark-mode .shift-box { background: #2c2c2c; border-color: #444; color: #ccc; }
        body.dark-mode .shift-box.selected { background: #004d40; border-color: #009688; color: #fff; }
        body.dark-mode .day-date { color: #aaa; }
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
            <li><a href="emr-list.php">📝 Bệnh án điện tử</a></li>
            <li class="active"><a href="schedule.php">🕒 Lịch làm việc</a></li>
            <li><a href="logout.php" class="logout">Đăng xuất</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <header class="top-bar">
            <h2>Đăng Ký Lịch Làm Việc</h2>
            <div class="date-display">Tháng <?php echo date('m/Y', $monday_timestamp); ?></div>
        </header>

        <div class="schedule-section"> <div class="week-header">
                <a href="?offset=<?php echo $offset - 1; ?>" class="nav-week-btn">◀ Tuần trước</a>
                <h3>Từ <?php echo $start_date_str; ?> đến <?php echo $end_date_str; ?></h3>
                <a href="?offset=<?php echo $offset + 1; ?>" class="nav-week-btn">Tuần sau ▶</a>
            </div>

            <form action="" method="POST">
                <div class="schedule-grid">
                    <?php 
                    for ($i = 0; $i < 7; $i++) {
                        $current_day_ts = $monday_timestamp + ($i * 24 * 60 * 60);
                        $day_code = date('D', $current_day_ts);
                        $date_display = date('d/m', $current_day_ts);
                        $is_sunday = ($day_code == 'Sun');
                    ?>
                    <div class="day-col">
                        <span class="day-name" style="<?php echo $is_sunday ? 'color:#ef5350;' : ''; ?>">
                            <?php echo $days_of_week[$day_code]; ?>
                        </span>
                        <span class="day-date"><?php echo $date_display; ?></span>
                        
                        <?php if (!$is_sunday): ?>
                            <label class="shift-box">
                                <input type="checkbox" name="shift[<?php echo $date_display; ?>][]" value="Sáng"> Sáng
                            </label>
                            <label class="shift-box">
                                <input type="checkbox" name="shift[<?php echo $date_display; ?>][]" value="Chiều"> Chiều
                            </label>
                        <?php else: ?>
                            <label class="shift-box" style="background:#ffebee; color:#c62828; border:none; cursor: default;">
                                Nghỉ
                            </label>
                        <?php endif; ?>
                    </div>
                    <?php } ?>
                </div>

                <div style="text-align: center;">
                    <button type="button" class="btn-save-schedule" onclick="alert('Đã lưu lịch đăng ký!')">LƯU LỊCH ĐĂNG KÝ</button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
    // Script chọn ca làm việc
    const shifts = document.querySelectorAll('.shift-box input');
    shifts.forEach(input => {
        input.addEventListener('change', function() {
            if(this.checked) {
                this.parentElement.classList.add('selected');
            } else {
                this.parentElement.classList.remove('selected');
            }
        });
    });

    // --- ĐỒNG BỘ DARK MODE ---
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
    }
</script>

</body>
</html>