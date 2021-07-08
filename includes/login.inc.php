<?php

if (isset($_POST['login-submit'])) { 
    $username = $_POST['username'];
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];
    require_once 'dbh.inc.php';

    if (empty($username_email) || empty($password)) {
        header("Location: ../index.php?error=emptyfields");
        
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE usersEmail=? OR usersUid=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $username_email, $username_email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                
                $password_check = password_verify($password, $row['usersPwd']);
                
                if (!$password_check) {
                    header("Location: ../index.php?error=wrongpassword");
                    
                    exit();
                }
                else if ($password_check) {
                    session_start();
                    $_SESSION['id'] = $row['usersId'];
                    $_SESSION['username'] = $row['usersUid'];
                    
                    header("Location: ../index.php?login=success");
                    
                    exit();
                }
            }
            else {
                header("Location: ../index.php?error=nouser");
                
                exit();
            }
        }
    }

} 
else {
    header("Location: ../index.php");
    exit();
}