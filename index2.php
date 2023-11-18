<?php
require_once 'database.php';
if ($_GET) {


    $item = $database->select("tb_dishes", [
        "[>]tb_dishes_category" => ["id_category" => "id_category"],
        "[>]tb_amount_people" => ["id_amount_people" => "id_amount_people"]
    ], [
        "tb_dishes.id_dishes",
        "tb_dishes.n_dishes",
        "tb_dishes.d_dish",
        "tb_dishes.img_dish",
        "tb_dishes.featured",
        "tb_dishes.price",
        "tb_dishes.id_category",
        "tb_dishes_category.c_description",
        "tb_amount_people.n_category_people"
    ], [
        "id_dishes" => $_GET["id"]
    ]);
}
$modalities = $database->select("tb_modality", "*");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>details</title>

    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <header>
        <?php
        include "./parts/nav.php";
        ?>
    </header>

    <main class="pag2">
        <input class="return-bottom return-btn-admin" type="button" onclick="history.back();" value="←">


        <section id="buy" class="buy-dish-container">

            <?php
            echo "<h2 class='featured-text'>" . $item[0]["n_dishes"] . "</h2>";
            echo "<div class='img-thumb'>";
            echo "<div class='dish-price-container'>";
            echo "<span class='dish-price'>$" . $item[0]["price"] . "</span>";
            echo "</div>";
            echo "<img class='dishes-img' src='./img/" . $item[0]["img_dish"] . "' />";
            echo "</div>";
            echo "<p class='porpuse-text'>" . $item[0]["d_dish"] . "</p>";


            echo "<section class='tags-container'>";
            echo "    <div class='tag'>";
            echo "        <img class='tag-img' src='./img/categories.svg' alt=''>";
            echo "        <span class='porpuse-text'> " . $item[0]["c_description"] . "</span>";
            echo "    </div>";
            echo "    <div class='tag'>";
            echo "        <img class='tag-img' src='./img/people.svg' alt=''>";
            echo "        <span class='porpuse-text'> " . $item[0]["n_category_people"] . "</span>";
            echo "    </div>";
            echo "    <div class='tag'>";
            echo "        <img class='tag-img' src='./img/heart.svg' alt=''>";
            if ($item[0]["featured"] == 1) {
                echo "        <span class='porpuse-text'>Featured</span>";
            } else {
                echo "        <span class='porpuse-text'>No featured</span>";
            }
            echo "    </div>";
            echo "</section>";
            ?>

            <form method="post" action="cart.php">
                <div class="input-container">
                    <div class="input-div">
                        <label class="porpuse-text" for="dish-amount">Select the quantity</label>
                        <input class="menu-input" name="dish-amount" type="number" min="0" value="0">
                    </div>
                    <div class="input-div">
                        <label class="porpuse-text" for="dish-modality">Select the modality</label>
                        <select class="menu-input" name="dish-modality" id="dish-modality">
                            <?php
                            foreach ($modalities as $modality) {
                                echo "<option value='" . $modality["id_modality"] . "'>" . $modality["n_modality"] . "</option>";
                            }
                            ?>

                        </select>
                    </div>
                </div>
                <input type="hidden" name="id_dishes" value='<?php echo $item[0]["id_dishes"]; ?>'>
                <input class="order-now-bottom" class="btn-explore" type="submit" value="Order Now">
            </form>
        </section>
        <hr class="line">


        <section class="realated-dishes-container">
            <h2 class="featured-text">Related Dishes</h2>
            <div class="category-container">

                <?php
                $items = $database->select("tb_dishes", [
                    "[>]tb_dishes_category" => ["id_category" => "id_category"]
                ], [
                    "tb_dishes.id_dishes",
                    "tb_dishes.n_dishes",
                    "tb_dishes.d_dish",
                    "tb_dishes.img_dish"
                ], [
                    "tb_dishes.id_category" => $item[0]["id_category"]
                ]);

                $counter = 0;

                foreach ($items as $item) {
                    if ($counter < 4) {
                        if ($item["id_dishes"] != $_GET["id"]) {
                            echo "<div class='food-container'>";
                            echo "<img class= 'featured-img' src='./img/" . $item["img_dish"] . "' alt='Food'>";
                            echo "<h3 class='food-text'>" . substr($item["n_dishes"], 0, 17) . "</h3>";
                            echo "<p class='food-description'>" . substr($item["d_dish"], 0, 70) . "...</p>";
                            echo "<a class='details-buttom' href='index2.php?id=" . $item["id_dishes"] . "'>See details</a>";
                            echo "</div>";
                            $counter++;

                        }
                    }
                }

                ?>

            </div>
        </section>

        <?php
        include "./parts/footer.php";
        ?>

    </main>



</body>

</html>