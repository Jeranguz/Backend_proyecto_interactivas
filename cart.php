<?php
session_start();
require_once 'database.php';
$total = 0;

$cart_details = [];


$cart_details = isset($_COOKIE['destinations']) ? json_decode($_COOKIE['destinations'], true) : [];
    
        if ($_POST && isset($_POST['delete'])) {
            foreach ($cart_details as $index => &$cart) {
                if ($cart["id_dishes"] == $_POST["delete"]) { 
                    
                    unset($cart_details[$index]);
                    $cart_details = array_values($cart_details);
                    setcookie('destinations', json_encode($cart_details), time() + 72000);
                        
                    break;
                }
            }
        } elseif ($_POST && !isset($_POST['Buy']) && isset($_POST['add_cart']) ) {
           
            $cart_details = isset($_COOKIE['destinations']) ? json_decode($_COOKIE['destinations'], true) : [];

            $found = false;

            foreach ($cart_details as &$cart) {
                if ($cart["id_dishes"] == $_POST["id_dishes"]) { 
                        $cart["dish-amount"] += $_POST["dish-amount"];
                        $found = true;
                    break;
                }
            }

            if (!$found) {
                $dish_details["id_dishes"] = $_POST["id_dishes"];
                $dish_details["dish-amount"] = $_POST["dish-amount"];
                $dish_details["n_dishes"] = $_POST["n_dishes"];
                $dish_details["price"] = $_POST["price"];

                $cart_details[] = $dish_details;
            }

            setcookie('destinations', json_encode($cart_details), time() + 72000);
        
        }

        if ($_POST && isset($_POST['Buy']) && $cart_details!=[]){
          if($_SESSION["isLoggedIn"]==false){
                header("location: add_user.php");
          }
          $database->insert("record",[
                "id_user"=>$_SESSION["id"],
                "id_modality"=>$_POST["dish-modality"],
                "date"=> $_POST["date"],
                "total"=>$_POST["total"] 
        
            ]);
            $id_record= $database->id();
            
            $recordsToInsert = [];

            foreach ($cart_details as $food) {
                $record = [
                    "id_record" => $id_record,
                    "id_dish" => $food["id_dishes"],
                    "amount" => $food["dish-amount"]
                ];

                $recordsToInsert[] = $record;
            }
            $database->insert("tb_record_details", $recordsToInsert);
            setcookie('destinations', "", time() + 72000);
            $cart_details = [];
           
        }

        $modalities = $database->select("tb_modality", "*");
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/luxon@3.4.3/build/global/luxon.min.js"></script>
</head>
<header>
    <?php
     include "./parts/nav.php";
    ?>
</header>

<body>
    <input class="return-bottom return-btn-admin" type="button" onclick="history.back();" value="←">
    <h2 class="featured-text admin-title">Cart</h2>

    <div class="table-div">
        <table>
            <thead>
                <tr>
                    <td>Dish name</td>
                    <td>Amount</td>
                    <td>price</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($cart_details as $index=> $food) {
                   
                    $total += $food["price"] * $food["dish-amount"];
                    echo "<tr>";
                    echo "<td>" . $food["n_dishes"] . "  </td>";
                    echo "<td><input class='menu-input' id='id_amount' name='".$food["id_dishes"]."' type='number' min='1' value='".$food["dish-amount"]."'></td>";
                    echo "<td id='dish_total'>$". $food["price"] * $food["dish-amount"] . "  </td>";
                    echo "<td>
                        <form method='post'>
                            <input type='hidden' name='delete' value='" .$food["id_dishes"] . "'>
                            <button type='submit'>Delete</button>
                        </form>
                      </td>";
                } 
                ?>
            </tbody>
        </table>
        
    </div>
    <?php 
            if(count($cart_details)==0){
                echo "<h2 class='main-text'>No items added</h2>";
            }
        ?>         
        <div class="cart-buy-section">
            
        
                        <form method='post'>
                            <input type="hidden" id="timeAndDateInput" name='date' >
                            <input type='hidden' name='total' value='<?= $total; ?>'>
                           
                           
                            

                             <div class="input-div">
                                    <label class="porpuse-text" for="dish-modality">Select the modality</label>
                                    <select class="menu-input" name="dish-modality" id="dish-modality">
                                        <?php
                                        foreach ($modalities as $modality) {
                                            echo "<option value='" . $modality["id_modality"] . "'>" . $modality["n_modality"] . "</option>";
                                        } 
                                        ?>
                                    </select>
                             </div>
                             
                             <?php 
                                echo "<h3 id='total' class='porpuse-text'>Total to Pay ".$total."$</h3>"
                            ?>        
                             <input class="btn-explore" name='Buy' type="submit" value="Buy :)">
                        </form>
                
            </div>
            
</body>

<footer>
    <?php
    include "./parts/footer.php";
    ?>
</footer>

        <script>
        // Function to update the input field with the current time and date
        function updateDateTime() {
            // Get the current time and date using Luxon
            const now = luxon.DateTime.now();
            
            // Format the time and date as per your requirements
            const format = 'yyyy-MM-dd HH:mm:ss';
            const formattedDateTime = now.toFormat(format);

            // Update the value of the input field
            document.getElementById('timeAndDateInput').value = formattedDateTime;
        }

        // Call the function when the page loads and every second (1000 milliseconds)
        document.addEventListener('DOMContentLoaded', function() {
            // Call the function initially
            updateDateTime();
           
            // Set up a timer to update every second
            setInterval(updateDateTime, 1000);

                        var inputElements = document.querySelectorAll('#id_amount');
                        inputElements.forEach(function(inputElement) {
                            inputElement.addEventListener('change', function() {
                            // Esta función se ejecutará cuando cambie el valor del input
                           
                            let info = {
                            id_dish: inputElement.name,
                            amount: inputElement.value
                            };
                            
                            

                                    fetch("http://localhost/backend_proyecto_interactivas/traduction2.php",{
                                    method: "POST",
                                    mode: "same-origin",
                                    credentials: "same-origin",
                                    headers:{
                                        'Accept': 'application/json, text/plain, */*',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(info)
                                })
                                .then(response => response.json())
                                .then(data => {
                                    location.href = location.href;

                                    
                                    })
                                    .catch(err => console.log("error: " + err));

                            });
                });
            
        });


        </script>

        

</html>