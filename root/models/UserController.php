<?php 
class UserController {

    public function registerUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            //Set validate ở đây

            // Tạo ra một model mới
            $UserModel = new UserModel();

            // Sử dụng hash để mã hóa mật kh
            $hasedPassword = password_hash($password, PASSWORD_DEFAULT);

            //Gọi phương thức model để gửi data từ form về database
            $UserModel->createuser($username, $hasedPassword);


            // Phần còn lại của code ở đây
        } 
    }
}

class UserModel {
    
    public function createUser($username, $hashedPassword) {
        $success = true;
    
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)"; #Chỉ mang tính chất thử
    
        // Kiểm tra xem có lỗi trong trường hợp này không
        if (!pdo_execute($sql, $username, $hashedPassword)) {
            $success = false;
            // Kiểm lỗi debug cho phần SQL
            // error_log("Lỗi câu lệnh SQL khi khởi tạo");
        }
    
        // Nếu có lỗi, ném một cái exception
        if (!$success) {
            throw new Exception("Error creating user");
        }
    }
    

    public function deleteUser($userId) {
        $sql = "DELETE ....";//Để tạm thời
    }


}
    

?>