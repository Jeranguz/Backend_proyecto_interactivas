<?php
require_once 'database.php';
session_start();
$categories = $database->select("tb_dishes_category", "*");

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
    <header>
        <?php
        include "./parts/nav.php";
        ?>
    </header>
    <nav id="nav-category" class="navigation-category">
        <div class="navigation-category-div">
            <ul class="navigation-list">
                <li><a class="navigation-element navigation-category-element" href="#Salad">Salads</a></li>
                <li><a class="navigation-element navigation-category-element" href="#Main dish">Main Dishes</a></li>
                <li><a class="navigation-element navigation-category-element" href="#Dessert">Desserts</a></li>
                <li><a class="navigation-element navigation-category-element" href="#Drink">Drinks</a></li>
            </ul>
        </div>
    </nav>

    <div class="search-elements">
        <div class="search-box">
            <input id="search" class="search-space" type="text" placeholder="Search" name="keyword">
            <input class="search-btn" type="button" value="search" onclick="getFilters()">
        </div>
        <select name="dish_category" id="dish_category" class="filter">
            <option value="0">All categories</option>
            <?php
            foreach ($categories as $category) {
                echo "<option value='" . $category["id_category"] . "'>" . $category["n_category"] . "</option>";
            }
            ?>
        </select>
    </div>
    <h1 class="menu-title">Menu</h1>
    <div id="content">
<div id='items'>
    <?php
    foreach ($categories as $category) {
        echo "<section class='category-section'>";
        echo "<h2 id='" . $category['c_description'] . "' class='category-title'>" . $category['c_description'] . "</h2>";
        echo "<div class='category-container'>";

        $items = $database->select("tb_dishes", [
            "[>]tb_dishes_category" => ["id_category" => "id_category"]
        ], [
            "tb_dishes.id_dishes",
            "tb_dishes.n_dishes",
            "tb_dishes.d_dish",
            "tb_dishes.img_dish"
        ], [
            "tb_dishes.id_category" => $category["id_category"]
        ]);


        foreach ($items as $item) {
            echo "<div class='food-container'>";
            echo "<img class= 'featured-img' src='./img/" . $item["img_dish"] . "' alt='Food'>";
            echo "<h3 class='food-text'>" . substr($item["n_dishes"], 0, 17) . "...</h3>";
            echo "<p class='food-description'>" . substr($item["d_dish"], 0, 70) . "...</p>";
            echo "<a class='details-buttom' href='index2.php?id=" . $item["id_dishes"] . "'>See details</a>";
            echo "</div>";
        }
        echo "</div>";
        echo "</section>";
    }

    ?>
</div>
</div>
    <?php
    include "./parts/footer.php";
    ?>

    <script src="./js/category.js"></script>
    <script>
        function getFilters() {

            let info = {
                keyword : document.getElementById("search").value,
                category: document.getElementById("dish_category").value
            };

            fetch("http://localhost/backend_proyecto_interactivas/response.php", {
                method: "POST",
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': "application/json"
                },
                body: JSON.stringify(info)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data)

                if(document.getElementById("items") !== null) document.getElementById("items").remove();

                if(data.length > 0){
                    console.log("entro")
                let fullContainer =document.createElement("div");
                fullContainer.setAttribute("id", "items");
                let section = document.createElement("section");
                section.classList.add("category-section");
                fullContainer.appendChild(section);

                let container =document.createElement("div");
                container.classList.add("category-container");
                section.appendChild(container);

                data.forEach(function(item) {
                    let dish = document.createElement("div");
                    dish.classList.add("food-container")
                    //Create img
                    let img = document.createElement("img");
                    img.classList.add("featured-img");
                    img.setAttribute("src", './img/'+item.img_dish);
                    img.setAttribute("alt", item.n_dishes);
                    dish.appendChild(img);
                    //create title
                    let title = document.createElement("h3");
                    title.classList.add("food-text");
                    title.innerText = item.n_dishes.substr(0,17) + "...";
                    dish.appendChild(title);
                    //Create description
                    let description = document.createElement("p");
                    description.classList.add("food-description");
                    description.innerText = item.d_dish.substr(0,70) + "...";
                    dish.appendChild(description);
                    //create btn
                    let btn = document.createElement("a");
                    btn.classList.add("details-buttom");
                    btn.setAttribute("href", "index2.php?id="+item.id_dishes);
                    btn.innerText = "See details";
                    dish.appendChild(btn);
                    container.appendChild(dish);
                    document.getElementById("content").appendChild(fullContainer);

                });
                }
            })
        }
    </script>
</body>

</html>