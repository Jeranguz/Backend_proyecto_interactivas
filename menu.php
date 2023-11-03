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
<header >
    <?php 
        include "./parts/nav.php";
    ?>
    </header>
    <nav id="nav-category" class="navigation-category">
        <div  class="navigation-category-div">
            <ul class="navigation-list">
                <li><a class="navigation-element navigation-category-element" href="#Salads">Salads</a></li>
                <li><a class="navigation-element navigation-category-element" href="#Main dishes">Main Dishes</a></li>
                <li><a class="navigation-element navigation-category-element" href="#Desserts">Desserts</a></li>
                <li><a class="navigation-element navigation-category-element" href="#Drinks">Drinks</a></li>
            </ul>
        </div>
    </nav>
    <h1 class="menu-title">Menu</h1>
    
    <?php  
         foreach($categories as $category){
            echo "<section class='category-section'>";
                echo "<h2 id='".$category['c_description']."' class='category-title'>".$category['c_description']."</h2>";
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

   <?php 
        include "./parts/footer.php";
    ?>

<script src="./js/category.js"></script>
</body>
</html>