<?php
// GROUP_CONCAT để kết hợp nhiều dòng dữ liệu thành một chuỗi
// GROUP BY để nhóm các dòng dữ liệu theo chitietdethi.id
function load_ChiTietDeThi($id)
{
    $sql = "SELECT chitietdethi.id, dethi.id AS idDeThi, cauhoi.id AS idCauHoi, cauhoi.noiDung AS tenCauHoi, 
                GROUP_CONCAT(dapan.noiDung) AS tenDapAn, GROUP_CONCAT(dapan.laDapAnDung) AS laDapAnDung
            FROM chitietdethi
            JOIN dethi ON chitietdethi.idDeThi = dethi.id
            JOIN cauhoi ON chitietdethi.idCauHoi = cauhoi.id
            LEFT JOIN dapan ON cauhoi.id = dapan.cauHoiId
            WHERE chitietdethi.idDeThi = $id
            GROUP BY chitietdethi.id, cauhoi.id";

    $result = query_All($sql);
    return $result;
}
