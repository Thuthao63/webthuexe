<?php
// Khởi động session
session_start();

// Xóa toàn bộ session
session_unset();
session_destroy();

// Chuyển hướng người dùng đến trang đăng nhập hoặc trang chính của bạn
header("Location: login.php"); // Chuyển hướng đến trang đăng nhập
exit; // Dừng kịch bản sau khi chuyển hướng
?>
