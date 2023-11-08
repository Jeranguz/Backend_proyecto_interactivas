<?php 
    require_once '../database.php';
    $categories = $database->select("tb_dishes_category","*");
    $peoples = $database->select("tb_amount_people","*");

    $message = "";

    if($_POST){

        if(isset($_FILES["img_dish"])){
            
            $errors = [];
            $file_name = $_FILES["img_dish"]["name"];
            $file_size = $_FILES["img_dish"]["size"];
            $file_tmp = $_FILES["img_dish"]["tmp_name"];
            $file_type = $_FILES["img_dish"]["type"];
            $file_ext_arr = explode(".", $_FILES["img_dish"]["name"]);

            $file_ext = end($file_ext_arr);
            $img_ext = ["jpeg", "png", "jpg", "webp"];

            if(!in_array($file_ext, $img_ext)){
                $errors[] = "File type not supported";
                $message = "File type not supported";
            }

            
             if(empty($errors)){
                 $filename = $_POST["n_dishes"];
                 $filename = str_replace(',', '', $filename);
                 $filename = str_replace('.', '', $filename);
                 $filename = str_replace(' ', '-', $filename);
                 $img = $filename.".".$file_ext;
                 echo $img;
                 move_uploaded_file($file_tmp, "../img/".$img);

                //    $database->insert("tb_dishes",[
                //        "n_dishes"=>$_POST["n_dishes"],
                //        "id_category"=>$_POST["id_category"],
                //        "id_amount_people"=>$_POST["id_amount_people"],
                //        "price"=>$_POST["price"],
                //        "d_dish"=>$_POST["d_dish"],
                //        "img_dish"=>"$img"
                //    ]);
             }
        }
        // Reference: https://medoo.in/api/insert
         
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <title>Add Dish</title>
</head>
<body>
    <h2 class="featured-text">Add Dish</h2>
    <form method="post" action="add-dish.php" enctype="multipart/form-data">
        <div>
            <label class="porpuse-text" for="dish_name">Dish name</label>
            <input id="n_dishes" name="n_dishes" type="text">
        </div>
        <div>
            <label class="porpuse-text" for="d_dish">Dish description</label>
            <textarea id="d_dish" name="d_dish" cols="30" rows="10"></textarea>
        </div>
        <div>
            <label class="porpuse-text" for="id_category">Dish category</label>
            <select name="id_category" id="id_category">
                <?php 
                    foreach($categories as $category){
                        echo "<option value='".$category["id_category"]."'>".$category["n_category"]."</option>";
                    }
                ?>
            </select>
        </div>
        <div>
            <label class="porpuse-text" for="id_amount_people">Dish amount people</label>
            <select name="id_amount_people" id="id_amount_people">
                <?php 
                    foreach($peoples as $people){
                        echo "<option value='".$people["id_amount_people"]."'>".$people["n_category_people"]."</option>";
                    }
                ?>
            </select>
        </div>
        <div>
            <label class="porpuse-text" for="price">Dish price</label>
            <input id="price" name="price" type="text">
        </div>
        <div>
            <label class="porpuse-text" for="img_dish">Destination Image</label>
            <img id="preview" src="./imgs/destination-placeholder.webp" alt="Preview">
            <input id="img_dish" type="file" name="img_dish" onchange="readURL(this)">
        </div>
        <div>
            <input type="submit" value="Add new dish :)">
        </div>
    </form> 
    <script>
        function readURL(input) {
            if(input.files && input.files[0]){
                let reader = new FileReader();

                reader.onload = function(e) {
                    let preview = document.getElementById('preview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
    </script>  
</body>
</html>