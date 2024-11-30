<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styleee.css">
    <link rel="icon" type="image/png" href="image/logocar.png">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- CDN link để thêm SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Thanh toán | Q&TCAR</title>
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
<div class="checkout-container">
    <div class="image-containerr">
        <!-- Hình ảnh của xe -->
        <?php
        // Kết nối tới cơ sở dữ liệu
        $conn = new mysqli('localhost', 'root', '', 'tai_khoan');

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Lấy tham số từ URL
        $vehicle_id = $_GET['id'];
        $vehicle_type = $_GET['type'];
		$vehicle_price = $_GET['price'];
		
		if (!isset($vehicle_price)) {
            die("Giá trị 'price' không được truyền.");
        }

        // Truy vấn lấy thông tin chi tiết xe từ bảng tương ứng
        $sql = "SELECT * FROM $vehicle_type WHERE STT = $vehicle_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<img src="' . $row["TenFile"] . '" alt="' . $row["TenXe"] . '" class="zoom-image">';
        } else {
            echo "Không tìm thấy thông tin xe.";
        }
        $conn->close();
        ?>
    </div>
    <div class="payment-details">
		<?php echo '<h2 class="centered-text">' . $row["TenXe"] . '</h2>'; ?>
        <form id="rental-form" method="POST">
            <div class="datetime-container">
                <div>
                    <label for="pickup_datetime">Nhận Xe:</label>
                    <input type="datetime-local" id="pickup_datetime" name="pickup_datetime" required>
                </div>
                <div>
                    <label for="return_datetime">Trả Xe:</label>
                    <input type="datetime-local" id="return_datetime" name="return_datetime" required>
                </div>
            </div>
            
            <label for="delivery_option">Giao Xe:</label>
            <select id="delivery_option" name="delivery_option">
                <option value="...">---</option>
                <option value="no_delivery">Nhận xe tại cơ sở</option>
                <option value="with_delivery">Giao Tận Nơi(Thêm phí 50.000VND)</option>
            </select>
            
            <div id="delivery_address_container" style="display:none;">
                <label for="delivery_address">Địa Chỉ Giao Xe:</label>
                <textarea id="delivery_address" name="delivery_address" rows="2" placeholder="Nhập địa chỉ giao xe"></textarea>
            </div>
            
            <div class="price-driver-container">
                <div>
                    <label for="rental_price">Giá Thuê:</label>
                    <input type="text" id="rental_price" name="rental_price" value="<?php echo $vehicle_price; ?>" readonly>
                </div>
                <div>
                    <label>Tài xế:</label>
                    <div>
                        <input type="radio" id="with_driver" name="driver_options" value="with_driver">
                        <label for="with_driver">Có tài xế (thêm 200,000 VND/ngày)</label>
                    </div>
                    <div>
                        <input type="radio" id="no_driver" name="driver_options" value="no_driver">
                        <label for="no_driver">Không có tài xế</label>
                    </div>
                </div>
            </div>
            
            <label for="payment_method">Phương Thức Thanh Toán:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="...">---</option>
                <option value="bank_transfer">Chuyển Khoản Ngân Hàng</option>
                <option value="cash_on_delivery">Thanh Toán Khi Nhận Xe</option>
            </select>
			
            <!-- Dòng "Nhấn vào link này để đọc điều khoản thuê xe" -->
            <p class="terms-link">Nhấn vào <a href="dieukhoan.php" target="_blank" style="color: red;">link này</a> để đọc điều khoản thuê xe.</p>
            
            <!-- Dòng "Tôi chấp nhận các điều khoản trên" và ô checkbox -->
            <div class="accept-terms">
                <input type="checkbox" id="accept_terms" name="accept_terms">
                <label for="accept_terms">Tôi chấp nhận các điều khoản trên.</label>
            </div>
            
            <!-- Nút Giỏ Hàng và Chọn Thuê -->
            <div class="button-group">
                <input type="submit" id="complete-rental" name="nut" value="Chọn thuê">
            </div>
        </form>
    </div>
</div>
</body> 
<script>
document.getElementById('delivery_option').addEventListener('change', function () {
    const deliveryAddressContainer = document.getElementById('delivery_address_container');
    const fixedAddress = document.getElementById('fixed_address');

    if (this.value === 'with_delivery') {
        deliveryAddressContainer.style.display = 'block';
        fixedAddress.style.display = 'none';
    } else {
        deliveryAddressContainer.style.display = 'none';
        fixedAddress.style.display = 'none';
    }

});
</script>
</html>
<?php


if (isset($_POST['nut'])) {
    $pickup_datetime = $_POST['pickup_datetime'];
    $return_datetime = $_POST['return_datetime'];
    $delivery_option = $_POST['delivery_option'];
    $driver_option = isset($_POST['driver_options']) ? $_POST['driver_options'] : 'no_driver';
    $payment_method = $_POST['payment_method'];

    // Lấy giá thuê từ GET hoặc mặc định
    $vehicle_price = $_GET['price'];
    $vehicle_price = str_replace(['.', ' VND'], '', $vehicle_price); // Loại bỏ ký tự không phải số
    $vehicle_price = (int)$vehicle_price;

    if ($pickup_datetime && $return_datetime) {
        // Tính số ngày thuê xe
        $pickupDate = new DateTime($pickup_datetime);
        $returnDate = new DateTime($return_datetime);
        $interval = $pickupDate->diff($returnDate);
        $days_rented = max(1, $interval->days); // Tối thiểu là 1 ngày

        // Tính phí tài xế
        $driver_fee = ($driver_option === "with_driver") ? 200000 * $days_rented : 0;

        // Tính phí giao xe (nếu có)
        $delivery_fee = ($delivery_option === "with_delivery") ? 50000 : 0;

        // Tính tổng chi phí
        $total_cost = ($vehicle_price * $days_rented) + $driver_fee + $delivery_fee;

        // Lưu vào session
        $_SESSION['total_cost'] = $total_cost;
        $_SESSION['nx'] = $pickup_datetime;
        $_SESSION['tx'] = $return_datetime;

        // Hiển thị tổng chi phí
        echo "<script>
            Swal.fire({
                title: 'THUÊ XE THÀNH CÔNG',
                text: 'Tổng chi phí: " . number_format($total_cost, 0, ',', '.') . " VND',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Lỗi',
                text: 'Vui lòng nhập đầy đủ thông tin.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>
