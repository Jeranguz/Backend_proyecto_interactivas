<?php
    require_once 'database.php';
    session_start();
    $message="";
    $user = $database->select("tb_users","*",[
        "usr"=>$_SESSION["username"]
    ]);

    if($_POST){
        if(isset($_POST["update-profile"])){
            $validateUsername = $database->select("tb_users","*",[
                "usr"=>$_POST["username"]
            ]);

            if(count($validateUsername) > 0){
                $message = "This username is already registered";
            }else{
                $database->update("tb_users", [
                    "usr" => $_POST["username"],
                    "fullname" => $_POST["fullname"],
                    "email" => $_POST["email"]    
                ], [
                    "usr"=>$_SESSION["username"]
                ]);
                $_SESSION["username"] = $_POST["username"];
                header("location: profile.php");
            }
                
        }

        if(isset($_POST["upt-pwd"])){
            if($_POST["password"]==$_POST["c_password"]){
                $passHash = password_hash($_POST["password"], PASSWORD_DEFAULT, ['cost' => 12]);

                $database->update("tb_users", [
                    "pwd" => $passHash
                ], [
                    "usr"=>$_SESSION["username"]
                ]);
                header("location: profile.php");

            }else{
                $message= "Passwords do not match";
            }      
        }

        

    }


?>


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
           ."<form class='form-container'  method='post' action='profile.php?id=edt-profile'>"
                        ."<div class='form-items'>"                 
                                ."<input id='fullname' class='form-input' type='text' name='fullname' required='' value='".$user[0]["fullname"]."'>"
                                ."<label class='' for='fullname'>Fullname</label>"
                        ."</div>"
                        ."<div class='form-items'>"
                                ."<input id='email' class='form-input' type='text' name='email' required='' value='".$user[0]["email"]."'>"
                                ."<label class='' for='email'>Email Address</label>"                                            
                        ."</div>"
                        ."<div class='form-items'>"                                                                            
                                ."<input id='username' class='form-input' type='text' name='username' required='' value='".$user[0]["usr"]."'>"
                                ."<label class='' for='username'>Username</label>"                           
                        ."</div>"
                        ."<div class='form-items'>"                       
                                ."<input class='btn-explore register-btn' type='submit' value='Update'>"                     
                        ."</div>"
                        ."<input type='hidden' name='update-profile' value='1'>"
                    ."</form>"
        ."</section>";
                }
                if($_GET["id"]=="upt-pwd"){
                    echo
                "<h1 class='featured-text admin-title'>Change Password</h1>"
                ."<hr style='width:98%'>"    
                ."<section id='register' class='login-container'>"
               ."<form class='form-container'  method='post' action='profile.php?id=upt-pwd'>"
                            ."<div class='form-items'>"                     
                                ."<input id='password' class='form-input' type='password' name='password' required=''>"
                                ."<span onclick='togglePassword()'><img class='togglePassword' id='togglePassword' src='./img/eye-password-see-view-svgrepo-com.svg' alt=''></span>"
                                ."<label class=''for='password'>New password</label>"    
                        ."</div>"
                        ."<div class='form-items'>"                     
                                ."<input id='c_password' class='form-input' type='password' name='c_password' required=''>"
                                ."<label class=''for='password'>Confirm password</label>"    
                        ."</div>"
                            ."<div class='form-items'>" 
                                    ."<input class='btn-explore register-btn' type='submit' value='Update'>"
                            ."</div>"
                            ."<p>$message</p>"
                            ."<input type='hidden' name='upt-pwd' value='1'>"
                        ."</form>"
            ."</section>";      
                }
              if($_GET["id"]=="historial"){
                    echo
                "<h1 class='featured-text admin-title'>Historial</h1>"
                ."<hr style='width:98%'>"
                ."<div style='height:30rem'>"
                ."</div>";
                
                }
           
            } else{
                echo 
        "<h1 class='featured-text admin-title'>Your profile</h1>"
        ."<hr style='width:98%'>"
            ."<div class='profile-settings-container'>"
                ."<a class='profile-settings' href='profile.php?id=edt-profile'>"
                   ."<img class='profile-icon-resource' src='./img/edit-profile.svg' alt=''>"
                    ."<span class='food-text'>Edit profile</span>"   
                ."</a>"
                ."<a class='profile-settings' href='profile.php?id=upt-pwd'>"
                    ."<img class='profile-icon-resource' src='./img/change-password.svg' alt=''>"
                    ."<span class='food-text'>Change password</span>"    
                ."</a>"
                ."<a class='profile-settings' href='profile.php?id=historial'>"     
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

        <?php
        include './parts/footer.php';
        ?>

<script>
   
   /* eyeSwitch */
   function togglePassword() {
       const passwordInput = document.getElementById("password");
       const toggleIcon = document.getElementById("togglePassword");
   
       if (passwordInput.type === "password") {
       passwordInput.type = "text";
       toggleIcon.src = "./img/eye-password-show-svgrepo-com.svg"; 
       
       } else {
       passwordInput.type = "password";
       toggleIcon.src = "./img/eye-password-see-view-svgrepo-com.svg";
      
       }
   }
      /* eyeSwitch */
   </script>

    </main>



   
</body>
</html>