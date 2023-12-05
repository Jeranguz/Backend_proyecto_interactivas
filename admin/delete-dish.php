<?php
require_once '../database.php';

session_start();
if (!isset($_SESSION["isLoggedIn"])) {
    header("location: err.php");
    
}else{
   
        $user = $database->select("tb_users","*",[
            "usr"=>$_SESSION["username"]
        ]);
        
        if($user[0]["adm"]==0){
            header("location: err.php");
        }
} 

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
        "tb_dishes_category.n_category",
        "tb_amount_people.n_category_people",
        "tb_amount_people.id_amount_people"
    ], [
        "id_dishes" => $_GET["id"]
    ]);
}

if($_POST){
    // Reference: https://medoo.in/api/delete
    $database->delete("tb_dishes",[
        "id_dishes"=>$_POST["id"]
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
    <title>Delete dish</title>
</head>

<body>
    <?php 
        include "../parts/adm_nav.php";
    ?>
    <input class="return-bottom return-btn-admin" type="button" onclick="history.back();" value="←">
    <div class="card-background">
        <h2 class="featured-text">Delete dish</h2>
        <?php
        echo "<h3 class='food-text'>Name: " . $item[0]['n_dishes'] . "</h3>";
        echo "<img class='delete-img' src='../img/" . $item[0]['img_dish'] . "' alt=''>";
        echo "<div class='delete-elements'>";
        echo "<h3 class='food-text'>Dish Price: $" . $item[0]['price'] . "</h3>";
        echo "<h3 class='food-text'>Category: " . $item[0]['n_category'] . "</h3>";
        echo "<h3 class='food-text'>Amount: " . $item[0]['n_category_people'] . "</h3>";
        if ($item[0]["featured"] == "1") {
            echo "<h3 class='food-text'>Featured: Yes</h3>";
        } else {
            echo "<h3 class='food-text'>Featured: No</h3>";
        }
        echo "</div>";
        ?>
        <form method="post" action="delete-dish.php">
            <input name="id" type="hidden" value="<?php echo $item[0]["id_dishes"]; ?>">
            <label class='food-text delete-txt' for="Delete">Are you sure you want to delete this dish?</label>
            <div class="btn-container">
                <input class="btn-explore" type="submit" value="Delete dish :(">
            </div>
        </form>

    </div>
</body>

</html>