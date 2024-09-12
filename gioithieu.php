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
    <title>Giới thiệu | Q&TCAR</title>
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

<section id="s0">
	<div class="gt1">
        <h1>Tổng quan về công ty</h1>
        <p class="namect"><strong>Tên công ty:</strong> Công ty TNHH 3 thành viên Long Đền </p>

        <h2>Sứ mệnh và tầm nhìn</h2>
        <p><strong>Sứ mệnh:</strong> Cung cấp dịch vụ cho thuê xe máy chất lượng cao, an toàn và tiện lợi để giúp khách hàng khám phá mọi nẻo đường một cách dễ dàng và thoải mái.</p>
        <p><strong>Tầm nhìn:</strong> Trở thành nhà cung cấp dịch vụ cho thuê xe máy hàng đầu tại Việt Nam, được khách hàng tin tưởng và lựa chọn hàng đầu.</p>

        <h2>Giá trị cốt lõi</h2>
        <ul>
            <li><strong>Chất lượng:</strong> Cam kết cung cấp những chiếc xe máy luôn ở trạng thái tốt nhất.</li>
            <li><strong>An toàn:</strong> Đảm bảo an toàn tối đa cho khách hàng với các dịch vụ bảo dưỡng và kiểm tra định kỳ.</li>
            <li><strong>Khách hàng là trung tâm:</strong> Luôn lắng nghe và đáp ứng nhu cầu của khách hàng một cách nhanh chóng và tận tình.</li>
            <li><strong>Trách nhiệm xã hội:</strong> Đóng góp vào sự phát triển bền vững của cộng đồng và môi trường.</li>
        </ul>

        <h2>Lịch sử phát triển</h2>
        <ul>
            <li><strong>2024:</strong> Thành lập Công ty TNHH 3 thành viên Long Đền tại TP.Quy Nhơn.</li>
            <li><strong>2024:</strong> Mở rộng dịch vụ ra các tỉnh thành lân cận như Gia Lai, Phú Yên.</li>
            <li><strong>2024:</strong> Đạt mốc 10,000 khách hàng sử dụng dịch vụ.</li>
            <li><strong>2024:</strong> Ra mắt ứng dụng di động giúp khách hàng dễ dàng đặt xe và theo dõi dịch vụ.</li>
        </ul>
    </div>

    <div class="gt2">
        <h1>Chi tiết về dịch vụ và hoạt động</h1>
        <h2>Sản phẩm và dịch vụ</h2>
        <ul>
            <li><strong>Cho thuê xe máy:</strong> Các dòng xe từ xe tay ga, xe số đến xe phân khối lớn, phù hợp với mọi nhu cầu của khách hàng.</li>
            <li><strong>Dịch vụ giao nhận xe tại nhà:</strong> Giao xe tận nơi và nhận xe tại bất kỳ địa điểm nào trong thành phố.</li>
            <li><strong>Bảo dưỡng và sửa chữa:</strong> Dịch vụ bảo dưỡng và sửa chữa xe máy cho khách hàng thuê xe dài hạn.</li>
            <li><strong>Hỗ trợ 24/7:</strong> Đội ngũ hỗ trợ khách hàng luôn sẵn sàng giải đáp và hỗ trợ mọi vấn đề phát sinh.</li>
        </ul>

        <h2>Thị trường và khách hàng mục tiêu</h2>
        <p><strong>Thị trường:</strong> Khách du lịch trong và ngoài nước, người dân địa phương cần thuê xe di chuyển hàng ngày.</p>
        <p><strong>Khách hàng mục tiêu:</strong> Những người muốn trải nghiệm du lịch tự do, các công ty cần thuê xe cho nhân viên, sinh viên và cư dân thành phố.</p>

        <h2>Đội ngũ nhân sự</h2>
        <ul>
            <li><strong>Giám đốc điều hành:</strong> Trần Minh Quyết, với hơn 21 năm kinh nghiệm trong ngành dịch vụ cho thuê xe.</li>
            <li><strong>Trưởng phòng kinh doanh:</strong> Nguyễn Thị Thu Thảo, chuyên gia trong lĩnh vực quản lý khách hàng và mở rộng thị trường.</li>
            <li><strong>Trưởng phòng kỹ thuật:</strong> Lê Quốc Thắng, dẫn dắt 15 nhân viên kỹ thuật chuyên nghiệp, đảm bảo chất lượng và an toàn cho xe.</li>
        </ul>

        <h2>Đối tác và khách hàng quan trọng</h2>
        <ul>
            <li><strong>Đối tác:</strong> Các hãng xe lớn như Honda, Yamaha, Suzuki.</li>
            <li><strong>Khách hàng:</strong> Các công ty du lịch, khách sạn lớn tại TP.Quy Nhơn như FPT, khách sạn FLC.</li>
        </ul>

        <h2>Định hướng phát triển tương lai</h2>
        <ul>
            <li><strong>Mở rộng dịch vụ:</strong> Phát triển dịch vụ cho thuê xe điện, máy bay nhằm bảo vệ môi trường.</li>
            <li><strong>Ứng dụng công nghệ:</strong> Tăng cường sử dụng công nghệ để nâng cao trải nghiệm khách hàng, mở rộng ứng dụng di động với nhiều tính năng mới.</li>
            <li><strong>Phát triển thị trường:</strong> Mở rộng mạng lưới cho thuê xe máy đến các tỉnh thành trên cả nước và hướng tới thị trường quốc tế.</li>
        </ul>
    </div>
	<div class="zalo-button">
        <a href="linkzalo" target="_blank">
            <img src="image/zalo.png" alt="Zalo">
        </a>
    </div>
	<div class="daugach"> </div>
</section>

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