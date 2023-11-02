<?php 
    require_once 'database.php';

    // Reference: https://medoo.in/api/select
    //variables que almacenan las platillos
    $main_dishes = $database->select("tb_dishes","*",["id_category_dish"=>1]);
    $salads = $database->select("tb_dishes","*",["id_category_dish"=>2]);
    $desserts = $database->select("tb_dishes","*",["id_category_dish"=>3]);
    $drinks = $database->select("tb_dishes","*",["id_category_dish"=>4]);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body class="body">
    <nav class="top-nav">
        <a href="index.html"><img class="logo" src="./img/logo.png" alt="Restaurant logo"></a>
        <input class="mobile-check" type="checkbox">
            <label class="mobile-btn">
                <span></span>
            </label>
        <div class="navigation-lists">
        <ul class="navigation-list">
            <li><img class="log-navigation-list" src="./img/logo.png" alt=""></li>
            <li><a class="navigation-element" href="#">About Us</a></li>
            <li><a class="navigation-element" href="#">Menu</a></li>
            <li><a class="navigation-element" href="#">Reviews</a></li>
            <li><a class="navigation-element" href="#">Location</a></li>
        </ul>
        <ul class="navigation-list navigation-login">
            <li><a class="sign-in navigation-element" href="#">Sign up</a></li>
            <li>
                <a class="navigation-element" href="#">
                    <img clasAquavit" src="./img/cart.png" alt="cart">
                </a>
            </li>
        </ul>
        </div>
    </nav>
    <nav id="nav-category" class="navigation-category">
        <div  class="navigation-category-div">
            <ul class="navigation-list">
                <li><a class="navigation-element navigation-category-element" href="#salads">Salads</a></li>
                <li><a class="navigation-element navigation-category-element" href="#main-dishes">Main Dishes</a></li>
                <li><a class="navigation-element navigation-category-element" href="#desserts">Desserts</a></li>
                <li><a class="navigation-element navigation-category-element" href="#drinks">Drinks</a></li>
            </ul>
        </div>
    </nav>
    <h1 class="menu-title">Menu</h1>
    <section class="category-section">
    <h2 id="salads" class="category-title">Salads</h2>
    <div class="category-container">
    <?php 
    //ciclo para agregar cada platillo
        foreach($salads as $salad){
            echo "<div class='food-container'>";
            echo "<img class= 'featured-img' src='./img/".$salad["img_dish"]."' alt='Food'>";
            echo "<h3 class='food-text'>".$salad["n_dishes"]."</h3>";
            echo "<p class='food-description'>".substr($salad["d_dish"], 0, 80)."...</p>";
            echo "<a class='details-buttom' href='index2.php?id=".$salad["id_dishes"]."'>See details</a>";
            echo "</div>";
        }
        ?>
    </div>
</section>

<section class="category-section">
    <h2 id="main-dishes" class="category-title">Main Dishes</h2>
    <div class="category-container">
        <?php 
        //ciclo para agregar cada platillo
        foreach($main_dishes as $main_dish){
            echo "<div class='food-container'>";
            echo "<img class= 'featured-img' src='./img/".$main_dish["img_dish"]."' alt='Food'>";
            echo "<h3 class='food-text'>".$main_dish["n_dishes"]."</h3>";
            echo "<p class='food-description'>".substr($main_dish["d_dish"], 0, 80)."...</p>";
            echo "<a class='details-buttom' href='index2.php?id=".$main_dish["id_dishes"]."'>See details</a>";
            echo "</div>";
        }
        ?>
        
    </div>
</section>
<section class="category-section">
    <h2 id="desserts" class="category-title">Desserts</h2>
    <div class="category-container">
    <?php 
    //ciclo para agregar cada platillo
        foreach($desserts as $dessert){
            echo "<div class='food-container'>";
            echo "<img class= 'featured-img' src='./img/".$dessert["img_dish"]."' alt='Food'>";
            echo "<h3 class='food-text'>".$dessert["n_dishes"]."</h3>";
            echo "<p class='food-description'>".substr($dessert["d_dish"], 0, 80)."...</p>";
            echo "<a class='details-buttom' href='index2.php?id=".$dessert["id_dishes"]."'>See details</a>";
            echo "</div>";
        }
        ?>
    </div>
</section>
<section class="category-section">
    <h2 id="drinks" class="category-title">Drinks</h2>
    <div class="category-container">
    <?php 
    //ciclo para agregar cada platillo
        foreach($drinks as $drink){
            echo "<div class='food-container'>";
            echo "<img class= 'featured-img' src='./img/".$drink["img_dish"]."' alt='Food'>";
            echo "<h3 class='food-text'>".$drink["n_dishes"]."</h3>";
            echo "<p class='food-description'>".substr($drink["d_dish"], 0, 80)."...</p>";
            echo "<a class='details-buttom' href='index2.php?id=".$drink["id_dishes"]."'>See details</a>";
            echo "</div>";
        }
        ?>
    </div>
</section>
<footer class="footer-container">
    <section class="logo">
        <img src="./img/logo.png" alt="">
    </section>
    
    <div class="footer-content">
        <div class="footer-links">
            <section>
                <h3>Company</h3>
                <ul class="nav-bottom-list">
                    <li><a class="nav-bottom-link"href="#">FAQ</a></li>
                    <li><a class="nav-bottom-link"href="#">Blog</a></li>
                    <li><a class="nav-bottom-link"href="#">Career</a></li>
                </ul>
            </section>

            <section>
                <h3>Legal</h3>
                <ul class="nav-bottom-list">
                    <li><a class="nav-bottom-link"href="#">Terms of use</a></li>
                    <li><a class="nav-bottom-link"href="#">Privacy</a></li>
                    <li><a class="nav-bottom-link"href="#">Cookie</a></li>
                </ul>
            </section>

            <section>
                <h3>Resourse</h3>
                <ul class="nav-bottom-list">
                    <li><a class="nav-bottom-link" href="#">Help center</a></li>
                    <li><a class="nav-bottom-link" href="#">Server status</a></li>
                    <li><a class="nav-bottom-link" href="#">Feedback</a></li>                        
                </ul>
            </section>
        </div> 
    </div>

    <div class="follow-content"> 
        <h3 class="follow-text">Follow us</h3>
        <div class="social-network-links">
            <a href=""> <img src="./img/facebook.svg" alt="" class="follow-img" ></a>
            <a href=""> <img src="./img/Group 28.svg" alt="" class="follow-img" ></a>
            <a href=""> <img src="./img/Group 29.svg" alt="" class="follow-img" ></a>
            <a href=""> <img src="./img/Group 30.svg" alt="" class="follow-img" ></a>
        </div>
    </div>
</footer>

<script src="./js/category.js"></script>
</body>
</html>