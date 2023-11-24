<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/User.php';
include_once '../assets/global/Url_Path.php';

// include_once 'models/TaiKhoan.php';

if (isset($_GET['act']) && ($_GET['act'] != '')) {

    
    $act = $_GET['act'];
    switch ($act) {
        case 'TrangChu':{
            include_once 'views/Home.html';
            break;
        }
        case 'DangKyTaiKhoan':{
            include_once 'views/Add.html';
            break;
        }
        case 'ThongTinTaiKhoan':{
            include_once 'views/InfoUser.html';
            break;
        }
            default:
            include_once 'views/Home.html';
            break;
    }
}
 else {
    include_once 'views/Home.html';
}


