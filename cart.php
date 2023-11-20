<?php

require_once 'database.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Document</title>
</head>
<header>
    <?php
    include "./parts/nav.php";
    if (!isset($_SESSION['foodList'])) {
        $_SESSION['foodList'] = [];
    }

    $total = 0;

    if ($_POST && isset($_POST['delete'])) {
        $indexToDelete = $_POST['delete'];
        if (isset($_SESSION['foodList'][$indexToDelete])) {
            unset($_SESSION['foodList'][$indexToDelete]);
            $_SESSION['foodList'] = array_values($_SESSION['foodList']);
            var_dump($_SESSION['foodList']);
        }
    } elseif ($_POST) {
        $_SESSION['foodList'][] = $_POST;
        var_dump($_SESSION['foodList']);
    }


    ?>
</header>

<body>
    <input class="return-bottom return-btn-admin" type="button" onclick="history.back();" value="←">
    <h2 class="featured-text admin-title">Cart</h2>

    <div class="table-div">
        <table>
            <thead>
                <tr>
                    <td>Dish name</td>
                    <td>Amount</td>
                    <td>Modality</td>
                    <td>price</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($_SESSION['foodList'] as $index => $food) {
                    $total += $food["price"] * $food["dish-amount"];
                    $modality = $database->select("tb_modality", "*", [
                        "id_modality" => $food["dish-modality"]
                    ]);
                    echo "<tr>";
                    echo "<td>" . $food["n_dishes"] . "  </td>";
                    echo "<td>" . $food["dish-amount"] . "  </td>";
                    echo "<td>" . $modality[0]["n_modality"] . "  </td>";
                    echo "<td>$" . $food["price"] * $food["dish-amount"] . "  </td>";
                    echo "<td>
                        <form method='post'>
                            <input type='hidden' name='delete' value='" . $index . "'>
                            <button type='submit'>Delete</button>
                        </form>
                      </td>";
                }
                ?>
            </tbody>
        </table>
        
    </div>
    
        <div class="btn-container">
        <?php 
            echo "<h3 class='porpuse-text'>Total to Pay ".$total."</h3>"
        ?>
                <input class="btn-explore" type="submit" value="Buy :)">
            </div>
</body>

<footer>
    <?php
    include "./parts/footer.php";
    ?>
</footer>

</html>