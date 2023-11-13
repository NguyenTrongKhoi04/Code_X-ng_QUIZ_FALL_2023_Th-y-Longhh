<?php
    function loadAll_ChuyenDe() {
        $sql = "SELECT * FROM chuyende order by id desc";
        $result = query_All($sql);
        return $result;
    }