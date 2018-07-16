<?php
    require_once("inc/header.php");

    $page = "Login";

    if($_POST)
    {
        $req = "SELECT * FROM user WHERE pseudo = :pseudo OR email =:email";

        $result = $pdo->prepare($req);
        $result->bindValue(":pseudo", $_POST['pseudo'], PDO::PARAM_STR);
        $result->bindValue(":email", $_POST['email'], PDO::PARAM_STR);

        $result->execute();

        if($result->rowCount() > 0) // if we select a pseudo in the DTB
        {
            $user = $result->fetch();

            if(password_verify($_POST['password'], $user['pwd'])) // function passwor_verify() is link to password_hash(). It allows us to check the correspondance between 2 values: 1rst argument will be the value to check, 2nd argument will be the match value
            {
                // $_SESSION['user']['pseudo'] = $user['pseudo']
                // $_SESSION['user']['firstname'] = $user['firstname']

                foreach ($user as $key => $value) 
                {
                    if($key != 'pwd')
                    {
                        $_SESSION['user'][$key] = $value;

                        header('location:profile.php');
                    }
                }
            }
            else 
            {
                $msg_error .= "<div class='alert alert-danger'>Identification error, please try again.</div>";
            }
        }
        else
        {
            $msg_error .= "<div class='alert alert-danger'>Identification error, please try again.</div>";
        }  
    }

?>

        <nav aria-label="breadcrumb">

        <nav aria-label="breadcrumb" id="bradscrupSing">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=URL?>">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Connect</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $page ?></li>
            </ol>
        </nav>
        <h1><?= $page ?></h1>
        
        <form action="" method="post">
            <?= $msg_error ?>
            <div class="form-group">
                <input type="text" class="form-control" name="pseudo" placeholder="Your pseudo..." required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Your password..." required>
            </div>
            <input type="submit" value="Login" class="btn btn-success btn-lg btn-block">
            
        </form>
        <br>
        <a href="password.php" class="btn btn-danger btn-lg btn-block">Forgot your password?</a>
    
<?php
    require_once("inc/footer.php");
?>