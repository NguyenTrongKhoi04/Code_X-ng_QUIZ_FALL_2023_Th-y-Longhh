<?php
    function add_NguoiDung($tenDangNhap,$matKhau,$anhDaiDien,$email,$diaChi) {
        if ($anhDaiDien != "") {
            $sql = "INSERT INTO nguoidung (tenDangNhap, matKhau,anhDaiDien,email,diaChi) 
                VALUES ('$tenDangNhap', '$matKhau','$anhDaiDien','$email','$diaChi')";
        } else {
            $sql = "INSERT INTO nguoidung (tenDangNhap, matKhau,email,diaChi) 
            VALUES ('$tenDangNhap', '$matKhau','$email','$diaChi')";
        }
        $result = pdo_Execute($sql);
        return $result;
    }
