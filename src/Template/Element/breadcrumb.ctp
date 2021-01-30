<?php 
    $this->Breadcrumbs->add('Home', ['_name' => 'home']);

    if(!empty($categoryPath)){
        $categoryUrl = [];
        foreach($categoryPath as $category){
            array_push($categoryUrl, $category->slug);
            $this->Breadcrumbs->add($category->name, ['_name' => 'category', @implode('/', $categoryUrl)]);
        }
    }

    // for product page
    if(isset($product))
        $this->Breadcrumbs->add($product->name, ['_name' => 'product', 'slug' => $product->slug]);
    
    // for tag page
    if($this->request->getParam('action') === 'tag')
        $this->Breadcrumbs->add($category->name, ['_name' => 'tag', 'slug' => $category->slug]);

    if($this->request->getParam('action') === 'search' || $this->request->getParam('action') === 'onSale')
        $this->Breadcrumbs->add($category->name, ['_name' => 'search', 'search_term' => $category->name]);

    $this->Breadcrumbs->setTemplates([
            'wrapper' => '<p>{{content}}</p>',
            'item' => '<a href="{{url}}"{{innerAttrs}}>{{title}}</a> | ',
            ]);
?>

<section class="top_details product_location">
    <div class="container">
        <div class="row path">
            <?= $this->Breadcrumbs->render(['separator' => '|'])?>
        </div>
    </div>
</section>