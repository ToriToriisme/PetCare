<?php
include('config/db.php');
// include('includes/header.php');

// Lấy ID bài viết từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Mảng dữ liệu demo cho các bài viết - GIỮ NGUYÊN NỘI DUNG ĐÃ MỞ RỘNG
$posts = [
    1 => [
        'title' => '5 Bước Chăm Sóc Toàn Diện Cho Thú Cưng Mùa Hè',
        'date' => '18/11/2025',
        'image' => 'assets/img/blog/blog1.png',
        'content' => '
<p>Mùa hè với nhiệt độ tăng cao là thời điểm thú cưng rất dễ bị say nắng, mất nước, và các vấn đề da liễu nghiêm trọng. Để đảm bảo người bạn bốn chân của bạn luôn khỏe mạnh và thoải mái, Pet Care hướng dẫn bạn 5 bước chăm sóc toàn diện sau:</p>

<h2>1. Cung cấp nước đầy đủ và giữ mát môi trường sống</h2>
<p>Điều quan trọng số một là chống mất nước. Luôn đảm bảo thú cưng có nước sạch, mát, và kiểm tra thường xuyên. Nếu có thể, hãy đặt thêm các bát nước ở nhiều khu vực trong nhà. Đối với chó, bạn có thể thêm đá viên vào bát nước hoặc sử dụng bình nước tự động làm mát. Tạo các khu vực thoáng mát trong nhà, tránh xa cửa sổ nơi ánh nắng mặt trời chiếu trực tiếp. Quạt và điều hòa là trợ thủ đắc lực.</p>

<h2>2. Điều chỉnh Chế độ ăn hợp lý, dễ tiêu hóa</h2>
<p>Chế độ ăn nên được điều chỉnh nhẹ nhàng hơn. Thêm trái cây (như dưa hấu, táo không hạt) và rau củ tươi (như bí đỏ, cà rốt) để bổ sung độ ẩm và vitamin. Giảm thức ăn nặng, nhiều protein hoặc nhiều dầu mỡ, vì chúng có thể làm tăng nhiệt độ cơ thể trong quá trình tiêu hóa. Chia nhỏ bữa ăn và cho ăn vào buổi sáng sớm hoặc chiều tối mát mẻ.</p>

<h2>3. Bảo vệ da và lông khỏi nhiệt và ký sinh trùng</h2>
<p>Nhiệt độ cao tạo điều kiện cho ký sinh trùng phát triển. Đảm bảo bạn đã tẩy giun, tiêm phòng và phòng ve rận đầy đủ. Tắm đúng cách, dùng dầu gội chuyên dụng có tính năng dưỡng ẩm để tránh da bị khô. Cắt tỉa lông (đặc biệt đối với chó giống lông dài như Husky, Alaska) giúp cơ thể tản nhiệt tốt hơn, nhưng không nên cạo trọc vì lớp lông bảo vệ da khỏi tia UV. </p>

<h2>4. Tránh nắng trực tiếp và các hoạt động cường độ cao</h2>
<p>Không để thú cưng ra ngoài trời quá lâu, đặc biệt từ 10h sáng đến 4h chiều. Nếu đi dạo, hãy chọn thời điểm sáng sớm hoặc tối muộn. Tuyệt đối không để thú cưng trong xe ô tô dù chỉ 5 phút – nhiệt độ trong xe có thể tăng lên mức nguy hiểm chết người rất nhanh chóng. Giảm cường độ tập luyện; thay thế các trò chạy nhảy bằng các trò chơi nhẹ nhàng trong bóng râm hoặc trong nhà.</p>

<h2>5. Kiểm tra sức khỏe định kỳ và nhận biết dấu hiệu say nắng</h2>
<p>Đưa thú cưng đến Pet Care khám tổng quát định kỳ, kiểm tra da liễu, ký sinh trùng. Đặc biệt quan trọng là bạn phải nhận biết các dấu hiệu say nắng: thở dốc nặng, nướu răng đỏ hoặc tái nhợt, đi loạng choạng, nôn mửa hoặc tiêu chảy. Nếu thấy bất kỳ dấu hiệu nào, cần làm mát cơ thể thú cưng ngay lập tức bằng khăn lạnh và đưa đến phòng khám thú y gần nhất.</p>'
    ],
    2 => [
        'title' => 'Chế Độ Dinh Dưỡng Chuẩn Cho Chó Mọi Lứa Tuổi',
        'date' => '10/10/2025',
        'image' => 'assets/img/blog/blog2.jpg',
        'content' => '
<p>Dinh dưỡng là nền tảng của sức khỏe và tuổi thọ của chó. Bài viết này hướng dẫn cách xây dựng chế độ dinh dưỡng hợp lý, đáp ứng nhu cầu cụ thể của chó ở từng giai đoạn phát triển.</p>

<h2>1. Chó con (Dưới 12 tháng tuổi): Phát triển đỉnh cao</h2>
<p>Giai đoạn này đòi hỏi chế độ dinh dưỡng giàu protein chất lượng cao, canxi, và phốt pho để phát triển xương, cơ bắp, và hệ thần kinh. Chó con cần ăn nhiều bữa nhỏ (3-4 bữa/ngày) do dạ dày còn nhỏ. Tuyệt đối không sử dụng thức ăn của chó trưởng thành, vì chúng thiếu calo và khoáng chất cần thiết. Chúng tôi khuyến nghị thức ăn công thức dành riêng cho chó con (Puppy formula) để đảm bảo cân bằng dinh dưỡng tuyệt đối.</p>
<ul>
    <li>Nhu cầu chính: Protein, Calo, DHA, Canxi.</li>
    <li>Lưu ý: Chuyển sang thức ăn chó trưởng thành quá sớm có thể gây thiếu chất.</li>
</ul>

<h2>2. Chó trưởng thành (1-7 tuổi): Duy trì cân bằng</h2>
<p>Mục tiêu của chó trưởng thành là duy trì cân nặng lý tưởng và năng lượng ổn định. Chế độ ăn nên giữ cân bằng giữa protein (duy trì cơ bắp), chất béo lành mạnh (lông bóng mượt), và carbohydrate phức hợp (năng lượng). Tùy thuộc vào mức độ hoạt động, lượng thức ăn cần được điều chỉnh để tránh thừa cân. Đầy đủ vitamin, chất xơ và khoáng chất là cần thiết cho hệ miễn dịch khỏe mạnh.</p>
<ul>
    <li>Nhu cầu chính: Chất xơ (hỗ trợ tiêu hóa), Axit béo Omega (da & lông), Vitamin tổng hợp.</li>
    <li>Lưu ý: Tránh cho ăn quá nhiều đồ ăn vặt của người để bảo vệ dạ dày và gan.</li>
</ul>

<h2>3. Chó già (Trên 7 tuổi): Hỗ trợ cơ quan và khớp</h2>
<p>Khi chó già đi, tốc độ trao đổi chất giảm và nhu cầu năng lượng cũng giảm theo. Cần chuyển sang thức ăn ít calo (Senior formula) để tránh tăng cân không mong muốn, nhưng vẫn giàu chất xơ để hỗ trợ tiêu hóa. Các chất bổ sung như Glucosamine và Chondroitin rất quan trọng để hỗ trợ sức khỏe khớp và làm chậm quá trình thoái hóa khớp. Tăng cường chất chống oxy hóa để hỗ trợ chức năng não và hệ miễn dịch.</p>
<ul>
    <li>Nhu cầu chính: Glucosamine (hỗ trợ khớp), Chất chống oxy hóa, Protein dễ tiêu hóa.</li>
    <li>Lưu ý: Thường xuyên kiểm tra cân nặng và tham khảo ý kiến bác sĩ để điều chỉnh chế độ ăn cho các bệnh lý liên quan đến tuổi già (thận, tim).</li>
</ul>'
    ]
];

// Kiểm tra ID hợp lệ
if (!isset($posts[$id])) {
    echo "Bài viết không tồn tại.";
    exit;
}

$post = $posts[$id];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title><?php echo $post['title']; ?> - Pet Care</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .blog-container { max-width: 900px; margin: 50px auto; padding: 0 15px; line-height: 1.8; font-size: 17px; color: #333; }
    
    .blog-title { 
        font-size: 38px; 
        font-weight: 600; 
        margin-bottom: 10px; 
        color: #00838f; 
    } 
    .blog-meta { font-size: 15px; color: #666; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;}
    .blog-image { width: 100%; max-height: 450px; object-fit: cover; border-radius: 15px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    .blog-content p { margin-bottom: 25px; text-align: justify; } 
    
    /* Tiêu đề phụ (H2, H3) - Bỏ font-weight: 700 */
    .blog-content h2, .blog-content h3 { 
        color: #00bcd4; 
        margin-top: 40px; 
        margin-bottom: 15px; 
        font-weight: 500; 
        border-left: 5px solid #ffb300; 
        padding-left: 15px;
    }
    .blog-content ul { margin-left: 25px; margin-bottom: 25px; list-style-type: disc; } 
    .blog-content ul li { margin-bottom: 10px; line-height: 1.6; }
    
    @media(max-width:768px){ 
        .blog-title{ font-size:30px; } 
        .blog-image{ max-height:250px; } 
        .blog-container { font-size: 16px; margin-top: 30px; }
    }
  </style>
</head>
<body>

<?php include('includes/header.php'); ?>

<main class="blog-container">
  <h1 class="blog-title"><?php echo $post['title']; ?></h1>
  <div class="blog-meta"><i class="far fa-calendar-alt" style="margin-right: 5px;"></i> Ngày đăng: <?php echo $post['date']; ?></div>
  <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" class="blog-image">
  <div class="blog-content">
      <?php echo $post['content']; ?>
  </div>
</main>

<?php include('includes/footer.php'); ?>


</body>
</html>