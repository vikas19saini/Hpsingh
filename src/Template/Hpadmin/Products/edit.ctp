<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="product_section">
    <h2>Add New Product</h2>
</div>
<?= $this->Form->create($product)?>
<?php $this->Form->setTemplates([
    'inputContainer' => '{{content}}',
    'checkboxWrapper' => '<li>{{label}}</li>',
    'nestingLabel' => '{{hidden}}<label class="media_label">{{input}}<span class="checkmark"></span></label>{{text}}'
    ])?>
    <?= $this->Form->control('id', ['type' => 'hidden'])?>
<div class="product_area">
    <div class="product_left">
        <?= $this->Form->control('name', ['label' => false, 'placeholder' => 'Product name', 'onblur' => 'hpAdmin.generateAndValidateProductSlug(this.value)', 'class' => 'product_title'])?><br/>
        <div class="peramlink-sample" id="paramlink-sample">
            <span>
                <strong></strong>
                <a data-paramlink ='<?= BASE . 'product/'?>' href="#peramlink"></a>
                <button type="button" id='edit-product-slug'>Edit</button>
            </span>
        </div>
        <?= $this->Form->control('slug', ['label' => false, 'style' => 'display:none'])?>
        
        <div class="product_data">
            <div class="p_data">Product Long Description<span class="active"><i class="fa fa-play"></i></span></div>
            <div class="p_data_text">
                <?= $this->Form->control('long_description', ['label' => false,])?>
            </div>
        </div>
        
        <div class="product_data">
            <div class="p_data">Product Data<span class="active"><i class="fa fa-play"></i></span></div>
            <div class="p_data_text">
                <div class="product_data_categories_view">
                    <div class="product_data_categories_list">
                        <div class="product_data_categories_shipping">
                            <fieldset>
                                <legend><i class="fa fa-wrench" aria-hidden="true"></i> General</legend>
                                <div class="ele-group">
                                    <div class="ele">
                                        <label>Regular Price</label>
                                        <?= $this->Form->control('ragular_price', ['label' => false])?>
                                    </div>
                                    <div class="ele">
                                        <label>Sale Price</label>
                                        <?= $this->Form->control('sale_price', ['label' => false])?>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend><i class="fa fa-cart-plus" aria-hidden="true"></i> Inventory</legend>
                                <div class="ele-group">
                                    <div class="ele">
                                        <label>Stock Status</label>
                                        <?= $this->Form->control('stock', ['label' => false, 'type' => 'select', 'options' => \Cake\Core\Configure::read('Stock')])?>
                                    </div>
                                    <div class="ele">
                                        <label>Available Quantity</label>
                                        <?= $this->Form->control('quantity', ['label' => false])?>
                                    </div>
                                </div>
                                <div class="ele-group">
                                    <div class="ele">
                                        <label>Min Order Quantity</label>
                                        <?= $this->Form->control('min_order_qty', ['label' => false])?>
                                    </div>
                                    <div class="ele">
                                        <label>Max Order Quantity</label>
                                        <?= $this->Form->control('max_order_qty', ['label' => false])?>
                                    </div>
                                </div>
                                <div class="ele-group">
                                    <div class="ele">
                                        <label>Step</label>
                                        <?= $this->Form->control('step', ['label' => false])?>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend><i class="fa fa-bars" aria-hidden="true"></i> Attributes</legend>
                                <div class="ele-group">
                                    <div class="ele">
                                        <label>Fabric Name</label>
                                        <?= $this->Form->control('fabric_name', ['label' => false])?>
                                    </div>
                                    <div class="ele">
                                        <label>Weave</label>
                                        <?= $this->Form->control('weave', ['label' => false])?>
                                    </div>
                                </div>
                                <div class="ele-group">
                                    <div class="ele">
                                        <label>Width</label>
                                        <?= $this->Form->control('width', ['label' => false])?>
                                    </div>
                                    <div class="ele">
                                        <label>Content</label>
                                        <?= $this->Form->control('content', ['label' => false])?>
                                    </div>
                                </div>
                                <div class="ele-group">
                                    <div class="ele">
                                        <label>Design No</label>
                                        <?= $this->Form->control('design_no', ['label' => false])?>
                                    </div>
                                    <div class="ele">
                                        <label>Count</label>
                                        <?= $this->Form->control('count', ['label' => false])?>
                                    </div>
                                </div>
                                <div class="ele-group">
                                    <div class="ele">
                                        <label>Weight</label>
                                        <?= $this->Form->control('weight', ['label' => false])?>
                                    </div>
                                    <div class="ele">
                                        <label>Manage Stock</label>
                                        <?= $this->Form->control('manage_stock', ['label' => false, 'options' => ['no' => 'Don\'t Manage Stock', 'yes' => 'Manage Stock']])?>
                                    </div>
                                </div>
                                <div class="ele-group">
                                    <div class="ele">
                                        <label>Weight/Feel/Suitability</label>
                                        <?= $this->Form->control('weight_feel_suitability', ['label' => false])?>
                                    </div>
                                    <div class="ele">
                                        <label>Design Name/Color</label>
                                        <?= $this->Form->control('design_name_color', ['label' => false])?>
                                    </div>
                                </div>
                                <div class="ele-group">
                                    <div class="ele">
                                        <label>Length</label>
                                        <?= $this->Form->control('length', ['label' => false])?>
                                    </div>
                                    <div class="ele">
                                        <label>Price</label>
                                        <?= $this->Form->control('price_text', ['label' => false])?>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset>
                                <legend><i class="fa fa-truck"></i> Shipping</legend>
                                <div class="ele-group">
                                    <div class="ele">
                                        <label>Weight(KG)</label>
                                        <?= $this->Form->control('shipping_weight', ['label' => false, 'placeholder' => 'Weight', 'step' => '0.1'])?>
                                    </div>
                                    <div class="ele">
                                        <label>Shipping Length</label>
                                        <?= $this->Form->control('shipping_length', ['label' => false, 'placeholder' => 'Length', 'step' => '0.1'])?>
                                    </div>
                                </div>
                                <div class="ele-group">
                                    <div class="ele">
                                        <label>Shipping Width</label>
                                        <?= $this->Form->control('shipping_width', ['label' => false, 'placeholder' => 'Width', 'step' => '0.1'])?>
                                    </div>
                                    <div class="ele">
                                        <label>Shipping Height</label>
                                        <?= $this->Form->control('shipping_height', ['label' => false, 'placeholder' => 'Height', 'step' => '0.1'])?>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product_description">
            <div class="p_description">Product Short Description <span class="active"><i class="fa fa-play"></i></span></div>
            <div class="p_description_text">
                <?= $this->Form->control('short_description', ['label' => false,])?>
            </div>
        </div>
        <div class="product_description">
            <div class="p_description">Product SEO Data <span class="active"><i class="fa fa-play"></i></span></div>
            <div class="p_description_text">
                <?= $this->Form->control('meta_title')?><br/>
                <?= $this->Form->control('meta_description')?><br/>
                <?= $this->Form->control('meta_keywords')?><br/>
            </div>
        </div>
    </div>
    <div class="product_right">
        <div class="product_status">
            <h2>Publish <span class="play_right"><i class="fa fa-play"></i></span></h2>
            <p>
                <?= $this->Form->select('status', ['drafts' => 'Drafts', 'published' => 'Publish'])?>
            </p>
            <?= $this->Form->button('Save')?>
        </div>
        <div class="product_categories_right">
            <h2>Product Categories <span class="play_right"><i class="fa fa-play"></i></span></h2>
            <ul>
                <li class="tablinks tabactive" onclick="openTab(event, 'categories')">Categories</li>
                <li class="tablinks" onclick="openTab(event, 'whatmake')">What Make</li>
            </ul>
            <div class="product_categories_check">
                <ul id="categories" class="tabcontent" style="display: block">
                    <?= $this->Form->select('categories._ids', $allCategories, ['hiddenField' => false, 'secure' => false, 'multiple' => 'checkbox', 'escape' => false])?>
                </ul>
                <ul id="whatmake" class="tabcontent">
                    
                </ul>
            </div>
        </div>
        <div class="product_tag">
            <h2>Product Tag <span class="play_right"><i class="fa fa-play"></i></span></h2>
            <div class="product_tag_input">
                <input type="text" id="product-temp-tags-input" autocomplete="off" onkeyup="hpAdmin.searchTags(this, this.value)">
                <button type="button" onclick="hpAdmin.addTagsToPost(this)">Add</button>
                <ul>
                </ul>
                <p>Separate tags with commas</p>
            </div>
            <div class="dynamic_product_tag_add">
                <ul id="added-product-tag-list">
                    <?php $addedTagIds = []?>
                    <?php if(isset($product->tags) && !empty($product->tags)):?>
                    <?php foreach ($product->tags as $tag):?>
                    <li><i class="fa fa-minus-circle" onclick="hpAdmin.removeTagsFromProducts(this, 146)"></i> <?= $tag->name?></li>
                    <?php array_push($addedTagIds, $tag->id)?>
                    <?php endforeach;?>
                    <?php endif;?>
                </ul>
            </div>
            <?= $this->Form->control('product-tags', ['secure' => false, 'style' => 'display:none', 'label' => false, 'value' => @implode(',', $addedTagIds)])?>
        </div>
        <div class="product_img">
            <h2>Product Image 
                <span class="play_right">
                    <i class="fa fa-play"></i>
                </span>
            </h2>
            <div id="product-image">
                <?php $featuredImage = '';?>
                <?php if(isset($product->featured_image) && !empty($product->featured_image)):?>
                <div>
                    <?= $this->Media->the_image('thumbnail', $product->featured_image->url, ['alt' => 'alt']) ?>
                    <span onclick="hpAdmin.removeMedia('<?= $product->featured_image->id?>', 'featured-image', this)">
                        <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </span>
                </div>
                <?php $featuredImage = $product->featured_image->id?>
                <?php endif;?>
            </div>
            <p><a href="javascript:void(0);" onclick="hpAdmin.mediaChooser('featured-image', 'product-image')">Set Product Image</a></p>
            <?= $this->Form->control('featured-image', ['label' => false, 'type' => 'text', 'style' => 'display:none', 'value' => $featuredImage])?>
        </div>
        <div class="product_img">
            <h2>Product Gallery <span class="play_right"><i class="fa fa-play"></i></span></h2>
            <?php $thumbnails = []; $length = isset($product->product_thumbnail) ? count($product->product_thumbnail) : 0?>
            <div id="product-gallery">
                <?php if(isset($product->product_thumbnail) && !empty($product->product_thumbnail)):?>
                <?php for($i=0; $i<$length; $i++):?>
                <div>
                        <?= $this->Media->the_image('thumbnail', $product->product_thumbnail[$i]->url, ['alt' => 'alt']) ?>
                    <span onclick="hpAdmin.removeMedia('<?= $product->product_thumbnail[$i]->id?>', 'thumbnails', this)">
                        <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </span>
                </div>
                <?php array_push($thumbnails, $product->product_thumbnail[$i]->id)?>
                <?php endfor;?>
                <?php endif;?>
            </div>
            <p><a href="javascript:void(0);" onclick="hpAdmin.mediaChooser('thumbnails', 'product-gallery')">Add/Edit Product Gallery</a></p>
            <?= $this->Form->control('thumbnails', ['label' => false, 'type' => 'text', 'style' => 'display:none', 'value' => @implode(',', $thumbnails)])?>
        </div>
        <div class="product_img">
            <h2>Product Review <span class="play_right"><i class="fa fa-play"></i></span></h2>            
            <div class="field-group">
                <input type="text" id="reviewBy" placeholder="Comment as.." onkeyup="hpAdmin.getUsers(this.value, this)">
                <input type="hidden" id="customerId">
                <input type="hidden" id="customerRating">
                <input type="hidden" id="productId" value="<?= $product->id?>">
                <textarea placeholder="Comment" id="customerReview"></textarea>
            </div>
            <div class="field-group">
                <div class="product-rating">
                    <div class="product-star">
                        <span data-rating="1" class="dashicons dashicons-star-filled"></span>
                    </div>
                    <div class="product-star">
                        <span data-rating="2" class="dashicons dashicons-star-filled"></span>
                    </div>
                    <div class="product-star">
                        <span data-rating="3" class="dashicons dashicons-star-filled"></span>
                    </div>
                    <div class="product-star">
                        <span data-rating="4" class="dashicons dashicons-star-filled"></span>
                    </div>
                    <div class="product-star">
                        <span data-rating="5" class="dashicons dashicons-star-filled"></span>
                    </div>
                </div>
                <button type="button" onclick="hpAdmin.comment(this)">Comment</button>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end()?>
<script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
<?= $this->Html->scriptStart(['block' => true])?>
    CKEDITOR.replace('long_description');
    CKEDITOR.replace('short_description');
    $(document).ready(function () {
        $(".p_description").click(function () {
            $(this).next('.p_description_text').slideToggle("slow");
            $(this).find('span').toggleClass("active");
        });
    });
    $(document).ready(function () {
        $(".p_data").click(function () {
            $(".p_data_text").slideToggle("slow");
            $(".p_data>span").toggleClass("active");
        });
        $(".product_data_categories>ul>li").click(function () {
            $(this).addClass("active");
            $(this).siblings().removeClass("active");
        });
    });
    $(document).ready(function () {
        $(".product_categories_add>p").click(function () {
            $(".visible_add_categories").addClass("active");
        });
    });
    // Star rating
    $(".product-star>.dashicons-star-filled").hover(function(){
        $(this).parent('.product-star').prevAll().children('.dashicons-star-filled').addClass('rhover');
        $(this).addClass('rhover');
    }, function(){
        $(this).parent('.product-star').prevAll().children('.dashicons-star-filled').removeClass('rhover');
        $(this).removeClass('rhover');        
    });
    $(".product-star>.dashicons-star-filled").click(function(){
        $(".product-star>.dashicons-star-filled").removeClass('rated');
        $(".product-star>.dashicons-star-filled").removeClass('rhover');
        $(this).parent('.product-star').prevAll().children('.dashicons-star-filled').addClass('rated');
        $(this).addClass('rated');
        $("#customerRating").val($(this).attr('data-rating'));
    });
    function openTab(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" tabactive", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " tabactive";
    }
<?= $this->Html->scriptEnd()?>
