<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/Admin.php';
include_once '../assets/global/Url_Path.php';
include_once '../admin/models/Diem.php ';

$dsDiem = danhSachDiemThi();
include_once 'models/TaiKhoan.php';

if (isset($_GET['act']) && ($_GET['act'] != '')) {

    
    $act = $_GET['act'];
    switch ($act) {

        // Phần xử lý đăng nhập
        // case 'dangnhap':
        //     check_Login();
        //     if ($_SESSION['user']['vaiTro'] == 1) {
        //         header('location: AdminController.php');
        //     } else
        //         include_once 'views/diem/List_Diem.php';
        //     break;
        // Tôi cần một cái comment hướng dẫn debug cho cái này
        // Không hiểu lắm, vì lỗi liên tục session, không thể set được

        case 'dangxuat':{
            session_destroy();
            header("Location: AdminController.php");
            break;
        }
        case 'AddAccount':
            if (isset($_POST['add'])) {

<<<<<<< HEAD
        // Phần xử lý chuyên đề
        case 'ViewChuyenDe':
            include_once 'views/chuyen_de/Ngan_Hang_Chuyen_De.php'; // Điều hướng đến trang tổng hợp chuyên đề (Read)
            // Xử lý bảng ở dưới đây
            
=======
                $arrCheckAccount = select_One('nguoidung', null, "tenDangNhap = '" . $_POST['tenDangNhap'] . "'");
                if (is_array($arrCheckAccount)) {
                    $error = 'Tài Khoản này đã tồn tại';
                } else {
                    extract($_POST);
                    extract($_FILES);
                    $select = $_POST['vaiTro'];

                    $duoianh = pathinfo($anhDaiDien['name'], PATHINFO_EXTENSION);
                    // var_dump($duoianh);
                    if (($duoianh != 'png') && ($duoianh != 'jpg') && ($duoianh != 'jpeg')) {
                        $error = 'Chọn đúng định dạng file ảnh';
                    } else {
                        $img = $anhDaiDien['name'];
                        move_uploaded_file($anhDaiDien['tmp_name'], $adminImage . $img);
                        $error = "Thêm thành công";
                        insert_Account($tenDangNhap, $matKhau, $img, $email, $diaChi, $select);
                    }
                }
            }
            include_once 'views/tai_khoan/Add_Tai_Khoan.php';
            break;
        case 'ListAccount':
            $error = $_GET['mes'] ?? '';
            $arrAccount = select_All('nguoidung');
            include_once 'views/tai_khoan/List_Tai_Khoan.php';
            break;
        case 'UpdateAccount':
            $id = $_GET['id'];
            $arrAccount = select_One('nguoidung', null, " id = '" . $id . "'");
            if (isset($_POST['add'])) {
                extract($_POST);
                extract($_FILES);
                $img = ($anhDaiDien['size'] != 0) ? $anhDaiDien['name'] : $arrAccount['anhDaiDien'];
                
                if ($img == $anhDaiDien['name']) {
                    $duoianh = pathinfo($anhDaiDien['name'], PATHINFO_EXTENSION);
                    if (($duoianh != 'png') && ($duoianh != 'jpg') && ($duoianh != 'jpeg')) {
                        $error = 'Chọn đúng định dạng file ảnh';
                    } else {
                        move_uploaded_file($anhDaiDien['tmp_name'], $adminImage.$img);
                        $select = $vaiTro ?? $arrAccount['vaiTro'];
                        $error = "Update thành công";
                        update_Accouut($id, $tenDangNhap, $matKhau, $img, $email, $diaChi, $select);
                        header("Location:".$adminAction."ListAccount");
                    }
                }else{
                        $select = $vaiTro ?? $arrAccount['vaiTro'];
                        $error = "Update thành công";
                        update_Accouut($id, $tenDangNhap, $matKhau, $img, $email, $diaChi, $select);
                        header("Location:".$adminAction."ListAccount");
                }
            }
            include_once 'views/tai_khoan/Update_Tai_Khoan.php';
            break;
        case 'DeleteAccount':
            $id = $_GET['id'];
            $mes = "Xóa thành công";
            delete_Account($id);
            header('location: AdminController.php?act=ListAccount&mes=' . $mes);
            break;
            /**
             * ====================================================================================
             *                                 CHUYÊN ĐỀ                   
             * ====================================================================================
             */
        case 'NganHangChuyenDe':
            include_once 'views/chuyen_de/Ngan_Hang_Chuyen_De.php';
>>>>>>> 6e17a91d20cb93c1c35fd152db3722604be9a9dc
            break;
        case 'AddChuyenDe':
            include_once 'views/chuyen_de/Add_Chuyen_De.php'; // Điều hướng đén trang thêm chuyên đề mới (Create)
            // Xử lý form ở dưới đây
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addChuyenDe"])) {
                $tenChuyenDe = $_POST["tenChuyenDe"];
                $boCauHoi = $_POST["boCauHoi"];
                $boDapAn = $_POST["boDapAn"];
                insertChuyenDe($tenChuyenDe, $boCauHoi, $boDapAn);
                // INSERT INTO `chuyende`(`tenChuyenDe`, `boCauHoi`, `boDapAn`) VALUES (?, ?, ?)
                // Sẽ set up server-side validation sau. Hoặc dẹp bà nó luôn
            }
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

            $dsDiem = danhSachDiemThi();
            include_once 'views/diem/List_Diem.php';
            break;
        case 'KhaoThi':
            if(isset($_GET['idDiem']) & $_GET['idDiem'] > 0){
                $khaoThi = getone_khaoThi($_GET['idDiem']);
            }
            if(isset($_POST['btnsUpdate'])){
                $idDiem = $_POST['idDiem'];
                $diem = $_POST['diem'];
                updateDiem($idDiem,$diem);
                header('location: ?act=ListDiem');

            }           
            
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

