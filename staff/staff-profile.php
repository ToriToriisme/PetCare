<?php
session_start();
require_once '../config/db.php';

// Kiểm tra đăng nhập
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$msg = "";
$msg_type = "";

// --- XỬ LÝ CẬP NHẬT THÔNG TIN ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Cập nhật Chức vụ & Tên
    if (isset($_POST['update_info'])) {
        $name = $_POST['name'];
        $specialty = $_POST['specialty']; 
        
        $stmt = $conn->prepare("UPDATE doctors SET name = ?, specialty = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $specialty, $user_id);
        
        if ($stmt->execute()) {
            $_SESSION['user_name'] = $name;
            $_SESSION['user_role'] = $specialty; 
            $msg = "Cập nhật thông tin thành công!";
            $msg_type = "success";
        } else {
            $msg = "Lỗi cập nhật thông tin.";
            $msg_type = "error";
        }
    }

    // 2. Xử lý Upload Ảnh đại diện
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['avatar']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (in_array(strtolower($filetype), $allowed)) {
            $new_filename = "staff_" . $user_id . "_" . time() . "." . $filetype;
            $target_dir = "../assets/img/uploads/";
            if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }
            
            $target_file = $target_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
                $db_path = "assets/img/uploads/" . $new_filename;
                
                $stmt = $conn->prepare("UPDATE doctors SET image = ? WHERE id = ?");
                $stmt->bind_param("si", $db_path, $user_id);
                $stmt->execute();
                
                $_SESSION['user_avatar'] = $db_path; 
                $msg = "Đổi ảnh đại diện thành công!";
                $msg_type = "success";
            } else {
                $msg = "Lỗi khi tải ảnh lên.";
                $msg_type = "error";
            }
        } else {
            $msg = "Chỉ chấp nhận file ảnh (JPG, PNG, GIF).";
            $msg_type = "error";
        }
    }
}

// Lấy thông tin mới nhất từ DB
$stmt = $conn->prepare("SELECT * FROM doctors WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Xử lý ảnh hiển thị
$avatar_url = "../" . ($user['image'] ?? 'assets/img/default-avatar.png');
if (!file_exists($avatar_url)) {
    $avatar_url = "https://ui-avatars.com/api/?name=" . urlencode($user['name']) . "&background=random"; 
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ cá nhân - PetCare Staff</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/staff-style.css">
</head>
<body>

<div class="admin-layout">
    <aside class="sidebar">
        <div class="brand">🐾 PetCare <span class="badge">Staff</span></div>
        
        <a href="staff-profile.php" class="user-panel active-panel" style="text-decoration: none;">
            <img src="<?php echo $avatar_url; ?>" alt="Avatar">
            <div class="info">
                <p>Xin chào,</p>
                <h4><?php echo htmlspecialchars($user['name']); ?></h4>
                <small><?php echo htmlspecialchars($user['specialty']); ?></small>
            </div>
        </a>

        <ul class="menu">
            <li><a href="dashboard.php">📅 Lịch hẹn hôm nay</a></li>
            <li><a href="emr-list.php">📝 Bệnh án điện tử</a></li>
            <li><a href="schedule.php">🕒 Lịch làm việc</a></li>
            <li><a href="logout.php" class="logout">Đăng xuất</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <header class="top-bar">
            <h2>Quản lý Hồ Sơ Cá Nhân</h2>
        </header>

        <div class="profile-container">
            <?php if($msg): ?>
                <div class="alert <?php echo $msg_type; ?>"><?php echo $msg; ?></div>
            <?php endif; ?>

            <div class="profile-grid">
                <div class="profile-card center-text" style="overflow: hidden;"> <div class="avatar-upload-fb">
                        <img src="<?php echo $avatar_url; ?>" id="avatarPreview" alt="Profile" style="max-width: 100%; object-fit: cover;"> <form action="" method="POST" enctype="multipart/form-data" id="avatarForm">
                            <label for="avatarInput" class="upload-icon-btn" title="Đổi ảnh đại diện">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" name="avatar" id="avatarInput" accept="image/*" onchange="document.getElementById('avatarForm').submit()" style="display: none;">
                        </form>
                    </div>

                    <h3 style="margin-top: 15px;"><?php echo htmlspecialchars($user['name']); ?></h3>
                    <p class="role-badge"><?php echo htmlspecialchars($user['specialty']); ?></p>
                    
                    <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
                    
                    <div class="theme-toggle-box">
                        <span>Giao diện Tối</span>
                        <label class="switch">
                            <input type="checkbox" id="darkModeToggle">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

                <div class="profile-card">
                    <h3 style="margin-top: 0;">Thông tin cơ bản</h3>
                    <form action="" method="POST">
                        <input type="hidden" name="update_info" value="1">
                        
                        <div class="form-group">
                            <label>Họ và tên</label>
                            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Tên đăng nhập (Không thể đổi)</label>
                            <input type="text" value="<?php echo htmlspecialchars($user['username']); ?>" disabled style="background: #f0f2f5;">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled style="background: #f0f2f5;">
                        </div>

                        <div class="form-group">
                            <label>Chức vụ / Chuyên khoa</label>
                            <p style="font-size: 12px; color: #666; margin-bottom: 5px;">*Cập nhật khi được thăng chức hoặc thay đổi vị trí</p>
                            <select name="specialty">
                                <option value="Bác sĩ Thú Y" <?php echo ($user['specialty'] == 'Bác sĩ Thú Y') ? 'selected' : ''; ?>>Bác sĩ Thú Y</option>
                                <option value="Y tá / Kỹ thuật viên" <?php echo ($user['specialty'] == 'Y tá / Kỹ thuật viên') ? 'selected' : ''; ?>>Y tá / Kỹ thuật viên</option>
                                <option value="Lễ tân" <?php echo ($user['specialty'] == 'Lễ tân') ? 'selected' : ''; ?>>Lễ tân</option>
                                <option value="Quản lý" <?php echo ($user['specialty'] == 'Quản lý') ? 'selected' : ''; ?>>Quản lý</option>
                                <?php if(!in_array($user['specialty'], ['Bác sĩ Thú Y', 'Y tá / Kỹ thuật viên', 'Lễ tân', 'Quản lý'])): ?>
                                    <option value="<?php echo $user['specialty']; ?>" selected><?php echo $user['specialty']; ?></option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn-save">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    // --- XỬ LÝ DARK MODE ---
    const toggle = document.getElementById('darkModeToggle');
    const body = document.body;

    if (localStorage.getItem('darkMode') === 'enabled') {
        body.classList.add('dark-mode');
        toggle.checked = true;
    }

    toggle.addEventListener('change', () => {
        if (toggle.checked) {
            body.classList.add('dark-mode');
            localStorage.setItem('darkMode', 'enabled');
        } else {
            body.classList.remove('dark-mode');
            localStorage.setItem('darkMode', 'disabled');
        }
    });
</script>

</body>
</html>