<?php
    function loadAll_Lichthi() {
        $sql = "SELECT * FROM lichthi";
        $result = query_All($sql);
        return $result;
    }
    
    function add_LichThi($thoiGianBatDau,$thoiGianThi,$soLuongDeThi,$chuyenDeId,$tenLichThi) {
        $sql = "INSERT INTO lichthi(thoiGianBatDau,thoiGianThi,soLuongDeThi,chuyenDeId,tenLichThi)
                VALUES ('$thoiGianBatDau','$thoiGianThi','$soLuongDeThi','$chuyenDeId','$tenLichThi')";
        // var_dump($sql);
        // die;
        $last_Id_LichThi = pdo_Execute_Return_LastinsertID($sql);

        for($dem=0;$dem < $soLuongDeThi ;$dem++){
            $sql = "INSERT INTO dethi(id_LichThi) VALUES ('$last_Id_LichThi')";
            $last_Id_DeThi = pdo_Execute_Return_LastinsertID($sql);
            
        $sql = "SELECT * FROM cauhoi where chuyenDeId = '$chuyenDeId' ORDER BY RAND() LIMIT 10  ";
        $soLuongCauHoi = query_All($sql);
        foreach($soLuongCauHoi as $i){
            extract($i);
            $sql = "INSERT INTO chitietdethi(idDeThi,idCauHoi) VALUES ('$last_Id_DeThi','$id')";
            pdo_Execute($sql);
        }
        }

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
