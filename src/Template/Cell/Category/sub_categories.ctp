<?php ?>

<ul>
    <?php foreach ($subCategories as $subCategory):?>
    <li>
        <a href="<?= (!empty($subCategory->url)) ? $subCategory->url : $this->Url->build(['_name' => 'category', $category->slug, $subCategory->slug])?>"><?= ucwords($subCategory->name)?></a>
    </li>
    <?php endforeach;?>
</ul>
