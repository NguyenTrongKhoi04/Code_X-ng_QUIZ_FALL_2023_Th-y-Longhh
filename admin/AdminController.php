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
include_once 'models/TaiKhoan.php';
include_once 'models/QuanLyCauHoi.php';
include_once 'models/ChiTietDeThi.php';

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
            } else{
                header('location: ../user/UserController.php');
            }
            break;
        case 'dangxuat':{
            session_destroy();
            header("Location: AdminController.php");
            break;
        }
        case 'AddAccount':{
            // if (isset($_POST['add'])) {
        // Phần xử lý chuyên đề
        }

        case 'ViewChuyenDe':{
            include_once 'views/chuyen_de/Ngan_Hang_Chuyen_De.php'; // Điều hướng đến trang tổng hợp chuyên đề (Read)
            // Xử lý bảng ở dưới đây
            
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
                include_once 'views/tai_khoan/Add_Tai_Khoan.php';
                break;
        }
        case 'ListAccount':{
            $error = $_GET['mes'] ?? '';
            $arrAccount = select_All('nguoidung');
            include_once 'views/tai_khoan/List_Tai_Khoan.php';
            break;
        }
        case 'UpdateAccount':{
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
                        move_uploaded_file($anhDaiDien['tmp_name'], $adminImage . $img);
                        $select = $vaiTro ?? $arrAccount['vaiTro'];
                        $error = "Update thành công";
                        update_Accouut($id, $tenDangNhap, $matKhau, $img, $email, $diaChi, $select);
                   
                        header("Location:" . $adminAction . "ListAccount");
                    }
                } else {
                    $select = $vaiTro ?? $arrAccount['vaiTro'];
                    $error = "Update thành công";
                    update_Accouut($id, $tenDangNhap, $matKhau, $img, $email, $diaChi, $select);
                    header("Location:" . $adminAction . "ListAccount");
                }
            }
            include_once 'views/tai_khoan/Update_Tai_Khoan.php';
            break;
        }
        case 'DeleteAccount':{
            $id = $_GET['id'];
            $mes = "Xóa thành công";
            delete_Account($id);
            header('location: AdminController.php?act=ListAccount&mes=' . $mes);
            break;
    /**
        * ====================================================================================
        *                                 CHUYÊN ĐỀ                   
        * ====================================================================================
        */}
        case 'NganHangChuyenDe':{
            $allChuyenDe = loadAll_ChuyenDe();

            include_once 'views/chuyen_de/Ngan_Hang_Chuyen_De.php';
            break;
        }
        case 'AddChuyenDe':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                extract($_POST);
                $arrCheckChuyenDe = check_ChuyenDe($tenchuyende);
                if ($tenchuyende == NULL) {
                    echo "<script>alert('Chuyên Đề không được để trống')</script>";
                } else if (is_array($arrCheckChuyenDe)) {
                    echo "<script>alert('Chuyên đề bị trùng')</script>";
                } else {
                    add_ChuyenDe($tenchuyende);
                    header('location: AdminController.php?act=NganHangChuyenDe');
                }
            }
            include_once 'views/chuyen_de/Add_Chuyen_De.php';
            break;
        case 'UpdateChuyenDe':
            $id = $_GET['id'];
            $arrOneChuyenDe = loadOne_ChuyenDe($id);
            extract($arrOneChuyenDe);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                extract($_POST);
                $arrCheckChuyenDe = check_ChuyenDe($tenchuyende);
                ($tenchuyende == NULL) ? $tenChuyenDe : $tenchuyende;
                if (is_array($arrCheckChuyenDe)) {
                    echo "<script>alert('Chuyên đề bị trùng')</script>";
                } else {
                    echo "<script>alert('cập nhật Chuyên đề thành công')</script>";
                    update_ChuyenDe($id, $tenchuyende);
                    header('location: AdminController.php?act=NganHangChuyenDe');
                };
            }
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
            if (isset($_POST['AddCauHoi']) && ($_POST['AddCauHoi'])) {
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
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $kq = loadOne_CauHoi($id);
            }
            $dscd = loadAll_ChuyenDe();
            include_once 'views/cau_hoi/Update_Cau_Hoi.php';
            break;
        case 'UpdateCauHoi':
            if (isset($_POST['UpdateCauHoi']) && ($_POST['UpdateCauHoi'])) {
                $id = $_POST['id'];
                $noiDung = $_POST['noiDung'];
                $chuyenDeId = $_POST['chuyenDeId'];
                $hinhAnh = '';
                if ($_FILES['hinhAnh']['name'] != "") {
                    $file = $_FILES['hinhAnh'];
                    $hinhAnh = $file['name'];
                    move_uploaded_file($file['tmp_name'], '../assets/upload/' . $hinhAnh);
                }
                update_CauHoi($id, $noiDung, $hinhAnh, $chuyenDeId);
            }
            $dsch = loadAll_CauHoi();
            // $cauHoi = loadOne_CauHoiChuaDapAn();
            include_once 'views/cau_hoi/Ngan_Hang_Cau_Hoi.php';
            break;
        case 'DeleteCauHoi':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                delete_CauHoi($id);
            }
            $dsch = loadAll_CauHoi();
            // $cauHoi = loadOne_CauHoiChuaDapAn();
            include_once 'views/cau_hoi/Ngan_Hang_Cau_Hoi.php';
            break;
        case 'QuanLyCauHoi':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $cauHoiId = $_GET['id'];
                $qlch = loadAll_QuanLyCauHoi($cauHoiId);
            }
            include_once 'views/cau_hoi/Quan_Ly_Cau_Hoi.php';
            break;
        case 'laDapAnDung':
            if (isset($_POST['chonDapAnDung']) && ($_POST['chonDapAnDung'])) {
                update_DapAnSai();
                $arrDapAnDung = $_POST['dapAnDung'];
                // var_dump($arrDapAnDung);
                // die;
                foreach ($arrDapAnDung as $id_Correct) {
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
            if (isset($_POST['AddDapAn']) && $_POST['AddDapAn']) {
                if (isset($_POST['noiDung']) && isset($_POST['cauHoiId']) && isset($_POST['laDapAnDung'])) {
                    $noiDung = $_POST['noiDung'];
                    $cauHoiId = $_POST['cauHoiId'];
                    $laDapAnDung = $_POST['laDapAnDung'];
                    $hinhAnh = '';
                    if (empty($noiDung) || empty($cauHoiId)) {
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
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $kq = loadOne_DapAn($id);
            }
            $dsch = loadAll_CauHoi();
            // $cauHoi = loadOne_CauHoiChuaDapAn();
            include_once 'views/dap_an/Update_Dap_An.php';
            break;
        case 'UpdateDapAn':
            if (isset($_POST['UpdateDapAn']) && ($_POST['UpdateDapAn'])) {
                $id = $_POST['id'];
                $cauHoiId = $_POST['cauHoiId'];
                $noiDung = $_POST['noiDung'];
                $laDapAnDung = $_POST['laDapAnDung'];
                $hinhAnh = '';
                $thongBao = "<div style='color:green'>Thêm thành công</div>";
                if ($_FILES['hinhAnh']['name'] != "") {
                    $file = $_FILES['hinhAnh'];
                    $hinhAnh = $file['name'];
                    move_uploaded_file($file['tmp_name'], '../assets/upload/' . $hinhAnh);
                }
                update_DapAn($id, $cauHoiId, $noiDung, $hinhAnh, $laDapAnDung);
            }
            $dsda = loadAll_DapAn();

            include_once 'views/dap_an/Ngan_Hang_Dap_An.php';
            break;
        case 'DeletaDapAn':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
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
        case 'ListDiem':{
            include_once 'views/diem/List_Diem.php';
            break;
        }
        case 'KhaoThi':{
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

    /**
        * ====================================================================================
        *                                  LỊCH THI
        * ====================================================================================
        */}
        case 'ListLichThi':
            $danhSachLichThi = loadAll_Lichthi();
            $chuyenDe = loadAll_ChuyenDe();
            include_once 'views/lich_thi/List_lich_thi.php';
            break;
        case 'AddLichThi':
            $danhSachLichThi = loadAll_Lichthi();
            $chuyenDe = loadAll_ChuyenDe();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                extract($_POST);
              
                // $arrCheckTenLichThi = check_LichThi($tenLichThi);
                // if(is_array($arrCheckTenLichThi)){
                //     echo "<script>alert('Tên lịch thi bị trùng ')</script>";
                // }else{
                //     echo "<script>alert('Thêm Lịch Thi Thành Công ')</script>";
                    add_LichThi($thoiGianBatDau,$thoiGianThi,$soLuongDeThi,$chuyenDeId,$tenLichThi);
                //     header('location: AdminController.php?act=NganHangChuyenDe');
                // }
            }
            include_once 'views/lich_thi/Add_Lich_Thi.php';
            break;
        case 'DeleteLichThi':
            $id = $_GET['id'];
            delete_LichThi($id);
            header('location: AdminController.php?act=ListLichThi');
            break;    


        case 'UpdateLichThi': //update những lịch thi chưa xảy ra
            include_once 'views/lich_thi/Update_Lich_Thi.php';
            break;

    /**
        * ====================================================================================
        *                                   ĐỀ THI
        * ====================================================================================
        */
        case 'ListDeThi':
            $dsDeThi=loadAll_DeThi();
            include_once 'views/de_thi/List_De_Thi.php';
            break;
        case 'ChiTietDeThi':
            if(isset($_GET['id']) && ($_GET['id'] > 0)){
                $id = $_GET['id'];
                $dsct_DeThi = load_ChiTietDeThi($id);
                echo "<pre>";
                print_r($dsct_DeThi);
                echo "</pre>";

            }
            include "views/de_thi/Chi_Tiet_De_Thi.php";
            break;
        case "DeleteDeThi":{
            if(isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                delete_DeThi($id);
            }
            $dsDeThi=loadAll_DeThi();
            include_once 'views/de_thi/List_De_Thi.php';
            break;
        }
        case 'AddDeThi':{
            include_once 'views/de_thi/Add_De_Thi.php';
            break;
        }
        default:
            $allChuyenDe = loadAll_ChuyenDe();
            include_once 'views/chuyen_de/Ngan_Hang_Chuyen_De.php';
            break;
    }
} else {
    if (empty($_SESSION['user'])) {
        header('location:../assets/global/Login.php');
    } else {
        $allChuyenDe = loadAll_ChuyenDe();
        include_once 'views/chuyen_de/Ngan_Hang_Chuyen_De.php';
    }
}


