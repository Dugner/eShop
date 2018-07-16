<?php
    require_once("inc/header.php");

    $page = "Welcome on MyEshop.com";

    $pic = $pdo->query("SELECT picture FROM product ORDER BY RAND() LIMIT 3");

    $randpic = $pic->fetchAll();



?>

        <h1><?= $page ?></h1>
        <p class="lead">Please feel free to buy !</p>
 
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
               <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="<?=URL?>uploads/img/<?= $randpic[0]['picture'] ?>">

                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?=URL?>uploads/img/<?= $randpic[1]['picture'] ?>">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?=URL?>uploads/img/<?= $randpic[2]['picture'] ?>">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div id="articlesRow">
            <div id="aricle1">
                <article>
                    <header id="headerArt">
                        <img id="imgArt"src="uploads/frontPageimg/Photo1.jpg" alt="">
                        <div class="date">
                        <span>12</span>
                        <span>MAI</span>
                        </div>
                    </header>
                    <section>
                        <h2>Sales</h2>
                        <h3>Super Summer collection</h3>
                        <h4>Fast FAst !!!</h4>
                        <p>Super Sale on our new Collection for more details check our magasin.Super Sale on our new Collection for more details check our magasin.Super Sale on our new Collection for more details check our magasin.Super Sale on our new Collection for more details check our magasin.</p>
                    </section>
                </article>
            </div>
            <div id="aricle3">
            <article>
                    <header id="headerArt">
                        <img id="imgArt"src="uploads/frontPageimg/shoes1.jpg" alt="">
                        <div class="date">
                        <span>10</span>
                        <span>JUN</span>
                        </div>
                    </header>
                    <section>
                        <h2>Sales</h2>
                        <h3>Super Summer collection</h3>
                        <h4>Fast FAst !!!</h4>
                        <p>Super Sale on our new Collection for more details check our magasin.Super Sale on our new Collection for more details check our magasin.Super Sale on our new Collection for more details check our magasin.Super Sale on our new Collection for more details check our magasin.</p>
                    </section>
                </article>
            </div>
        </div>

        
    
<?php
    require_once("inc/footer.php");
?>