<?php
/**
 * Mở kết nối đến CSDL sử dụng PDO
 */
function pdo_get_connection(){
    $dburl = "mysql:host=localhost;dbname=duan1 ;charset=utf8";
    $username = 'root';
    $password = '';
    try{
        $conn = new PDO($dburl, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }catch(Exception $ex){
        echo "ERROR: ".$ex->getMessage();
        die();
    }
}