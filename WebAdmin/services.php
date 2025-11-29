<?php
// Chỉ include DB nếu bạn muốn thao tác thêm/xóa
require_once('../config/db.php');
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <title>Dịch Vụ - Quản Lý Phòng Khám</title>
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-clinic'></i>
        <span class="text">PETCARE</span>
    </a>
    <ul class="side-menu top">
       <li><a href="services.php"><i class='bx bxs-briefcase-alt-2'></i><span class="text">Dịch Vụ</span></a></li>
        <li><a href="doctors.php"><i class='bx bxs-user-voice'></i><span class="text">Bác Sĩ</span></a></li>
        <li><a href="customers.php"><i class='bx bxs-group'></i><span class="text">Khách Hàng</span></a></li>
        <li ><a href="blogs.php"><i class='bx bxs-book-content'></i><span class="text">Blogs</span></a></li>
    </ul>
</section>

<!-- CONTENT -->
<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <a class="nav-link">Quản Lý Dịch Vụ</a>
        <form action="">
            <div class="form-input">
                <input type="search" placeholder="Tìm kiếm dịch vụ...">
                <button class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>
        <a class="profile"><img src="../WebAdmin/img/bs1.jpg"></a>
    </nav>

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Quản Lý Dịch Vụ</h1>
                <ul class="breadcrumb">
                    <li><a href="index.php">Bảng Điều Khiển</a></li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li><a class="active" href="#">Dịch Vụ</a></li>
                </ul>
            </div>

            <button class="btn-add" id="openAddModal">
                <i class='bx bx-plus'></i> Thêm Dịch Vụ
            </button>
        </div>

        <!-- TABLE -->
        <div class="table-data">
            <div class="order">
                <div class="head">
                    <h3>Danh Sách Dịch Vụ</h3>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Dịch Vụ</th>
                            <th>Mô Tả</th>
                            <th>Hình ảnh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Lấy danh sách dịch vụ từ database
                        $services = $conn->query("SELECT * FROM services ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC);
                        $stt = 1;
                        foreach ($services as $s) {
                            $img_path = "../assets/img/service/service" . $stt . ".png";
                            if (!empty($s['image'])) {
                                if (strpos($s['image'], 'assets/img/service/') !== false) {
                                    $img_path = "../" . $s['image'];
                                } else {
                                    $img_path = "../assets/img/service/" . basename($s['image']);
                                }
                            }
                            echo "<tr>
                                <td>{$stt}</td>
                                <td>" . htmlspecialchars($s['name']) . "</td>
                                <td>" . htmlspecialchars($s['description'] ?? $s['short_description'] ?? '') . "</td>
                                <td><img src='{$img_path}' width='60' height='60' style='object-fit:cover; border-radius:5px;' alt='" . htmlspecialchars($s['name']) . "' onerror=\"this.src='../assets/img/service/service{$stt}.png'\"></td>
                            </tr>";
                            $stt++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</section>

</body>
</html>
