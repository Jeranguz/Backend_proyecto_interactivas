<?php
session_start();
require_once 'database.php';

if (!isset($_SESSION['foodList'])) {
    $_SESSION['foodList'] = [];
}

if ($_POST) {
    $_SESSION['foodList'][] = $_POST;
    var_dump($_SESSION['foodList']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Amount</td>
                <td>Modality</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($_SESSION['foodList'] as $food) {
                echo "<tr>";
                echo "<td>" . $food["id_dishes"] . "  </td>";
                echo "<td>" . $food["dish-amount"] . "  </td>";
                echo "<td>$" . $food["dish-modality"] . "  </td>";
            }
            ?>

        </tbody>
    </table>
</body>

</html>