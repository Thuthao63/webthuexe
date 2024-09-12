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
                <option value="with_delivery">Giao Tận Nơi</option>
            </select>
            
            <div id="delivery_address_container" style="display:none;">
                <label for="delivery_address">Địa Chỉ Giao Xe:</label>
                <textarea id="delivery_address" name="delivery_address" rows="2" placeholder="Nhập địa chỉ giao xe"></textarea>
            </div>
            
            <div id="fixed_address" style="display:none;">
                <label for="fixed_address_text">Địa Chỉ Giao Xe:</label>
                <textarea id="fixed_address_text" rows="2" readonly>Quy Nhơn, Bình Định</textarea>
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
    function calculateTotal() {
        const dailyRate = 150000;
        const driverRate = 200000;
        const discountThreshold = 5; // Áp dụng giảm giá từ 5 ngày trở lên
        const discountRate = 0.1; // 10% discount

        const pickupDateTime = $('#pickup_datetime').val();
        const returnDateTime = $('#return_datetime').val();

        if (!pickupDateTime || !returnDateTime) {
            $('#total_price').val('');
            return;
        }

        const startDateTime = new Date(pickupDateTime);
        const endDateTime = new Date(returnDateTime);

        const totalHours = (endDateTime - startDateTime) / (1000 * 3600);
        const totalDays = Math.ceil(totalHours / 24);

        if (isNaN(totalDays) || totalDays <= 0) {
            $('#total_price').val('');
            return;
        }

        // Kiểm tra xem radio 'Có tài xế' có được chọn hay không
        const driverIncluded = $('input[name="driver_options"]:checked').val() === 'with_driver';
        let total = dailyRate * totalDays + (driverIncluded ? driverRate * totalDays : 0);

        // Áp dụng giảm giá nếu thời gian thuê từ 5 ngày trở lên
        if (totalDays >= discountThreshold) {
            total = total * (1 - discountRate);
        }

        
    }

    // Thêm sự kiện 'change' cho các radio và các input datetime
    $('#pickup_datetime, #return_datetime, input[name="driver_options"]').change(calculateTotal);

    // thu phóng
    document.querySelector('.zoom-image').addEventListener('mousemove', function(e) {
        const rect = e.target.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        e.target.style.transformOrigin = `${x}px ${y}px`;
        e.target.style.transform = 'scale(1.2)';
    });

    document.querySelector('.zoom-image').addEventListener('mouseleave', function(e) {
        e.target.style.transform = 'scale(1)';
    });

    // Chuyển hướng tới trang xác nhận
    document.getElementById('complete-rental').addEventListener('click', function() {
        if(!$('#accept_terms').is(':checked')) {
            alert('Bạn phải chấp nhận các điều khoản để tiếp tục.');
            return;
        }

        // Lưu dữ liệu form vào localStorage
        localStorage.setItem('pickup_datetime', $('#pickup_datetime').val());
        localStorage.setItem('return_datetime', $('#return_datetime').val());
        if($('#delivery_option').val() === 'with_delivery') {
            localStorage.setItem('delivery_address', $('#delivery_address').val());
        } else {
            localStorage.removeItem('delivery_address');
        }
        localStorage.setItem('rental_price', $('#rental_price').val());
        localStorage.setItem('driver_options', $('input[name="driver_options"]:checked').val());
        localStorage.setItem('total_price', $('#total_price').val());

        Swal.fire({
        title: 'Thành công!',
        text: 'Thuê thành công!',
        icon: 'success',
        confirmButtonText: 'OK'
        }).then((result) => {
        if (result.isConfirmed) {
            // Chuyển hướng đến trang chủ (URL trang chủ của bạn)
            window.location.href = 'trangchu.php';
        }
        });
    });

    $(document).ready(function() {
        $('#delivery_option').change(function() {
            if($(this).val() === 'with_delivery') {
                $('#delivery_address_container').show();
                $('#fixed_address').hide();
            } else {
                $('#delivery_address_container').hide();
                $('#fixed_address').show();
            }
        });
        
        $('#payment_method').change(function() {
        // Lấy giá trị được chọn
        var selectedValue = $(this).val();
        
        // Kiểm tra nếu là "bank_transfer" thì hiển thị ảnh QR, ngược lại ẩn đi
        if (selectedValue === 'bank_transfer') {
            $('#bank_transfer_info').show();
        } else {
            $('#bank_transfer_info').hide();
        }
    });
    
		// Kiểm tra giá trị ban đầu của select khi tải trang
		var initialPaymentMethod = $('#payment_method').val();
		if (initialPaymentMethod !== 'bank_transfer') {
			$('#bank_transfer_info').hide();
		}
 });
</script>
</html>
<?php
if( isset($_POST["nut"])){ 
	$_SESSION['nx'] = $_POST['pickup_datetime'];
	$_SESSION['tx'] = $_POST['return_datetime'];
}
?>
