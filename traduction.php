<?php
require_once 'database.php';

$destination = [];

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));

        $decoded = json_decode($content, true);
        
        $response = "server response";
       
        //echo json_encode($decoded["language"]);

        if ($decoded["language"] == 'tr') {
            $item = $database->select("tb_dishes", [
                "tb_dishes.n_dishes",
                "tb_dishes.d_dish"
            ], [
                "id_dishes" => $decoded["id_dish"]
            ]);

            $destination["name"] = $item[0]["n_dishes"];
            $destination["description"] = $item[0]["d_dish"];

        } else {
            $item = $database->select("tb_dishes", [
                "tb_dishes.n_dishes_tr",
                "tb_dishes.d_dish_tr"
            ], [
                "id_dishes" => $decoded["id_dish"]
            ]);

            $destination["name"] = $item[0]["n_dishes_tr"];
            $destination["description"] = $item[0]["d_dish_tr"];
        }
            echo json_encode($destination);
    }
}
?>