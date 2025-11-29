<?php 
include('../config/db.php'); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khám Tổng Quát & Chẩn Đoán - Pet Care</title>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --primary-color: #00bcd4;
            --primary-dark: #0097a7;
            --accent-color: #ff9800;
            --bg-light: #f4faff;
            --bg-card: #ffffff;
            --text-dark: #2c3e50;
            --text-muted: #5e6d7a;
            --heading-font: 'Montserrat', sans-serif;
            --body-font: 'Poppins', sans-serif;
        }

        body {
            font-family: var(--body-font);
            background: var(--bg-light);
            color: var(--text-dark);
            margin: 0;
            line-height: 1.7;
        }

        /* ---------- Container ---------- */
        .services-container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 0 15px;
            position: relative;
        }

        /* ---------- Section Title ---------- */
        .section-title {
            font-size: 36px;
            color: var(--primary-dark);
            font-weight: 700;
            margin-bottom: 50px;
            text-align: center;
            position: relative;
        }
        .section-title::after {
            content:'';
            display:block;
            width:80px;
            height:4px;
            background: var(--accent-color);
            margin:15px auto 0;
            border-radius:2px;
        }

        /* ---------- Card giới thiệu ---------- */
        .service-card { 
            background: linear-gradient(135deg, #e0f7fa, #b2ebf2); 
            border-radius: 20px; 
            padding: 40px 30px; 
            text-align: center; 
            margin-bottom: 60px;
            box-shadow: 0 10px 25px rgba(0,188,212,0.15);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }
        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,188,212,0.3);
        }
        .service-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 3px solid var(--primary-color);
            transition: transform 0.4s ease;
        }
        .service-card:hover img {
            transform: scale(1.1) rotate(5deg);
        }
        .service-card h3 { font-size: 26px; color: var(--primary-dark); margin-bottom: 15px; font-weight: 700;}
        .service-card p { font-size: 16px; color: var(--text-dark); line-height: 1.6;}

        /* ---------- Chi tiết dịch vụ ---------- */
        .detail-section {
            background-color: var(--bg-card);
            border-radius: 20px;
            padding: 50px 35px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        .detail-heading {
            font-size: 28px;
            color: var(--primary-dark);
            margin-bottom: 40px;
            text-align: center;
            font-weight: 700;
            position: relative;
        }
        .detail-heading::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--accent-color);
            margin: 15px auto 0;
            border-radius: 2px;
        }

        /* ---------- Grid Chi tiết ---------- */
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 35px;
        }
        .detail-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: var(--bg-light);
            border-radius: 18px;
            padding: 25px 20px;
            border: 1px solid #e0f7fa;
            transition: transform 0.5s ease, box-shadow 0.5s ease;
            opacity: 0;
            transform: translateY(30px);
        }
        .detail-item.show {
            opacity: 1;
            transform: translateY(0);
        }
        .detail-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.12);
        }
        .detail-item img {
            width: 100%;
            max-width: 250px;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 15px;
            transition: transform 0.4s ease;
        }
        .detail-item:hover img {
            transform: scale(1.05) rotate(2deg);
        }
        .detail-content h4 {
            font-size: 20px;
            color: var(--primary-dark);
            margin-bottom: 10px;
            text-align: center;
            transition: color 0.3s ease;
        }
        .detail-item:hover .detail-content h4 {
            color: var(--accent-color);
        }
        .detail-content p {
            font-size: 15px;
            color: var(--text-muted);
            text-align: center;
        }

        /* ---------- CTA Box ---------- */
        .cta-box {
            text-align: center;
            margin-top: 50px;
            padding: 25px 20px;
            background: linear-gradient(135deg, #fff3e0, #ffe0b2);
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(255,152,0,0.25);
            position: relative;
        }
        .primary-btn {
            display: inline-block;
            background: var(--accent-color);
            color: #fff;
            padding: 15px 35px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 18px;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-top: 15px;
        }
        .primary-btn:hover {
            background: #f57c00;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255,152,0,0.5);
        }

        /* ---------- CTA cố định khi scroll ---------- */
        .fixed-cta {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--accent-color);
            color: #fff;
            padding: 12px 25px;
            border-radius: 30px;
            box-shadow: 0 6px 15px rgba(255,152,0,0.5);
            z-index: 999;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: transform 0.3s, opacity 0.3s;
        }
        .fixed-cta:hover {
            transform: translateY(-3px);
        }

        @media(max-width:768px){ 
            .detail-grid { grid-template-columns: 1fr; }
            .services-container { margin: 30px auto; padding: 0 15px; }
            .service-card { padding: 30px 20px; }
            .detail-section { padding: 30px 20px; }
        }
    </style>
</head>
<body>

<?php include('../includes/header.php'); ?>

<main class="services-container">
    <h1 class="section-title">Khám Tổng Quát & Chẩn Đoán Chuyên Sâu</h1>

    <div class="service-card">
        <img src="../assets/img/service/service1.png" alt="Khám & Chẩn đoán">
        <h3>Bước Đầu Tiên Cho Sức Khỏe Thú Cưng</h3>
        <p>Quy trình khám tổng quát toàn diện giúp phát hiện sớm các vấn đề tiềm ẩn, đưa ra phác đồ điều trị và chăm sóc phòng ngừa hiệu quả, đảm bảo thú cưng luôn khỏe mạnh và hạnh phúc.</p>
    </div>

    <div class="detail-section">
        <h2 class="detail-heading"><i class="fas fa-search"></i> Quy Trình Khám Tổng Quát Chi Tiết</h2>
        <div class="detail-grid">
            <div class="detail-item">
                <img src="../assets/img/service/service7.png" alt="Khám lâm sàng">
                <div class="detail-content">
                    <h4>1. Khám Lâm Sàng & Lịch Sử Bệnh</h4>
                    <p>Kiểm tra các chỉ số cơ bản, đánh giá tình trạng da lông, răng miệng, thu thập lịch sử bệnh lý và thói quen sinh hoạt.</p>
                </div>
            </div>
            <div class="detail-item">
                <img src="../assets/img/service/service8.png" alt="Xét nghiệm chuyên khoa">
                <div class="detail-content">
                    <h4>2. Xét Nghiệm Máu & Ký Sinh Trùng</h4>
                    <p>Thực hiện CBC, sinh hóa máu, xét nghiệm ký sinh trùng để đánh giá tổng quan tình trạng sức khỏe.</p>
                </div>
            </div>
            <div class="detail-item">
                <img src="../assets/img/service/service9.png" alt="Chẩn đoán hình ảnh">
                <div class="detail-content">
                    <h4>3. Chẩn Đoán Hình Ảnh Chuyên Sâu</h4>
                    <p>Sử dụng X-quang và siêu âm để kiểm tra chi tiết các cơ quan nội tạng, phát hiện dị vật hoặc khối u kịp thời.</p>
                </div>
            </div>
            <div class="detail-item">
                <img src="../assets/img/service/service10.png" alt="Tư vấn phác đồ">
                <div class="detail-content">
                    <h4>4. Tư Vấn & Lên Phác Đồ Điều Trị</h4>
                    <p>Bác sĩ phân tích kết quả, tư vấn chi tiết về dinh dưỡng, tiêm phòng và xây dựng phác đồ chăm sóc nếu cần.</p>
                </div>
            </div>
        </div>

        <div class="cta-box">
            <p style="font-size: 18px; color: #333; font-weight: 500;">Chủ động chăm sóc người bạn bốn chân của bạn! Đặt lịch khám tổng quát ngay hôm nay để yên tâm về sức khỏe thú cưng.</p>
            <a href="<?= $BASE_URL ?>/user/booking.php" class="primary-btn"><i class="fas fa-calendar-alt"></i> Đặt Lịch Khám Ngay</a>
        </div>
    </div>
</main>

<!-- Fixed CTA khi scroll -->
<a href="<?= $BASE_URL ?>/user/booking.php" class="fixed-cta"><i class="fas fa-calendar-alt"></i> Đặt Lịch Ngay</a>

<script>
    // --- Animation khi scroll --- 
    const items = document.querySelectorAll('.detail-item');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('show');
            }
        });
    }, { threshold: 0.2 });

    items.forEach(item => observer.observe(item));
</script>

<?php include('../includes/footer.php'); ?>
</body>
</html>
