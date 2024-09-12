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
    <title>Trang chủ | Q&TCAR</title>
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
<section id="slider">
    <!-- Slide -->
    <div class="aspect-ratio-169">
        <img src="image/slidecar1.png" alt="slidecar1">
        <img src="image/slidecar2.png" alt="slidecar2">
        <img src="image/slidecar3.png" alt="slidecar3">
        <img src="image/slidecar4.png" alt="slidecar4">
        <img src="image/slidecar5.png" alt="slidecar5">
    </div>

    <div class="not-container">
        <div class="not active"></div>
        <div class="not"></div>
        <div class="not"></div>
        <div class="not"></div>
        <div class="not"></div>
    </div>
</section>

<section id="cac-loai-xe-cho-thue">
    <div class="title-xe">
        <h3>CÁC LOẠI XE CHO THUÊ</h3>
    </div>
    <div class="ds-xe">
        <div class="loai-xe">
            
            <div class="thumb-xe">
                <img src="image/quangcao1.png" alt="Xe Yamaha">
            </div>
            <div class="inf-xe">
                <h3 class="title-xe">
                    <a href="">Xe máy</a>
                </h3>
                <div class="combo-gia-mua quangcao">
                    <div class="gia-xe">
                        <ins>
                            <span>170.000đ - 500.000đ</span>
                        </ins>
                    </div>
                </div>
            </div>
            <div class="not-xem">
                <a href="xemay_honda.php" class="xem-tat-ca">Xem tất cả</a>
            </div>
        </div>
        <div class="loai-xe">
            <div class="thumb-xe">
                <img src="image/quangcao2.png" alt="Xe Yamaha">
            </div>
            <div class="inf-xe">
                <h3 class="title-xe">
                    <a href="">Xe hơi</a>
                </h3>
                <div class="combo-gia-mua quangcao">
                    <div class="gia-xe">
                        <ins>
                            <span>170.000đ - 1.000.000đ</span>
                        </ins>
                    </div>
                </div>
            </div>
            <div class="not-xem">
                <a href="xehoi_honda.php" class="xem-tat-ca">Xem tất cả</a>
            </div>
        </div>
        <div class="loai-xe">
            <div class="thumb-xe">
                <img src="image/quangcao3.jpg" alt="Xe Yamaha">
            </div>
            <div class="inf-xe">
                <h3 class="title-xe">
                    <a href="">Xe du lịch</a>
                </h3>
                <div class="combo-gia-mua quangcao">
                    <div class="gia-xe">
                        <ins>
                            <span>1.000.000đ - 17.000.000đ</span>
                        </ins>
                    </div>
                </div>
            </div>
            <div class="not-xem">
                <a href="xedulich.php" class="xem-tat-ca">Xem tất cả</a>
            </div>
        </div>
    </div>
</section>

<section id="cac-loai-xe-hot">
    <div class="title-xe xethuenhieu">
        <h3>Xe được thuê nhiều</h3>
    </div>
    <div class="ds-xe">
        <div class="loai-xe">
            <div class="thumb-xe">
                <img src="image/honda/airblade2020.jpg" alt="Xe Yamaha">
            </div>
            <div class="inf-xe">
                <h3 class="title-xe">
                    <a href="">Airblade 2020</a>
                </h3>
                <div class="combo-gia-mua">
                    <div class="gia-xe">
                        <ins>
                            <span>170.000đ</span>
                        </ins>
                    </div>
                    <div class="icon-mua-hang">
                        <a class="fa fa-shopping-bag"></a>
                    </div>
                </div>
            </div>
            <div class="not-xem">
                <a href="xemay_honda.php#airblade" class="xem-tat-ca">Thuê ngay!</a>
            </div>
        </div>
        <div class="loai-xe">
            <div class="thumb-xe">
                <img src="image/yamaha/exciter2022.jpg" alt="Xe Yamaha">
            </div>
            <div class="inf-xe">
                <h3 class="title-xe">
                    <a href="">Exciter 2022</a>
                </h3>
                <div class="combo-gia-mua">
                    <div class="gia-xe">
                        <ins>
                            <span>170.000đ</span>
                        </ins>
                    </div>
                    <div class="icon-mua-hang">
                        <a class="fa fa-shopping-bag"></a>
                    </div>
                </div>
            </div>
            <div class="not-xem">
                <a href="xemay_yamaha.php#exciter" class="xem-tat-ca">Thuê ngay!</a>
            </div>
        </div>
        <div class="loai-xe">
            <div class="thumb-xe">
                <img src="image/Suzuki/gsx2024.png" alt="Xe Yamaha">
            </div>
            <div class="inf-xe">
                <h3 class="title-xe">
                    <a href="">GSX 2024</a>
                </h3>
                <div class="combo-gia-mua">
                    <div class="gia-xe">
                        <ins>
                            <span>120.000đ</span>
                        </ins>
                    </div>
                    <div class="icon-mua-hang">
                        <a class="fa fa-shopping-bag"></a>
                    </div>
                </div>
            </div>
            <div class="not-xem">
                <a href="xemay_suzuki.php#gsx" class="xem-tat-ca">Thuê ngay!</a>
            </div>
        </div>
        <div class="loai-xe">
            <div class="thumb-xe">
                <img src="image/Ford/fordRanger2022.jpg" alt="Xe Ford" width="100%" height="100%">
            </div>
            <div class="inf-xe">
                <h3 class="title-xe">
                    <a href="">Ford Ranger 2022</a>
                </h3>
                <div class="combo-gia-mua">
                    <div class="gia-xe">
                        <ins>
                            <span>170.000đ</span>
                        </ins>
                    </div>
                    <div class="icon-mua-hang">
                        <a class="fa fa-shopping-bag"></a>
                    </div>
                </div>
            </div>
            <div class="not-xem">
                <a href="xehoi_ford.php" class="xem-tat-ca">Thuê ngay!</a>
            </div>
        </div>
    </div>
</section>

<a>
    <section class="home-trending box-border bg-before bg-before_02">
                <div class="img-trending-desktop">
            <img src="image/quangcao10.png" alt="BANNER TRENDING" class="lazy">
        </div>
    </section>
</a>

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
<div class="footer-center" id="footerr">
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
<script src="trangchu.js"></script>
</html>
