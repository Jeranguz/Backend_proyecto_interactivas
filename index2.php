<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>details</title>

    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <header >
        <nav class="top-nav">
            <a href="index.html"><img class="logo" src="./img/logo.png" alt="Restaurant logo"></a>
            <input class="mobile-check" type="checkbox">
            <label class="mobile-btn">
                <span></span>
            </label>
            <div class="navigation-lists">
                <ul class="navigation-list">
                    <li><img class="log-navigation-list" src="./img/logo.png" alt=""></li>
                    <li><a class="navigation-element" href="#">About Us</a></li>
                    <li><a class="navigation-element" href="menu.html">Menu</a></li>
                    <li><a class="navigation-element" href="#">Reviews</a></li>
                    <li><a class="navigation-element" href="#">Location</a></li>
                </ul>
                <ul class="navigation-list navigation-login">
                    <li><a class="sign-in navigation-element" href="#">Sign up</a></li>
                    <li>
                        <a class="navigation-element" href="#">
                            <img class="cart" src="./img/cart.png" alt="cart">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="pag2">
        <button class="return-bottom">
            <a href="index.html" class="left-arrow">←</a>
        </button>


        <section id="buy" class="buy-dish-container">
            <h2 class="featured-text">Farikal</h2>
            <div class="img-thumb">
                <div class="dish-price-container">
                    <span class="dish-price">$12.99</span>
                </div>
                <img class="dishes-img" src="./img/f.png" alt="">
            </div>
            <p class="porpuse-text">It consists of pieces of mutton with bone, cabbage, whole black pepper</p>

            <section class="tags-container">
                <div class="tag">
                    <img class="tag-img" src="./img/categories.svg" alt="">
                    <span class="porpuse-text"> Vegetarian</span>
                </div>
                <div class="tag">
                    <img class="tag-img" src="./img/people.svg" alt="">
                    <span class="porpuse-text"> 1 </span>
                </div>
                <div class="tag">
                    <img class="tag-img" src="./img/heart.svg" alt="">
                    <span class="porpuse-text"> Feautured</span>
                </div>
            </section>
            <div class="input-container">
                <div class="input-div">
                    <label class="porpuse-text" for="dish-amount">Select the quantity</label>
                    <input class="menu-input" name="dish-amount" type="number" min="0" value="0">
                </div>
                <div class="input-div">
                    <label class="porpuse-text" for="dish-modality">Select the modality</label>
                    <select class="menu-input" name="dish-modality" id="modality">
                        <option value="">Express</option>
                        <option value="">Eat in restaurant</option>
                        <option value="">Hola</option>
                    </select>
                </div>               
            </div>
            <a class="order-now-bottom" href="">Order Now</a>
        </section>
        <hr class="line">
        <section class="realated-dishes-container">
            <h2 class="featured-text">Related Dishes</h2>
            <div class="category-container">
                <div class="food-container">
                    <img class="featured-img" src="./img/food-example.png" alt="Food">
                    <h3 class="food-text">Fårikål</h3>
                    <p class="food-description"> It consists of pieces of mutton with bone, cabbage, whole black pepper
                    </p>
                    <a class="details-buttom" href="index2.html">See details</a>
                </div>
                <div class="food-container">
                    <img class="featured-img" src="./img/food-example.png" alt="Food">
                    <h3 class="food-text">Fårikål</h3>
                    <p class="food-description"> It consists of pieces of mutton with bone, cabbage, whole black pepper
                    </p>
                    <a class="details-buttom" href="index2.html">See details</a>
                </div>
                <div class="food-container">
                    <img class="featured-img" src="./img/food-example.png" alt="Food">
                    <h3 class="food-text">Fårikål</h3>
                    <p class="food-description"> It consists of pieces of mutton with bone, cabbage, whole black pepper
                    </p>
                    <a class="details-buttom" href="index2.html">See details</a>
                </div>

                <div class="food-container">
                    <img class="featured-img" src="./img/food-example.png" alt="Food">
                    <h3 class="food-text">Fårikål</h3>
                    <p class="food-description"> It consists of pieces of mutton with bone, cabbage, whole black pepper
                    </p>
                    <a class="details-buttom" href="index2.html">See details</a>
                </div>
            </div>
        </section>

        <footer class="footer-container">
            <section class="logo">
                <img src="./img/logo.png" alt="">
            </section>

            <div class="footer-content">
                <div class="footer-links">
                    <section>
                        <h3>Company</h3>
                        <ul class="nav-bottom-list">
                            <li><a class="nav-bottom-link" href="#">FAQ</a></li>
                            <li><a class="nav-bottom-link" href="#">Blog</a></li>
                            <li><a class="nav-bottom-link" href="#">Career</a></li>
                        </ul>
                    </section>

                    <section>
                        <h3>Legal</h3>
                        <ul class="nav-bottom-list">
                            <li><a class="nav-bottom-link" href="#">Terms of use</a></li>
                            <li><a class="nav-bottom-link" href="#">Privacy</a></li>
                            <li><a class="nav-bottom-link" href="#">Cookie</a></li>
                        </ul>
                    </section>

                    <section>
                        <h3>Resourse</h3>
                        <ul class="nav-bottom-list">
                            <li><a class="nav-bottom-link" href="#">Help center</a></li>
                            <li><a class="nav-bottom-link" href="#">Server status</a></li>
                            <li><a class="nav-bottom-link" href="#">Feedback</a></li>
                        </ul>
                    </section>
                </div>
            </div>

            <div class="follow-content">
                <h3 class="follow-text">Follow us</h3>
                <div class="social-network-links">
                    <a href=""> <img src="./img/facebook.svg" alt="" class="follow-img"></a>
                    <a href=""> <img src="./img/Group 28.svg" alt=""class="follow-img"></a>
                    <a href=""> <img src="./img/Group 29.svg" alt=""class="follow-img"></a>
                    <a href=""> <img src="./img/Group 30.svg" alt=""class="follow-img"></a>
                </div>
            </div>


        </footer>

    </main>



</body>

</html>