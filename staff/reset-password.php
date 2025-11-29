<?php
session_start();
include('../config/db.php');

$message = "";
$messageType = "";
// Lấy mã Token và Email từ trên thanh địa chỉ (cái link màu xanh lúc nãy gửi qua)
$token = $_GET['token'] ?? '';
$email = $_GET['email'] ?? '';

// --- 1. KIỂM TRA TOKEN ---
// Xem token này có đúng của bác sĩ này không và còn hạn không
date_default_timezone_set('Asia/Ho_Chi_Minh');
$now = date("Y-m-d H:i:s");

// Kiểm tra trong bảng doctors
$stmt = $conn->prepare("SELECT id FROM doctors WHERE email = ? AND reset_token = ? AND reset_expiry > ?");
$stmt->bind_param("sss", $email, $token, $now);
$stmt->execute();
$result = $stmt->get_result();

$isValidToken = ($result->num_rows > 0);

if (!$isValidToken) {
    // Nếu token sai hoặc hết hạn
    $message = "⚠️ Link này không hợp lệ hoặc đã hết hạn!";
    $messageType = "error";
}

// --- 2. XỬ LÝ ĐỔI MẬT KHẨU KHI BẤM NÚT ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && $isValidToken) {
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    if ($new_pass !== $confirm_pass) {
        $message = "Mật khẩu nhập lại không khớp!";
        $messageType = "error";
    } else {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);
        
        // Cập nhật mật khẩu mới vào Database và XÓA token cũ
        $update = $conn->prepare("UPDATE doctors SET password = ?, reset_token = NULL, reset_expiry = NULL WHERE email = ?");
        $update->bind_param("ss", $hashed_password, $email);
        
        if ($update->execute()) {
            $message = "✅ Đổi mật khẩu thành công! Đang chuyển trang...";
            $messageType = "success";
            // Chuyển về trang login sau 2 giây
            echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";
        } else {
            $message = "Lỗi hệ thống!";
            $messageType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đặt lại mật khẩu - PetCare Staff</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/staff-style.css">
  <style>
      body.login-page { display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #f0f2f5; margin: 0; }
      .login-container { background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
      .alert-box { padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; text-align: center; }
      .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
      .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
  </style>
</head>
<body class="login-page">

  <div class="login-container">
      <div class="login-header" style="text-align: center;">
          <h1>🔑 Mật Khẩu Mới</h1>
          <?php if($email): ?>
            <p style="color: #666; font-size: 14px; margin-bottom: 20px;">Cho tài khoản: <b><?php echo htmlspecialchars($email); ?></b></p>
          <?php endif; ?>
      </div>

      <?php if ($message): ?>
          <div class="alert-box alert-<?php echo $messageType; ?>">
              <?php echo $message; ?>
          </div>
      <?php endif; ?>

      <?php if ($isValidToken && $messageType !== 'success'): ?>
      
      <form class="login-form" action="" method="POST">
          <div class="form-group">
              <label>Mật khẩu mới</label>
              <input type="password" name="new_password" placeholder="••••••••" required 
                     style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-top: 5px;">
          </div>

          <div class="form-group">
              <label>Nhập lại mật khẩu</label>
              <input type="password" name="confirm_password" placeholder="••••••••" required
                     style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-top: 5px;">
          </div>

          <button type="submit" style="width: 100%; padding: 12px; background: #28a745; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; margin-top: 20px;">
              XÁC NHẬN ĐỔI
          </button>
      </form>
      <?php endif; ?>

      <?php if (!$isValidToken): ?>
          <div style="text-align:center; margin-top:20px;">
              <a href="forgot-password.php" style="color:#00bcd4; text-decoration:none;">Gửi lại yêu cầu</a>
          </div>
      <?php endif; ?>
  </div>

</body>
</html>