<?php
require_once 'database.php';

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType === "application/json") {
        $content = trim(file_get_contents("php://input"));

        $decoded = json_decode($content, true);


        if($decoded["category"]==0){
            $items = $database->select("tb_dishes", "*", [
                    "n_dishes[~]" => $decoded["keyword"]
            ]);
        }else{
            $items = $database->select("tb_dishes", "*", [
                "AND" => [
                    "n_dishes[~]" => $decoded["keyword"],
                    "id_category" => $decoded["category"]
                ],
            ]);
        }
        

        /*$state = $database->select("tb_us_states","*",[
            "id_us_state" => $_GET["destination_state"]
        ]);*/

        echo json_encode($items);
    }
}


?>