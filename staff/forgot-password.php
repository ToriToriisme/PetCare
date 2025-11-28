<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu - PetCare Staff</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/staff-style.css">
    <style>
        /* CSS bổ sung nhỏ để căn giữa màn hình nếu file css gốc chưa có */
        body.login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f0f2f5;
            margin: 0;
        }
        .login-container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-header h1 { font-size: 24px; color: #333; margin-bottom: 10px; }
        .login-header p { color: #666; font-size: 14px; margin-bottom: 30px; }
        
        .alert-box {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none; /* Ẩn mặc định, JS sẽ hiện lên */
            text-align: left;
        }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body class="login-page">

    <div class="login-container">
        <div class="login-header">
            <h1>🔒 Quên Mật Khẩu?</h1>
            <p>Đừng lo! Hãy nhập email đăng ký của bạn, chúng tôi sẽ gửi hướng dẫn đặt lại mật khẩu.</p>
        </div>
        
        <div class="alert-box alert-success" id="successMsg">
            ✅ Đã gửi link khôi phục! Vui lòng kiểm tra Email.
        </div>

        <form class="login-form" action="" method="POST" onsubmit="return handleMockSubmit(event)">
            <div class="form-group" style="text-align: left;">
                <label>Email nhân viên</label>
                <input type="email" id="email" placeholder="VD: bacsi@petcare.vn" required 
                       style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; margin-top: 5px;">
            </div>

            <button type="submit" class="btn-login" 
                    style="width: 100%; padding: 12px; background: #00bcd4; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; margin-top: 20px;">
                GỬI YÊU CẦU
            </button>
            
            <div class="login-footer" style="margin-top: 20px;">
                <a href="login.php" style="color: #666; text-decoration: none; font-size: 14px;">
                    <i class="fas fa-arrow-left"></i> Quay lại Đăng nhập
                </a>
            </div>
        </form>
    </div>

    <script>
        // Script giả lập hiệu ứng UI để bạn xem trước
        function handleMockSubmit(e) {
            e.preventDefault(); // Chặn reload trang
            const btn = document.querySelector('button[type="submit"]');
            const originalText = btn.innerText;
            
            // 1. Hiệu ứng đang gửi
            btn.innerText = "Đang gửi...";
            btn.style.opacity = "0.7";
            
            // 2. Giả lập sau 1.5s thì báo thành công
            setTimeout(() => {
                btn.innerText = originalText;
                btn.style.opacity = "1";
                document.getElementById('successMsg').style.display = 'block';
                document.getElementById('email').value = ''; // Xóa ô input
            }, 1500);
            return false;
        }
    </script>
</body>
</html>