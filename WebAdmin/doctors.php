<?php
include('../config/db.php');

// Danh sách chuyên khoa
$specialties = [
    'Chuyên khoa: Khám tổng quát & Điều trị' => 'Khám tổng quát & Điều trị',
    'Chuyên khoa: Tiêm phòng & Tẩy giun' => 'Tiêm phòng & Tẩy giun',
    'Chuyên khoa: Phẫu thuật (Cấp cứu/Ngoại khoa)' => 'Phẫu thuật (Cấp cứu/Ngoại khoa)',
    'Chuyên khoa: Chẩn đoán hình ảnh & Xét nghiệm' => 'Chẩn đoán hình ảnh & Xét nghiệm'
];

// Xử lý thêm / sửa / xóa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $name = $_POST['name'] ?? '';
    $specialty = $_POST['specialty'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $description = $_POST['description'] ?? '';
    
    // Xử lý upload ảnh
    $image_name = '';
    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_name = uniqid('doctor_').'.'.$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/doctors/'.$image_name);
    }

    if ($action === 'add') {
        $stmt = $conn->prepare("INSERT INTO doctors (name, specialty, phone, email, description, image) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $name, $specialty, $phone, $email, $description, $image_name);
        $stmt->execute();
        $stmt->close();
    }

    if ($action === 'edit') {
        $id = $_POST['id'];
        // Lấy ảnh cũ nếu không upload mới
        $old_img = $_POST['old_image'] ?? '';
        if ($image_name == '') $image_name = $old_img;

        $stmt = $conn->prepare("UPDATE doctors SET name=?, specialty=?, phone=?, email=?, description=?, image=? WHERE id=?");
        $stmt->bind_param("ssssssi", $name, $specialty, $phone, $email, $description, $image_name, $id);
        $stmt->execute();
        $stmt->close();
    }

    if ($action === 'delete') {
        $id = $_POST['id'];
        // Xóa file ảnh
        $row = $conn->query("SELECT image FROM doctors WHERE id=$id")->fetch_assoc();
        if($row && $row['image'] && file_exists('../uploads/doctors/'.$row['image'])){
            unlink('../uploads/doctors/'.$row['image']);
        }
        $stmt = $conn->prepare("DELETE FROM doctors WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: doctors.php");
    exit;
}

// Lấy danh sách bác sĩ
$doctors = $conn->query("SELECT * FROM doctors ORDER BY id DESC")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quản lý bác sĩ - PetCare</title>
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="css/style.css">
<style>
.add-btn {background:#3C91E6;padding:8px 14px;color:white;border:none;border-radius:6px;cursor:pointer;}
.add-btn:hover{background:#2F78C4;}
select, input[type=text], input[type=email], textarea {width:100%;padding:6px 8px;margin:4px 0 10px;box-sizing:border-box;border-radius:4px;border:1px solid #ccc;}
textarea {resize:vertical;}
</style>
</head>
<body>

<section id="sidebar">
    <a class="brand"><i class='bx bxs-clinic'></i><span class="text">PETCARE</span></a>
    <ul class="side-menu top">
       <li><a href="services.php"><i class='bx bxs-briefcase-alt-2'></i><span class="text">Dịch Vụ</span></a></li>
        <li><a href="doctors.php"><i class='bx bxs-user-voice'></i><span class="text">Bác Sĩ</span></a></li>
        <li><a href="customers.php"><i class='bx bxs-group'></i><span class="text">Khách Hàng</span></a></li>
        <li ><a href="blogs.php"><i class='bx bxs-book-content'></i><span class="text">Blogs</span></a></li>
    </ul>
</section>

<section id="content">
<nav>
    <i class='bx bx-menu'></i>
    <a class="nav-link">Quản lý bác sĩ</a>
</nav>

<main>
    <div class="account-header">
        <div>
            <h1>Danh sách bác sĩ</h1>
            <p>Quản lý hồ sơ và thông tin bác sĩ</p>
        </div>
        <button class="add-btn" onclick="openModal()">+ Thêm bác sĩ</button>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Tên bác sĩ</th>
                    <th>Chuyên khoa</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Mô tả</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doctors as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['name']) ?></td>
                    <td><?= htmlspecialchars($specialties[$d['specialty']] ?? $d['specialty']) ?></td>
                    <td><?= htmlspecialchars($d['phone']) ?></td>
                    <td><?= htmlspecialchars($d['email']) ?></td>
                    <td><?= htmlspecialchars($d['description']) ?></td>
                    <td>
                        <?php if($d['image'] && file_exists('../uploads/doctors/'.$d['image'])): ?>
                            <img src="../uploads/doctors/<?= $d['image'] ?>" width="60" alt="<?= $d['name'] ?>">
                        <?php endif; ?>
                    </td>
                    <td>
                        <button onclick='editDoctor(<?= json_encode($d) ?>)'><i class='bx bx-edit'></i></button>
                        <form method="post" style="display:inline">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $d['id'] ?>">
                            <button type="submit" onclick="return confirm('Xóa bác sĩ này?')"><i class='bx bx-trash'></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
</section>

<!-- Modal CRUD -->
<div id="modal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;">
    <div style="background:white;padding:20px;border-radius:8px;width:430px;">
        <h2 id="modalTitle">Thêm bác sĩ</h2>
        <form method="post" id="doctorForm" enctype="multipart/form-data">
            <input type="hidden" name="action" id="formAction" value="add">
            <input type="hidden" name="id" id="doctorId">
            <input type="hidden" name="old_image" id="oldImage">

            <label>Tên bác sĩ</label>
            <input type="text" name="name" id="name" required>

            <label>Chuyên khoa</label>
            <select name="specialty" id="specialty" required>
                <option value="">-- Chọn chuyên khoa --</option>
                <?php foreach($specialties as $key => $label): ?>
                    <option value="<?= $key ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>

            <label>Số điện thoại</label>
            <input type="text" name="phone" id="phone" required>

            <label>Email</label>
            <input type="email" name="email" id="email">

            <label>Mô tả bác sĩ</label>
            <textarea name="description" id="description" rows="4"></textarea>

            <label>Ảnh bác sĩ</label>
            <input type="file" name="image" id="image">

            <div style="margin-top:10px;text-align:right;">
                <button type="button" onclick="closeModal()">Hủy</button>
                <button type="submit">Lưu</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById("modal").style.display = "flex";
    document.getElementById("formAction").value = "add";
    document.getElementById("modalTitle").innerText = "Thêm bác sĩ";
    document.getElementById("doctorForm").reset();
    document.getElementById("oldImage").value = '';
}

function closeModal() {
    document.getElementById("modal").style.display = "none";
}

function editDoctor(d) {
    openModal();
    document.getElementById("formAction").value = "edit";
    document.getElementById("modalTitle").innerText = "Chỉnh sửa bác sĩ";

    document.getElementById("doctorId").value = d.id;
    document.getElementById("name").value = d.name;
    document.getElementById("specialty").value = d.specialty;
    document.getElementById("phone").value = d.phone;
    document.getElementById("email").value = d.email;
    document.getElementById("description").value = d.description;
    document.getElementById("oldImage").value = d.image;
}
</script>

</body>
</html>
