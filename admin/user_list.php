<?php
    $msg_update='';
    $msg_delete='';
    require_once('inc/header.php');
    

    $result = $pdo->query("SELECT id_user, pseudo, firstname, lastname, email, gender, city, zip_code, address, privilege FROM user");
    $users = $result->fetchAll();

    $content .= "<table class='table table-striped'>";
    $content .= "<thead class='thead-dark'><tr>";

    for ($i = 0; $i < $result->columnCount(); $i++) 
    {
        $columns = $result->getColumnMeta($i);
        $content .= "<th scope='col'>" . ucfirst(str_replace('_', ' ', $columns['name'])) . "</th>";
    }
    $content .= '<th colspan="2">Actions</th>';
    $content .= "</tr></thead><tbody>";
    foreach ($users as $user) 
    {
        $content .= "<tr>";
        foreach ($user as $key => $value) 
        {
            $content .= '<th>' . $value . '</th>';
        }
         
            $content .= "<td><a href='" . URL . "admin/editUser_form.php?id=" . $user['id_user'] . "'><i class='fas fa-pen'></i></a></td>";
            $content .= "<td><a data-toggle='modal' data-target='#exampleModal'><i class='fas fa-trash-alt'></i></a></td>
            <!-- Modal -->
                <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body'>
                        Are you sure you want to Delete the User?
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                        <a href='?id=" . $user['id_user'] . "'><button type='button' class='btn btn-primary'>Confirm</button></a>
                        </form>
                    </div>
                    </div>
                </div>
                </div></td>";
            $content .= "</tr>";
        
    }
    $content .= "</tbody></table>";

    if(!empty($_GET['m']) && $_GET['m']== 'update')
    {   
        $msg_update .= "<div class='alert alert-success'>The User is succsesfuly Updated.</div>";
    }
    

    
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

            $delete_user = $pdo->exec($delete_req);

            header("location: user_list.php?mes=delete");
        }
        
    }
    if(!empty($_GET['mes']) && $_GET['mes'] == "delete")
        {
            $msg_delete .= "<div class='alert alert-success'>The User is succsesfuly Deleted.</div>";
        }
?>


<h1><center>Welcome to the User List<center></h1>
<?= $msg_error ?>
<?= $msg_update ?>
<?= $msg_delete?>
<?=$content?>

<?php

require_once('inc/footer.php');

?>