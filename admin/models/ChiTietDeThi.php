<?php
    function load_ChiTietDeThi($id) {
        $sql = "SELECT chitietdethi.id, dethi.id AS idDeThi, cauhoi.noiDung AS tenCauHoi, dapan.noiDung AS tenDapAn, dapan.laDapAnDung
                FROM chitietdethi
                JOIN dethi ON chitietdethi.idDeThi = dethi.id
                JOIN cauhoi ON chitietdethi.idCauHoi = cauhoi.id
                LEFT JOIN dapan ON cauhoi.id = dapan.cauHoiId
                WHERE chitietdethi.idDeThi = $id";
        
        $result = query_All($sql);
        return $result;
    }
?>