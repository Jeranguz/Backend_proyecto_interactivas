<?php 
    require_once '../database.php';
    
    include('simple_html_dom.php');

    //link de la pagina de la cual se sacara la información
    $link = "https://www.chefspencil.com/top-20-most-popular-danish-foods/";
    //nombres de las imagenes
    $filenames = [];
    //nombres de los platillos
    $menu_item_names = [];
    //direccion de las imagenes
    $image_url = [];

    $items = file_get_html($link);

    foreach($items->find('.wp-block-heading') as $item){
        // $details = "";
        // $title = $item->find('.h1');
        $a_tag = $item->find('a');
        // if(!empty($a_tag->href)){
        // $details = file_get_html($a_tag->href);
        // }
        var_dump($a_tag);
        //h1 h1--center h1--bold h1--medium h1--lowercase
        //var_dump($item->find('.top-list-article__item-title'));
       //var_dump(trim($title[0]->plaintext));
    }
?>