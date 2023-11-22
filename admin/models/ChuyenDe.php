<?php
    function loadAll_ChuyenDe() {
        $sql = "SELECT * FROM chuyende order by id desc";
        $result = query_All($sql);
        return $result;
    }

    function add_ChuyenDe($tenchuyende){
        $sql = "INSERT INTO chuyende VALUES ('','$tenchuyende')";
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