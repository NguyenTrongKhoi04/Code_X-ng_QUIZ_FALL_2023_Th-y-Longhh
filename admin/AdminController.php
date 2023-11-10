<?php
session_start();
ob_start();
include_once '../app/Pdo.php';
include_once '../assets/global/Admin.php';


    if(isset($_GET['act'])&&($_GET['act'] !='' )){
        
        $act = $_GET['act'];
        switch($act){
            case 'dangnhap':
                check_Login();
                if($_SESSION['user']['vaiTro']==0){
                    header('location: ../user/');
                }else
                include_once 'views/diem/List_Diem.php';
            break;
            case 'logout':
                check_Login();
                session_destroy();
                header("Location: AdminController.php");
             break;
            default:
                include_once 'views/chuyen_de/Ngan_Hang_Chuyen_De.php';
                break;
            }
        }else{
            if(empty($_SESSION['user'])){
                header('Location: ../assets/global/Login.php');
            }else{
                include_once 'views/chuyen_de/Update_Chuyen_De.php';
            }            
        }    
