<?php
require_once '../config/db.php'; // db.php already handles session_start

if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }
$user_id = $_SESSION['user_id'];
$msg = "";

// Auto-create work_schedules table if it doesn't exist
$table_check = $conn->query("SHOW TABLES LIKE 'work_schedules'");
if ($table_check->num_rows == 0) {
    $create_table_sql = "CREATE TABLE IF NOT EXISTS work_schedules (
        id INT AUTO_INCREMENT PRIMARY KEY,
        doctor_id INT NOT NULL,
        work_date DATE NOT NULL,
        shift_type ENUM('Sáng', 'Chiều') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE,
        UNIQUE KEY unique_schedule (doctor_id, work_date, shift_type)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    $conn->query($create_table_sql);
}

// Xử lý lưu lịch
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_schedule'])) {
    $week_start = $_POST['week_start'];
    $week_end = $_POST['week_end'];
    $shifts = $_POST['shift'] ?? []; 

    // Use prepared statement for DELETE
    $stmt_delete = $conn->prepare("DELETE FROM work_schedules WHERE doctor_id = ? AND work_date BETWEEN ? AND ?");
    $stmt_delete->bind_param("iss", $user_id, $week_start, $week_end);
    $stmt_delete->execute();

    if (!empty($shifts)) {
        $stmt = $conn->prepare("INSERT INTO work_schedules (doctor_id, work_date, shift_type) VALUES (?, ?, ?)");
        foreach ($shifts as $date => $types) {
            foreach ($types as $type) {
                $stmt->bind_param("iss", $user_id, $date, $type);
                $stmt->execute();
            }
        }
    }
    $msg = "Đã lưu lịch làm việc thành công!";
}

// Logic thời gian
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$monday_ts = strtotime("this week monday") + ($offset * 7 * 86400);
$sunday_ts = $monday_ts + (6 * 86400);
$start_db = date('Y-m-d', $monday_ts);
$end_db = date('Y-m-d', $sunday_ts);
$start_view = date('d/m', $monday_ts);
$end_view = date('d/m', $sunday_ts);

// Lấy dữ liệu lịch
$registered = [];
$stmt_schedule = $conn->prepare("SELECT work_date, shift_type FROM work_schedules WHERE doctor_id = ? AND work_date BETWEEN ? AND ?");
$stmt_schedule->bind_param("iss", $user_id, $start_db, $end_db);
$stmt_schedule->execute();
$res = $stmt_schedule->get_result();
while ($row = $res->fetch_assoc()) {
    $registered[$row['work_date']][] = $row['shift_type'];
}

// Lấy user info
$stmt_user = $conn->prepare("SELECT name, specialty, image FROM doctors WHERE id = ?");
$stmt_user->bind_param("i", $user_id);
$stmt_user->execute();
$user = $stmt_user->get_result()->fetch_assoc();
$avatar_url = "../" . ($user['image'] ?? 'assets/img/default-avatar.png');
if (!file_exists($avatar_url) || empty($user['image'])) {
    $avatar_url = "https://ui-avatars.com/api/?name=" . urlencode($user['name']) . "&background=0097a7&color=fff&size=128";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lịch làm việc</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/staff-style.css">
    <style>
        .week-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .schedule-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px; text-align: center; }
        .day-col { background: var(--bg-card); border-radius: 8px; padding: 15px 10px; border: 1px solid var(--border-color); display: flex; flex-direction: column; }
        .day-name { font-weight: bold; color: var(--primary); margin-bottom: 5px; display: block; }
        .day-date { font-size: 12px; color: var(--text-muted); margin-bottom: 15px; display: block; }
        .nav-week-btn { background: #607d8b; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none; font-size: 14px; }
        .shift-box { 
            display: block; 
            padding: 10px; 
            margin: 5px 0; 
            border: 2px solid var(--border-color); 
            border-radius: 8px; 
            cursor: pointer; 
            text-align: center;
            transition: all 0.3s;
            background: var(--bg-body);
            color: var(--text-main);
        }
        .shift-box:hover { 
            border-color: var(--primary); 
            background: rgba(0, 188, 212, 0.1);
        }
        .shift-box.selected { 
            background: var(--primary); 
            color: white; 
            border-color: var(--primary);
            font-weight: 600;
        }
        .btn-save-schedule {
            background: var(--primary);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-save-schedule:hover {
            background: var(--primary-dark);
        }
    </style>
</head>
<body>

<div class="admin-layout">
    <aside class="sidebar">
        <div class="brand">🐾 PetCare <span class="badge">Doctor</span></div>
        
        <a href="staff-profile.php" class="user-panel" style="text-decoration: none;">
            <img src="<?php echo $avatar_url; ?>" alt="Avatar">
            <div class="info">
                <h4 style="margin:0; font-size:15px; font-weight:600;"><?php echo htmlspecialchars($user['name']); ?></h4>
                <small style="color:#b0bec5; font-size: 12px; display:block; margin-top:2px;"><?php echo htmlspecialchars($user['specialty']); ?></small>
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
        </header>

        <div class="schedule-section">
            <?php if($msg): ?><div style="background:#d4edda; color:#155724; padding:15px; margin-bottom:20px; border-radius:8px;">✅ <?php echo $msg; ?></div><?php endif; ?>

            <div class="week-header">
                <a href="?offset=<?php echo $offset - 1; ?>" class="nav-week-btn">◀ Tuần trước</a>
                <h3>Từ <?php echo $start_view; ?> đến <?php echo $end_view; ?></h3>
                <a href="?offset=<?php echo $offset + 1; ?>" class="nav-week-btn">Tuần sau ▶</a>
            </div>

            <form action="" method="POST">
                <input type="hidden" name="save_schedule" value="1">
                <input type="hidden" name="week_start" value="<?php echo $start_db; ?>">
                <input type="hidden" name="week_end" value="<?php echo $end_db; ?>">

                <div class="schedule-grid">
                    <?php 
                    $days = ['Mon'=>'Thứ 2','Tue'=>'Thứ 3','Wed'=>'Thứ 4','Thu'=>'Thứ 5','Fri'=>'Thứ 6','Sat'=>'Thứ 7','Sun'=>'CN'];
                    for ($i=0; $i<7; $i++) {
                        $ts = $monday_ts + ($i*86400);
                        $d_code = date('D', $ts);
                        $d_db = date('Y-m-d', $ts);
                        $d_view = date('d/m', $ts);
                        
                        $sang = (isset($registered[$d_db]) && in_array('Sáng', $registered[$d_db])) ? 'checked' : '';
                        $chieu = (isset($registered[$d_db]) && in_array('Chiều', $registered[$d_db])) ? 'checked' : '';
                        $cls_sang = $sang ? 'selected' : '';
                        $cls_chieu = $chieu ? 'selected' : '';
                    ?>
                    <div class="day-col">
                        <span class="day-name" style="<?php echo ($d_code=='Sun')?'color:#ef5350':''; ?>"><?php echo $days[$d_code]; ?></span>
                        <span class="day-date"><?php echo $d_view; ?></span>
                        <?php if ($d_code != 'Sun'): ?>
                            <label class="shift-box <?php echo $cls_sang; ?>" for="shift_sang_<?php echo $d_db; ?>">
                                <input type="checkbox" id="shift_sang_<?php echo $d_db; ?>" name="shift[<?php echo $d_db; ?>][]" value="Sáng" <?php echo $sang; ?> style="display:none"> Sáng
                            </label>
                            <label class="shift-box <?php echo $cls_chieu; ?>" for="shift_chieu_<?php echo $d_db; ?>">
                                <input type="checkbox" id="shift_chieu_<?php echo $d_db; ?>" name="shift[<?php echo $d_db; ?>][]" value="Chiều" <?php echo $chieu; ?> style="display:none"> Chiều
                            </label>
                        <?php else: ?>
                            <div style="padding:20px 0; color:#ef5350; font-size:13px;">Nghỉ</div>
                        <?php endif; ?>
                    </div>
                    <?php } ?>
                </div>

                <div style="text-align:center; margin-top:20px;">
                    <button type="submit" class="btn-save-schedule">LƯU LỊCH ĐĂNG KÝ</button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
    }
    
    // Fix checkbox click functionality
    document.addEventListener('DOMContentLoaded', function() {
        const boxes = document.querySelectorAll('.shift-box');
        boxes.forEach(box => {
            const inp = box.querySelector('input[type="checkbox"]');
            if (!inp) return;
            
            // Update visual state on page load
            if (inp.checked) {
                box.classList.add('selected');
            }
            
            // Handle label click - toggle checkbox
            box.addEventListener('click', function(e) {
                e.preventDefault();
                // Toggle checkbox
                inp.checked = !inp.checked;
                // Update visual state
                if (inp.checked) {
                    box.classList.add('selected');
                } else {
                    box.classList.remove('selected');
                }
            });
            
            // Also handle checkbox change event (in case it's clicked directly)
            inp.addEventListener('change', function() {
                if (this.checked) {
                    box.classList.add('selected');
                } else {
                    box.classList.remove('selected');
                }
            });
        });
    });
</script>
</body>
</html>