<?php 
    require_once 'database.php';
    $items = $database->select("tb_dishes","*");
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

    <link rel="stylesheet" href="./css/main.css">


</head>

<body>
    <header class="header-container">
    <?php 
        include "./parts/nav.php";
    ?>
        <h1 class="main-title">Where Nordic tradition become legendary flavor</h1>
        <p class="main-text">Amazing Nordic recipes, ready to delight your taste buds</p>
        <div class="btn-container">
            <a class="btn-explore" href="#featured">Explore</a>
        </div>
    </header>
    <main>
        <h2 id="featured" class="featured-text">Our best dishes</h2>
        <div class="swiper swiper-hero">
            <div class="swiper-wrapper">
            <?php 
                 foreach($items as $item){
                    if($item["feautured"]==1){
                echo"<div class='swiper-slide'>";
                  echo"<div class='food-container'>";
                          echo"<img class= 'featured-img' src='./img/".$item["img_dish"]."' alt='Food'>";
                          echo"<h3 class='food-text'>".$item["n_dishes"]."</h3>";
                          echo"<p class='food-description'>".substr($item["d_dish"], 0, 80)."...</p>";
                            echo"<a class='details-buttom' href='index2.php?id=".$item["id_dishes"]."'>See details</a>";
                   echo"</div>";
                echo"</div>";
                
                    }
                 }
            ?> 
                </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>

                <div class="caracteristics-container">
                    <section class="center">
                        <h3 class="nv-md">Fresh food</h3>
                        <img src="./img/fish.png" alt="Fish-img" class="img-center">
                        <p class="ms-md">All the dishes that arrive at your table are prepared at the moment</p>
                    </section>
                    <section class="center">
                        <h3 class="nv-md">Tasty food</h3>
                        <img src="./img/pot.png" alt="Pot" class="img-center">
                        <p class="ms-md">We are committed to serving you food that exceeds your expectations </p>
                    </section>
                    <section class="center">
                        <h3 class="nv-md">Fast delivery</h3>
                        <img src="./img/delivery-man.png" alt="Delivery-man" class="img-center">
                        <p class="ms-md">Your food will arrive at your home in less than 25 minutes.</p>
                    </section>
                </div>


                <section class="our-porpuse-container">
                   <div>
                    <h2 class="featured-text">Our purpose</h2>
                    <p class="porpuse-text">
                        We Want to offer our guests the best
                        of the Nordic tradition, which is why
                        we focus on even the smallest detail
                        of our recipes.
                    </p>
                   </div> 
                    <img src="./img/flags.png" alt="flags images" class="flags-img">
                </section>

    <?php 
        include "./parts/footer.php";
    ?>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <script src="./js/main.js"></script>


</body>

</html>