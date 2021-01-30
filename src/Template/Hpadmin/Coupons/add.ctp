<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coupon $coupon
 */
?>
<div class="coupon_section">
    <h2>Add New Coupon</h2>
</div>
<?= $this->Form->create($coupon)?>
<?php $this->Form->setTemplates(['inputContainer' => '{{content}}'])?>
<div class="product_area">
    <div class="product_left">
        <?= $this->Form->control('code', ['label' => false, 'placeholder' => 'Coupon code'])?>
        <div class="textarea_edit coupon_textarea">
            <?= $this->Form->control('description', ['label' => false, 'placeholder' => 'Coupon description', 'type' => 'textarea'])?>
        </div>
        <div class="coupon_data">
            <div class="p_data">General <span><i class="fa fa-play"></i></span></div>
            <div class="general_coupon">
                <p>
                    <span class="span_left">Discount type</span> 
                    <span class="span_right">
                        <?= $this->Form->control('type', ['label' => false, 'options' => ['percent' => 'Percentage discount', 'fixed' => 'Fixed cart discount']])?>
                    </span>
                </p>
                <p>
                    <span class="span_left">Coupon amount</span> 
                    <span class="span_right">
                        <?= $this->Form->control('value', ['label' => false, 'value' => 0])?>
                        <i class="fa fa-question-circle tooltip" title="Value of the coupon">
                            <span class="tooltiptext">Value of the coupon</span>
                        </i>
                    </span>
                </p>
                <p>
                    <span class="span_left">Coupon expiry date</span> 
                    <span class="span_right">
                        <?= $this->Form->control('expiry_date', ['label' => false, 'year' => ['style' => 'width:23.33%'], 'month' => ['style' => 'width:23.33%'], 'day' => ['style' => 'width:23.33%']])?>
                    </span>
                </p>
            </div>    
        </div>
        <div class="coupon_data">
            <div class="p_data">Usage restriction <span><i class="fa fa-play"></i></span></div>
            <div class="general_coupon">
                <p>
                    <span class="span_left">Minimum spend</span> 
                    <span class="span_right">
                        <?= $this->Form->control('minimum_spend', ['label' => false, 'placeholder' => 'No minimum'])?>
                        <i class="fa fa-question-circle tooltip">
                            <span class="tooltiptext">This field allows you to set the minimum spend (subtotal) allowed to use the coupon.</span>
                        </i>
                    </span>
                </p>
                <p>
                    <span class="span_left">Maximum spend</span> 
                    <span class="span_right">
                        <?= $this->Form->control('maximum_spend', ['label' => false, 'placeholder' => 'No maximum'])?>
                        <i class="fa fa-question-circle tooltip">
                            <span class="tooltiptext">This field allows you to set the maximum spend (subtotal) allowed to use the coupon.</span>
                        </i>
                    </span>
                </p>
                <p>
                    <span class="span_left">Individual use only</span> 
                    <span class="span_right coupon_text">
                        <?= $this->Form->control('individual_only', ['label' => false, 'class' => 'checkbox'])?>
                        Check this box if the coupon cannot be used in conjunction with other coupons.
                    </span>
                </p>
                <p>
                    <span class="span_left">Exclude sale items</span> 
                    <span class="span_right coupon_text">
                        <?= $this->Form->control('exclude_sale_items', ['label' => false, 'class' => 'checkbox'])?>
                        Check this box if the coupon should not apply to items on sale. Per-item coupons will only work if the item is not on sale. Per-cart coupons will only work if there are items in the cart that are not on sale.</span>
                </p>
                <hr>
                <?= $this->Form->unlockField('products')?>
                <div class="suggesions" id="product-include-search-coupon">
                    <p>
                        <span class="span_left">Products</span> 
                        <span class="span_right">
                            <input type="text" class="suggesions" placeholder="Search for a product..." onkeyup="hpAdmin.searchSuggestion(this.value, 'products', 'product-include-search-coupon')">
                            <i class="fa fa-question-circle tooltip">
                                <span class="tooltiptext">Products that the coupon will be applied to, or that need to be in the cart in order for the "Fixed cart discount" to be applied.</span>
                            </i>
                        </span>
                    </p>
                    <ul></ul>
                    <!-- Display selected products -->
                    <div class="span_right" id="product-include-coupon-added">
                    </div>
                    <!-- Display selected products end-->
                </div>
                <?= $this->Form->unlockField('exclude_products')?>
                <div class="suggesions" id="product-exclude-search-coupon">
                    <p>
                        <span class="span_left">Exclude Products</span> 
                        <span class="span_right">
                            <input type="text" class="suggesions" placeholder="Search for a product..." onkeyup="hpAdmin.searchSuggestion(this.value, 'products', 'product-exclude-search-coupon')">
                            <i class="fa fa-question-circle tooltip">
                                <span class="tooltiptext">Products that the coupon will not be applied to, or that cannot be in the cart in order for the "Fixed cart discount" to be applied.</span>
                            </i>
                        </span>
                    </p>
                    <ul></ul>
                    <!-- Display selected products -->
                    <div class="span_right" id="product-exclude-coupon-added">
                    </div>
                    <!-- Display selected products end-->
                </div>
                <?= $this->Form->unlockField('categories')?>
                <div class="suggesions" id="categories-include-search-coupon">
                    <p>
                        <span class="span_left">Product categories</span> 
                        <span class="span_right">
                            <input type="text" class="suggesions" placeholder="Search for categories" onkeyup="hpAdmin.searchSuggestion(this.value, 'categories', 'categories-include-search-coupon')">
                            <i class="fa fa-question-circle tooltip">
                                <span class="tooltiptext">Product categories that the coupon will be applied to, or that need to be in the cart in order for the "Fixed cart discount" to be applied.</span>
                            </i>
                        </span>
                    </p>
                    <ul></ul>
                    <!-- Display selected categories -->
                    <div class="span_right" id="categories-include-coupon-added">
                    </div>
                    <!-- Display selected categories end-->
                </div>
                <?= $this->Form->unlockField('exclude_categories')?>
                <div class="suggesions" id="categories-exclude-search-coupon">
                    <p>
                        <span class="span_left">Exclude categories</span> 
                        <span class="span_right">
                            <input type="text" class="suggesions" placeholder="Search for categories" onkeyup="hpAdmin.searchSuggestion(this.value, 'categories', 'categories-exclude-search-coupon')">
                            <i class="fa fa-question-circle tooltip">
                                <span class="tooltiptext">Product categories that the coupon will not be applied to, or that cannot be in the cart in order for the "Fixed cart discount" to be applied.</span>
                            </i>
                        </span>
                    </p>
                    <ul></ul>
                    <!-- Display selected categories -->
                    <div class="span_right" id="categories-exclude-coupon-added">
                    </div>
                    <!-- Display selected categories end-->
                </div>
                <p>
                    <span class="span_left">User restrictions</span> 
                    <span class="span_right">
                        <?= $this->Form->control('users', ['label' => false, 'placeholder' => 'No restrictions'])?>
                        <i class="fa fa-question-circle tooltip">
                            <span class="tooltiptext">List of allowed emails to check against the customer billing email when an order is placed. Separate email addresses with commas.</span>
                        </i>
                    </span>
                </p>
            </div>    
        </div>
        <div class="coupon_data">
            <div class="p_data">Usage limits <span><i class="fa fa-play"></i></span></div>
            <div class="general_coupon">
                <p>
                    <span class="span_left">Usage limit per coupon</span> 
                    <span class="span_right">
                        <?= $this->Form->control('usage_limit', ['label' => false, 'placeholder' => 'Unlimited usage'])?>
                        <i class="fa fa-question-circle tooltip">
                            <span class="tooltiptext">How many times this coupon can be used before it is void.</span>
                        </i>
                    </span>
                </p>
                <p>
                    <span class="span_left">Usage limit per user</span> 
                    <span class="span_right">
                        <?= $this->Form->control('limit_per_user', ['label' => false, 'placeholder' => 'Unlimited usage'])?>
                        <i class="fa fa-question-circle tooltip">
                            <span class="tooltiptext">How many times this coupon can be used by an individual user.</span>
                        </i>
                    </span>
                </p>
            </div>    
        </div>
    </div>
    <div class="product_right">
        <div class="product_status">
            <h2>Publish <span class="play_right"><i class="fa fa-play"></i></span></h2>
            <p>
                <?= $this->Form->control('status', ['options' => ['published' => 'Published', 'drafts' => 'Drafts'], 'empty' => 'Status', 'label' => false])?>
            </p>
            <?= $this->Form->button('Save')?>
        </div>
    </div>
</div>
<?= $this->Form->end()?>