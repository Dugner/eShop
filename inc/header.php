<?php require_once("init.php") ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="TeamKeepers">

    <!-- CAREFUL to create the favicon -->
    <link rel="icon" href="">

    <title>MyEshop.com | Be$t deal$ online</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- AwesomeFont -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- My CSS -->
    <link  rel="stylesheet" href="css/style.css">

  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" id="navBar">
      <a class="navbar-brand" href="<?= URL ?>">MyEshop.com</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>">Home</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= URL ?>eshop.php">Eshop</a>
          </li>

          <?php if(!userConnect()) : ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Connect</a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="<?= URL ?>login.php">Login</a>
                <a class="dropdown-item" href="<?= URL ?>signup.php">Signup</a>
              </div>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= URL ?>profile.php">Profile</a>
            </li>
          <?php endif; ?>

          <li class="nav-item">
            <!-- CAREFUL to call the right link here -->
            <a class="nav-link" href="#">Contact</a>
          </li>

          <?php if(userConnect()) : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= URL ?>logout.php">Logout</a>
            </li>
          <?php endif; ?>

          <?php if(userAdmin()) : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= URL ?>admin/product_form.php">BackOffice access</a>
            </li>
          <?php endif; ?>
          <li>
            <a class="nav-link" href="<?=URL?>cart.php"><i class="fas fa-shopping-cart"></i><?php if(productNumber()){echo'<span class="bubble">' . productNumber() . '</span>';} ?></a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="container">
        <div class="starter-template">