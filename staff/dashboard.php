<?php
session_start(); // Khởi động phiên làm việc

// 1. KIỂM TRA BẢO MẬT
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// 2. LẤY THÔNG TIN BÁC SĨ
$current_user = [
    'name' => $_SESSION['user_name'] ?? 'Bác sĩ',
    'role' => $_SESSION['user_role'] ?? 'Bác sĩ Thú Y',
    'avatar' => '../' . ($_SESSION['user_avatar'] ?? 'assets/img/doctor-duy.jpg') 
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bác sĩ Dashboard - PetCare</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/staff-style.css">
    <style>
        /* Thêm style cho trạng thái Đã hủy */
        .status.cancelled { color: #c62828; background: #ffebee; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px; }
        .reason-text { font-size: 12px; color: #777; font-style: italic; display: block; margin-top: 5px; }
    </style>
</head>
<body>

<div class="admin-layout">
    <aside class="sidebar">
        <div class="brand">
            🐾 PetCare <span class="badge">Doctor</span>
        </div>
        
        <div class="user-panel">
            <img src="<?php echo htmlspecialchars($current_user['avatar']); ?>" alt="Avatar"> 
            <div class="info">
                <p>Xin chào,</p>
                <h4><?php echo htmlspecialchars($current_user['name']); ?></h4>
                <small style="color:#ccc; font-size: 12px;"><?php echo htmlspecialchars($current_user['role']); ?></small>
            </div>
        </div>

        <ul class="menu">
            <li class="active"><a href="dashboard.php">📅 Lịch hẹn hôm nay</a></li>
            <li><a href="emr-list.php">📝 Bệnh án điện tử</a></li>
            <li><a href="schedule.php">🕒 Lịch làm việc</a></li>
            <li><a href="logout.php" class="logout">Đăng xuất</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <header class="top-bar">
            <h2>Quản lý Lịch hẹn (Nghiệp vụ)</h2>
            <div class="date-display">Hôm nay: <b><?php echo date('d/m/Y'); ?></b></div>
        </header>

        <div class="stats-grid">
            <div class="stat-card blue">
                <h3>05</h3>
                <p>Lịch chờ khám</p>
            </div>
            <div class="stat-card green">
                <h3>02</h3>
                <p>Đã hoàn thành</p>
            </div>
            <div class="stat-card orange">
                <h3>01</h3>
                <p>Chờ Check-in</p>
            </div>
        </div>

        <section class="schedule-section">
            <div class="section-header">
                <h3>Danh sách bệnh nhân hôm nay</h3>
                <button class="btn-refresh" onclick="location.reload()">Làm mới</button>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Giờ</th>
                            <th>Khách hàng</th>
                            <th>Thú cưng</th>
                            <th>Dịch vụ</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="row-1">
                            <td><b>08:30</b></td>
                            <td>Nguyễn Văn A<br><small>0909123456</small></td>
                            <td>🐶 Miu (Chó)</td>
                            <td><span class="tag service">Khám tổng quát</span></td>
                            <td><span class="status pending" id="status-1">Chờ Check-in</span></td>
                            <td id="action-1">
                                <button class="btn-action checkin" onclick="handleCheckIn(1)">✅ Check-in</button>
                                <button class="btn-action cancel" onclick="handleCancel(1)">❌ Hủy</button>
                            </td>
                        </tr>
                        
                        <tr class="active-row">
                            <td><b>09:00</b></td>
                            <td>Trần Thị B<br><small>0912345678</small></td>
                            <td>🐱 Bông (Mèo)</td>
                            <td><span class="tag service">Tiêm phòng</span></td>
                            <td><span class="status waiting">Đang đợi khám</span></td>
                            <td>
                                <a href="medical-record.php" class="btn-action exam" style="display:inline-block; text-decoration:none;">🩺 Khám ngay</a>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><b>10:15</b></td>
                            <td>Lê Văn C<br><small>0988776655</small></td>
                            <td>🐶 Lu (Chó)</td>
                            <td><span class="tag service">Phẫu thuật</span></td>
                            <td><span class="status done">Đã xong</span></td>
                            <td>
                                <a href="medical-record.php?view=true" class="btn-action view" style="display:inline-block; text-decoration:none;">👁️ Xem hồ sơ</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<script>
    // Hàm xử lý Check-in
    function handleCheckIn(id) {
        if(confirm('Xác nhận khách hàng đã đến và sẵn sàng khám?')) {
            // 1. Đổi trạng thái
            const statusSpan = document.getElementById('status-' + id);
            statusSpan.className = 'status waiting'; // Đổi class màu xanh
            statusSpan.innerText = 'Đang đợi khám';

            // 2. Đổi nút bấm
            const actionTd = document.getElementById('action-' + id);
            actionTd.innerHTML = '<a href="medical-record.php" class="btn-action exam" style="display:inline-block; text-decoration:none;">🩺 Khám ngay</a>';
            
            // 3. Highlight dòng đó lên
            document.getElementById('row-' + id).classList.add('active-row');
        }
    }

    // Hàm xử lý Hủy lịch
    function handleCancel(id) {
        const reason = prompt("Vui lòng nhập lý do hủy lịch (Khách bận, Bác sĩ bận...):");
        
        if (reason != null && reason.trim() !== "") {
            // 1. Đổi trạng thái
            const statusSpan = document.getElementById('status-' + id);
            statusSpan.className = 'status cancelled'; // Đổi class màu đỏ
            statusSpan.innerText = 'Đã hủy';

            // 2. Xóa nút bấm và hiện lý do
            const actionTd = document.getElementById('action-' + id);
            actionTd.innerHTML = '<span class="reason-text">Lý do: ' + reason + '</span>';
            
            // 3. Làm mờ dòng đó đi
            document.getElementById('row-' + id).style.opacity = '0.6';
        }
    }
</script>

</body>
</html>