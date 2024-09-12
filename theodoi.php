<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>

    <title>Thông Tin</title>
</head>
<body>

<?php
session_start();

function formatTime($totalSeconds) {
    $hours = floor($totalSeconds / 3600);
    $minutes = floor(($totalSeconds % 3600) / 60);
    $seconds = $totalSeconds % 60;
    return $hours . " giờ " . $minutes . " phút " . $seconds . " giây";
}

// Lấy thời gian hiện tại của máy chủ
$serverTime = date('Y-m-d H:i:s');

// Kiểm tra và lấy thời gian bắt đầu và kết thúc từ session
if (!isset($_SESSION['nx']) || !isset($_SESSION['tx'])) {
    $_SESSION['nx'] = $serverTime; // Thời gian bắt đầu là thời điểm hiện tại của máy chủ
    $_SESSION['tx'] = date('Y-m-d H:i:s', strtotime($serverTime . '+1 hour')); // Thời gian kết thúc là 1 giờ sau thời điểm hiện tại của máy chủ
}

$nx = $_SESSION['nx'];
$tx = $_SESSION['tx'];
$totalTimeInSeconds = strtotime($tx) - strtotime($nx);
$totalTimeFormatted = formatTime($totalTimeInSeconds);
?>
<section id="chinh1">
	<div class="alltime">
		<div class="time1">
			<h1>Thời Gian đếm ngược để trả xe</h1>
			<p>Thời gian bắt đầu: <?php echo date('H:i:s', strtotime($nx)); ?></p>
			<p>Thời gian kết thúc: <?php echo date('H:i:s', strtotime($tx)); ?></p>
			<p>Tổng thời gian thuê xe máy: <?php echo $totalTimeFormatted; ?></p>
		</div>
		<div class="thanhtt">
			<div class="progress-bar" id="progress-bar"></div>
		</div>
		<div id="time-running"></div>
	</div>
</section>
<script>
    // Lấy thời gian bắt đầu và kết thúc từ PHP và chuyển đổi thành mili giây
    let startTime = new Date('<?php echo $nx; ?>').getTime();
    let endTime = new Date('<?php echo $tx; ?>').getTime();
    let totalDuration = endTime - startTime;

    function updateProgressBar() {
        let currentTime = Date.now();
        let elapsedTime = currentTime - startTime;

        if (elapsedTime >= totalDuration) {
            // Nếu đã hết thời gian
            document.getElementById('time-running').textContent = "Đã hết thời gian thuê";
            document.getElementById('progress-bar').style.width = '100%';
        } else {
            // Tính toán thời gian còn lại
            let remainingTime = totalDuration - elapsedTime;
            let hours = Math.floor(remainingTime / 3600000);
            let minutes = Math.floor((remainingTime % 3600000) / 60000);
            let seconds = Math.floor((remainingTime % 60000) / 1000);

            document.getElementById('time-running').textContent = "Còn lại: " + hours + " giờ " + minutes + " phút " + seconds + " giây";

            // Tính toán và cập nhật thanh tiến trình
            let progress = (elapsedTime / totalDuration) * 100;
            progress = Math.min(progress, 100);
            document.getElementById('progress-bar').style.width = progress + '%';
        }

        // Gọi lại hàm sau mỗi 1 giây (1000ms), chỉ khi thời gian còn lại dương
        if (elapsedTime < totalDuration) {
            requestAnimationFrame(updateProgressBar);
        }
    }

    // Gọi hàm updateProgressBar để bắt đầu
    updateProgressBar();
</script>
<header>
    <div class="logo">
        <a href="trangchu.php">
            <img src="image/logocar.png" height="100%" width="100%">
        </a>
    </div>
    <ul class="menu">
        <li><a class="doi-mau" href="trangchu.php#cac-loai-xe-cho-thue">TRANG CHỦ</a></li>
        <li>
            <a class="doi-mau" >DỊCH VỤ</a>
            <ul class="sub-menu">
                <div class="cat-sub-menu">
                    <div class="item-list-submenu">
                        <h3><a class="doi-mau" href="xemay_honda.php">HONDA</a></h3>
                        <ul>
                            <li><a class="doi-mau" href="xemay_honda.php#airblade">Airblade</a></li>
                            <li><a class="doi-mau" href="xemay_honda.php#future">Future</a></li>
                            <li><a class="doi-mau" href="xemay_honda.php#vario">Vario</a></li>
                            <li><a class="doi-mau" href="xemay_honda.php#wave">Wavealpha</a></li>
                            <li><a class="doi-mau" href="xemay_honda.php#winnerx">Winner</a></li>
                            <li><a class="doi-mau" href="xemay_honda.php#vision">Vision</a></li>
                        </ul>
                    </div>
                    <div class="item-list-submenu">
                        <h3><a class="doi-mau" href="xemay_yamaha.php">YAMAHA</a></h3>
                        <ul>
                            <li><a class="doi-mau" href="xemay_yamaha.php#exciter">Exciter</a></li>
                            <li><a class="doi-mau" href="xemay_yamaha.php#jupiter">Jupiter</a></li>
                            <li><a class="doi-mau" href="xemay_yamaha.php#sirius">Sirius</a></li>

                        </ul>
                    </div>
                    <div class="item-list-submenu">
                        <h3><a class="doi-mau" href="xemay_suzuki.php">SUZUKI</a></h3>
                        <ul>
                            <li><a class="doi-mau" href="xemay_suzuki.php#smash">Smash</a></li>
                            <li><a class="doi-mau" href="xemay_suzuki.php#skydrive">Skydrive</a></li>
                            <li><a class="doi-mau" href="xemay_suzuki.php#raider150">Raider-150</a></li>
                            <li><a class="doi-mau" href="xemay_suzuki.php#address">Address</a></li>
                            <li><a class="doi-mau" href="xemay_suzuki.php#satria">Satria</a></li>
                            <li><a class="doi-mau" href="xemay_suzuki.php#vstrom">V-Strom</a></li>
                            <li><a class="doi-mau" href="xemay_suzuki.php#gsx">GSX-R150</a></li>
                        </ul>
                    </div>
                    <div class="item-list-submenu">
                        <h3><a class="doi-mau">XE HƠI</a></h3>
                        <ul>
                            <li><a class="doi-mau" href="xehoi_toyota.php">Toyota</a></li>
                            <li><a class="doi-mau" href="xehoi_honda.php">Honda</a></li>
                            <li><a class="doi-mau" href="xehoi_ford.php">Ford</a></li>
                        </ul>
                    </div>
                    <div class="item-list-submenu">
                        <h3><a class="doi-mau" href="xedulich.php">XE DU LỊCH</a></h3>
                    </div>
                </div>
            </ul>
        </li>
        <li><a class="doi-mau" href="gioithieu.php">GIỚI THIỆU</a></li>
        <li><a class="doi-mau" href="trangchu.php#footerr">LIÊN HỆ</a></li>
        <li><a class="doi-mau" href="huongdan.php">HƯỚNG DẪN</a></li>
        <li><a class="doi-mau" href="thongtin.php">THÔNG TIN</a></li>
    </ul>
    <ul class="others">
        <li>
			<form method="post" action="search.php" class="search_row">
				<input placeholder="Tìm kiếm" name="noidung" type= "text"> 
				<button class="fas fa-search" type="submit" name="btn"></button>
			</form>
			<?php
				$conn = new mysqli('localhost', 'root', '', 'tai_khoan');
				if ($conn->connect_error) {
					die("Kết nối thất bại: " . $conn->connect_error);
				}
				if(isset($_POST['btn'])) {
					$noidung = $_POST['noidung'];
					$stmt = $conn->prepare("SELECT * FROM xe WHERE TenXe LIKE ?");
					$searchTerm = "%$noidung%";
					$stmt->bind_param("s", $searchTerm);
					$stmt->execute();
					$result = $stmt->get_result();

					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							echo '<div class="cartegory-right-content-item">';
							echo '<img src="' . $row["TenFile"] . '" alt="">';
							echo '<h1>' . $row["TenXe"] . '</h1>';
							echo '<div class="item-footer">';
							echo '<span>' . ($row["GiaThue"]) . '</span>';
							echo '<a href="thanhtoan.php?id=' . $row["STT"] . '&type=xe &price=' . $row["GiaThue"] . '">Thuê ngay!</a>';
							echo '</div>';
							echo '</div>';
						}
					} else {
						echo "Không có sản phẩm nào.";
					}
					$stmt->close();
				}
				$conn->close();
			?>
		</li>
        <?php if(isset($_SESSION['username'])) { 
            $username = $_SESSION['username'];
            $customer_name = $_SESSION['customer_name'];?>
            <li>
                <a class="fa fa-user doi-mau user-icon"></a>
                <div class="show-account">
                <div class="image-container">
                    <img src="image/account.png" width="150px" height="150px" style="border-radius: 50%; overflow:hidden;">
                </div>
                    <?php echo "<span class='hello-message'>Xin chào, $customer_name </span>"; ?>
                    
                    <div class="auth__form__buttons">
                        <a class="btn btn--large" href="logout.php">Đăng xuất</a>
                    </div>
                </div>
            </li>
        <?php } else { ?>
            <li><a class="fa fa-user doi-mau user-icon" href="login.php"></a></li>
        <?php } ?>
        <li><a class="fa fa-key doi-mau" href="theodoi.php"></a></li>
        <li>
            <div class="shopping-window">
                <!-- Nội dung cửa sổ shopping -->
                <i class="close-icon fa fa-compress doi-mau"></i>
                <h3 style="font-size: 25px; margin:10px; color:red; border-bottom: #bcb8b8;">Giỏ hàng</h3>
                <h1 style="margin-top: 20px; margin-left: 10px;">Bạn chưa thêm sản phẩm nào...</h1>
            </div>
            <a class="fa fa-shopping-bag doi-mau" id="shopping-icon" href="#"></a>
        </li>
    </ul>
</header>
<section id="danhgiachinh">
<div class="danhgia">
	<h1>Đánh giá dịch vụ thuê xe</h1>
	<div class="stars">
		<span class="star" data-value="1">&#9733;</span>
		<span class="star" data-value="2">&#9733;</span>
		<span class="star" data-value="3">&#9733;</span>
		<span class="star" data-value="4">&#9733;</span>
		<span class="star" data-value="5">&#9733;</span>
	</div>
	<textarea id="comment" placeholder="Nhập nhận xét của bạn ở đây..."></textarea>
	<button onclick="submitReview()">Gửi đánh giá</button>
	<div id="thank-you-message"></div>
</div>
</section>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star');
    let selectedRating = 0;

    stars.forEach(star => {
        star.addEventListener('click', () => {
            selectedRating = star.getAttribute('data-value');
            highlightStars(selectedRating);
        });
        star.addEventListener('mouseover', () => {
            const value = star.getAttribute('data-value');
            highlightStars(value);
        });
        star.addEventListener('mouseout', () => {
            highlightStars(selectedRating);
        });
    });

    function highlightStars(rating) {
        stars.forEach(star => {
            if (star.getAttribute('data-value') <= rating) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });
    }
});

function submitReview() {
    const comment = document.getElementById('comment').value;
    const thankYouMessage = document.getElementById('thank-you-message');

    if (selectedRating > 0 && comment.trim() !== "") {
        thankYouMessage.textContent = `Cảm ơn bạn đã đánh giá ${selectedRating} sao! Nhận xét của bạn: "${comment}"`;
        thankYouMessage.style.color = 'green';
    } else {
        thankYouMessage.textContent = 'Vui lòng chọn số sao và nhập nhận xét!';
        thankYouMessage.style.color = 'red';
    }
}
</script>

</body>
</html>
