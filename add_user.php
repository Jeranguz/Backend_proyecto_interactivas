<?php
    require_once 'database.php';
    $message = "";

    if($_POST){

        if(isset($_POST["login"])){

            $user = $database->select("tb_users","*",[
                "usr"=>$_POST["username"]
            ]);
            if(count($user) > 0){
                //validate password
                    if(password_verify($_POST["password"], $user[0]["pwd"])){
                        session_start();
                        $_SESSION["isLoggedIn"] = true;
                        $_SESSION["fullname"] = $user[0]["usr"];
                        header("location: index.php");
                    }else{
                        $message = "Wrong username or password";
                    }
            }else{
                $message = "wrong username or password";
            }
        }
        
        if(isset($_POST["register"])){
            if(verifyInfo()){
                //validate if user already registered
            $validateUsername = $database->select("tb_users","*",[
                "usr"=>$_POST["username"]
            ]);

            if(count($validateUsername) > 0){
                $message = "This username is already registered";
            }else{

                $pass = password_hash($_POST["password"], PASSWORD_DEFAULT, ['cost' => 12]);

                $database->insert("tb_users",[
                    "fullname"=> $_POST["fullname"],
                    "usr"=> $_POST["username"],
                    "pwd"=> $pass,
                    "email"=> $_POST["email"]
                ]);

                header("location: add_user.php");
            }

            }
        }

        if(isset($_POST["fw-pw"])){
            $email = $database->select("tb_users","*",[
                "email"=>$_POST["email"]
            ]);

            if(count($email) > 0){
                $allowedCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $pass = '';
                    for ($i = 0; $i < 8; $i++) {
                        $pass .= $allowedCharacters[rand(0, strlen($allowedCharacters) - 1)];
                    }
    
                $passHash = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 12]);

                $database->update("tb_users", [
                    "pwd" => $passHash
                ], [
                    "email"=>$_POST["email"]
                ]);
                
                $message = "New Password : $pass" ;
            }else{
                $message = "Wrong email";
            }
        }
    }

    function verifyInfo() {
        global $message; 
        if ($_POST["fullname"] == "") {
            $message = "fullname incorrect";
            return false;
        } elseif ($_POST["username"] == "") {
            $message = "username incorrect";
            return false;
        } elseif ($_POST["password"] == "") {
            $message = "password incorrect";
            return false;
        } elseif ($_POST["email"] == "") {
            $message = "email incorrect";
            return false;
        } else {
            return true;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css">
    
    <style> 
          
  
    </style>
        

   
</head>
<body>
  
      <main class="logs">
        
      <button class="return-bottom">
            <a href="index.php" class="left-arrow">←</a>
        </button>
        <?php
        if($_GET){
            if($_GET["id"]=="register"){
                echo  
                "<section id='register' class='login-container'>"
            ."<div class='title-conatiner'>"
            ."<h1 class='add-user-title'>Register</h1>"
            ."</div>"
         
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
                            
                                ."<input class='btn-explore register-btn' type='submit' value='Sign up'>"
                            
                        ."</div>"
                        ."<p>$message</p>"
                        ."<input type='hidden' name='register' value='1'>"
                        ."<p>Do you have an account? <a class='span' href='add_user.php'> Login  </a> </p>"
                    ."</form>"
        ."</section>";     
            }
            if($_GET["id"]=="fg-pw"){
                echo  
            "<section id='register' class='login-container'>"
            ."<div class='title-conatiner'>"
            ."<h1 class='add-user-title'>Password</h1>"
            ."</div>"
         
           ."<form class='form-container'  method='post' action='add_user.php?id=fg-pw'>"
                        ."<div class='form-items'>"
                         
                                ."<input id='email' class='form-input' type='text' name='email' required=''>"
                                ."<label class='' for='email'>Email Address</label>"                                 
                          
                        ."</div>"
                        ."<div class='form-items'>"
                            
                                ."<input class='btn-explore register-btn' type='submit' value='Submit'>"
                            
                        ."</div>"
                        ."<p>$message</p>"
                        ."<input type='hidden' name='fw-pw' value='1'>"
                    ."</form>"
        ."</section>";      
            }
            }else{
                echo 
                "<section class='login-container'>"
                ."<div class='title-conatiner'>"
                  ."<h1 class='add-user-title'>Login</h1>"
                ."</div>"
             
               ."<form class='form-container'  method='post' action='add_user.php'>"
                           ."<div class='form-items'>"
                                   ." <input id='usernameLog' class='form-input' type='text' name='username' required=''>"
                                    ."<label class='form-label' for='username'>Username</label>"              
                            ."</div>"
                            ."<div class='form-items'>"
                                    ."<input id='password' class='form-input' type='password' name='password' required=''>"
                                    ."<span onclick='togglePassword()'><img class='togglePassword' id='togglePassword' src='./img/eye-password-see-view-svgrepo-com.svg' alt=''></span>"
                                    ."<label class='form-label' for='password'>Password</label>"
                                    ."<div class='flex-row'>"
                                        ."<div>"
                                            ."<input type='checkbox'>"
                                            ."<label>Remember me </label>"
                                        ."</div>"
                                        ."<a href='add_user.php?id=fg-pw' class='span'>Forgot password?</a>"
                                    ."</div>"
                                  
                            ."</div>"
                            ."<div class='form-items'>"
                                    ."<input class='btn-explore register-btn' type='submit' value='Sign In'>"
                            ."</div>"
                            ."<p>$message</p>"
                           ."<input type='hidden' name='login' value='1'>"
                        ."</form>"
    
                        ."<p>Don't have an account? <a class='span' href='add_user.php?id=register'> Sign Up  </a></p>"
    
                        ."<p>Or With</p>"
    
                            ."<div class='flex-row'>"
                                ."<a class= 'btn-login' href=''>"
                                    ."<img class= 'icon-login' src='./img/google-color.svg' alt=''>"
                                ."</a>" 
                                ."<a class= 'btn-login' href=''>"
                                    ."<img class= 'icon-login' src='./img/facebook-color.svg' alt=''>"
                                ."</a>" 
    
                           ."</div>"
            ."</section>";
                
            } 
        
           





?>

      </main>  

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
    
   
</body>
</html>