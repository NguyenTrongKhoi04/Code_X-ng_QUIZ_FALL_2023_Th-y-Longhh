<?php
/**
 *  Những biến,func Global được sử dụng bên phía User
 */

 /**
 * ========================================================================================================================
 *  FUNCTION XỬ LÝ SQL
 * ========================================================================================================================
 */


/**
 * return: 1 bảng
 * $tenBang, $tenCot: Tên bảng, cột được chọn, Kiểu String
 * $limit: giới hạn xuất ra; 
 * $params: Các tham số phụ; 
 * Ví dụ:  $b = Select_All('bang1','*',null,'_id_ten_loai_','_1_3_');
 *      =>> "SELECT * FROM bang1 ORDER BY id DESC , ten , loai DESC "
 */

function insertChuyenDe($tenChuyenDe, $boCauHoi, $boDapAn) {
    $sql = "INSERT INTO `chuyende`(`tenChuyenDe`, `boCauHoi`, `boDapAn`) VALUES (?, ?, ?)";
    pdo_Execute($sql, $tenChuyenDe, $boCauHoi, $boDapAn);
    //Sử dụng dấu hỏi vì đã đặt theo thứ tự có sẵn.
    //Tăng cường bảo mật hơn
}

function updateChuyenDe($id, $tenChuyenDe, $boCauHoi, $boDapAn) {
    $sql = "UPDATE chuyende SET id = ?, tenChuyenDe = ?, boCauHoi = ?, boDapAn = ? WHERE id = ?";
    pdo_Execute($sql, $id, $tenChuyenDe, $boCauHoi, $boDapAn);
}

function deleteChuyenDe($id) {
    $sql = "DELETE FROM `chuyende` WHERE `chuyende`.`id` = ?  ";
    pdo_Execute($sql, $id);
}

function getAllChuyenDe() {
    $sql = "SELECT * FROM ChuyenDe";
    return query_All($sql);
}

function getOneChuyenDe() {
    $sql = "SELECT * FROM ChuyenDe WHERE ID = ?";
    return query_One($sql);
}

//Ghi chú cho bảng này để làm gì. Bên trên chưa đủ để giải thích.
//Debug thì tự ông để riêng, để chung nên để tối giản lại.
//Còn nếu ông dùng chung thì ít nhất nên để demo, vì mỗi người hiểu một kiểu khác nhau.
function select_All($tenBang,$tenCot=null,$limit=null,$params=null,$desc=null){
 function select_All($tenBang,$tenCot=null,$limit=null,$params=null,$desc=null){
    if($tenCot==null){
        $tenCot =' * ';
    }
    $sql ='SELECT '.$tenCot.' FROM '.$tenBang;

    //Kiểm tra tham sô truyền vào. Nếu (?)
    $arrCheck =[$tenBang,$tenCot];
    foreach($arrCheck as $var=>$value){
        if (!is_string($value)){
            $errorArrCheck = '';
        }
    }

    if(empty($errorArrCheck)){
        if($params != null){
        $sql .= ' ORDER BY ';
        // xử lý $params thành mảng tuần tự
        $arrParams = array_values(array_filter(explode('_',$params)));

        // Xử lý mảng chứa dấu phẩy tương ứng với số lượng $params 
        $countParams = count($arrParams);        
        $arrComma = [];
        for($i=0;$i<$countParams-1;$i++){
            $n =',';
            array_push($arrComma,$n);
        }
        
        //Xử lý DESC
        $arrFakeDesc = array_values(array_filter(explode('_',$desc)));
        $arrDesc = [];
            // gán rỗng chõ mảng
        for($i=0;$i<max($arrFakeDesc);$i++){
            $arrDesc[$i] =  '';
        }
            // Gán DESC vào mảng theo vị trí
        foreach ($arrDesc as $index => $values) {
            foreach ($arrFakeDesc as $i) {
              if($index == $i ){
                    $arrDesc[$index-1] = 'DESC';
              }  
            }
            if(max($arrFakeDesc)){
                $arrDesc[max($arrFakeDesc)-1]='DESC';
            }
        }
         
        // Nối Mảng thành chuỗi
        for($i=0;$i<count($arrParams);$i++){
            // Xử lý dấu chấm ở cuối
            if(empty($arrComma[$i])){
                $arrComma[$i]=' ';
                echo 'khoi';
            }
            $arrList[$i]= $arrParams[$i].' '.$arrDesc[$i].' '.$arrComma[$i].' ';
        }
        }
        if(($limit != null)&&(is_numeric($limit))){
        $sql .=" LIMIT ".$limit." ";
    }
    }
    if(isset($arrList)){
        $sql .= join('',$arrList);
    }
    // var_dump($sql);
    return query_All($sql);
};


function select_One($tenBang,$tenCot=null,$where,$limit=null){
    if(empty($tenCot)){
        $tenCot = ' * ';
    }
    $sql = 'SELECT '.$tenCot.' FROM '.$tenBang;
    if(isset($where)){
        $sql.= ' WHERE '.$where;
    }
    
    if(isset($limit)){
        $sql.=' LIMIT '.$limit;
    }

    $account=query_One($sql);
    // var_dump($sql);
    // var_dump($account);
    return $account;
}

function check_Login(){
    $tk = $_POST['tk'] ?? null;
    $mk = $_POST['mk'] ?? null;
    if(isset($tk)&&isset($mk)){
        $tk = $_POST['tk'];
        $mk = ($_POST['mk']);//md5
        $arrCheck = select_One('nguoidung',null," email = '$tk' AND matKhau = '$mk'");
        if(is_array($arrCheck)){
            $_SESSION['user']=$arrCheck;
            unset($tk,$mk);
        }else{
            header('location:../assets/global/Login.php');
        }
    }
}

}