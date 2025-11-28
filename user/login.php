<?php
include('../config/db.php'); // db.php đã tự session_start() nếu cần

$error = "";

// Xử lý đăng nhập
if(isset($_POST['action']) && $_POST['action'] == 'login'){
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])){
            $_SESSION['user_id'] = $row['id'];
            header('Location: ../index.php'); // Redirect về trang index
            exit;
        } else {
            $error = "Sai mật khẩu!";
        }
    } else {
        $error = "Người dùng không tồn tại!";
    }
}

// Xử lý đăng ký
if(isset($_POST['action']) && $_POST['action'] == 'register'){
    $username = trim($_POST['username']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Kiểm tra username đã tồn tại chưa
    $sql_check = "SELECT id FROM users WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if($result_check->num_rows > 0){
        $error = "Tên đăng nhập đã tồn tại!";
    } else {
        $sql_insert = "INSERT INTO users (username, phone, email, password) VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ssss", $username, $phone, $email, $password);
        if($stmt_insert->execute()){
            $_SESSION['user_id'] = $conn->insert_id; // Tự động login sau khi đăng ký
            header('Location: ../index.php'); // Redirect về index
            exit;
        } else {
            $error = "Đăng ký thất bại, thử lại sau.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đăng nhập / Đăng ký - PetCare</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Poppins', sans-serif; background: #f5f5f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
  .auth-container { background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 400px; text-align: center; }
  .auth-container h2 { margin-bottom: 20px; color: #333; }
  .auth-container form { display: none; flex-direction: column; }
  .auth-container form.active { display: flex; }
  .auth-container input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; }
  .auth-container button { width: 100%; padding: 12px; margin-top: 15px; background: #FF6B6B; border: none; border-radius: 8px; color: #fff; font-size: 16px; cursor: pointer; transition: 0.3s; }
  .auth-container button:hover { background: #ff4b4b; }
  .auth-container .toggle { margin-top: 15px; font-size: 14px; color: #555; }
  .auth-container .toggle a { color: #FF6B6B; text-decoration: none; font-weight: 600; cursor: pointer; }
  .error-message { color: #ff4b4b; font-size: 14px; margin-top: 10px; }
</style>
</head>
<body>

<div class="auth-container">
  <h2>PetCare</h2>

  <?php if($error) echo "<div class='error-message'>$error</div>"; ?>

  <!-- Form đăng nhập -->
  <form method="post" id="loginForm" class="active">
      <input type="text" name="username" placeholder="Tên đăng nhập" required>
      <input type="password" name="password" placeholder="Mật khẩu" required>
      <input type="hidden" name="action" value="login">
      <button type="submit">Đăng nhập</button>
      <div class="toggle" style="margin-top:8px;">
        <a href="forgot_password.php">Quên mật khẩu?</a>
      </div>
      <div class="toggle">Chưa có tài khoản? <a onclick="toggleForm()">Đăng ký</a></div>
  </form>

  <!-- Form đăng ký -->
  <form method="post" id="registerForm">
      <input type="text" name="username" placeholder="Tên đăng nhập" required>
      <input type="text" name="phone" placeholder="Số điện thoại" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Mật khẩu" required>
      <input type="hidden" name="action" value="register">
      <button type="submit">Đăng ký</button>
      <div class="toggle">Đã có tài khoản? <a onclick="toggleForm()">Đăng nhập</a></div>
  </form>
</div>

<script>
function toggleForm(){
  document.getElementById('loginForm').classList.toggle('active');
  document.getElementById('registerForm').classList.toggle('active');
}
</script>

</body>
</html>
