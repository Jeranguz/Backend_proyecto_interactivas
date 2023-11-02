<?php 
    require_once 'database.php';
    $categories = $database->select("tb_dishes_category","*");
   
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
    
    <?php  
         foreach($categories as $category){
            echo "<section class='category-section'>";
                echo "<h2 id='salads' class='category-title'>".$category['n_category']."</h2>";
                    echo "<div class='category-container'>";

                    $items = $database->select("tb_dishes",[
                        "[>]tb_dishes_category"=>["id_category" =>"id_category"]
                    ],[
                        "tb_dishes.id_dishes",
                        "tb_dishes.n_dishes",
                        "tb_dishes.d_dish",
                        "tb_dishes.img_dish"
                    ],[
                        "tb_dishes.id_category" => $category["id_category"]
                    ]);


                    foreach($items as $item){
                        echo "<div class='food-container'>";
                        echo "<img class= 'featured-img' src='./img/".$item["img_dish"]."' alt='Food'>";
                        echo "<h3 class='food-text'>".$item["n_dishes"]."</h3>";
                        echo "<p class='food-description'>".substr($item["d_dish"], 0, 80)."...</p>";
                        echo "<a class='details-buttom' href='index2.php?id=".$item["id_dishes"]."'>See details</a>";
                        echo "</div>";
                    }
                    
                   
             echo "</div>";
            echo "</section>";
        } 
    
     ?>

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