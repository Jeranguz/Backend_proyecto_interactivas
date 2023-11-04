<?php 
    require_once '../database.php';
    // Reference: https://medoo.in/api/select
    $dishes = $database->select("tb_dishes","*");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Dishes</title>
</head>
<body>
    <h2>Registered Dishes</h2>
    <table>
        <?php
            foreach($dishes as $dish){
                echo "<tr>";
                echo "<td>".$dish["n_dishes"]."</td>";
                echo "<td><a href='edit-destination.php?id=".$dish["id_dishes"]."'>Edit</a> <a href='delete.php?id=".$dish["id_dishes"]."'>Delete</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
    
</body>
</html>