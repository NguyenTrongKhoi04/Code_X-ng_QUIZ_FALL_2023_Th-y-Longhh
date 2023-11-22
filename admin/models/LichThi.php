<?php
    function loadAll_Lichthi() {
        $sql = "SELECT * FROM lichthi";
        $result = query_All($sql);
        return $result;
    }
    
    function add_LichThi($thoiGianBatDau,$thoiGianThi,$soLuongDeThi,$chuyenDeId,$tenLichThi) {
        $sql = "INSERT INTO lichthi 
                VALUES ('','$thoiGianBatDau','$thoiGianThi','$soLuongDeThi','$chuyenDeId','$tenLichThi')";
            var_dump($sql);
        return pdo_Execute($sql);
    }

    function loadOne_LichThi($id) {
        $sql = "SELECT * FROM lichthi Where id= $id";
        $result = query_One($sql);
        return $result;
    }

    function update_LichThi($id,$thoiGianBatDau,$thoiGianKetThuc,$thoiGianThi,$soLuongDeThi) {
        $sql = "UPDATE lichthi 
                SET thoiGianBatDau = '$thoiGianBatDau',thoiGianKetThuc = '$thoiGianKetThuc',thoiGianThi = '$thoiGianThi',soLuongDeThi = '$soLuongDeThi'  
                WHERE id = $id";
        $result = pdo_Execute($sql);
        return $result;
    }

    function delete_LichThi($id) {
        $sql = "DELETE FROM lichthi WHERE id = '$id'";
        $result = pdo_Execute($sql);
        return $result;
    }

    function check_LichThi($tenLichThi){
        $sql = "SELECT * FROM lichthi Where tenLichThi= '$tenLichThi'";
        $result = query_One($sql);
        return $result;
    }
