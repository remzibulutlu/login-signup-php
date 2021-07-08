
<?php
    require 'header.php';
?>

<main>
    <?php
    
        if (isset($_SESSION['id'])) {
            echo '<p>You are logged in :D</p>';
        }
        else {
            echo '<p>Please Login or Register !!!</p>';
    }
        ?>
</main>

<?php
    require_once 'footer.php';
?>
