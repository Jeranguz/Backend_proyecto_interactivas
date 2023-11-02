<?php 
    require_once '../database.php';
    
    include('simple_html_dom.php');

    //link de la pagina de la cual se sacara la información
    $link = "https://mydanishkitchen.com/tag/salad/";
    //nombres de las imagenes
    $filenames = [];
    //nombres de los platillos
    $menu_item_names = [];
    //direccion de las imagenes
    $image_url = [];

    $items = file_get_html($link);

    foreach($items->find('.type-post') as $item){
        $title = $item->find('.card__title-text');
        var_dump($item);
       //var_dump(trim($title[0]->plaintext));
    }
?>