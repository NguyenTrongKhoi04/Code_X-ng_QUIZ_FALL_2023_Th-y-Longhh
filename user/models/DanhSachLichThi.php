<?php

    /* 
    Thêm hàm count (đếm số idCauHoi có trong ctdt)
    SELECT
        count(ctdt.idCauHoi) as locDeThi
    Join chitietdethi ctdt on dt.id = ctdt.idDeThi
        GROUP BY 
             lt.id, lt.tenLichThi, cd.tenChuyenDe, dt.id          
        HAVING 
             locDeThi >= 10    
    */        
    function loadAll_DanhSachLichThi() {
        $sql = "SELECT lt.id, lt.tenLichThi, cd.tenChuyenDe, dt.id as idDeThi ,
                        count(ctdt.idCauHoi) as locDeThi
                FROM lichthi lt
                    JOIN chuyende cd on lt.chuyenDeId = cd.id
                    JOIN dethi dt on lt.id = dt.id_LichThi
                    JOIN chitietdethi ctdt ON dt.id = ctdt.idDeThi 
                GROUP BY 
                    lt.id, lt.tenLichThi, cd.tenChuyenDe, dt.id          
                HAVING 
                     locDeThi >= 10
                ORDER BY lt.id desc";

        query_All($sql);
        return query_All($sql);
    }

