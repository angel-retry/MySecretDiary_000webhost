<?php
ob_start();
session_start();

if ($_GET["logout"] == 1 AND $_SESSION['id']) {
    session_destroy();

    $message = "您已經登出，祝您有美好的一天。";
}

include("connection.php");

    if($_POST['submit'] == "Sign Up") {
        require "connection.php";
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        $null = "";
        
        if(!$email) {
            $error .= "<br/>請輸入您的郵箱。";
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "<br/>請輸入有效的郵箱地址。";
        }

        if(!$password) {
            $error .= "<br/>請輸入您的密碼。";
        } else {
            if(strlen($password) < 8) {
                $error .= "<br/>請至少輸入8位字元。";
            }
            if(!preg_match('`[A-Z]`', $password)) {
                $error .= "<br/>請輸入包含一個大寫字母";
            }
        }

        if($error) {
            $error =  "註冊時有些錯誤: ". $error;
        } else {
            
            $query = "SELECT email FROM users WHERE email=?";
            $statement = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($statement, $query)) {
                $error =  "SQL ERROR 1"; 
            } else {
                mysqli_stmt_bind_param($statement, "s", $email);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                $resultCeck = mysqli_stmt_num_rows($statement);
                if($resultCeck > 0) {
                    $error =  "此帳號已經存在，請問是否想登入呢?"; 

                }else {
                    $query = "INSERT INTO users  (email, password, diary) VALUES (?,?,?)"; 
                    $statement = mysqli_stmt_init($connection);
                    if(!mysqli_stmt_prepare($statement, $query)) {
                        $error =  "SQL ERROR 2";
                    } else {
                        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($statement, "sss",$email, $hashedPwd,$null);
                        mysqli_stmt_execute($statement);
                        mysqli_stmt_store_result($statement);
                        
                        header("Location: mainpage.php"); 
                        exit();

                    }
            }

        }
    }
    }
    if($_POST['submit'] == "Log In") {
        require "connection.php";
        
        $loginemail = $_POST["loginemail"];
        $loginpassword = $_POST["loginpassword"];
        
        if(!$loginemail) {
            $error .= "<br/>請輸入您的郵箱。";
        } else if(!filter_var($loginemail, FILTER_VALIDATE_EMAIL)) {
            $error .= "<br/>請輸入有效的郵箱地址。";
        }

        if(!$loginpassword) {
            $error .= "<br/>請輸入您的密碼。";
        }

        if($error) {
            $error =  "錯誤: ". $error;
        } else {
            $query = "SELECT * FROM users WHERE email=?";
            $statement = mysqli_stmt_init($connection);
            if(!mysqli_stmt_prepare($statement, $query)) {

                $error ="SQL錯誤 login";
                exit();
            } else {
                mysqli_stmt_bind_param($statement, "s", $loginemail);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
                if($row = mysqli_fetch_assoc($result)) {
                    $pwdCheck = password_verify($loginpassword, $row["password"]);
                    if($pwdCheck == true) {
                        $_SESSION['loginemail'] = $row['email'];
                        $_SESSION['id'] = $row['id'];
                        header("Location: mainpage.php");
                        exit();
                    } else {
                
                        $error =  "發生錯誤:請確認輸入信箱地址或密碼無錯誤。" ;
                    }
                }else {
                    $error =  "發生錯誤。" ;
                    exit();
            }
            }

        }
           


    }

ob_end_flush();
?>
