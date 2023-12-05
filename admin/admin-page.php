<?php

        session_start();
    if (!isset($_SESSION["isLoggedIn"])) {
        header("location: err.php");
        
    }else{
        require_once '../database.php';
            $user = $database->select("tb_users","*",[
                "usr"=>$_SESSION["username"]
            ]);
            
            if($user[0]["adm"]==0){
                header("location: err.php");
            }
    } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Admin Page</title>
</head>

<body>
    <?php 
        include "../parts/adm_nav.php";
    ?>
    <div class="card-background">
        <h1 class="featured-text admin-title">Admin options</h1>
        <div class="admin-btn-container">
            <a class="btn-explore admin-botton" href="dish-list.php">Dish List</a>
            <a class="btn-explore admin-botton" href="add-dish.php">Add Dish</a>
        </div>
    </div>
</body>

</html>