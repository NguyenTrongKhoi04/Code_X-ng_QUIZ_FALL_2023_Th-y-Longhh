<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/Admin.php';
include_once '../assets/global/Url_Path.php';
include_once 'models/CauHoi.php';
include_once 'models/ChuyenDe.php';
include_once 'models/DapAn.php';
include_once 'models/DeThi.php';
include_once 'models/LichThi.php';
include_once 'models/QuanLyCauHoi.php';

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
            if ($_SESSION['user']['vaiTro'] == 1) {
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
            $dscd = loadAll_ChuyenDe();
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
                $dsch = loadAll_CauHoi();
                // $cauHoi = loadOne_CauHoiChuaDapAn();
                // $cauHoi = loadOne_CauHoiChuaDapAn();
                include_once 'views/cau_hoi/Ngan_Hang_Cau_Hoi.php';
                break;
            case 'AddCauHoi':
                if(isset($_POST['AddCauHoi']) && ($_POST['AddCauHoi'])) {
                    $noiDung = $_POST['noiDung'];
                    $chuyenDeId = $_POST['chuyenDeId'];
                    $hinhAnh = '';
                
                    // Kiểm tra xem các trường dữ liệu không được để trống
                    if (empty($noiDung) || empty($chuyenDeId)) {
                        $thongBao = "<div style='color:red'>Vui lòng điền đầy đủ thông tin.</div>";
                    } else {
                        if ($_FILES['hinhAnh']['name'] != "") {
                            $file = $_FILES['hinhAnh'];
                            //lấy tên file
                            $hinhAnh = $file['name'];
                            move_uploaded_file($file['tmp_name'], "../assets/upload/" . $hinhAnh);
                        }
                
                        $thongBao = add_CauHoi($noiDung, $hinhAnh, $chuyenDeId);
                    }
                }
                $dscd = loadAll_ChuyenDe();
                include_once 'views/cau_hoi/Add_Cau_Hoi.php';
                break;
            case 'EditCauHoi':
                if(isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $id = $_GET['id'];
                    $kq= loadOne_CauHoi($id);
                }
                $dscd = loadAll_ChuyenDe();
                include_once 'views/cau_hoi/Update_Cau_Hoi.php';
                break;
            case 'UpdateCauHoi':
                if(isset($_POST['UpdateCauHoi']) && ($_POST['UpdateCauHoi'])) {
                    $id = $_POST['id']; 
                    $noiDung = $_POST['noiDung']; 
                    $chuyenDeId = $_POST['chuyenDeId']; 
                    $hinhAnh = '';
                    if($_FILES['hinhAnh']['name'] != "") {
                        $file = $_FILES['hinhAnh'];
                        $hinhAnh = $file['name'];
                        move_uploaded_file($file['tmp_name'], '../assets/upload/'.$hinhAnh);
                    }
                    update_CauHoi($id,$noiDung,$hinhAnh,$chuyenDeId);
                }
                $dsch = loadAll_CauHoi();
                // $cauHoi = loadOne_CauHoiChuaDapAn();
                include_once 'views/cau_hoi/Ngan_Hang_Cau_Hoi.php';
                break;
            case 'DeleteCauHoi':
             if(isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $id = $_GET['id'];
                    delete_CauHoi($id);
                }
                $dsch = loadAll_CauHoi();
                // $cauHoi = loadOne_CauHoiChuaDapAn();
                include_once 'views/cau_hoi/Ngan_Hang_Cau_Hoi.php';
                break;
            case 'QuanLyCauHoi':
                if(isset($_GET['id']) && ($_GET['id'] > 0) ) {
                    $cauHoiId = $_GET['id'];
                    $qlch = loadAll_QuanLyCauHoi($cauHoiId);
                }
                include_once 'views/cau_hoi/Quan_Ly_Cau_Hoi.php';
                break;
            case 'laDapAnDung':
                if(isset($_POST['chonDapAnDung']) && ($_POST['chonDapAnDung'])) {
                    update_DapAnSai();
                    $arrDapAnDung = $_POST['dapAnDung'];
                    // var_dump($arrDapAnDung);
                    // die;
                    foreach($arrDapAnDung as $id_Correct) {
                        select_DapAnDung($id_Correct);
                    }
                }
                $dsch = loadAll_CauHoi();
                include_once 'views/cau_hoi/Ngan_Hang_Cau_Hoi.php';
                break;
                case 'ThemDapAnMoi':
                    if (isset($_POST['addDapAnQuanLyCauHoi']) && ($_POST['addDapAnQuanLyCauHoi'])) {
                        $cauHoiId = $_POST['cauHoiId'];
                        $noiDung = $_POST['noiDung'];
                        if (empty($noiDung)) {
                            echo "Vui lòng nhập nội dung đáp án.";
                        } else {
                            // Thêm đáp án mới vào cơ sở dữ liệu
                            addDapAn_QuanLyCauHoi($cauHoiId, $noiDung);
    
                        }
                    }
                    
                    $qlch = loadAll_QuanLyCauHoi($_GET['id']);
                include_once 'views/cau_hoi/Quan_Ly_Cau_Hoi.php';
                break;


            /**
             * ====================================================================================
             *                                 ĐÁP ÁN                   
             * ====================================================================================
             */
        case 'NganHangDapAn':
            $dsda = loadAll_DapAn();
            include_once 'views/dap_an/Ngan_Hang_Dap_An.php';
            break;
        case 'AddDapAn':
            if(isset($_POST['AddDapAn']) && $_POST['AddDapAn']) {
                if(isset($_POST['noiDung']) && isset($_POST['cauHoiId']) && isset($_POST['laDapAnDung'])) {
                    $noiDung = $_POST['noiDung'];
                    $cauHoiId = $_POST['cauHoiId'];
                    $laDapAnDung = $_POST['laDapAnDung'];
                    $hinhAnh = '';
                    if(empty($noiDung) || empty($cauHoiId)) {
                        $thongBao = "<div style='color:red'>Vui lòng điền đầy đủ thông tin.</div>";
                    } else {
                        // Kiểm tra và thêm dữ liệu nếu đã điền đầy đủ
                        if ($laDapAnDung === '' || $laDapAnDung === null) {
                            $laDapAnDung = 0;
                        }
            
                        $existingAnswer = check_DapAnExists($noiDung);
                        if ($existingAnswer) {
                            $thongBao = "<div style='color:red'>Đáp án đã tồn tại.</div>";
                        } else {
                            if ($_FILES['hinhAnh']['name'] != "") {
                                $file = $_FILES['hinhAnh'];
                                $hinhAnh = $file['name'];
                                move_uploaded_file($file['tmp_name'], "../assets/upload/" . $hinhAnh);
                            }
                            
                            $thongBao = "<div style='color:green'>Thêm thành công</div>";
                            add_DapAn($cauHoiId, $noiDung, $hinhAnh, $laDapAnDung);
                        }
                    }
                } else {
                    $thongBao = "<div style='color:red'>Vui lòng điền đầy đủ thông tin.</div>";
                }
            }
            
            $dsch = loadAll_CauHoi();
            // $cauHoi = loadOne_CauHoiChuaDapAn();
            include_once 'views/dap_an/Add_Dap_An.php';
            break;
        case 'EditDapAn':
            if(isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
               $kq = loadOne_DapAn($id);
            }
            $dsch = loadAll_CauHoi();
            // $cauHoi = loadOne_CauHoiChuaDapAn();
            include_once 'views/dap_an/Update_Dap_An.php';
            break;
        case 'UpdateDapAn':
            if(isset($_POST['UpdateDapAn']) && ($_POST['UpdateDapAn'])) {
                $id = $_POST['id'];
                $cauHoiId = $_POST['cauHoiId'];
                $noiDung = $_POST['noiDung'];
                $laDapAnDung = $_POST['laDapAnDung'];
                $hinhAnh = '';
                $thongBao = "<div style='color:green'>Thêm thành công</div>";
                if($_FILES['hinhAnh']['name'] != "") {
                    $file = $_FILES['hinhAnh'];
                    $hinhAnh = $file['name'];
                    move_uploaded_file($file['tmp_name'], '../assets/upload/'.$hinhAnh);
                }
                update_DapAn($id,$cauHoiId,$noiDung,$hinhAnh,$laDapAnDung);
            }
            $dsda = loadAll_DapAn();

            include_once 'views/dap_an/Ngan_Hang_Dap_An.php';
            break;
        case 'DeletaDapAn':
            if(isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                delete_DapAn($id);
            }
            $dsda = loadAll_DapAn();
            include_once 'views/dap_an/Ngan_Hang_Dap_An.php';
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

            /**
             * ====================================================================================
             *                                  LỊCH THI
             * ====================================================================================
             */
        case 'ListLichThi':
            $dslt = loadAll_Lichthi();
            include_once 'views/lich_thi/List_lich_thi.php';
            break;
        case 'AddLichThi':
            if(isset($_POST['AddLichThi']) && $_POST['AddLichThi']) {
                $thoiGianBatDau = $_POST['thoiGianBatDau'];
                $thoiGianKetThuc = $_POST['thoiGianKetThuc'];
                $thoiGianThi = $_POST['thoiGianThi'];
                $soLuongDeThi = $_POST['soLuongDeThi'];
            
                if (!empty($thoiGianBatDau) && !empty($thoiGianKetThuc) && !empty($thoiGianThi) && !empty($soLuongDeThi)) {
                    // Tất cả các trường đều không rỗng, tiến hành thêm vào cơ sở dữ liệu
                    add_LichThi($thoiGianBatDau, $thoiGianKetThuc, $thoiGianThi, $soLuongDeThi);
                    $thongBao = "<div style='color:green'>Thêm thành công</div>";
                } else {
                    // Có ít nhất một trường rỗng, xử lý theo ý của bạn (hiển thị thông báo lỗi, chẳng hạn)
                    $thongBao = "<div style='color:red'>Vui lòng điền đầy đủ thông tin.</div>";
                }
            }
            include_once 'views/lich_thi/Add_Lich_Thi.php';
            break;
        case 'EditLichThi': //update những lịch thi chưa xảy ra
            if(isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $kq = loadOne_LichThi($id);
            }
            include_once 'views/lich_thi/Update_Lich_Thi.php';
            break;
        case 'UpdateLichThi':
            if(isset($_POST['UpdateLichThi']) && ($_POST['UpdateLichThi'])) {
                $id = $_POST['id'];
                $thoiGianBatDau = $_POST['thoiGianBatDau'];
                $thoiGianKetThuc = $_POST['thoiGianKetThuc'];
                $thoiGianThi = $_POST['thoiGianThi'];
                $soLuongDeThi = $_POST['soLuongDeThi'];

                update_LichThi($id,$thoiGianBatDau,$thoiGianKetThuc,$thoiGianThi,$soLuongDeThi);
            }
            $dslt = loadAll_Lichthi();

            include_once 'views/lich_thi/List_lich_thi.php';
            break;
        case 'DeleteLichThi':
            if(isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                delete_LichThi($id);
            }
            $dslt = loadAll_Lichthi();
            include_once 'views/lich_thi/List_lich_thi.php';
            break;
            /**
             * ====================================================================================
             *                                   ĐỀ THI
             * ====================================================================================
             */
        case 'ListDeThi':
            $dslt = loadAll_DeThi();
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
