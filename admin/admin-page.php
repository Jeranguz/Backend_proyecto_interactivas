<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Admin Page</title>
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
        <h1 class="featured-text admin-title">Admin options</h1>
        <div class="admin-btn-container">
            <a class="btn-explore admin-botton" href="dish-list.php">Dish List</a>
            <a class="btn-explore admin-botton" href="add-dish.php">Add Dish</a>
        </div>
    </div>
</body>

</html>