<?php
    // lấy các trường dữ liệu id, noiDung, hinhAnh, laDapAnDung  của bảng đáp án
    // và JOIN vào bảng cauhoi
    // để lấy ra tên của nội dung của câu hỏi ra
    function loadAll_DapAn() {
        $sql = "SELECT da.id, da.noiDung, da.hinhAnh, da.laDapAnDung, ch.noiDung as 'cauHoi' 
                FROM dapan da 
                JOIN cauhoi ch 
                ON da.cauHoiId = ch.id 
                ORDER BY da.id DESC";
        $result = query_All($sql);
        
        return $result;
    }
    // thêm dữ liệu vào bảng dapan
    function add_DapAn($cauHoiId,$noiDung,$hinhAnh,$laDapAnDung) {
        $sql = "INSERT INTO dapan(cauHoiId, noiDung, hinhAnh, laDapAnDung) 
                VALUES('$cauHoiId','$noiDung','$hinhAnh','$laDapAnDung')";
        $result = pdo_Execute($sql);
        return $result;
    }
    // Kiểm tra nội đung đã tồn tại trong database hay chưa
    function check_DapAnExists($noiDung) {
        $sql = "SELECT id FROM dapan WHERE noiDung =  '$noiDung'";
        $result = query_One($sql);
        return $result;
    }
    // lấy 1 trường dữ liệu của bảng dapan theo id dapan
    function loadOne_DapAn($id) {
        $sql = "SELECT * FROM dapan WHERE id = $id";
        $result = query_One($sql);
        return $result;
    }
    // đùng để cập nhập và sửa dapan
    function update_DapAn($id,$cauHoiId,$noiDung,$hinhAnh,$laDapAnDung) {
        if($hinhAnh != "") {
            $sql = "UPDATE dapan 
                    SET cauHoiId = '$cauHoiId', noiDung = '$noiDung', hinhAnh = '$hinhAnh', laDapAnDung = '$laDapAnDung' 
                    WHERE id = $id";
        } else {
            $sql = "UPDATE dapan 
            SET cauHoiId = '$cauHoiId', noiDung = '$noiDung', laDapAnDung = '$laDapAnDung' 
            WHERE id = $id";
        }
        $result = pdo_Execute($sql);
        return $result;
    }
    // Dùng để xóa các trường dữ liệu của bảng dapan theo id dapan
    function delete_DapAn($id) {
        $sql = "DELETE FROM dapan WHERE id = '$id'";
        $result = pdo_Execute($sql);
        return $result;
    }
?>