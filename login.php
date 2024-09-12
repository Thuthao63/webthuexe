<?php

$error_message = ""; // Biến lưu trữ thông điệp lỗi

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form đăng nhập
    $user = isset($_POST['customer_account']) ? $_POST['customer_account'] : "";
    $password = isset($_POST['customer_password']) ? $_POST['customer_password'] : "";

    // Kiểm tra xem các trường đã được điền đầy đủ hay không
    if(empty($user) || empty($password)) {
        $error_message = "Vui lòng nhập đầy đủ thông tin đăng nhập!";
    } else {
        // Kết nối đến cơ sở dữ liệu
        $kn = mysqli_connect("localhost", "root", "", "tai_khoan") or die("Không kết nối được!");

        // Xây dựng câu lệnh truy vấn
        $caulenh = "SELECT * FROM users WHERE (email='$user' OR phone='$user')";
        $kq = mysqli_query($kn, $caulenh);

        // Lấy kết quả trả về
        $dong = mysqli_fetch_array($kq);

        // Xử lý kết quả trả về
        if ($dong) {
            // Kiểm tra mật khẩu
            if(password_verify($password, $dong['password'])) {
                // Đăng nhập thành công
                session_start();    
                $_SESSION['username'] = $user;
                $customer_name = $dong['lastname'];
                $_SESSION['customer_name'] = $customer_name;
                header('location:trangchu.php');
            } else {
                // Sai mật khẩu
                $error_message = "Sai mật khẩu!";
            }
        } else {
            // Tài khoản không tồn tại
            $error_message = "Tài khoản không tồn tại!";
        }

        // Đóng kết nối
        mysqli_close($kn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="image/logocar.png">
    <title>Đăng nhập | Q&TCAR</title>
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
<main id="main" class="site-main">
    <div class="container">
        <div class="auth">
            <div class="auth-container">
                <div class="auth-row">
                    <div class="auth__login auth__block">
                        <h3 class="auth__title">Bạn đã có tài khoản</h3>
                        <div class="auth__login__content">
                            <p class="auth__description">
                                Nếu bạn đã có tài khoản, hãy đăng nhập để tích lũy điểm
                                thành viên và nhận được những ưu đãi tốt hơn!
                            </p>
                            <form id="login-form" class="auth__form login-form" role="login" name="frm_customer_account_email" enctype="application/x-www-form-urlencoded" method="POST" action="login.php" autocomplete="off">
                                <div class="form-group">
                                    <input class="form-control" name="customer_account" type="text" placeholder="Email/SĐT" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="customer_password" type="password" placeholder="Mật khẩu">
                                </div>
                                <div class="auth__form__options">
                                    <div class="form-checkbox">
                                        <label>
                                            <input class="checkboxs" value="1" name="customer_remember" type="checkbox">
                                            <span style="margin-left: 5px"> Ghi nhớ đăng nhập</span>
                                        </label>
                                    </div>
                                    <a class="auth__form__link doi-mau" href="" onclick="showAlert()">Quên mật khẩu? </a>
                                </div>
                                <div id="login-error-message" style="margin-top: 10px;"></div>
                                <span class="error-message" style="color: red;"><?php echo $error_message; ?></span>
                                <div class="auth__form__buttons">
                                    <button id="but_login_email" name="but_login_email" class="btn btn--large">Đăng nhập</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="auth__register auth__block">
                        <h3 class="auth__title">Khách hàng mới</h3>
                        <div class="auth__login__content">
                            <p class="auth__description">
                                Nếu bạn chưa có tài khoản, hãy sử dụng tùy chọn này để truy cập biểu mẫu đăng ký.
                            </p>
                            <p class="auth__description">
                                Bằng cách cung cấp cho chúng tôi thông tin chi tiết của bạn, quá trình đặt thuê xe sẽ là một trải nghiệm thú vị và nhanh chóng hơn!
                            </p>

                            <div class="auth__form__buttons">
                                <a href="register.php"><button class="btn btn--large">Đăng ký</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function showAlert() {
                alert("Hết cứu rồi.");
            }
        </script>
    </div>
</main>
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
