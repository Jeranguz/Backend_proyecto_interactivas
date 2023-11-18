<?php
require_once '../database.php';
// Reference: https://medoo.in/api/select
$dishes = $database->select("tb_dishes",[
    "[>]tb_dishes_category"=>["id_category" =>"id_category"]
    ],[
        "tb_dishes.n_dishes",
        "tb_dishes.id_dishes",
        "tb_dishes.price",
        "tb_dishes.featured",
        "tb_dishes.img_dish",
        "tb_dishes_category.c_description"
    ]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Registered Dishes</title>
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
    <input class="return-bottom return-btn-admin" type="button" onclick="history.back();" value="←">

        <h2 class="featured-text admin-title">Registered Dishes</h2>
        <div class="table-div">
            <table>
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Category</td>
                        <td>Price</td>
                        <td>Featured</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tbody class="body">
                    <?php
                    foreach ($dishes as $dish) {
                        echo "<tr>";
                        echo "<td>" . $dish["n_dishes"] . "  </td>";
                        echo "<td>" . $dish["c_description"] . "  </td>";
                        echo "<td>$" . $dish["price"] . "  </td>";
                        if($dish["featured"]== 1){
                            echo "<td>Yes</td>";
                        }else{
                            echo "<td>No</td>";
                        }
                        echo "<td><a class='action-button' href='edit-dish.php?id=" . $dish["id_dishes"] . "'><img class='action-img miSvg' src='../img/edit-img.svg' alt=''></a> <a class='action-button' href='delete-dish.php?id=" . $dish["id_dishes"] . "'><img class='action-img miSvg' src='../img/delete-img.svg' alt=''></a></td>";
                        echo "</tr>";
                    }
                    // <img class='img' src='../img/" . $dish["img_dish"] . "' alt='" . $dish["n_dishes"] . " img'>
                    ?>

                </tbody>
            </table>
        </div>

</body>

</html>