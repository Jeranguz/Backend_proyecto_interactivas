<?php 
    require_once '../database.php';
    
    include('simple_html_dom.php');

    //Posible link para extraer los platos fuertes
    //https://www.tasteatlas.com/50-most-popular-dishes-in-denmark


    //link de la pagina de la cual se sacara la información
    
    //nombres de las imagenes
    $filenames = [];
    //nombres de los platillos
    $menu_item_names = [];
    //direccion de las imagenes
    $image_url = [];

    $menu_item_descriptions = [];
    $menu_items = 15;
    $link = "https://www.sbs.com.au/food/tag/cuisine/danish?page=1";

    $items = file_get_html($link);

    //Pagina a la que le "logre" hacer un scraping https://www.sbs.com.au/food/tag/cuisine/danish?page=1
    //El problema es que agarra cada platillo 2 veces porque hay 2 etiquetas a que tienen la misma clase
    //Otro problema es que no puedo conseguir el src
     foreach($items->find('.css-szedqc') as $item){
         
         $details = file_get_html("https://www.sbs.com.au".$item->href);
         if ($details !== false) {
            // Realiza la extracción de datos con $details
            echo "se ha logrado ingresar";
            $description = $details->find('.MuiTypography-subtitle1');
            $title = $details->find('.MuiTypography-h4');
            $image = $details->find('.css-eck1d1');
            if(count($image) > 0){
                echo ' entro en el primer if';
                $image_urls[] = $image[0]->src;
            }else{
                echo 'entro en el primer else';
               
            }
            $menu_item_names[] = trim($title[0]->plaintext);
            $menu_item_descriptions[] = $description[0]->plaintext;
        } else {
            echo "Error al obtener el contenido HTML de la URL.";
        }

     }
     foreach($menu_item_names as $index=>$item){
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
     }

    //De este scraping se pueden sacar los postres
    // $dessert_link = "https://www.allrecipes.com/recipes/1892/world-cuisine/european/scandinavian/danish/";
    // $desserts_scraping_count = 15;
    //  $desserts = file_get_html($dessert_link);

    //  foreach($desserts->find(".card--no-image") as $dish){

    //      $title = $dish->find('.card__title-text');
        
    //      $details = file_get_html($dish->href);
    //      $description = $details->find('.article-subheading');
    //      $image = $details->find('.primary-image__image');

    //      if(count($image) > 0){
    //          $image_urls[] = $image[0]->src;
    //      }else{
    //          $replace_img = $dish->find('.universal-image__image');
    //          if(count($replace_img) > 0){
    //              $image_urls[] = $replace_img[0]->{'data-src'};
    //          }
    //      }
       
    //      if(count($description) > 0){
    //          if($desserts_scraping_count == 0) break;

    //          $menu_item_names[] = trim($title[0]->plaintext);
    //          echo trim($title[0]->plaintext);
    //          $menu_item_descriptions[] = $description[0]->plaintext;
            
    //          $filename = strtolower(trim($title[0]->plaintext));
    //          $filename = str_replace(' ', '-', $filename);
    //          $filenames[] = $filename.".jpg";

    //          $desserts_scraping_count--;
    //      }
    //  }

    //  foreach($filenames as $index=>$item){
    //      echo "******************";
    //      echo "<br>";
    //      echo $item;
    //      echo "<br>";
    //      echo $menu_item_names[$index];
    //      echo "<br>";
    //      echo $menu_item_descriptions[$index];
    //      echo "<br>";
    //      echo $image_urls[$index];
    //      echo "<br>";
    //      echo rand (1*10, 70*10)/10;
    //      echo "<br>";
    //  }

     //Guardar la imagenes
    //  foreach ($filenames as $index=>$image){
    //     file_put_contents("../img/".$image, file_get_contents($image_urls[$index]));
    // }

    //Meter a la base de datos
//     foreach($filenames as $index=>$item){
//     $database->insert("tb_dishes",[
//         "n_dishes"=>$menu_item_names[$index],
//         "img_dish"=>$item,
//         "price"=>rand (1*10, 70*10)/10,
//         "d_dish"=>$menu_item_descriptions[$index]
//     ]);
// }
?>