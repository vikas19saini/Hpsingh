<?php 
    $links = [];

    foreach($path as $pathLink){
        array_push($links, $pathLink->slug);
    }
?>

<a href="<?= $this->Url->build(['_name' => 'category', @implode('/', $links)])?>"><?= $category->name?></a>