<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">

    <link rel="stylesheet" href="./css/main.css">

    <style>
        .swiper-hero {
            display: flex;
            width: 80vw;
            margin: auto;
            padding-bottom: 2rem;
            padding-top: 2rem;
            justify-content: center;
            margin-top: 4rem;
            margin-bottom: 4rem;
        }

        @media (max-width: 767.98px) {
            .swiper-hero {
                display: flex;
                width: 100%;
                margin: auto;
                justify-content: center;
                margin-top: 4rem;
                margin-bottom: 4rem;
            }

        }

        .swiper-hero .swiper-slide {
            width: 350px;
            display: flex;
            justify-content: center;
            /* Centra horizontalmente */
            align-items: center;
            /* Centra verticalmente */
            text-align: center;
        }
    </style>

</head>

<body>
    <header class="header-container">
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
                    <li><a class="navigation-element" href="menu.php">Menu</a></li>
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
        <h1 class="main-title">Where Nordic tradition become legendary flavor</h1>
        <p class="main-text">Amazing Nordic recipes, ready to delight your taste buds</p>
        <div class="btn-container">
            <a class="btn-explore" href="#featured">Explore</a>
        </div>
    </header>
    <main>


        <h2 id="featured" class="featured-text">Our best dishes</h2>
        <div class="swiper swiper-hero">
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide">
                    <div class="food-container">
                      <img class= " featured-img" src="./img/food-example.png" alt="Food">
                        <h3 class="food-text">Fårikål</h3>
                        <p class="food-description"> It consists of pieces of mutton with bone, cabbage, whole black
                            pepper</p>
                        <a class="details-buttom" href="index2.php#buy">See details</a>
                    </div>

                </div>
                <div class="swiper-slide">
                    <div class="food-container">
                        <img class="featured-img" src="./img/Aquavit.jpg" alt="Food">
                        <h3 class="food-text">Aquavit</h3>
                        <p class="food-description">Is a Scandinavian distilled beverage usually 40% alcohol by volume</p>
                        <a class="details-buttom" href="index2.php#buy">See details</a>
                    </div>

                </div>
                <div class="swiper-slide">

                    <div class=" food-container">
                        <img class="featured-img" src="./img/dessert.jpg" alt="Food">
                        <h3 class="food-text">Galette</h3>
                        <p class="food-description">It can be had hot, warm ort is a Scandinavian distilled beverage usually 40% alcohol by volume</p>
                        <a class="details-buttom" href="index2.php#buy">See details</a>
                    </div>

                </div>

                <div class="swiper-slide">
                    <div class=" food-container">
                        <img class="featured-img" src="./img/food-example.png" alt="Food">
                        <h3 class="food-text">Fårikål</h3>
                        <p class="food-description"> It consists of pieces of mutton with bone, cabbage, whole black
                            pepper</p>
                        <a class="details-buttom" href="index2.php#buy">See details</a>
                    </div>

                </div>
                <div class="swiper-slide">

                    <div class=" food-container">
                        <img class="featured-img" src="./img/Aquavit.jpg" alt="Food">
                        <h3 class="food-text">Aquavit</h3>
                        <p class="food-description">Is a Scandinavian distilled beverage usually 40% alcohol by volume</p>
                        <a class="details-buttom" href="index2.php#buy">See details</a>
                    </div>

                </div>
                <div class="swiper-slide">

                    <div class=" food-container">
                        <img class="featured-img" src="./img/dessert.jpg" alt="Food">
                        <h3 class="food-text">Gallete</h3>
                        <p class="food-description">It can be had hot, warm ort is a Scandinavian distilled beverage usually 40% alcohol by volume</p>
                        <a class="details-buttom" href="index2.php#buy">See details</a>
                  </div>
                
              </div>    
            </div>
            <div class=" swiper-pagination">
                    </div>

                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>





                <div class="caracteristics-container">
                    <section class="center">
                        <h3 class="nv-md">Fresh food</h3>
                        <img src="./img/fish.png" alt="Fish-img" class="img-center">
                        <p class="ms-md">All the dishes that arrive at your table are prepared at the moment</p>
                    </section>
                    <section class="center">
                        <h3 class="nv-md">Tasty food</h3>
                        <img src="./img/pot.png" alt="Pot" class="img-center">
                        <p class="ms-md">We are committed to serving you food that exceeds your expectations </p>
                    </section>
                    <section class="center">
                        <h3 class="nv-md">Fast delivery</h3>
                        <img src="./img/delivery-man.png" alt="Delivery-man" class="img-center">
                        <p class="ms-md">Your food will arrive at your home in less than 25 minutes.</p>
                    </section>
                </div>


                <section class="our-porpuse-container">
                   <div>
                    <h2 class="featured-text">Our purpose</h2>
                    <p class="porpuse-text">
                        We Want to offer our guests the best
                        of the Nordic tradition, which is why
                        we focus on even the smallest detail
                        of our recipes.
                    </p>
                   </div> 
                    <img src="./img/flags.png" alt="flags images" class="flags-img">
                </section>


                <footer class="footer-container">
                    <div class="logo">
                        <img src="./img/logo.png" alt="">
                    </div>

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
                            <a href="https://www.instagram.com/sr.peregil97/"> <img src="./img/Group 28.svg" alt="" class="follow-img"></a>
                            <a href=""> <img src="./img/Group 29.svg" alt="" class="follow-img"></a>
                            <a href=""> <img src="./img/Group 30.svg" alt="" class="follow-img"></a>
                        </div>
                    </div>


                </footer>



    </main>

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <script src="./js/main.js"></script>


</body>

</html>