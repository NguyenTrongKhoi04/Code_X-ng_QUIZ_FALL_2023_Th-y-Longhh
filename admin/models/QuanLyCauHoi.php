<?php
     function loadAll_QuanLyCauHoi($id) {
        $sql = "SELECT ch.id, ch.noiDung, ch.hinhAnh, da.id as 'dapAnId' , da.noiDung as 'noiDungDapAn' , da.laDapAnDung
                FROM cauhoi ch 
                JOIN dapan da ON ch.id = da.cauHoiId
                WHERE ch.id = $id
                ORDER BY ch.id DESC";
        $result = query_All($sql);
        
        return $result;
    }

    function loadOne_QuanLyCauHoi($cauHoiId) {
        $sql = "SELECT ch.id, ch.noiDung, ch.hinhAnh, da.noiDung as 'noiDungDapAn'
                FROM cauhoi ch 
                JOIN dapan da ON ch.id = da.cauHoiId
                WHERE ch.id = $cauHoiId
                ORDER BY ch.id DESC";
        $result = query_All($sql);
        
        return $result;
    }

    function select_DapAnDung($id_Correct) {
       
        $sql = "UPDATE dapan SET laDapAnDung = 1 WHERE id = '".$id_Correct."'";
        // var_dump(pdo_Execute($sql));
        // pdo_Execute($sql);
        return pdo_Execute($sql);
    }
    
    function update_DapAnSai() {
        $sql = "UPDATE dapan SET laDapAnDung = 0 WHERE 1";
        // var_dump(pdo_Execute($sql));
        // pdo_Execute($sql);
        return pdo_Execute($sql);
    }
    function addDapAn_QuanLyCauHoi($cauHoiId, $noiDung) {
        $sql = "INSERT INTO dapan (cauHoiId, noiDung, laDapAnDung) 
                VALUES ('$cauHoiId', '$noiDung', 0) ";
                // var_dump($sql); die;
        $result = pdo_Execute($sql);
        return $result;
    }
?>