<?php
 require_once("inc/header.php");

 $page = "Forget my password";
 if ($_POST) 
 {
     if ((isset($_POST['pseudo']) && isset($_POST['email']))) 
     {

        $req = "SELECT * FROM user WHERE pseudo = :pseudo AND email=:email ";

        $result1 = $pdo->prepare($req);
        $result1->bindValue(":pseudo", $_POST['pseudo'], PDO::PARAM_STR);
        $result1->bindValue(":email", $_POST['email'], PDO::PARAM_STR);
        
        if($result1->execute())
        {
            $user = $result1->fetch(); 

            $result = $pdo->prepare("UPDATE user SET pseudo=:pseudo,  pwd=:pwd, firstname=:firstname ,lastname=:lastname, email=:email, address=:address, zip_code=:zc, city=:city, gender=:gender  WHERE id_user=:id_user");

            $hashed_pwd = password_hash($_POST['pwd'], PASSWORD_BCRYPT); 

            $result->bindValue(':id_user', $_POST['id_user'], PDO::PARAM_INT);
            $result->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
            $result->bindValue(':pwd', $hashed_pwd, PDO::PARAM_STR);
            $result->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
            $result->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
            $result->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $result->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
            $result->bindValue(':zc', $_POST['zc'], PDO::PARAM_STR);
            $result->bindValue(':gender', $_POST['gender'], PDO::PARAM_STR);
            $result->bindValue(':city', $_POST['city'], PDO::PARAM_STR);

            if ($result->execute()) {
                echo 'wooooo';
           header('location:login.php');
            }
            else
            {
                echo 'yuuuu';
            }
        }

     }
 }

 debug($_POST);
 debug($user);
$firstname = (isset($user['firstname'])) ? $user['firstname'] : '';
$lastname = (isset($user['lastname'])) ? $user['lastname'] : '';
$address = (isset($user['address'])) ? $user['address'] : '';
$zip_code = (isset($user['zc'])) ? $user['zc'] : '';
$city = (isset($user['city'])) ? $user['city'] : '';
$gender = (isset($user['gender'])) ? $user['gender'] : '';
$pwd = (isset($user['pwd'])) ? $user['pwd'] : '';

?>
<h1><?= $page ?></h1>
<?= $msg_error ?>
<form method="post">
    <div class="form-group">
        <input type="text" class="form-control" name= "pseudo" placeholder = "your pseudo...">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" name = "email" placeholder= "your email..." >
    </div>

    <div class="form-group">
        <input type="text" class="form-control" name = "pwd" placeholder= "your password..." >
    </div>

    <input type='hidden' name="firstname" value="<?=$firstname?>">
    <input type='hidden' name="lastname" value="<?=$lastname?>">
    <input type='hidden' name="city" value="<?=$city?>">
    <input type='hidden' name="zc" value="<?=$zip_code?>">
    <input type='hidden' name="address" value="<?=$address?>">
    <input type='hidden' name="gender" value="<?=$gender?>">

    <input type="submit" value="Submit" class="btn btn-success btn-lg btn-block">


</form>

<?php
    require_once("inc/footer.php");
?>