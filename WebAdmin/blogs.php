<?php
include('../config/db.php');

// Xử lý thêm/sửa/xóa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
$imagePath = 'assets/img/blog/blog1.png'; // ảnh mặc định
if(!empty($_FILES['image']['name'])) {
    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = 'blog_' . time() . '.' . $ext;
    $target = '../assets/img/blog/' . $filename;
    $upload_dir = '../assets/img/blog/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $imagePath = 'assets/img/blog/' . $filename;
    }
}

    try {
        if ($action === 'add') {
executeQuery("INSERT INTO blogs (title, content, image, created_at) VALUES (?, ?, ?, NOW())", [$title, $content, $imagePath]);
        } elseif ($action === 'edit') {
            $id = $_POST['id'] ?? 0;
executeQuery("UPDATE blogs SET title=?, content=?, image=? WHERE id=?", [$title, $content, $imagePath, $id]);
        } elseif ($action === 'delete') {
            $id = $_POST['id'] ?? 0;
            executeQuery("DELETE FROM blogs WHERE id=?", [$id]);
        }
    } catch(Exception $e) {
        die("Lỗi thao tác: " . $e->getMessage());
    }

    header("Location: ./blogs.php");
    exit;
}

// Lấy danh sách blog
$blogs = getResults("SELECT * FROM blogs ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quản Lý Blog - PetCare</title>
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="css/style.css">
<style>
/* Table */
.table-wrapper { overflow-x:auto; margin-top:20px; background:#fff; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.1);}
table { width:100%; border-collapse:collapse;}
th, td { padding:12px 15px; text-align:left;}
th { background:#007BFF; color:#fff; font-weight:600;}
tr:nth-child(even){background:#f9f9f9;}
tr:hover{background:#e6f2ff;}

/* Buttons */
button { background:#007BFF; color:#fff; padding:8px 14px; border:none; border-radius:6px; cursor:pointer; transition:0.3s; }
button:hover { background:#0056b3; }

/* Modal */
#modal { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); display:flex; justify-content:center; align-items:center; z-index:1000; }
.modal-content { background:white; padding:30px; border-radius:10px; width:500px; max-width:90%; box-shadow:0 4px 20px rgba(0,0,0,0.2); animation:fadeIn 0.3s ease;}
@keyframes fadeIn { from {opacity:0; transform:translateY(-20px);} to {opacity:1; transform:translateY(0);} }

/* Form inside modal */
.modal-content h2 { margin-top:0; margin-bottom:20px; color:#007BFF; font-size:1.5rem; }
.modal-content label { display:block; margin-bottom:5px; font-weight:500; color:#333; }
.modal-content input[type=text], .modal-content textarea { width:100%; padding:10px 12px; margin-bottom:15px; border:1px solid #ccc; border-radius:6px; font-size:0.95rem; transition:0.3s; }
.modal-content input:focus, .modal-content textarea:focus { border-color:#007BFF; box-shadow:0 0 5px rgba(0,123,255,0.5); outline:none; }
.modal-content textarea { resize: vertical; min-height:100px; }

/* Modal buttons */
.modal-buttons { display:flex; justify-content:flex-end; gap:10px; }
.modal-buttons button.cancel { background:#ccc; color:#333; }
.modal-buttons button.cancel:hover { background:#999; }
</style>
</head>
<body>

<section id="sidebar">
    <a href="#" class="brand"><i class='bx bxs-clinic'></i><span class="text">PETCARE</span></a>
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
    <a href="#" class="nav-link">Quản lý Blog</a>
</nav>

<main>
<div class="account-header">
    <div>
        <h1>Danh Sách Blog</h1>
        <p>Thêm, sửa, xóa bài viết trên website</p>
    </div>
    <button class="add-btn" onclick="openModal()">Thêm mới</button>
</div>

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Ngày tạo</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($blogs as $b): ?>
            <tr>
                <td><?= htmlspecialchars($b['title']) ?></td>
                <td><?= htmlspecialchars(substr($b['content'],0,100)) ?>...</td>
                <td><?= date('d-m-Y', strtotime($b['created_at'])) ?></td>
                <td>
                    <form method="post" style="display:inline">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $b['id'] ?>">
                        <button type="submit" onclick="return confirm('Xóa bài viết này?')"><i class='bx bx-trash'></i></button>
                    </form>
                    <button onclick='editBlog(<?= json_encode($b) ?>)'><i class='bx bx-edit'></i></button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</main>
</section>

<!-- Modal Add/Edit -->
<div id="modal">
    <div class="modal-content">
        <h2 id="modalTitle">Thêm bài viết mới</h2>
        <form method="post" id="blogForm" enctype="multipart/form-data">
            <input type="hidden" name="action" id="formAction" value="add">
            <input type="hidden" name="id" id="blogId">
            <label>Tiêu đề</label>
            <input type="text" name="title" id="title" required>
            <label>Nội dung</label>
            <textarea name="content" id="content" required></textarea>
            <label>Ảnh (tùy chọn)</label>
            <input type="file" name="image" id="image" accept="image/*">
            <div class="modal-buttons">
                <button type="button" class="cancel" onclick="closeModal()">Hủy</button>
                <button type="submit">Lưu</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('modal').style.display='flex';
    document.getElementById('modalTitle').innerText='Thêm bài viết mới';
    document.getElementById('formAction').value='add';
    document.getElementById('blogForm').reset();
}
function closeModal() { document.getElementById('modal').style.display='none'; }
function editBlog(data) {
    openModal();
    document.getElementById('modalTitle').innerText='Chỉnh sửa bài viết';
    document.getElementById('formAction').value='edit';
    document.getElementById('blogId').value=data.id;
    document.getElementById('title').value=data.title;
    document.getElementById('content').value=data.content;
}
</script>

</body>
</html>
