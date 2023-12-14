<?php
session_start();
ob_start();
include_once "../app/Pdo.php";
include_once "models/DangKy.php";
include_once "models/DanhSachLichThi.php";
include_once "models/BaiThi.php";


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
        case "Home":
            $dslt = loadAll_DanhSachLichThi();
            include_once "views/Home.php";
            break;
        case "InforUser":

            include_once "views/InforUser.php";
            break;
        case "Test":
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $btct = BaiThi($id);
                // var_dump($btct);
                // die;
            }
            include_once "views/TrangThi.php";
            break;
        default :
            $dslt = loadAll_DanhSachLichThi();
            include_once "views/Home.php";
            break;
    }
}else {
    if (empty($_SESSION['user'])) {
        header('location:../assets/global/Login.php');
    } else {
        $dslt = loadAll_DanhSachLichThi();
        include_once "views/Home.php";
    }
}
