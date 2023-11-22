<nav class="top-nav">
    <a href="index.php"><img class="logo" src="./img/logo.png" alt="Restaurant logo"></a>
    <input class="mobile-check" type="checkbox">
    <label class="mobile-btn">
        <span></span>
    </label>
    <div class="navigation-lists">

        <ul class="navigation-list">
            <li><img class="log-navigation-list" src="./img/logo.png" alt=""></li>
            <li><a class="navigation-element" href="#">About Us</a></li>
            <li><a class="navigation-element" href="menu.php">Menu</a></li>
            <li><a class="navigation-element" href="#">Reviews</a></li>
            <li><a class="navigation-element" href="#">Location</a></li>
        </ul>
        <ul class="navigation-list navigation-login">
            <li>
                <a class="navigation-element" href="cart.php">
                    <img class="cart" src="./img/cart.png" alt="cart">
                </a>
            </li>
            <?php
            session_start();
            if (isset($_SESSION["isLoggedIn"])) {
               
                echo 
                "<li class='pr'>"
                ."<img class='img-user' src='./img/user.svg' alt=''>" 
                ."<a class='nav-list-link user-name' href='./profile.php'>" . $_SESSION["fullname"] . "</a>"
                ."</li>";
                /* echo "<li><a class='nav-list-link' href='./logout.php'>Log out</a></li>"; */
            } else {
                echo "<li><a class='sign-in navigation-element' href='add_user.php'>Sign up</a></li>";
            }
            ?>

         
        </ul>


        </ul>
    </div>
</nav>