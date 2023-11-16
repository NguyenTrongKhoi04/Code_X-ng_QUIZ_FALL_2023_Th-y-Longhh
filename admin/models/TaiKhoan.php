<?php
function insert_Account($tenDangNhap,$matKhau,$img,$email,$diaChi,$select){
    $sql="INSERT INTO nguoidung VALUES ('','$tenDangNhap','$matKhau','$img','$email','$diaChi','$select')";
    return pdo_Execute($sql);
}

function delete_Account($id){
    $sql ="DELETE FROM nguoidung WHERE id = '$id'";
    var_dump($sql);
    return pdo_Execute($sql);
}

function update_Accouut($id,$tenDangNhap,$matKhau,$img,$email,$diaChi,$select){
    $sql= "UPDATE nguoidung SET tenDangNhap='$tenDangNhap', matKhau='$matKhau', anhDaiDien = '$img', email ='$email', diaChi = '$diaChi', vaiTro ='$select' WHERE id = '$id'";
    return pdo_Execute($sql);
}
