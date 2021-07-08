
<?php

 require 'header.php';

?>

<main>
    <h1>Signup</h1>
    <br>
    <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo "<p class='error-text'>Fill in all fields</p><br>";
            }
            elseif ($_GET['error'] == "invaliduid") {
                echo "<p class='error-text'>Invalid username</p><br>";
            }
            elseif ($_GET['error'] == "invalidemail") {
                echo "<p class='error-text'>Invalid email</p><br>";
            }
            elseif ($_GET['error'] == "passwordsnotmatch") {
                echo "<p class='error-text'>Passwords don't match </p><br>";
            }
            elseif ($_GET['error'] == "checksqlerrors") {
                echo "<p class='error-text'>Check the sql queries</p><br>";
            }
            elseif ($_GET['error'] == "takenUsernameORtakenEmail") {
                echo "<p class='error-text'>Username or email is already taken</p><br>";
            }
            elseif ($_GET['error'] == "checksqlerrors2") {
                echo "<p class='error-text'>check the sql queries</p><br>";
            }
        }
        elseif (isset($_GET['signup']) && $_GET['signup'] == "success") {
            echo "<p class='success'>Signup successful, please log in :)</p><br>";
        }

        
    ?>
    <div class="signup">
    <form action="/includes/signup.inc.php" method="post">
        <input type="text" name="username" placeholder="Username"><br><br>
        <input type="text" name="email" placeholder="E-mail"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <input type="password" name="password2" placeholder="Confirm password"><br><br>
        <button type="submit" name="signup-submit">Signup</button>
    </form>
    <!--<a href="">Forgot Your Password?</a>*-->
    </div>
</main>
?>
<?php
    require_once 'footer.php';
?>


<?php
if (isset($_SESSION['id'])) {
    header("Location: /index.php");
}
?>