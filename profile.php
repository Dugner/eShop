<?php
    require_once("inc/header.php");

    $page = "My Profile";

    if(!userConnect())
    {
        header('location:login.php');
        exit();
    }

?>

    <h1><?= $page ?></h1>
        
    <p>Please find your informations below:</p>
    <ul>
        <li>Firstame: <?= $_SESSION['user']['firstname'] ?></li>
        <li>Lastname: <?= $_SESSION['user']['lastname'] ?></li>
        <li>Email: <?= $_SESSION['user']['email'] ?></li>
    </ul>     
    
<?php
    require_once("inc/footer.php");
?>