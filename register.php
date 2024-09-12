<?php
$registerMessage = ""; // Biến lưu thông báo đăng ký

// Lấy dữ liệu từ form đăng ký
$firstname = $_POST['customer_firstname'] ?? '';
$lastname = $_POST['customer_display_name'] ?? '';
$email = $_POST['customer_email'] ?? '';
$phone = $_POST['customer_phone'] ?? '';
$birthday = $_POST['customer_birthday'] ?? '';
$sex = $_POST['customer_sex'] ?? '';
$address = $_POST['address'] ?? '';
$password1 = $_POST['customer_pass1'] ?? '';
$password2 = $_POST['customer_pass2'] ?? '';

// Kiểm tra xem có dữ liệu được gửi từ form không
if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($phone) && !empty($birthday) && !empty($sex) && !empty($address) && !empty($password1) && !empty($password2)) {
    // Kết nối đến cơ sở dữ liệu
    $conn = mysqli_connect("localhost", "root", "", "tai_khoan");

    // Kiểm tra kết nối
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }

    // Kiểm tra xem email hoặc số điện thoại đã tồn tại chưa
    $check_query = "SELECT * FROM users WHERE email='$email' OR phone='$phone'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $registerMessage = "Email hoặc số điện thoại đã tồn tại. Vui lòng sử dụng thông tin khác.";
    } else {
        // Kiểm tra mật khẩu
        if ($password1 === $password2) {
            // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
            $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

            // Tạo câu lệnh truy vấn để chèn dữ liệu vào bảng users
            $insert_query = "INSERT INTO users (firstname, lastname, email, phone, birthday, sex, address, password) VALUES ('$firstname', '$lastname', '$email', '$phone', '$birthday', '$sex', '$address', '$hashed_password')";

            if (mysqli_query($conn, $insert_query)) {
                $registerMessage = "Đăng ký thành công! <a href='login.php'><u>Đăng nhập ngay!</u></a>";
            } else {
                $registerMessage = "Đăng ký không thành công. Vui lòng thử lại.";
            }
        } else {
            $registerMessage = "Mật khẩu không khớp. Vui lòng kiểm tra lại.";
        }
    }

    // Đóng kết nối
    mysqli_close($conn);
} else {
    $registerMessage = "Vui lòng điền đầy đủ thông tin.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Đăng kí | Q&TCAR</title>
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
        <div class="order-block__title justify-content-center pt-4 pb-2"><h3 class="text-uppercase">Đăng ký</h3></div>
        <div class="auth auth-forgotpass">
            <div class="row" style="display: block">
                <form id="registerForm" enctype="application/x-www-form-urlencoded" name="frm_register" method="post" action="register.php">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="register-summary__overview">
                            <h4>Thông tin khách hàng</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Họ:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" value="" name="customer_firstname" placeholder="Họ..." style="width: 100%" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Tên:<span style="color: red">*</span></label>
                                    <input class="form-control" type="text" value="" name="customer_display_name" placeholder="Tên..." style="width: 100%" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Email:<span style="color: red">*</span></label>
                                    <input id="email" class="form-control" type="email" name="customer_email" value="" placeholder="Email..." style="width: 100%" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Điện thoại:<span style="color: red">*</span></label>
                                    <input class="form-control" type="text" value="" name="customer_phone" placeholder="Điện thoại..." style="width: 100%" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Ngày sinh:<span style="color: red">*</span></label>
                                    <input type="date" class="form-control" name="customer_birthday" value="" placeholder="Ngày sinh..." style="width: 100%" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Giới tính:<span style="color: red">*</span></label>
                                    <select name="customer_sex" style="width: 100%" class="form-control" required>
                                        <option value="">Chọn giới tính</option>
                                        <option value="Nữ">Nữ</option>
                                        <option value="Nam">Nam</option>
                                        <option value="Khác">Khác</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Địa chỉ:<span style="color: red">(Số nhà, phường/xã, thành phố, tỉnh)*</span></label>
                                    <textarea class="form-control" name="address" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="register-summary__overview">
                            <h4>Thông tin mật khẩu</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Mật khẩu:<span style="color: red">*</span></label>
                                    <input class="form-control" type="password" value="" name="customer_pass1" placeholder="Mật khẩu..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label>Nhập lại mật khẩu:<span style="color: red">*</span></label>
                                    <input class="form-control" type="password" value="" name="customer_pass2" placeholder="Nhập lại mật khẩu..." required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-check">
                                    <input class="form-check-input checkboxs" type="checkbox" name="customer_agree" value="1" id="defaultCheck1" required>
                                    <label style="margin-top: 4px;margin-left: 3px;" class="form-check-label" for="defaultCheck1">
                                        <span> Đồng ý với các <a style="color: #f31f1f" href="">điều khoản</a> của Q&T </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-check">
                                    <input class=" form-check-input checkboxs" type="checkbox" value="1" name="customer_subscribe" id="defaultCheck2">
                                    <label style="margin-top: 4px;margin-left: 3px;" class="form-check-label" for="defaultCheck2">
                                        <span>Đăng ký nhận bản tin</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <button id="bnt_register" class="btn btn--large" type="submit" style="width: 100%;margin-top: 15px">Đăng ký</button>
                                <span style="display: block; margin-top: 10px; color: red; <?php echo $registerMessageColor; ?>"><?php echo $registerMessage; ?></span>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="error-message" style="color: red;"></div>
            </div>
        </div>
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