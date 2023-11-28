<?php
    function loadAll_DeThi() {
        $sql = "SELECT lt.tenLichThi,dt.id,cd.tenChuyenDe
                FROM dethi dt 
                INNER JOIN lichthi lt on dt.id_LichThi = lt.id
                INNER JOIN chuyende cd on cd.id = lt.chuyenDeId"
                ;
        $result = query_All($sql);
        return $result;
    }

    function delete_DeThi($id) {
        $sql = "DELETE FROM dethi WHERE id = $id";
        $result = pdo_Execute($sql);
        return $result;
    }
?>