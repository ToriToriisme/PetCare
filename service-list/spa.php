<?php 
include('../config/db.php'); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Spa & Grooming - PetCare</title>

<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --primary-color: #00bcd4;
    --primary-dark: #00838f;
    --accent-color: #ff9800;
    --bg-light: #f8fcff;
    --bg-card: #ffffff;
    --text-dark: #212529;
    --text-muted: #495057;
    --heading-font: 'Montserrat', sans-serif;
    --body-font: 'Poppins', sans-serif;
}

body {
    font-family: var(--body-font);
    background: var(--bg-light);
    color: var(--text-dark);
    line-height: 1.8;
    margin: 0;
}

.services-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 0 15px;
}

.section-title {
    font-size: 32px;
    color: var(--primary-dark);
    font-weight: 700;
    text-align: center;
    margin-bottom: 30px;
    font-family: var(--heading-font);
}

.service-card {
    background: linear-gradient(135deg, #e0f7fa, #b2ebf2);
    border-radius: 20px;
    padding: 25px 20px;
    box-shadow: 0 10px 25px rgba(0, 188, 212, 0.15);
    text-align: center;
    margin-bottom: 50px;
    transition: transform 0.3s, box-shadow 0.3s;
}
.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 188, 212, 0.25);
}
.service-card img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    margin: 0 auto 15px auto;
    border: 3px solid var(--primary-color);
}
.service-card h3 {
    font-size: 24px;
    color: var(--primary-dark);
    margin-bottom: 10px;
    font-weight: 700;
}
.service-card p {
    font-size: 16px;
    color: #333;
    line-height: 1.6;
}

/* Quy trình Grooming */
.long-form-section {
    background-color: var(--bg-card);
    border-radius: 20px;
    padding: 50px 30px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.08);
    margin-bottom: 70px;
}

.detail-heading {
    font-family: var(--heading-font);
    font-size: 32px;
    font-weight: 700;
    color: var(--primary-dark);
    text-align: center;
    margin-bottom: 50px;
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

.step-content-block {
    display: flex;
    gap: 30px;
    margin-bottom: 60px;
    align-items: center;
    flex-wrap: wrap;
}
.step-number-lg {
    font-family: var(--heading-font);
    font-size: 50px;
    font-weight: 800;
    color: var(--accent-color);
    flex-shrink: 0;
    width: 70px;
    text-align: center;
}
.step-text {
    flex: 1;
    min-width: 250px;
}
.step-text h4 {
    font-family: var(--heading-font);
    font-size: 22px;
    color: var(--primary-dark);
    font-weight: 700;
    margin-bottom: 15px;
    border-bottom: 3px solid var(--accent-color);
    padding-bottom: 5px;
    display: inline-block;
}
.step-media-content {
    display: flex;
    gap: 25px;
    align-items: flex-start;
}
.step-media-content.reverse {
    flex-direction: row-reverse;
}
.step-media-content img {
    width: 40%;
    height: auto;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    flex-shrink: 0;
}
.media-text-wrapper {
    width: 60%;
}

/* CTA */
.cta-header-box {
    text-align: center;
    background: linear-gradient(45deg, #ffe0b2, #ffcc80);
    border-radius: 25px;
    padding: 60px 30px;
    margin-top: 60px;
    margin-bottom: 80px;
    box-shadow: 0 12px 35px rgba(255, 179, 0, 0.25);
}
.cta-header-box h4 {
    font-family: var(--heading-font);
    font-size: 32px;
    font-weight: 800;
    color: var(--primary-dark);
    margin-bottom: 15px;
}
.cta-header-box p {
    font-size: 18px;
    color: var(--text-dark);
    font-weight: 500;
    margin-bottom: 30px;
    line-height: 1.6;
}
.primary-btn {
    display: inline-block;
    background: var(--accent-color);
    color: #fff;
    padding: 15px 40px;
    border-radius: 30px;
    font-weight: 700;
    font-size: 18px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(255,152,0,0.4);
}
.primary-btn:hover {
    background: #f57c00;
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(255,152,0,0.6);
}

/* Responsive */
@media(max-width:900px){
    .step-content-block { flex-direction: column; }
    .step-media-content, .step-media-content.reverse { flex-direction: column; gap: 20px; }
    .step-media-content img, .media-text-wrapper { width: 100%; max-width: 100%; }
    .step-text h4 { text-align: center; }
}
@media(max-width:576px){
    .section-title { font-size: 26px; }
    .service-card img { width: 100px; height: 100px; }
    .step-number-lg { font-size: 40px; width: 60px; }
    .step-text h4 { font-size: 20px; }
    .cta-header-box h4 { font-size: 24px; }
    .cta-header-box p { font-size: 16px; }
    .primary-btn { padding: 12px 30px; font-size: 16px; }
}
</style>
</head>
<body>

<?php include('../includes/header.php'); ?>

<main class="services-container">

    <h1 class="section-title">Spa & Grooming Chuyên Nghiệp</h1>

    <div class="service-card">
        <img src="../assets/img/service/service4.png" alt="Spa & Grooming">
        <h3>Chăm sóc toàn diện cho thú cưng</h3>
        <p>PetCare cung cấp dịch vụ Spa & Grooming chuyên nghiệp, chăm sóc từ da, lông đến móng. Chúng tôi cam kết mang đến vẻ ngoài rạng rỡ, sức khỏe tối ưu và cảm giác thư thái tuyệt đối cho thú cưng của bạn. Mỗi liệu trình đều được thực hiện bởi đội ngũ groomer có kinh nghiệm, sử dụng sản phẩm cao cấp, an toàn cho mọi loại da và lông.</p>
    </div>

    <div class="long-form-section">
        <h2 class="detail-heading"><i class="fas fa-scissors"></i> Quy Trình Grooming Chuẩn Salon</h2>

        <!-- Step 01 -->
        <div class="step-content-block">
            <div class="step-number-lg">01</div>
            <div class="step-text">
                <h4>Tư Vấn & Kiểm Tra Da Lông</h4>
                <div class="step-media-content">
                    <img src="../assets/img/service-list/grooming1.png" alt="Kiểm tra da lông">
                    <div class="media-text-wrapper">
                        <p>Ngay khi thú cưng bước vào phòng chăm sóc, đội ngũ groomer tiến hành kiểm tra tổng thể tình trạng da và lông. Bao gồm: kiểm tra da có kích ứng, mẩn đỏ, vảy gàu, tình trạng lông rối, lông rụng quá mức. Mỗi chi tiết được ghi nhận để lựa chọn phương pháp chăm sóc và sản phẩm phù hợp nhất.</p>
                        <p>Đội ngũ cũng kiểm tra tai, mắt, móng và các vùng nhạy cảm, đảm bảo quá trình grooming diễn ra an toàn tuyệt đối. Groomer tư vấn trực tiếp với chủ nhân về kiểu cắt, loại dầu gội và liệu trình dưỡng lông, giúp thú cưng luôn khỏe mạnh, lông bóng mượt và tinh thần thoải mái.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 02 -->
        <div class="step-content-block">
            <div class="step-number-lg">02</div>
            <div class="step-text">
                <h4>Tắm & Massage Thư Giãn</h4>
                <div class="step-media-content reverse">
                    <img src="../assets/img/service-list/grooming2.png" alt="Tắm và massage">
                    <div class="media-text-wrapper">
                        <p>Sử dụng sản phẩm thảo dược cao cấp, không cay mắt, diệt khuẩn, khử mùi và dưỡng ẩm sâu. Sản phẩm thân thiện với mọi loại da, kể cả da nhạy cảm, giúp loại bỏ bụi bẩn, lông rụng và mùi hôi hiệu quả.</p>
                        <p>Quá trình massage nhẹ nhàng giúp lưu thông máu, giảm căng thẳng và tăng sự gắn kết giữa thú cưng và groomer. Vệ sinh tai, cắt tỉa móng và kiểm tra tuyến hôi được thực hiện kỹ lưỡng, đảm bảo sức khỏe và tinh thần thú cưng luôn thoải mái.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 03 -->
        <div class="step-content-block">
            <div class="step-number-lg">03</div>
            <div class="step-text">
                <h4>Sấy Khô & Chải Lông</h4>
                <div class="step-media-content">
                    <img src="../assets/img/service-list/grooming3.png" alt="Sấy khô và chải lông">
                    <div class="media-text-wrapper">
                        <p>Thú cưng được sấy khô bằng thiết bị chuyên dụng, kiểm soát nhiệt độ phù hợp để lông khô đều mà không gây stress hay tổn thương da. Sấy giúp loại bỏ hoàn toàn độ ẩm, ngăn ngừa nấm da và mùi hôi khó chịu.</p>
                        <p>Groomer chải lông kỹ, gỡ rối, loại bỏ lông chết, giúp lông mềm mượt và chắc khỏe. Quá trình này còn giúp phát hiện sớm các vấn đề về da như nấm, ve, rận, từ đó tư vấn chăm sóc và điều trị kịp thời.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 04 -->
        <div class="step-content-block">
            <div class="step-number-lg">04</div>
            <div class="step-text">
                <h4>Cắt Tỉa & Hoàn Thiện</h4>
                <div class="step-media-content reverse">
                    <img src="../assets/img/service-list/grooming4.png" alt="Cắt tỉa tạo kiểu">
                    <div class="media-text-wrapper">
                        <p>Bước cuối cùng quyết định vẻ ngoài hoàn thiện của thú cưng. Groomer cắt tỉa lông theo yêu cầu hoặc kiểu chuẩn giống, đảm bảo cân đối, gọn gàng và thoải mái. Móng chân được cắt đúng chuẩn, tránh gây đau.</p>
                        <p>Thêm bước xịt nước hoa nhẹ, thắt nơ hoặc khăn trang trí giúp thú cưng vừa thơm tho vừa đáng yêu. Quy trình grooming toàn diện đảm bảo thú cưng không chỉ sạch đẹp mà còn khỏe mạnh, giảm rối lông và các vấn đề da tiềm ẩn. Kết thúc quá trình, thú cưng trông rạng rỡ, thơm tho, và chủ nhân hoàn toàn yên tâm về sức khỏe của bé cưng.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- CTA -->
    <div class="cta-header-box">
        <h4>Đã đến lúc tỏa sáng!</h4>
        <p>Đặt lịch ngay hôm nay để trải nghiệm dịch vụ uy tín, được khách hàng đánh giá cao và được nhiều thú cưng yêu thích.</p>
        <a href="<?= $BASE_URL ?>/user/booking.php" class="primary-btn"><i class="fas fa-calendar-alt"></i> Đặt Lịch Ngay</a>
    </div>

</main>

<?php include('../includes/footer.php'); ?>
</body>
</html>
