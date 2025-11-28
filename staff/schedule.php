<?php
// --- PHẦN XỬ LÝ LOGIC PHP (Mới thêm) ---

// 1. Lấy tham số 'offset' từ URL (Mặc định là 0 - Tuần hiện tại)
// offset = 1 nghĩa là tuần sau, offset = -1 nghĩa là tuần trước
$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

// 2. Xác định ngày Thứ 2 đầu tuần của tuần đang chọn
// Logic: Lấy thứ 2 tuần này, cộng thêm số tuần (offset)
$monday_timestamp = strtotime("this week monday") + ($offset * 7 * 24 * 60 * 60);

// 3. Tính ngày Chủ nhật cuối tuần đó
$sunday_timestamp = $monday_timestamp + (6 * 24 * 60 * 60);

// 4. Tạo định dạng hiển thị (VD: 20/11)
$start_date_str = date('d/m', $monday_timestamp);
$end_date_str = date('d/m', $sunday_timestamp);
$year_str = date('Y', $monday_timestamp);

// Danh sách tên thứ tiếng Việt để hiển thị trong vòng lặp
$days_of_week = [
    'Mon' => 'Thứ 2',
    'Tue' => 'Thứ 3',
    'Wed' => 'Thứ 4',
    'Thu' => 'Thứ 5',
    'Fri' => 'Thứ 6',
    'Sat' => 'Thứ 7',
    'Sun' => 'CN'
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
        /* Giữ nguyên CSS cũ của bạn */
        .schedule-card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .week-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        
        .schedule-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px; text-align: center; }
        .day-col { background: #f9fafb; border-radius: 8px; padding: 15px 10px; border: 1px solid #eee; }
        .day-name { font-weight: bold; color: var(--primary); margin-bottom: 5px; display: block; }
        .day-date { font-size: 12px; color: #888; margin-bottom: 15px; display: block; }
        
        .shift-box { 
            background: white; border: 1px solid #ddd; padding: 10px; 
            border-radius: 6px; margin-bottom: 10px; cursor: pointer; transition: 0.2s;
            font-size: 13px; display: block; /* Sửa thành block để label hoạt động tốt hơn */
        }
        .shift-box input { display: none; }
        .shift-box.selected { background: #e0f2f1; border-color: var(--primary); color: var(--primary); font-weight: bold; }
        
        .btn-save-schedule { 
            background: var(--primary); color: white; border: none; 
            padding: 12px 30px; border-radius: 8px; font-weight: bold; 
            margin-top: 20px; cursor: pointer; 
        }
        .btn-save-schedule:hover { background: #006064; }

        /* Style cho link nút bấm chuyển tuần */
        .nav-week-btn {
            background: #607d8b; color: white; padding: 8px 15px; 
            border-radius: 5px; text-decoration: none; font-size: 14px;
            transition: 0.3s;
        }
        .nav-week-btn:hover { background: #455a64; }
    </style>
</head>
<body>

<div class="admin-layout">
    <aside class="sidebar">
        <div class="brand">🐾 PetCare <span class="badge">Doctor</span></div>
        <div class="user-panel">
            <img src="../assets/img/doctor-duy.jpg" alt="Avatar">
            <div class="info">
                <p>Xin chào,</p>
                <h4>BS. Đào Văn Duy</h4>
            </div>
        </div>
        <ul class="menu">
            <li><a href="dashboard.php">📅 Lịch hẹn hôm nay</a></li>
            <li><a href="emr-list.php">📝 Bệnh án điện tử</a></li>
            <li class="active"><a href="schedule.php">🕒 Lịch làm việc</a></li>
            <li><a href="login.php" class="logout">Đăng xuất</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <header class="top-bar">
            <h2>Đăng Ký Lịch Làm Việc</h2>
            <div class="date-display">Tháng <?php echo date('m/Y', $monday_timestamp); ?></div>
        </header>

        <div class="schedule-card">
            <div class="week-header">
                <a href="?offset=<?php echo $offset - 1; ?>" class="nav-week-btn">◀ Tuần trước</a>
                
                <h3>Từ <?php echo $start_date_str; ?> đến <?php echo $end_date_str; ?></h3>
                
                <a href="?offset=<?php echo $offset + 1; ?>" class="nav-week-btn">Tuần sau ▶</a>
            </div>

            <form action="" method="POST">
                <div class="schedule-grid">
                    
                    <?php 
                    // VÒNG LẶP SINH RA 7 NGÀY (Thay vì viết code cứng HTML 7 lần)
                    for ($i = 0; $i < 7; $i++) {
                        // Tính ngày hiện tại trong vòng lặp
                        $current_day_ts = $monday_timestamp + ($i * 24 * 60 * 60);
                        $day_code = date('D', $current_day_ts); // Mon, Tue...
                        $date_display = date('d/m', $current_day_ts); // 20/11...
                        
                        // Kiểm tra nếu là Chủ nhật thì bôi đỏ chữ (logic hiển thị)
                        $is_sunday = ($day_code == 'Sun');
                    ?>
                    
                    <div class="day-col">
                        <span class="day-name" style="<?php echo $is_sunday ? 'color:red;' : ''; ?>">
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

                    <?php } // Kết thúc vòng lặp ?>

                </div>

                <div style="text-align: center;">
                    <button type="button" class="btn-save-schedule" onclick="alert('Đã lưu lịch đăng ký cho tuần này!')">LƯU LỊCH ĐĂNG KÝ</button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
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
</script>

</body>
</html>