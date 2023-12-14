<?php
    function loadAll_DanhSachLichThi() {
        $sql = "SELECT lt.id, lt.tenLichThi, cd.tenChuyenDe, dt.id as idDeThi
                FROM lichthi lt
                JOIN chuyende cd on lt.chuyenDeId = cd.id
                JOIN dethi dt on lt.id = dt.id_LichThi
                ORDER BY lt.id desc
                ";
        query_All($sql);
        return query_All($sql);
    }

