<?php
   function BaiThi($id)
   {
       $sql = " SELECT cauhoi.id AS idCauHoi, cauhoi.noiDung AS tenCauHoi, 
                    GROUP_CONCAT(dapan.noiDung) AS tenDapAn, GROUP_CONCAT(dapan.laDapAnDung) AS laDapAnDung
                FROM chitietdethi
                JOIN cauhoi ON chitietdethi.idCauHoi = cauhoi.id
                LEFT JOIN dapan ON cauhoi.id = dapan.cauHoiId
                WHERE chitietdethi.idDeThi = $id
                GROUP BY cauhoi.id
                ORDER BY cauhoi.id ASC";
                
       $result = query_All($sql);
       return $result;
   }

