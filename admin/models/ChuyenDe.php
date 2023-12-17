<?php
    function loadAll_ChuyenDe() {
        $sql = "SELECT * FROM chuyende order by id desc";
        $result = query_All($sql);
        return $result;
    }

    function add_ChuyenDe($tenchuyende){
        $sql = "INSERT INTO chuyende(tenchuyende) VALUES ('$tenchuyende')";
        // var_dump($sql);
        // die;
        return pdo_Execute($sql);
    }

    function loadOne_ChuyenDe($id){
        $sql = "SELECT * FROM chuyende WHERE id = '$id'";
        $result =  query_One($sql);
        return $result;
    }
    function check_ChuyenDe($tenchuyende){
        $sql = "SELECT * FROM chuyende WHERE tenChuyenDe = '$tenchuyende'";
        $result =  query_One($sql);
        return $result;
    }

    function update_ChuyenDe($id,$tenchuyende){
        $sql = "UPDATE chuyende SET tenChuyenDe = '$tenchuyende' WHERE id = '$id' ";
        return pdo_Execute($sql);
    }

    function delete_ChuyenDe($id) {
        $deleteDethi = "DELETE FROM dethi WHERE id_LichThi IN (SELECT id FROM lichthi WHERE chuyenDeId = $id)";
        pdo_Execute($deleteDethi);
        
        $deleteLichThi = "DELETE FROM lichthi WHERE chuyenDeId = $id";
        pdo_Execute($deleteLichThi);

        $sql = "DELETE FROM chuyende WHERE id = $id";
        $result =  pdo_Execute($sql);
        return $result;
    }