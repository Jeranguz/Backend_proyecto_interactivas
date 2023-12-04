<?php
require_once '../database.php';
$categories = $database->select("tb_dishes_category", "*");
$peoples = $database->select("tb_amount_people", "*");

$message = "";

if ($_GET) {
    $item = $database->select("tb_dishes", [
        "[>]tb_dishes_category" => ["id_category" => "id_category"],
        "[>]tb_amount_people" => ["id_amount_people" => "id_amount_people"]
    ], [
        "tb_dishes.id_dishes",
        "tb_dishes.n_dishes",
        "tb_dishes.n_dishes_tr",
        "tb_dishes.d_dish",
        "tb_dishes.d_dish_tr",
        "tb_dishes.img_dish",
        "tb_dishes.featured",
        "tb_dishes.price",
        "tb_dishes.id_category",
        "tb_dishes_category.n_category",
        "tb_amount_people.n_category_people",
        "tb_amount_people.id_amount_people"
    ], [
        "id_dishes" => $_GET["id"]
    ]);
}



if ($_POST) {
    $data = $database->select("tb_dishes","*", ["id_dishes"=>$_POST["id"]]);
    if (isset($_FILES["img_dish"]) && $_FILES["img_dish"]["name"] !="") {
        
        $errors = [];
        $file_name = $_FILES["img_dish"]["name"];
        $file_size = $_FILES["img_dish"]["size"];
        $file_tmp = $_FILES["img_dish"]["tmp_name"];
        $file_type = $_FILES["img_dish"]["type"];
        $file_ext_arr = explode(".", $_FILES["img_dish"]["name"]);

        $file_ext = end($file_ext_arr);
        $img_ext = ["jpeg", "png", "jpg", "webp"];

        if (!in_array($file_ext, $img_ext)) {
            $errors[] = "File type not supported";
            $message = "File type not supported";
        }


        if (empty($errors)) {
            $filename = $_POST["n_dishes"];
            $filename = str_replace(',', '', $filename);
            $filename = str_replace('.', '', $filename);
            $filename = str_replace(' ', '-', $filename);
            $img = $filename . "." . $file_ext;
            move_uploaded_file($file_tmp, "../img/" . $img);
        } 
        
    }else{
        $img = $data[0]["img_dish"];
    }
    $database->update("tb_dishes", [
        "n_dishes" => $_POST["n_dishes"],
        "n_dishes_tr" => $_POST["n_dishes_tr"],
        "id_category" => $_POST["id_category"],
        "id_amount_people" => $_POST["id_amount_people"],
        "price" => $_POST["price"],
        "d_dish" => $_POST["d_dish"],
        "d_dish_tr" => $_POST["d_dish_tr"],
        "featured" => $_POST["featured"],
        "img_dish" => $img
    ], [
        "id_dishes" => $_POST["id"]
    ]);
    header("location: dish-list.php");


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Edit Dish</title>
    <?php 
        echo $message;
    ?>
</head>

<body>
    <nav class="top-nav">
        <a href="../index.php"><img class="logo" src="../img/logo.png" alt="Restaurant logo"></a>
        <input class="mobile-check" type="checkbox">
        <label class="mobile-btn">
            <span></span>
        </label>
        <div class="navigation-lists">
            <ul class="navigation-list">
                <li><img class="log-navigation-list" src="../img/logo.png" alt=""></li>
                <li><a class="navigation-element" href="#">About Us</a></li>
                <li><a class="navigation-element" href="../menu.php">Menu</a></li>
                <li><a class="navigation-element" href="#">Reviews</a></li>
                <li><a class="navigation-element" href="#">Location</a></li>
            </ul>
            <ul class="navigation-list navigation-login">
                <li><a class="sign-in navigation-element" href="#">Sign up</a></li>
                <li>
                    <a class="navigation-element" href="#">
                        <img class="cart" src="../img/cart.png" alt="cart">
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="card-background">

        <input class="return-bottom return-btn-admin" type="button" onclick="history.back();" value="←">
        <h2 class="featured-text">Edit Dish</h2>
        <form class="form" method="post" action="edit-dish.php" enctype="multipart/form-data">
            <div class="form-items">
                <label class="porpuse-text" for="dish_name">Dish name</label>
                <input id="n_dishes" name="n_dishes" type="text" value="<?php echo $item[0]["n_dishes"] ?>">
            </div>
            <div class="form-items">
                <label class="porpuse-text" for="dish_name_tr">Dish name tranlation</label>
                <input id="n_dishes_tr" name="n_dishes_tr" type="text" value="<?php echo $item[0]["n_dishes_tr"] ?>">
            </div>
            <div class="form-items">
                <label class="porpuse-text" for="d_dish">Dish description</label>
                <textarea id="d_dish" name="d_dish" cols="30" rows="10"><?php echo $item[0]["d_dish"] ?></textarea>
            </div>
            <div class="form-items">
                <label class="porpuse-text" for="d_dish_tr">Dish description tranlation</label>
                <textarea id="d_dish_tr" name="d_dish_tr" cols="30" rows="10"><?php echo $item[0]["d_dish_tr"] ?></textarea>
            </div>
            <div class="form-elements">

                <div class="form-items">
                    <label class="porpuse-text" for="id_category">Dish category</label>
                    <select name="id_category" id="id_category">
                        <?php
                        foreach ($categories as $category) {
                            if ($category["id_category"] == $item[0]["id_category"]) {
                                echo "<option value='" . $category["id_category"] . "' selected>" . $category["n_category"] . "</option>";
                            } else {
                                echo "<option value='" . $category["id_category"] . "'>" . $category["n_category"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-items">
                    <label class="porpuse-text" for="id_amount_people">Dish amount people</label>
                    <select name="id_amount_people" id="id_amount_people">
                        <?php
                        foreach ($peoples as $people) {
                            if ($people["id_amount_people"] == $item[0]["id_amount_people"]) {
                                echo "<option value='" . $people["id_amount_people"] . "' selected>" . $people["n_category_people"] . "</option>";
                            } else {
                                echo "<option value='" . $people["id_amount_people"] . "'>" . $people["n_category_people"] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-elements">

                <div class="form-items">
                    <label class="porpuse-text" for="price">Dish price</label>
                    <input id="price" name="price" type="text" value="<?php echo $item[0]["price"] ?>">
                </div>
                <div class="form-items">
                    <label class="porpuse-text" for="featured">Is featured?</label>
                    <select name="featured" id="featured">
                        <?php
                        if ($item[0]["featured"] == 1) {
                            echo "<option value='1' selected>Yes, it is</option>";
                            echo "<option value='0'>No, it isn't</option>";
                        } else {
                            echo "<option value='1'>Yes, it is</option>";
                            echo "<option value='0'selected>No, it isn't</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-items">
                <label class="porpuse-text" for="img_dish">Destination Image</label>
                <img class="form-img" id="preview" src="../img/<?php echo $item[0]["img_dish"]; ?>" alt="Preview">
                <input id="img_dish" type="file" name="img_dish" onchange="readURL(this)">
            </div>
            <div class="btn-container">
                <input class="btn-explore" type="submit" value="Edit dish :)">
            </div>
            <input type="hidden" name="id" value="<?php echo $item[0]["id_dishes"] ?>">
        </form>
    </div>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    let preview = document.getElementById('preview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
</body>

</html>