<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/Admin.php';
include_once '../assets/global/Url_Path.php';

if (isset($_GET['act']) && ($_GET['act'] != '')) {

    $act = $_GET['act'];
    switch ($act) {
            /**
             * ====================================================================================
             *                                 TÀI KHOẢN
             * ====================================================================================
             */
        case 'dangnhap':
            check_Login();
            if ($_SESSION['user']['vaiTro'] == 0) {
                header('location: AdminController.php');
            } else
                include_once 'views/diem/List_Diem.php';
            break;
        case 'dangxuat':
            session_destroy();
            header("Location: AdminController.php");
            break;

            /**
             * ====================================================================================
             *                                 CHUYÊN ĐỀ                   
             * ====================================================================================
             */
        case 'NganHangChuyenDe':
            include_once 'views/chuyen_de/Ngan_Hang_Chuyen_De.php';
            break;
        case 'AddChuyenDe':
            include_once 'views/chuyen_de/Add_Chuyen_De.php';
            break;
        case 'UpdateChuyenDe':
            include_once 'views/chuyen_de/Update_Chuyen_De.php';
            break;

            /**
             * ====================================================================================
             *                                 CÂU HỎI                   
             * ====================================================================================
             */
        case 'NganHangCauHoi':
            include_once 'views/cau_hoi/Ngan_Hang_Cau_Hoi.php';
            break;
        case 'AddCauHoi':
            include_once 'views/cau_hoi/Add_Cau_Hoi.php';
            break;
        case 'UpdateCauHoi':
            include_once 'views/cau_hoi/Update_Cau_Hoi.php';
            break;

              /**
             * ====================================================================================
             *                                 ĐÁP ÁN                   
             * ====================================================================================
             */
        case 'NganHangDapAn':
            include_once 'views/dap_an/Ngan_Hang_Dap_An.php';
            break;
        case 'AddDapAn':
            include_once 'views/dap_an/Add_Dap_An.php';
            break;
        case 'UpdateDapAn':
            include_once 'views/dap_an/Update_Dap_An.php';
            break;

            /**
             * ====================================================================================
             *                                  ĐIỂM
             * ====================================================================================
             */
        case 'ListDiem':
            include_once 'views/diem/List_Diem.php';
            break;
        case 'KhaoThi':
            include_once 'views/diem/Khao_Thi.php';
            break;
        default:
            include_once 'views/chuyen_de/Ngan_Hang_Chuyen_De.php';
            break;
    }
} else {
    if (empty($_SESSION['user'])) {
        header('location:../assets/global/Login.php');
    } else {
        include_once 'views/chuyen_de/Ngan_Hang_Chuyen_De.php';
    }
}
