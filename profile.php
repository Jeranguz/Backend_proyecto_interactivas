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
    if($_GET){
        if($_GET["id"]=="historial"){
            $records = $database->select("record","*",[
                "id_user"=>$_SESSION["id"]
            ]);

            $record_details = [];
            foreach($records as $record){
                $dish=$database->select("tb_record_details","*",[
                    "id_record" => $record["id_record"]
                ]);
                $record_details[]=$dish;

            } 
        }
        /* var_dump($records); */
       
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
                ."<div class='records-container'>";
                    foreach($records as $record){
                        $modality= $database->get("tb_modality", "n_modality", [
                            "id_modality" => $record["id_modality"]
                        ]);
                        echo
                        "<div class='record-container'>"
                        ."<div class= 'record-main-datails'>"
                        ."<span class='record-datails'>#Num record: ".$record["id_record"]."</span>"
                        ."<span class='record-datails'> Date: ".$record["date"]."</span>"
                        ."</div>"
                        ."<div class='table-div'>"
                        ."<table>"
                            ."<thead class='historial-thead'>"
                                ."<tr class='historial-tr'>"
                                    ."<td class='historial-td'>Dish name</td>"
                                    ."<td class='historial-td'>Amount</td>"
                                    ."<td class='historial-td'>price</td>"
                                ."</tr>"
                            ."</thead>"
                            ."<tbody>";
                               
                                foreach ($record_details as $dishes) {
                                    foreach($dishes as $food){
                                        if($record["id_record"]==$food["id_record"]){
                                            $dish_info = $database->get("tb_dishes", ["n_dishes", "price"], [
                                                "id_dishes" => $food["id_dish"]
                                            ]);
                                            echo "<tr class='historial-tr'>";
                                            echo "<td class='historial-td'>" . $dish_info["n_dishes"] . "  </td>";
                                            echo "<td class='historial-td'>" . $food["amount"] . "  </td>";
                                            echo "<td class='historial-td'>" .$dish_info["price"] * $food["amount"] . "  </td>";
                                        }

                                    }
                                }  
                                
                            echo"</tbody>";
                        echo"</table>";
                            echo"</div>";
                            echo
                            "<div class= 'record-main-datails'>"
                            ."<span class='record-datails'>Modality: $modality  </span>"
                            ."<span class='record-datails'> Total: $".$record["total"]."</span>"
                            ."</div>"; 
                        echo"</div>";    

                    }
                echo"</div>";
                
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