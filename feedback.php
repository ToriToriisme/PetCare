<?php 
// Bao gồm tệp cấu hình cơ sở dữ liệu và header
require_once __DIR__ . '/config/db.php';
$feedback_status = ''; // Biến để lưu trạng thái xử lý form

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Lấy dữ liệu từ form
    $name = isset($_POST['reviewer_name']) ? trim($_POST['reviewer_name']) : '';
    $pet_name = isset($_POST['pet_name']) ? trim($_POST['pet_name']) : '';
    $rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

    if (empty($name) || $rating == 0 || empty($comment)) {
        $feedback_status = 'error';
    } else {
       
        $feedback_status = 'success'; 
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi Phản Hồi và Đánh Giá - Pet Care</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root{
            --primary-color: #00bcd4; /* Xanh Ngọc */
            --primary-dark: #00838f; /* Xanh Ngọc Đậm */
            --accent-color: #ffb300; /* Vàng cam làm điểm nhấn */
            --bg-light: #f8fcff; 
            --bg-card: #ffffff; 
            --text-dark: #212529; 
            --text-muted: #495057;
            --heading-font: 'Montserrat', sans-serif;
            --body-font: 'Poppins', sans-serif;
        }
        body { background: var(--bg-light); }

        /* Banner phụ */
        .banner-sub {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
            height: 200px; 
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 50px;
            color: #fff;
        }
        .banner-inner-sub h1 {
            font-size: 36px;
            margin: 0;
        }
        .banner-inner-sub p {
            text-align: center;
            font-size: 16px;
            opacity: 0.9;
        }

        /* Form Container */
        .feedback-container {
            max-width: 800px;
            margin: 0 auto 80px;
            padding: 40px;
            background: var(--bg-card);
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        /* Tiêu đề form */
        .feedback-container h2 {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 30px;
            font-weight: 700;
        }
        
        /* Cấu trúc Form */
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            background-color: #fcfcfc;
            font-size: 15px;
        }
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        /* Khu vực Rating */
        .rating-area {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        .rating-area label {
            flex-shrink: 0;
            margin-bottom: 0;
        }
        .star-rating {
            font-size: 28px;
            color: #ccc; /* Màu xám mặc định */
            cursor: pointer;
            transition: color 0.2s;
        }
        .star-rating:hover, 
        .star-rating.selected {
            color: #ffc107; /* Màu vàng khi chọn */
        }
        
        /* Box thông báo trạng thái */
        .status-box {
            padding: 15px;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }
        .status-box.success {
            background-color: #e6f7ea;
            border: 1px solid #b7e6c7;
            color: #116a2b;
        }
        .status-box.error {
            background-color: #fcebeb;
            border: 1px solid #f5b7b7;
            color: #cc0000;
        }
        
        /* Khu vực tùy chọn Facebook */
        .facebook-option {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px dashed #e0e0e0;
        }
        .facebook-option p {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 15px;
        }
        .fb-btn {
            background-color: #1877f2;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: background-color 0.3s;
        }
        .fb-btn:hover {
            background-color: #145cb7;
        }

        /* Nút Gửi chính */
        .primary-btn {
            width: 100%;
            margin-top: 15px;
            padding: 14px 20px;
            border-radius: 999px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, #00bcd4, #0097a7);
            color: #fff;
            box-shadow: 0 15px 30px rgba(0, 151, 167, 0.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .primary-btn i {
            font-size: 16px;
        }
        .primary-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 35px rgba(0, 151, 167, 0.35);
        }
        
        /* CSS cho phần Xem Phản Hồi (Tương tự trang chủ) */
        .testimonial-list-new {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }
        .testimonial-card {
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 250px;
        }
        /* Cần đảm bảo các class light-blue, light-orange, light-gray có màu nền */
        .testimonial-card.light-blue { background-color: #e0f7fa; }
        .testimonial-card.light-orange { background-color: #fff8e1; }
        .testimonial-card.light-gray { background-color: #f5f5f5; }
        
        .testimonial-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .rating-stars { color: var(--accent-color); font-size: 14px; }
        .date-review { font-size: 12px; color: var(--text-muted); }
        .quote-text { 
            font-style: italic; 
            color: var(--text-dark); 
            line-height: 1.6;
            flex-grow: 1; /* Đẩy thông tin người đánh giá xuống cuối */
            margin-bottom: 20px;
        }
        .reviewer-info {
            border-top: 1px dashed #ccc;
            padding-top: 10px;
        }
        .reviewer-name { font-weight: 600; color: var(--primary-dark); display: block; }
        .pet-name { font-size: 13px; color: var(--text-muted); display: block; }

        /* Nút Xem Thêm/Gửi Đánh Giá (Căn giữa) */
        .view-more-action {
            text-align: center; 
            margin-top: 50px; 
            margin-bottom: 30px; 
            width: 100%; 
        }
        .view-more-action .cta-feedback-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 26px;
            border-radius: 999px;
            background: linear-gradient(135deg, #ff8a00, #e52e71);
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 12px 24px rgba(229, 46, 113, 0.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .view-more-action .cta-feedback-btn i {
            font-size: 16px;
        }
        .view-more-action .cta-feedback-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 26px rgba(229, 46, 113, 0.35);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .testimonial-list-new {
                grid-template-columns: 1fr 1fr;
            }
        }
        @media (max-width: 600px) {
            .feedback-container {
                padding: 20px;
            }
            .rating-area {
                flex-direction: column;
                align-items: flex-start;
            }
            .testimonial-list-new {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<?php include('includes/header.php'); ?>

<main>
    
    <section class="banner-new">
        <div class="banner-inner-sub">
            <h1>Phản Hồi & Đánh Giá Từ Khách Hàng</h1>
            <p>Xem trải nghiệm của cộng đồng PetCare và gửi đánh giá của bạn</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title" style="text-align: center; margin-bottom: 30px; color: var(--primary-dark);">Các Đánh Giá Gần Đây (6/6 Sao)</h2>
            
            <div class="grid testimonial-list-new">
                
                <div class="card testimonial-card light-blue">
                    <div class="testimonial-header">
                        <span class="rating-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </span>
                        <span class="date-review">25/11/2025</span>
                    </div>
                    <p class="quote-text">"Dịch vụ tiêm phòng và xét nghiệm máu rất nhanh chóng, chuyên nghiệp. Bác sĩ tư vấn rất rõ ràng về phác đồ chăm sóc cho bé nhà mình."</p>
                    <div class="reviewer-info">
                        <span class="reviewer-name">Mai Anh</span>
                        <span class="pet-name">của bé Vàng (Golden)</span>
                    </div>
                </div>

                <div class="card testimonial-card light-orange">
                    <div class="testimonial-header">
                        <span class="rating-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </span>
                        <span class="date-review">20/11/2025</span>
                    </div>
                    <p class="quote-text">"Phòng khám sạch sẽ, không gian thoáng đãng. Tôi ấn tượng nhất với sự kiên nhẫn của nhân viên khi khám cho mèo cưng nhà tôi."</p>
                    <div class="reviewer-info">
                        <span class="reviewer-name">Ngọc Trâm</span>
                        <span class="pet-name">của bé Miu (Mèo Anh)</span>
                    </div>
                </div>

                <div class="card testimonial-card light-gray">
                    <div class="testimonial-header">
                        <span class="rating-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </span>
                        <span class="date-review">15/11/2025</span>
                    </div>
                    <p class="quote-text">"Mình đã từng dùng dịch vụ phẫu thuật ở đây, mọi thứ diễn ra suôn sẻ, quy trình hậu phẫu cũng được theo dõi rất kỹ lưỡng."</p>
                    <div class="reviewer-info">
                        <span class="reviewer-name">Thành Long</span>
                        <span class="pet-name">của bé Kiki (Poodle)</span>
                    </div>
                </div>
                
                <div class="card testimonial-card light-blue">
                    <div class="testimonial-header">
                        <span class="rating-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </span>
                        <span class="date-review">10/11/2025</span>
                    </div>
                    <p class="quote-text">"Hệ thống nhắc lịch tự động rất tiện lợi, giúp tôi không bao giờ quên lịch tiêm nhắc lại cho bé cún. Yêu thích sự chu đáo này."</p>
                    <div class="reviewer-info">
                        <span class="reviewer-name">Hoàng Yến</span>
                        <span class="pet-name">của bé Boss (Husky)</span>
                    </div>
                </div>
                
                <div class="card testimonial-card light-orange">
                    <div class="testimonial-header">
                        <span class="rating-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </span>
                        <span class="date-review">05/11/2025</span>
                    </div>
                    <p class="quote-text">"Giá cả phải chăng, thái độ bác sĩ chuyên nghiệp. Luôn là lựa chọn hàng đầu của gia đình tôi mỗi khi thú cưng có vấn đề sức khỏe."</p>
                    <div class="reviewer-info">
                        <span class="reviewer-name">Minh Đức</span>
                        <span class="pet-name">của bé Lucky (Mèo Ba Tư)</span>
                    </div>
                </div>

                <div class="card testimonial-card light-blue">
                    <div class="testimonial-header">
                        <span class="rating-stars">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </span>
                        <span class="date-review">01/11/2025</span>
                    </div>
                    <p class="quote-text">"Mình đưa bé đi khám tổng quát định kỳ. Bác sĩ siêu âm rất kỹ và giải thích chi tiết về chế độ dinh dưỡng cho giống chó Bully."</p>
                    <div class="reviewer-info">
                        <span class="reviewer-name">Gia Hân</span>
                        <span class="pet-name">của bé Bon (Bulldog)</span>
                    </div>
                </div>

            </div>
            
            <div class="view-more-action">
                <a href="#form-feedback" class="cta-feedback-btn">
                    <i class="fas fa-comment-dots"></i>
                    Gửi Đánh Giá Của Bạn
                </a>
            </div>

        </div>
    </section>
    <hr style="max-width: 800px; margin: 40px auto; border-color: #e0e0e0;">
    
    <section class="section" id="form-feedback">
        <div class="container">
            <div class="feedback-container">
                <h2>Chia Sẻ Trải Nghiệm Cùng PetCare</h2>
                
                <?php if ($feedback_status == 'success'): ?>
                    <div class="status-box success">
                        <i class="fas fa-check-circle"></i> Cảm ơn bạn! Phản hồi của bạn đã được ghi nhận thành công.
                    </div>
                <?php elseif ($feedback_status == 'error'): ?>
                    <div class="status-box error">
                        <i class="fas fa-exclamation-triangle"></i> Lỗi! Vui lòng điền đầy đủ Tên, Đánh giá sao và Nội dung phản hồi.
                    </div>
                <?php endif; ?>

                <form action="feedback.php" method="POST">
                    
                    <div class="form-group">
                        <label for="reviewer_name">Tên của bạn (*)</label>
                        <input type="text" id="reviewer_name" name="reviewer_name" required>
                    </div>

                    <div class="form-group">
                        <label for="pet_name">Tên Thú Cưng (Tùy chọn)</label>
                        <input type="text" id="pet_name" name="pet_name">
                    </div>

                    <div class="form-group">
                        <label for="comment">Nội dung Phản hồi (*)</label>
                        <textarea id="comment" name="comment" required></textarea>
                    </div>
                    
                    <div class="rating-area">
                        <label>Đánh giá sao (*)</label>
                        <div id="star-rating-icons">
                            <i class="fas fa-star star-rating" data-rating="1"></i>
                            <i class="fas fa-star star-rating" data-rating="2"></i>
                            <i class="fas fa-star star-rating" data-rating="3"></i>
                            <i class="fas fa-star star-rating" data-rating="4"></i>
                            <i class="fas fa-star star-rating" data-rating="5"></i>
                            <input type="hidden" id="rating-value" name="rating" value="0" required>
                        </div>
                    </div>

                    <button type="submit" class="primary-btn">
                        <i class="fas fa-paper-plane"></i>
                        Gửi Phản Hồi Của Bạn
                    </button>
                </form>
                
                <div class="facebook-option">
                    <p>Hoặc bạn có thể đánh giá chúng tôi trực tiếp trên:</p>
                    <a href="https://www.facebook.com/PetCarePage" target="_blank" class="fb-btn">
                        <i class="fab fa-facebook-f"></i> Đánh Giá Trên Facebook
                    </a>
                </div>
                
            </div>
        </div>
    </section>
    </main>

<?php include('includes/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.star-rating');
    const ratingInput = document.getElementById('rating-value');
    let currentRating = 0;

    // Hàm tô màu sao
    function highlightStars(rating) {
        stars.forEach(star => {
            const starValue = parseInt(star.getAttribute('data-rating'));
            if (starValue <= rating) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });
    }

    // Xử lý khi click vào sao
    stars.forEach(star => {
        star.addEventListener('click', function() {
            currentRating = parseInt(this.getAttribute('data-rating'));
            ratingInput.value = currentRating;
            highlightStars(currentRating);
        });

        // Xử lý hover (chỉ để đẹp)
        star.addEventListener('mouseover', function() {
            highlightStars(parseInt(this.getAttribute('data-rating')));
        });
        
        // Xử lý khi rời chuột (trả về trạng thái đã chọn hoặc 0)
        star.addEventListener('mouseout', function() {
            highlightStars(currentRating);
        });
    });
    
    // Xử lý cuộn mượt (Smooth scrolling) cho nút Gửi Đánh Giá
    const sendFeedbackButton = document.querySelector('.view-more-action a');
    if (sendFeedbackButton) {
        sendFeedbackButton.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 30, // Trừ đi 30px để có khoảng cách đẹp
                    behavior: 'smooth'
                });
            }
        });
    }
});
</script>
</body>
</html>