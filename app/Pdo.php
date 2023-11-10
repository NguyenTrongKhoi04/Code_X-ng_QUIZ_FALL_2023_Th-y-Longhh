<?php
require_once "Connection.php";

/**
 * Thực thi câu lệnh sql thao tác dữ liệu (INSERT, UPDATE, DELETE)
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_Execute($sql){
    /**
     * array slice: Cắt thành 1 mảng mới
     * func_get_args(): gộp các tham số được truyền thành mảng 
     */
    $sql_Args = array_slice(func_get_args(), 1);
    var_dump($sql_Args);
    try{
        $conn = pdo_Get_Connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_Args);
    }
    catch(PDOException $e){
        throw $e;
        die();
    }
    // giải phóng dữ liêu
    finally{
        unset($conn);
    }
}
/*
 * Lấy ID của obj mới được INSERT
 */
function pdo_Execute_Return_LastinsertID($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try{
        $conn = pdo_Get_Connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        return $conn->lastInsertId();
    }
    catch(PDOException $e){
        throw $e;
    }
    finally{
        unset($conn);
    }
}
/**
 * Thực thi câu lệnh sql truy vấn dữ liệu (SELECT)
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array mảng các bản ghi
 * @throws PDOException lỗi thực thi câu lệnh
 */
function query_All($sql){
    $sql_Args = array_slice(func_get_args(), 1);
    try{
        $conn = pdo_Get_Connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_Args);
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arr;
    }
    catch(PDOException $e){
        throw $e;
        die();
    }
    finally{
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh sql truy vấn một bản ghi
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array mảng chứa bản ghi
 * @throws PDOException lỗi thực thi câu lệnh
 */
function query_One($sql){
    $sql_Args = array_slice(func_get_args(), 1);

    try{
        $conn = pdo_Get_Connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_Args);
        $arr = $stmt->fetch(PDO::FETCH_ASSOC);
        return $arr;
    }
    catch(PDOException $e){
        throw $e;
        die();
    }
    finally{
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh sql truy vấn một giá trị
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return giá trị
 * @throws PDOException lỗi thực thi câu lệnh
 */
function pdo_Query_Value($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try{
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return array_values($row)[0];
    }
    catch(PDOException $e){
        throw $e;
    }
    finally{
        unset($conn);
    }
}