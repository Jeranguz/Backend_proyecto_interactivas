<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My profile</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <header>
    <?php 
        include "./parts/nav.php";
    ?>
    </header>
    <main>
    <input class="return-bottom return-btn-admin" type="button" onclick="history.back();" value="←">
        <?php
        
            if($_GET){
                if($_GET["id"]=="edt-profile"){
                    echo
            "<h1 class='featured-text admin-title'>Edit profile</h1>"
            ."<hr style='width:98%'>"  
            ."<section id='register' class='login-container'>"
           ."<form class='form-container'  method='post' action='add_user.php?id=register'>"
                        ."<div class='form-items'>"                 
                                ."<input id='fullname' class='form-input' type='text' name='fullname' required=''>"
                                ."<label class='' for='fullname'>Fullname</label>"
                        ."</div>"
                        ."<div class='form-items'>"
                                ."<input id='email' class='form-input' type='text' name='email' required=''>"
                                ."<label class='' for='email'>Email Address</label>"                                            
                        ."</div>"
                        ."<div class='form-items'>"                                                                            
                                ."<input id='username' class='form-input' type='text' name='username' required=''>"
                                ."<label class='' for='username'>Username</label>"                           
                        ."</div>"
                        ."<div class='form-items'>"                     
                                ."<input id='password' class='form-input' type='password' name='password' required=''>"
                                ."<span onclick='togglePassword()'><img class='togglePassword' id='togglePassword' src='./img/eye-password-see-view-svgrepo-com.svg' alt=''></span>"
                                ."<label class=''for='password'>Password</label>"    
                        ."</div>"
                        ."<div class='form-items'>"                       
                                ."<input class='btn-explore register-btn' type='submit' value='Update'>"                     
                        ."</div>"
                        ."<input type='hidden' name='register' value='1'>"
                    ."</form>"
        ."</section>";
                }
            }else{
                echo 
        "<h1 class='featured-text admin-title'>Your profile</h1>"
        ."<hr style='width:98%'>"
            ."<div class='profile-settings-container'>"
                ."<a class='profile-settings' href='profile.php?id=edt-profile'>"
                   ."<img class='profile-icon-resource' src='./img/edit-profile.svg' alt=''>"
                    ."<span class='food-text'>Edit profile</span>"   
                ."</a>"
                ."<a class='profile-settings'>"
                    ."<img class='profile-icon-resource' src='./img/change-password.svg' alt=''>"
                    ."<span class='food-text'>Change password</span>"    
                ."</a>"
                ."<a class='profile-settings'>"     
                    ."<img class='profile-icon-resource' src='./img/historial.svg' alt=''>"
                    ."<span class='food-text'>Historial</span>"
                ."</a>"
                ."<a class='profile-settings' href= './logout.php'>"            
                    ."<img class='profile-icon-resource' src='./img/logout.svg' alt=''>"
                    ."<span class='food-text'>Logout</span>"
                ."</a>"
            ."</div>";
            }
        ?>



    </main>



   
</body>
</html>