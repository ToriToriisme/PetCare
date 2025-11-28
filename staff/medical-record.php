<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ bệnh án - PetCare Staff</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/staff-style.css">
    <style>
        /* CSS riêng cho trang bệnh án */
        .emr-container { max-width: 1000px; margin: 0 auto; }
        .patient-info-card {
            background: white; padding: 20px; border-radius: 12px;
            display: flex; gap: 20px; margin-bottom: 20px;
            border-left: 5px solid var(--primary);
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .patient-avatar { width: 80px; height: 80px; border-radius: 10px; object-fit: cover; }
        .form-section { background: white; padding: 25px; border-radius: 12px; margin-bottom: 20px; }
        .section-title { font-size: 18px; color: var(--primary); margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; min-height: 100px; font-family: inherit; }
        
        .btn-save { background: #2ecc71; color: white; padding: 12px 25px; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; }
        .btn-save:hover { background: #27ae60; }
        .btn-back { background: #95a5a6; color: white; padding: 12px 25px; text-decoration: none; border-radius: 8px; margin-right: 10px; }
    </style>
</head>
<body>

<div class="admin-layout">
    <aside class="sidebar">
        <div class="brand">🐾 PetCare <span class="badge">Doctor</span></div>
        <ul class="menu">
    <li><a href="dashboard.php">📅 Lịch hẹn hôm nay</a></li>
    <li><a href="emr-list.php">📝 Bệnh án điện tử</a></li>
    <li><a href="schedule.php">🕒 Lịch làm việc</a></li>
    <li><a href="login.php" class="logout">Đăng xuất</a></li>
</ul>
    </aside>

    <main class="main-content">
        <div class="emr-container">
            
            <div class="patient-info-card">
                <img src="../assets/img/dog3.png" alt="Pet" class="patient-avatar"> <div class="info">
                    <h2 style="margin: 0 0 5px 0;">Thú cưng: Bông (Mèo)</h2>
                    <p style="margin: 0; color: #666;">Chủ nuôi: Trần Thị B (0912345678)</p>
                    <p style="margin: 5px 0 0 0;"><span class="tag service">Tiêm phòng</span> <span class="status waiting">Đang khám</span></p>
                </div>
            </div>

            <form action="" method="POST">
                <div class="form-section">
                    <h3 class="section-title">1. Khám Lâm Sàng</h3>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Cân nặng (kg)</label>
                            <input type="number" step="0.1" placeholder="VD: 5.2">
                        </div>
                        <div class="form-group">
                            <label>Nhiệt độ (°C)</label>
                            <input type="number" step="0.1" placeholder="VD: 38.5">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Triệu chứng / Lý do đến khám</label>
                        <textarea placeholder="VD: Ăn kém, nôn mửa, sốt nhẹ..."></textarea>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">2. Chẩn Đoán & Phác Đồ</h3>
                    <div class="form-group">
                        <label>Chẩn đoán của bác sĩ</label>
                        <input type="text" placeholder="VD: Viêm ruột cấp tính / Rối loạn tiêu hóa...">
                    </div>
                    <div class="form-group">
                        <label>Chỉ định điều trị / Thuốc</label>
                        <textarea placeholder="- Tiêm kháng sinh ABC 1ml
- Truyền dịch Ringer Lactate
- Thuốc uống về nhà..."></textarea>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="section-title">3. Ghi Chú / Lịch Tái Khám</h3>
                    <div class="form-group">
                        <label>Lời dặn bác sĩ</label>
                        <textarea style="min-height: 60px;" placeholder="Kiêng ăn đồ dầu mỡ, tái khám sau 3 ngày..."></textarea>
                    </div>
                </div>

                <div style="text-align: right; margin-bottom: 50px;">
                    <a href="dashboard.php" class="btn-back">Quay lại</a>
                    <button type="button" class="btn-save" onclick="alert('Đã lưu bệnh án thành công!')">💾 LƯU HỒ SƠ BỆNH ÁN</button>
                </div>
            </form>

        </div>
    </main>
</div>

</body>
</html>