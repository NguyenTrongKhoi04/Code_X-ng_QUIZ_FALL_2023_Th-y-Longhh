<?php 
function danhSachDiemThi(){
    $sql = "select * from ketqua 
    inner join nguoidung on ketqua.nguoiDungId = nguoidung.id";
        $result = pdo_query($sql);
        return $result;
}

function getone_khaoThi($idDiem){
    $sql = "select * from ketqua 
    where id = $idDiem ";

    $result = query_One($sql);
    return $result;

}
function updateDiem($idDiem, $diem){
    $sql = "update ketqua set diem = $diem where id = $idDiem";
    pdo_Execute($sql);

}


?>