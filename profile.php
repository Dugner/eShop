<?php
    require_once("inc/header.php");

    $page = "My Profile";

    if(!userConnect())
    {
        header('location:login.php');
        exit();
    }
        $result = $pdo->query("SELECT * FROM user");
    $users = $result->fetchAll();
    
    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
    {
        $req = "SELECT * FROM user WHERE id_user = :id_user";

        $result = $pdo->prepare($req);

        $result->bindValue(':id_user', $_GET['id'], PDO::PARAM_INT);

        $result->execute();

        if($result->rowCount() == 1)
        {
            $user = $result->fetch();

            $delete_req = "DELETE FROM user WHERE id_user = $user[id_user]";

            $delete = $pdo->exec($delete_req);

            if ($delete) {
               header("location:".URL.'logout.php');
            }
         } 
         else
            {
                echo "b;a;a";
                //header('location:signup.php');
            }
        }
        
    
debug($_SESSION);
            $content .= "<a href='?id=" . $_SESSION['user']['id_user'] . "'></a>";
            debug($content);
?>

    <h1><?= $page ?></h1>
        
    <p>Please find your informations below:</p>
    <ul>
        <li>Firstame: <?= $_SESSION['user']['firstname'] ?></li>
        <li>Lastname: <?= $_SESSION['user']['lastname'] ?></li>
        <li>Email: <?= $_SESSION['user']['email'] ?></li>
    </ul>     
   
  <a href="update.php?id=<?=$_SESSION['user']['id_user']?>" class='alert alert-secondary btn btn-primary btn-lg btn-block'>Update your account</a>
  <a href="?id=<?=$_SESSION['user']['id_user']?>" class="alert alert-danger btn btn-primary btn-lg btn-block">Delete Your Account</a>

<?php
    require_once("inc/footer.php");
?>