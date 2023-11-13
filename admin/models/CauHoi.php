<?php
    // lấy các trường dữ liệu id, noiDung, hinhAnh của bảng cauhoi
    // và JOIN vào bảng chuyende
    // để lấy ra tên chuyên đề của bảng chuyende
    function loadAll_CauHoi() {
        $sql = "SELECT ch.id, ch.noiDung, ch.hinhAnh, cd.tenChuyenDe 
                FROM cauhoi ch 
                JOIN chuyende cd ON ch.chuyenDeId = cd.id 
                ORDER BY ch.id DESC";
        $result = query_All($sql);
        
        return $result;
    }

    // Lấy ra 1 trường dữ liệu của bảng câu hỏi theo id câu hỏi
    function loadOne_CauHoi($id) {
        $sql = "SELECT * FROM cauhoi where id = '$id'";
        $result = query_One($sql);
        return $result;
    }

    // Thêm dữ liệu vào bảng câu hỏi
    function add_CauHoi($noiDung, $hinhAnh, $chuyenDeId) {
        // Trước tiên, kiểm tra xem câu hỏi có cùng nội dung đã tồn tại hay chưa
        $checkSql = "SELECT id FROM cauhoi WHERE noiDung = '$noiDung'";
        $existingQuestion = query_One($checkSql);
    
        if ($existingQuestion) {
            // Nếu câu hỏi đã tồn tại, tạo thông báo lỗi và không thêm câu hỏi mới
            $thongBao = "<div style='color:red'>Câu hỏi đã tồn tại.</div>";
        } else {
            // Nếu câu hỏi chưa tồn tại, thêm câu hỏi mới vào cơ sở dữ liệu
            $sql = "INSERT INTO cauhoi(noiDung, hinhAnh, chuyenDeId) 
                    VALUES('$noiDung', '$hinhAnh', '$chuyenDeId')";
            $result = pdo_Execute($sql);
            $thongBao = "<div style='color:green'>Thêm thành công</div>";
            // return $result;
        }
        // var_dump( $thongBao);
        // die;
        
        return $thongBao;
    }

    // Sửa và cập nhập các trường dữ liệu của bảng câu hỏi 
    function update_CauHoi($id,$noiDung, $hinhAnh, $chuyenDeId) {
        if($hinhAnh != "") {
            $sql = "UPDATE cauhoi 
                    SET noiDung = '$noiDung', hinhAnh = '$hinhAnh', chuyenDeId = '$chuyenDeId' 
                    WHERE id = $id";
        } else {
            $sql = "UPDATE cauhoi 
                    SET noiDung = '$noiDung', chuyenDeId = '$chuyenDeId' 
                    WHERE id = $id";
        }
        $result = pdo_Execute($sql);
        return $result;
    }

    // Xóa các trường dữ liệu của bảng câu hỏi theo id câu hỏi
    function delete_CauHoi($id) {
        $sql = "DELETE FROM cauhoi WHERE id=$id";
        $result = pdo_Execute($sql);
        return $result;
    }

?>