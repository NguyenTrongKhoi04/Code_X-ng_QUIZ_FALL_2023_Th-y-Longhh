<?php
    function loadAll_DeThi() {
        $sql = "SELECT dt.id, dt.lichThiId ,cd.tenChuyenDe FROM dethi dt JOIN chuyende cd on dt.chuyenDeId = cd.id";
        $result = query_All($sql);
        return $result;
    }

?>