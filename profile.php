<?php
require_once("inc/header.php");

$page = "My Profile";

if (!userConnect()) {
    header('location:login.php');
    exit();
}
$result = $pdo->query("SELECT * FROM user");
$users = $result->fetchAll();

if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'] && isset($_GET['context']) && $_GET['context'] == 'user')) {
    $req = "SELECT * FROM user WHERE id_user = :id_user";

    $result = $pdo->prepare($req);

    $result->bindValue(':id_user', $_GET['id'], PDO::PARAM_INT);

    $result->execute();

    if ($result->rowCount() == 1) {
        $user = $result->fetch();

        $delete_req = "DELETE FROM user WHERE id_user = $user[id_user]";

        $delete = $pdo->exec($delete_req);

        if ($delete) {
            header("location:" . URL . 'logout.php');
        }
    } else {
                //echo "b;a;a";
        header('location:signup.php');
    }
}

if(!empty($_FILES['user_picture']['name'])){
    $picture_name = $_SESSION['user']['firstname'] . $_SESSION['user']['lastname'] .'_' . $_FILES['user_picture']['name'];
    $picture_name = str_replace(' ','-',$picture_name);
    $picture_path = ROOT_TREE . 'uploads/user/'.$picture_name;
    
    $result = $pdo->prepare("UPDATE user SET picture=:picture WHERE id_user = :id_user");
    $result->bindValue(':id_user',$_SESSION['user']['id_user'],PDO::PARAM_INT);
    $result->bindValue(':picture',$picture_name,PDO::PARAM_STR);
    if($result->execute()){
    if(!empty($_FILES['user_picture']['name'])){
    copy($_FILES['user_picture']['tmp_name'],$picture_path);
    }
    }
    $_SESSION['user']['picture'] = $picture_name;
    header('location:profile.php');
    
    }
    
    //debug($picture_name);
     debug($_SESSION);
    debug($_FILES);
    
?>

    <h1><?= $page ?></h1>
        
    <p>Please find your informations below:</p>
    <ul>
        <li>Firstame: <?= $_SESSION['user']['firstname'] ?></li>
        <li>Lastname: <?= $_SESSION['user']['lastname'] ?></li>
        <li>Email: <?= $_SESSION['user']['email'] ?></li>
        <li><img style='width:120px; border-radius:50%;' src='<?= URL . "uploads/img/". $_SESSION['user']['picture'] ?>'></li>
    </ul>     
    <form method="post" enctype="multipart/form-data">
<div class="input-group input-group-lg">

<label for="user_picture">Profile picture</label>
<input type="file" class="input-group mb-3" name="user_picture" > 
<input type="submit" class="btn btn-block btn-info" value="Update your photo">


</div>
</form>
<br>
  <a href="update.php?id=<?= $_SESSION['user']['id_user'] ?>" class='alert alert-secondary btn btn-primary btn-lg btn-block'>Update your account</a>
  <a href="?id=<?= $_SESSION['user']['id_user'] ?>" class="alert alert-danger btn btn-danger btn-lg btn-block">Delete Your Account</a>

<?php
require_once("inc/footer.php");
?>