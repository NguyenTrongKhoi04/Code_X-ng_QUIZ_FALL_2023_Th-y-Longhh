<?php 
include_once "../app/Pdo.php";
include_once "models/DangKy.php";


if (isset($_GET['act']) && ($_GET['act'] != '')) {

    $act = $_GET['act'];
    switch ($act) {
        case 'Register':
            if (isset($_POST['submit']) && $_POST['submit']) {
                // Xử lý khi có dữ liệu từ form
                if (isset($_POST['tenDangNhap'], $_POST['matKhau'], $_POST['email'], $_POST['diaChi'])) {
                    $tenDangNhap = $_POST['tenDangNhap'];
                    $matKhau = $_POST['matKhau'];
                    $email = $_POST['email'];
                    $diaChi = $_POST['diaChi'];
            
                    // Xử lý ảnh đại diện
                    // if ($_FILES['anhDaiDien']['name'] != "") {
                    //     $file = $_FILES['anhDaiDien'];
                    //     $anhDaiDien = $file['name'];
                    //     move_uploaded_file($file['tmp_name'], '../assets/upload/' . $anhDaiDien);
                    // }
            
                    // Gọi hàm thêm người dùng
                    add_NguoiDung($tenDangNhap, $matKhau, $anhDaiDien, $email, $diaChi);
                }
            }
            header('location: ../assets/global/Login.php');
            break;
    }
}