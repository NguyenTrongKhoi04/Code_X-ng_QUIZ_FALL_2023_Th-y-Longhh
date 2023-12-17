<?php
// GROUP_CONCAT để kết hợp nhiều dòng dữ liệu thành một chuỗi
// GROUP BY để nhóm các dòng dữ liệu theo chitietdethi.id
function loadAll_ChiTietDeThi($id)
{
    $sql = "SELECT chitietdethi.id, dethi.id AS idDeThi, cauhoi.id AS idCauHoi, cauhoi.noiDung AS tenCauHoi, 
                GROUP_CONCAT(dapan.noiDung) AS tenDapAn, GROUP_CONCAT(dapan.laDapAnDung) AS laDapAnDung,
                chuyende.id AS idChuyenDe, chuyende.tenChuyenDe
            FROM chitietdethi
            JOIN dethi ON chitietdethi.idDeThi = dethi.id
            JOIN cauhoi ON chitietdethi.idCauHoi = cauhoi.id
            LEFT JOIN dapan ON cauhoi.id = dapan.cauHoiId
            LEFT JOIN chuyende ON cauhoi.chuyenDeId = chuyende.id
            WHERE chitietdethi.idDeThi = $id
            GROUP BY chitietdethi.id, cauhoi.id";

    $result = query_All($sql);
    return $result;
}

function loadOne_ChiTietDeThi($id)
{
    $sql = "SELECT chitietdethi.id, dethi.id AS idDeThi, cauhoi.id AS idCauHoi, cauhoi.noiDung AS tenCauHoi, 
                GROUP_CONCAT(dapan.noiDung) AS tenDapAn, GROUP_CONCAT(dapan.laDapAnDung) AS laDapAnDung,
                chuyende.id AS idChuyenDe, chuyende.tenChuyenDe
            FROM chitietdethi
            JOIN dethi ON chitietdethi.idDeThi = dethi.id
            JOIN cauhoi ON chitietdethi.idCauHoi = cauhoi.id
            LEFT JOIN dapan ON cauhoi.id = dapan.cauHoiId
            LEFT JOIN chuyende ON cauhoi.chuyenDeId = chuyende.id
            WHERE chitietdethi.idDeThi = $id
            GROUP BY chitietdethi.id, cauhoi.id";

    $result = query_One($sql);
    return $result;
}


function loadAll_CauHoiChiTietDeThi($idChuyenDe) {
    $sql = "SELECT cauhoi.id AS idCauHoi, cauhoi.noiDung, chuyende.tenChuyenDe ,chuyende.id
            FROM cauhoi
            JOIN chuyende ON cauhoi.chuyenDeId = chuyende.id
            WHERE chuyende.id = $idChuyenDe";
    $result =  query_All($sql);
    return $result;
}


function add_CauHoiChiTietDeThi($idDeThi, $idCauHoi) {
    $sql = "INSERT INTO chitietdethi (idDeThi, idCauHoi) 
            VALUES ('$idDeThi','$idCauHoi')";
    $result = pdo_Execute($sql);
    return $result;

}

function isQuestionInDetail($questionId, $testDetail) {
    foreach ($testDetail as $detail) {
        if ($detail['idCauHoi'] == $questionId) {
            return true;
        }
    }
    return false;
}

function delete_CauHoi_ChiTietDeThi($idDeThi, $id) {
    $sql = "DELETE FROM chitietdethi
            WHERE idCauHoi = $id 
            AND idDeThi = $idDeThi";
    $result = pdo_Execute($sql);
    return $result;
}

function dem_SoLuongCauHoi_ChiTietDeThi($id) {
    $sql = "SELECT COUNT(*) as soLuong FROM chitietdethi WHERE idDeThi = $id";
    $result = query_One($sql);
    return $result['soLuong'];
}
