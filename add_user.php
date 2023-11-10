<?php
    require_once 'database.php';
    $message = "";

    if($_POST){
        
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
  
      <main>
        <section class="login-container">
           
            <div class="title-conatiner">
           <!--  <img class="logoOpt2" src="./img/logo.png" alt="Restaurant logo">    -->     
            <h1 class="add-user-title">Sign In</h1>
            </div>
           <div class="form-container"> 
           <form method="post" action="add_user.php">
                        <div class='form-items'>
                            <div>
                                <label class='form-label destination-extra' for='fullname'>Fullname</label>
                            </div>
                            <div>
                                <input id='fullname' class='form-input' type='text' name='fullname'>
                            </div>
                        </div>
                        <div class='form-items'>
                            <div>
                                <label class='form-label destination-extra' for='email'>Email Address</label>
                            </div>
                            <div>
                                <input id='email' class='form-input' type='text' name='email'>
                            </div>
                        </div>
                        <div class='form-items'>
                            <div>
                                <label class='form-label destination-extra' for='username'>Username</label>
                            </div>
                            <div>
                                <input id='username' class='form-input' type='text' name='username'>
                            </div>
                        </div>
                        <div class='form-items'>
                            <div>
                                <label class='form-label destination-extra' for='password'>Password</label>
                            </div>
                            <div>
                                <input id='password' class='form-input' type='password' name='password'>
                            </div>
                        </div>
                        <div class='form-items'>
                            <div>
                                <input class="btn-explore register-btn" type='submit' value="REGISTER">
                            </div>
                        </div>
                        <p><?php echo $message; ?></p>
                        <input type="hidden" name="register" value="1">
                    </form>
           </div>
            
        </section>
      </main>  
    
   
</body>
</html>