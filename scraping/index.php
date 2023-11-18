<?php 
    require_once '../database.php';
    include('simple_html_dom.php');

    //nombres de las imagenes
    $filenames = [];
    //nombres de los platillos
    $menu_item_names = [];
    //direccion de las imagenes
    $image_url = [];

    $menu_item_descriptions = [];

    $dessert_link = "https://www.allrecipes.com/recipes/725/world-cuisine/european/scandinavian/";
    $desserts_scraping_count = 36;
     $desserts = file_get_html($dessert_link);

     //scraping
     foreach($desserts->find(".card--no-image") as $dish){

         $title = $dish->find('.card__title-text');
        
         $details = file_get_html($dish->href);
         $description = $details->find('.article-subheading');
         $image = $details->find('.primary-image__image');

         if(count($image) > 0){
             $image_urls[] = $image[0]->src;
         }else{
             $replace_img = $dish->find('.universal-image__image');
             if(count($replace_img) > 0){
                 $image_urls[] = $replace_img[0]->{'data-src'};
             }
         }
       
         if(count($description) > 0){
             if($desserts_scraping_count == 0) break;

             $menu_item_names[] = trim($title[0]->plaintext);
             $menu_item_descriptions[] = trim($description[0]->plaintext);
            
             $filename = strtolower(trim($title[0]->plaintext));
             $filename = str_replace(' ', '-', $filename);
             $filename = str_replace('&#39;', '', $filename);
             $filenames[] = $filename.".jpg";

             $desserts_scraping_count--;
         }
     }

     //Mostrar los datos obtenidos
     foreach($filenames as $index=>$item){
         echo "******************";
         echo "<br>";
         echo $item;
         echo "<br>";
         echo $menu_item_names[$index];
         echo "<br>";
         echo $menu_item_descriptions[$index];
         echo "<br>";
         echo $image_urls[$index];
         echo "<br>";
         echo rand (1*10, 70*10)/10;
         echo "<br>";
     }

    //  Guardar las imagenes
    //  foreach ($filenames as $index=>$image){
    //     file_put_contents("../img/".$image, file_get_contents($image_urls[$index]));
    // }

    // Meter a la base de datos
    foreach($filenames as $index=>$item){
    $database->insert("tb_dishes",[
        "n_dishes"=>$menu_item_names[$index],
        "img_dish"=>$item,
        "price"=>rand (1*10, 70*10)/10,
        "d_dish"=>$menu_item_descriptions[$index],
        "id_amount_people"=>rand(1, 3),
        "id_category"=>rand(1, 4),
        "featured"=>rand(0, 1),
    ]);
}
?>