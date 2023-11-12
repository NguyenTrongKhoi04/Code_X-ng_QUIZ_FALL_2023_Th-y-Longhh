<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/Admin.php';
include_once '../assets/global/Url_Path.php';

if (isset($_GET['act']) && ($_GET['act'] != '')) {

    $act = $_GET['act'];
    switch ($act) {

        // Phần xử lý đăng nhập
        case 'dangnhap':// Gán session khi đăng nhập thành công
            check_Login();
            if ($_SESSION['user']['vaiTro'] == 1) {
                header('location: AdminController.php');
            } else
                include_once 'views/diem/List_Diem.php';
            break;

        case 'dangxuat':// Sử dụng session destroy để hủy session, đăng xuất tài khoản
            session_destroy();
            header("Location: AdminController.php");
            break;

        // Phần xử lý chuyên đề
        case 'NganHangChuyenDe':
            include_once 'views/chuyen_de/Ngan_Hang_Chuyen_De.php'; // Điều hướng đến trang tổng hợp chuyên đề (Read)
            // Xử lý bảng ở dưới đây
            break;
        case 'AddChuyenDe':
            include_once 'views/chuyen_de/Add_Chuyen_De.php'; // Điều hướng đén trang thêm chuyên đề mới (Create)
            // Xử lý form ở dưới đây
            break;
        case 'UpdateChuyenDe':// 
            include_once 'views/chuyen_de/Update_Chuyen_De.php'; //Xử lý phần cập nhật chuyên đề (Update)
            // Xử lý form ở dưới đây
            break;

        // Phần xử lý câu hỏi (Chưa động đến)
        case 'NganHangCauHoi':
            include_once 'views/cau_hoi/Ngan_Hang_Cau_Hoi.php';
            break;
        case 'AddCauHoi':
            include_once 'views/cau_hoi/Add_Cau_Hoi.php';
            break;
        case 'UpdateCauHoi':
            include_once 'views/cau_hoi/Update_Cau_Hoi.php';
            break;


        // Phần xử lý đáp án (Chưa động đến)
        case 'NganHangDapAn':
            include_once 'views/dap_an/Ngan_Hang_Dap_An.php';
            break;
        case 'AddDapAn':
            include_once 'views/dap_an/Add_Dap_An.php';
            break;
        case 'UpdateDapAn':
            include_once 'views/dap_an/Update_Dap_An.php';
            break;

        // Phần xử lí kết quả sau kỳ thi (Chưa động đến)
        case 'ListDiem':
            include_once 'views/diem/List_Diem.php';
            break;
        case 'KhaoThi':
            include_once 'views/diem/Khao_Thi.php';
            break;  


        // Phần xử lí lịch thi (Chưa động đến)
        case 'ListLichThi':
            include_once 'views/lich_thi/List_lich_thi.php';
            break;
        case 'AddLichThi':
            include_once 'views/lich_thi/Add_Lich_Thi.php';
            break;
        case 'UpdateLichThi': //update những lịch thi chưa xảy ra
            include_once 'views/lich_thi/Update_Lich_Thi.php';
            break;


        // Phần xử lý lịch thi (Chưa động đến)
        case 'ListDeThi':
            include_once 'views/de_thi/List_De_Thi.php';
            break;
        case 'AddDeThi':
            include_once 'views/de_thi/Add_De_Thi.php';
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
