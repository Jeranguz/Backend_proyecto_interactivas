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
                        $_SESSION["fullname"] = $user[0]["fullname"];
                        header("location: index.php");
                    }else{
                        $message = "wrong username or password";
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

                header("location: index.php");
            }

            }
        }
    }

    function verifyInfo() {
        global $message; // Para acceder a la variable $message definida fuera de la función
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

    
         <section id="register" class="login-container">
           
            <div class="title-conatiner">
            <h1 class="add-user-title">Register</h1>
            </div>
         
           <form class="form-container"  method="post" action="add_user.php">
                        <div class='form-items'>                  
                                <input id='fullname' class='form-input' type='text' name='fullname' required="">
                                <label class='' for='fullname'>Fullname</label>
                        </div>
                        <div class='form-items'>
                         
                                <input id='email' class='form-input' type='text' name='email' required="">
                                <label class='' for='email'>Email Address</label>                                 
                          
                        </div>
                        <div class='form-items'>
                                                                             
                                <input id='username' class='form-input' type='text' name='username' required="">
                                <label class='' for='username'>Username</label> 
                           
                        </div>
                        <div class='form-items'>                     
                                <input id='password' class='form-input' type='password' name='password' required="">
                                <span onclick="togglePassword()"><img class="togglePassword" id="togglePassword" src="./img/eye-password-see-view-svgrepo-com.svg" alt=""></span>
                                <label class='' for='password'>Password</label>    
                        </div>
                        <div class='form-items'>
                            
                                <input class="btn-explore register-btn" type='submit' value="Sign up">
                            
                        </div>
                        <p><?php echo $message; ?></p>
                        <input type="hidden" name="register" value="1">
                        <p>Do you have an account? <span class="span">Login</span> </p>
                    </form>
        </section> 

        <button class="return-bottom">
            <a href="index.php" class="left-arrow">←</a>
        </button>
        <section  class="login-container">
           
            <div class="title-conatiner">
         
            <h1 class="add-user-title">Login</h1>
            </div>
         
           <form class="form-container"  method="post" action="add_user.php">
                        <div class='form-items'>
                                <input id='usernameLog' class='form-input' type='text' name='username' required="">
                                <label class='form-label' for='username'>Username</label>              
                        </div>
                        <div class='form-items'>
                                <input id='passwordLog' class='form-input' type='password' name='password' required="">
                                <span onclick="togglePassword()"><img class="togglePassword" id="togglePassword1" src="./img/eye-password-see-view-svgrepo-com.svg" alt=""></span>
                                <label class='form-label' for='password'>Password</label>
                                <div class="flex-row">
                                    <div>
                                        <input type="checkbox">
                                        <label>Remember me </label>
                                    </div>
                                    <span class="span">Forgot password?</span>
                                </div>
                              
                        </div>
                        <div class='form-items'>
                                <input class="btn-explore register-btn" type='submit' value="Sign In">
                        </div>
                        <input type="hidden" name="login" value="1">
                    </form>

                    <p>Don't have an account? <a class="span" href="/add.user.php?id='login'"> Sign Up  </a></p>

                    <p>Or With</p>

                        <div class="flex-row">
                            <a class= "btn-login" href="">
                                <img class= "icon-login" src="./img/google-color.svg" alt="">
                            </a> 
                            <a class= "btn-login" href="">
                                <img class= "icon-login" src="./img/facebook-color.svg" alt="">
                            </a> 

                        </div>
        </section>

      </main>  

           <script>
            /* eyeSwitch */
            function togglePassword() {
                const passwordInput = document.getElementById("password");
                const toggleIcon = document.getElementById("togglePassword");
                const passwordInput1 = document.getElementById("passwordLog");
                const toggleIcon1 = document.getElementById("togglePassword1");

                if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordInput1.type = "text";
                toggleIcon.src = "./img/eye-password-show-svgrepo-com.svg"; 
                toggleIcon1.src = "./img/eye-password-show-svgrepo-com.svg"; 
                } else {
                passwordInput.type = "password";
                passwordInput1.type = "password";
                toggleIcon.src = "./img/eye-password-see-view-svgrepo-com.svg";
                toggleIcon1.src = "./img/eye-password-see-view-svgrepo-com.svg";
                }
            }
               /* eyeSwitch */

         
            </script>
    
   
</body>
</html>