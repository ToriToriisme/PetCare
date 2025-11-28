<?php
include('../config/db.php'); // đã có session_start nếu cần

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if ($email === '') {
        $message = 'Vui lòng nhập email đã đăng ký.';
    } else {
        // Tìm user theo email
        $stmt = $conn->prepare('SELECT id, username FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if (!$user) {
            $message = 'Không tìm thấy tài khoản với email này.';
        } else {
            // Tạo mật khẩu tạm (8 ký tự)
            $tempPassword = substr(bin2hex(random_bytes(8)), 0, 8);
            $hashed = password_hash($tempPassword, PASSWORD_DEFAULT);

            $update = $conn->prepare('UPDATE users SET password = ? WHERE id = ?');
            $update->bind_param('si', $hashed, $user['id']);
            if ($update->execute()) {
                $message = "Mật khẩu tạm thời của bạn là: <strong>{$tempPassword}</strong><br>"
                         . "Vui lòng đăng nhập và đổi lại mật khẩu trong trang Tài khoản.";
            } else {
                $message = 'Có lỗi xảy ra khi cập nhật mật khẩu. Vui lòng thử lại.';
            }
            $update->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quên mật khẩu - PetCare</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .auth-container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 420px;
            text-align: center;
        }
        .auth-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .auth-container p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }
        .auth-container input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        .auth-container button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background: #00bcd4;
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }
        .auth-container button:hover {
            background: #0097a7;
        }
        .message {
            margin-top: 15px;
            font-size: 14px;
            color: #333;
        }
        .back-link {
            margin-top: 15px;
            font-size: 14px;
        }
        .back-link a {
            color: #00bcd4;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="auth-container">
    <h2>Quên mật khẩu</h2>
    <p>Nhập email đã đăng ký. Hệ thống sẽ tạo mật khẩu tạm để bạn đăng nhập lại.</p>

    <form method="post">
        <input type="email" name="email" placeholder="Email đã đăng ký" required>
        <button type="submit">Tạo mật khẩu mới</button>
    </form>

    <?php if ($message): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>

    <div class="back-link">
        <a href="login.php">← Quay lại đăng nhập</a>
    </div>
</div>

</body>
</html>


