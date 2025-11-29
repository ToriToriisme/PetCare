<?php
include('../config/db.php');

// Get statistics from database
$total_appointments = $conn->query("SELECT COUNT(*) as total FROM bookings")->fetch_assoc()['total'];
$completed_appointments = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE status = 'completed'")->fetch_assoc()['total'];
$pending_appointments = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE status IN ('pending', 'confirmed', 'waiting')")->fetch_assoc()['total'];
$total_doctors = $conn->query("SELECT COUNT(*) as total FROM doctors")->fetch_assoc()['total'];
$total_services = $conn->query("SELECT COUNT(*) as total FROM services")->fetch_assoc()['total'];
$total_customers = $conn->query("SELECT COUNT(DISTINCT phone) as total FROM bookings")->fetch_assoc()['total'];

// Calculate completion rate
$completion_rate = $total_appointments > 0 ? round(($completed_appointments / $total_appointments) * 100, 1) : 0;
$pending_rate = $total_appointments > 0 ? round(($pending_appointments / $total_appointments) * 100, 1) : 0;

// Get recent appointments
$recent_appointments = $conn->query("
    SELECT b.*, d.name as doctor_name, s.name as service_name 
    FROM bookings b 
    LEFT JOIN doctors d ON b.doctor_id = d.id 
    LEFT JOIN services s ON b.service_id = s.id 
    ORDER BY b.appointment_date DESC, b.appointment_time DESC 
    LIMIT 5
")->fetch_all(MYSQLI_ASSOC);

// Get top doctors
$top_doctors = $conn->query("
    SELECT d.id, d.name, d.specialty, d.image,
           COUNT(b.id) as appointment_count
    FROM doctors d
    LEFT JOIN bookings b ON d.id = b.doctor_id AND b.status = 'completed'
    GROUP BY d.id
    ORDER BY appointment_count DESC
    LIMIT 4
")->fetch_all(MYSQLI_ASSOC);

// Get top services
$top_services = $conn->query("
    SELECT s.name, COUNT(b.id) as service_count
    FROM services s
    LEFT JOIN bookings b ON s.id = b.service_id AND b.status = 'completed'
    GROUP BY s.id
    ORDER BY service_count DESC
    LIMIT 5
")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="css/style.css">
	<title>Dashboard - Quản Lý Phòng Khám</title>
</head>
<body>

<!-- SIDEBAR -->
<section id="sidebar">
	<a href="#" class="brand">
		<i class='bx bxs-clinic'></i>
		<span class="text">PETCARE</span>
	</a>
	<ul class="side-menu top">
		<li class="active"><a href="index.php"><i class='bx bxs-dashboard'></i><span class="text">Dashboard</span></a></li>
		<li><a href="services.php"><i class='bx bxs-briefcase-alt-2'></i><span class="text">Dịch Vụ</span></a></li>
		<li><a href="doctors.php"><i class='bx bxs-user-voice'></i><span class="text">Bác Sĩ</span></a></li>
		<li><a href="customers.php"><i class='bx bxs-group'></i><span class="text">Khách Hàng</span></a></li>
		<li><a href="blogs.php"><i class='bx bxs-book-content'></i><span class="text">Blogs</span></a></li>
	</ul>
</section>

<!-- CONTENT -->
<section id="content">
	<!-- NAVBAR -->
	<nav>
		<i class='bx bx-menu'></i>
		<a class="nav-link">Dashboard Tổng Quan</a>
		<form action="#">
			<div class="form-input">
				<input type="search" placeholder="Tìm kiếm...">
				<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
			</div>
		</form>
		<input type="checkbox" id="switch-mode" hidden>
		<a href="#" class="profile">
			<img src="img/bs1.jpg" alt="Admin">
		</a>
	</nav>

	<!-- MAIN -->
	<main>
		<!-- HEADER -->
		<div class="head-title">
			<div class="left">
				<h1>Dashboard Tổng Quan</h1>
				<ul class="breadcrumb">
					<li><a href="#">Bảng Điều Khiển</a></li>
					<li><i class='bx bx-chevron-right'></i></li>
					<li><a class="active" href="#">Tổng Quan</a></li>
				</ul>
			</div>
		</div>

		<!-- STATISTICS CARDS -->
		<ul class="box-info">
			<li>
				<i class='bx bxs-calendar-check'></i>
				<span class="text">
					<h3 id="totalAppointments"><?= number_format($total_appointments) ?></h3>
					<p>Tổng Lịch Hẹn</p>
				</span>
			</li>

			<li>
				<i class='bx bxs-user-voice'></i>
				<span class="text">
					<h3 id="totalDoctors"><?= $total_doctors ?></h3>
					<p>Tổng Bác Sĩ</p>
				</span>
			</li>

			<li>
				<i class='bx bxs-group'></i>
				<span class="text">
					<h3 id="totalCustomers"><?= number_format($total_customers) ?></h3>
					<p>Tổng Khách Hàng</p>
				</span>
			</li>
		</ul>

		<!-- SECONDARY STATS -->
		<div class="stats-grid">
			<div class="stat-card">
				<div class="stat-icon">
					<i class='bx bxs-check-circle'></i>
				</div>
				<div class="stat-content">
					<h4>Lịch Hẹn Hoàn Thành</h4>
					<h2 id="completedAppointments"><?= number_format($completed_appointments) ?></h2>
					<p class="stat-detail"><?= $completion_rate ?>% tỷ lệ hoàn thành</p>
				</div>
			</div>

			<div class="stat-card">
				<div class="stat-icon">
					<i class='bx bxs-time-five'></i>
				</div>
				<div class="stat-content">
					<h4>Lịch Hẹn Đang Chờ</h4>
					<h2 id="pendingAppointments"><?= number_format($pending_appointments) ?></h2>
					<p class="stat-detail"><?= $pending_rate ?>% tổng số lịch hẹn</p>
				</div>
			</div>
			<div class="stat-card">
				<div class="stat-icon">
					<i class='bx bxs-briefcase-alt-2'></i>
				</div>
				<div class="stat-content">
					<h4>Tổng Dịch Vụ</h4>
					<h2 id="totalServices"><?= $total_services ?></h2>
					<p class="stat-detail">Dịch vụ đang cung cấp</p>
				</div>
			</div>
		</div>

		<!-- TABLES SECTION -->
		<div class="table-data">
			<!-- RECENT APPOINTMENTS -->
			<div class="order">
				<div class="head">
					<h3>Lịch Hẹn Gần Đây</h3>
					<div class="head-actions">
						<i class='bx bx-search'></i>
						<i class='bx bx-filter'></i>
					</div>
				</div>
				<table>
					<thead>
						<tr>
							<th>Khách Hàng</th>
							<th>Bác Sĩ</th>
							<th>Dịch Vụ</th>
							<th>Ngày</th>
							<th>Giờ</th>
							<th>Trạng Thái</th>
						</tr>
					</thead>
					<tbody id="recentAppointmentsTable">
						<?php if(count($recent_appointments) > 0): ?>
							<?php foreach($recent_appointments as $appt): ?>
							<tr>
								<td>
									<p><?= htmlspecialchars($appt['fullname']) ?></p>
									<small><?= htmlspecialchars($appt['pet_name']) ?> (<?= htmlspecialchars($appt['pet_type']) ?>)</small>
								</td>
								<td><?= htmlspecialchars($appt['doctor_name'] ?? 'Chưa phân công') ?></td>
								<td><?= htmlspecialchars($appt['service_name'] ?? 'N/A') ?></td>
								<td><?= date('d-m-Y', strtotime($appt['appointment_date'])) ?></td>
								<td><?= date('H:i', strtotime($appt['appointment_time'])) ?></td>
								<td>
									<?php
									$status_class = 'pending';
									$status_text = 'Đang Chờ';
									if($appt['status'] == 'completed') {
										$status_class = 'completed';
										$status_text = 'Hoàn Thành';
									} elseif($appt['status'] == 'waiting' || $appt['status'] == 'confirmed') {
										$status_class = 'process';
										$status_text = 'Đang Xử Lý';
									} elseif($appt['status'] == 'cancelled') {
										$status_class = 'cancelled';
										$status_text = 'Đã Hủy';
									}
									?>
									<span class="status <?= $status_class ?>"><?= $status_text ?></span>
								</td>
							</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="6" style="text-align:center; padding:20px;">Chưa có lịch hẹn nào</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
				<div class="table-footer">
					<a href="customers.php" class="view-all">Xem tất cả lịch hẹn →</a>
				</div>
			</div>

			<!-- TOP SERVICES -->
			<div class="todo">
				<div class="head">
					<h3>Dịch Vụ Phổ Biến</h3>
					<i class='bx bx-filter'></i>
				</div>
				<ul class="service-list">
					<?php if(count($top_services) > 0): ?>
						<?php foreach($top_services as $service): ?>
						<li class="service-item">
							<div class="service-info">
								<i class='bx bxs-check-circle'></i>
								<div>
									<p class="service-name"><?= htmlspecialchars($service['name']) ?></p>
									<span class="service-count"><?= $service['service_count'] ?> lượt</span>
								</div>
							</div>
						</li>
						<?php endforeach; ?>
					<?php else: ?>
						<li style="padding:20px; text-align:center; color:#999;">Chưa có dữ liệu dịch vụ</li>
					<?php endif; ?>
				</ul>
				<div class="table-footer">
					<a href="services.php" class="view-all">Xem tất cả dịch vụ →</a>
				</div>
			</div>
		</div>

		<!-- DOCTOR PERFORMANCE -->
		<div class="doctor-performance-section">
			<div class="section-header">
				<h3>Hiệu Suất Bác Sĩ</h3>
				<a href="doctors.php" class="view-all">Xem chi tiết →</a>
			</div>
			<div class="doctor-performance-grid">
				<?php if(count($top_doctors) > 0): ?>
					<?php foreach($top_doctors as $doctor): ?>
					<div class="doctor-performance-card">
						<div class="doctor-avatar">
							<?php
							$img_path = '';
							if(!empty($doctor['image'])) {
								if(strpos($doctor['image'], 'assets/img/doctors/') !== false) {
									$img_path = '../' . $doctor['image'];
								} else {
									$img_path = '../assets/img/doctors/' . basename($doctor['image']);
								}
							}
							if($img_path && file_exists($img_path)): ?>
								<img src="<?= $img_path ?>" alt="<?= htmlspecialchars($doctor['name']) ?>">
							<?php else: ?>
								<img src="img/bs1.jpg" alt="<?= htmlspecialchars($doctor['name']) ?>">
							<?php endif; ?>
						</div>
						<div class="doctor-info">
							<h4><?= htmlspecialchars($doctor['name']) ?></h4>
							<p><?= htmlspecialchars($doctor['specialty'] ?? 'Bác sĩ Thú Y') ?></p>
						</div>
						<div class="doctor-stats">
							<div class="stat-item">
								<span class="stat-label">Lịch hẹn</span>
								<span class="stat-value"><?= $doctor['appointment_count'] ?></span>
							</div>
							<div class="stat-item">
								<span class="stat-label">Hiệu suất</span>
								<span class="stat-value success"><?= $doctor['appointment_count'] > 0 ? '95%' : '0%' ?></span>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				<?php else: ?>
					<div style="padding:20px; text-align:center; color:#999; grid-column:1/-1;">Chưa có dữ liệu bác sĩ</div>
				<?php endif; ?>
			</div>
		</div>
	</main>
</section>

<script src="js/script.js"></script>
<script>
// Toggle Sidebar
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

if(menuBar) {
	menuBar.addEventListener('click', function () {
		sidebar.classList.toggle('hide');
	});
}

// Dark Mode
const switchMode = document.getElementById('switch-mode');
if (switchMode) {
	switchMode.addEventListener('change', function () {
		document.body.classList.toggle('dark');
	});
}

// Initialize dashboard
document.addEventListener('DOMContentLoaded', function() {
	console.log('Dashboard loaded successfully');
});
</script>
</body>
</html>

