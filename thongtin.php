<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="image/logocar.png">
    <title>Thông tin | Q&TCAR</title>
</head>
<body>
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
<div class="chung">
	<section id = "s1">
		<div class = "td"><b> Những thông tin cần thiết khi bạn muốn thuê xe ở công ty chúng tôi </b></div>
		<div class = "d1">
			<li><b> Giới thiệu về công ty: </b></li>
				<p> 
				Long Đền là một trong những công ty hàng đầu trong lĩnh vực thuê xe tại khu vực Đông Nam Á. 
				Với hơn 10 năm kinh nghiệm, chúng tôi cam kết cung cấp dịch vụ thuê xe chất lượng cao và đáng tin cậy cho khách hàng.
				</p>
		</div>
		<div class = "d2">
			<li><b> Dịch vụ cung cấp: </b></li>
				<ul>
					<p> Thuê xe du lịch: Xe sedan, SUV, xe 7 chỗ, xe 16 chỗ, và xe limousine. </p>
					<p> Thuê xe hạng sang: Các dòng xe hạng sang từ các thương hiệu nổi tiếng như Mercedes-Benz, BMW, Audi. </p>
					<p> Dịch vụ lái xe: Cung cấp tay lái xe chuyên nghiệp và am hiểu vùng địa lý. </p>
				</ul>
		</div>
		<div class = "d3">
			<li><b> Thông tin liên hệ: </b></li>
				<ul> 
					<p> Địa chỉ: 1234 Đường Đời, Thành phố Quy Nhơn, Tỉnh Bình Định, Quốc gia Việt Nam </p>
					<p> Số điện thoại: 0123-456-789 </p>
					<p> Email: temp@st.qnu.edu.vn </p>
				</ul>
		</div>
		<div class = "d4">
			<li><b> Chính sách và điều kiện: </b></li>
				<ul> 
					<p> Tuổi tối thiểu lái xe: 18 tuổi trở lên. </p>
					<p> Được phép lái xe ở nước ngoài: Cần cung cấp giấy phép lái xe hợp lệ và bản sao hộ chiếu. </p>
					<p> Phí phạt muộn: 20% giá thuê cho mỗi giờ muộn. </p>
					<p> Bảo hiểm: Tất cả các xe được bảo hiểm đầy đủ. </p>
				</ul>
		</div>
		<div class = "d5">
			<li><b> Thông tin về dịch vụ hỗ trợ khách hàng: </b></li>
				<p> Thời gian hoạt động: Thứ Hai - Chủ Nhật, từ 8:00 sáng đến 8:00 tối. </p>
		</div>
		<div class="d6">
			<li><b>Đánh giá phản hồi và góp ý:</b></li>
			<table>
				<thead>
					<tr>
						<th>Tiêu chí</th>
						<th>Đánh giá</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Chất lượng dịch vụ: </td>
						<td><input type="text"></td>
					</tr>
					<tr>
						<td>Giá cả: </td>
						<td><input type="text"></td>
					</tr>
					<tr>
						<td>Thái độ phục vụ: </td>
						<td><input type="text"></td>
					</tr>
					<tr>
						<td>Ý kiến khác: </td>
						<td><input type="text"></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="note">
			<b>Ghi chú:</b> Vui lòng điền đầy đủ thông tin vào các ô đánh giá để chúng tôi có thể cải thiện dịch vụ tốt hơn.
		</div>
		<a href="tel:0123456789" class="hotline-btn">Hotline: 0123 456 789</a>
	</section>
</div>
<div class="footer-top">
    <li><a href=""><img src="image/logocar.png" alt="" width="100%" height="100%"></a></li>
    <li><a href=""></a>Liên hệ</li>
    <li><a href=""></a>Tuyển dụng</li>
    <li><a href=""></a>Giới thiệu</li>
    <li>
        <a class="fab fa-facebook-f"></a>
        <a class="fab fa-twitter"></a>
        <a class="fab fa-youtube"></a>
    </li>
</div>
<div class="footer-center">
    <p>
        Trang web cho thuê xe máy, ô tô uy tín nhất! <br>
        Địa chỉ: 123 Lý Hải, Việt Nam <br>
        Tư vấn online: <b>8372173123</b>
    </p>
</div>
<div class="footer-bottom">
    @Q&TCARchothuexe
</div>
</body>
</html>	




