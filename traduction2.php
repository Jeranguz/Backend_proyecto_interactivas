<?php
require_once 'database.php';



if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));

        $decoded = json_decode($content, true);

        $response = "server response";

        $cart_details = isset($_COOKIE['destinations']) ? json_decode($_COOKIE['destinations'], true) : [];
        $modified_data=[];
        foreach ($cart_details as &$cart) {
            if ($cart["id_dishes"] ==  $decoded["id_dish"]) { 
                $cart["dish-amount"] = $decoded["amount"];
                $modified_data=$cart;
                break;
            }
        }

        // Actualiza la cookie con el array modificado completo
        setcookie('destinations', json_encode($cart_details), time() + 72000);

        echo json_encode($modified_data);
    }
}
?>