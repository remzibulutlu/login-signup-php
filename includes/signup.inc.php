<?php


require_once 'dbh.inc.php';
if (isset($_POST['signup-submit'])) {
    

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password= $_POST['password'];
    $password2= $_POST['password2'];


    if ((empty($username) || empty($email) || empty($password) || empty($password2))) {
        header("Location: ../signup.php?error=emptyfields");
        exit();
    }
    
    
    elseif (!filter_var($username, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]*$/', $username)) {
        header("Location: ../signup.php?error=invaliduid");
        exit();
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]*$/', $email)) {
        header("Location: ../signup.php?error=invalidemail");
        exit();
    } 


    elseif ($password !== $password2) {
        header("Location: ../signup.php?error=passwordsnotmatch");
        exit();
    }
    else {
        $sql = "SELECT usersUid FROM users WHERE usersUid=? OR usersEmail=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?error=checksqlerrors");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $email);
            mysqli_stmt_execute($stmt);
            
            
            mysqli_stmt_store_result($stmt);
            $result_check = mysqli_stmt_num_rows($stmt);

            if ($result_check > 0) {
                header("Location: ../signup.php?error=takenUsernameORtakenEmail");
                exit();
            }
            else {
                $sql = "INSERT INTO users (usersUid, usersEmail, usersPwd) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?error=checksqlerrors2");
                    exit();
                }
                else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../signup.php");
    exit();
}
