<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Country[]|\Cake\Collection\CollectionInterface $countries
 */
?>
<div class="main_user">
    <div class="user_section">
        <h2>Zones</h2>
    </div>
    <div class="add_categories">
        <?= $this->Form->create($zone, ['url' => ['action' => 'add'], 'class' => 'categories_left'])?>
        <h2>Add New Zone</h2>
        <div class="form-group">
                <?= $this->Form->control('name', ['autocomplete' => 'off'])?>
            <p class="specification">The zone name.</p>
        </div>
        <div class="form-group">
                <?= $this->Form->control('code', ['autocomplete' => 'off'])?>
            <p class="specification">The zone code.</p>
        </div>
        <div class="form-group">
                <?= $this->Form->control('country_id', ['options' => $countries])?>
            <p class="specification">The country name of the zone.</p>
        </div>
        <div class="form-group clearfix">
                <?= $this->Form->button('Add New Zone', ['type' => 'submit'])?>
        </div>
        <?= $this->Form->end()?>
        <?= $this->Form->create(null, ['url' => ['action' => 'delete'], 'class' => 'categories_right'])?>
        <div class="country-options">
            <div class="bulk_category">
                    <?= $this->Form->select('action', ['none' => 'Bulk Actions', 'delete' => 'Delete'])?>
                    <?= $this->Form->button('Apply', ['class' => 'user_btn2', 'type' => 'submit'])?>
            </div>
            <div class="media_pagination">                
                    <span><?= $this->Paginator->params()['count']?> Items</span>
                        <?= $this->Paginator->first('<button title="First page" type="button"><i class="fa fa-angle-double-left"></i></button>', ['escape' => false])?>                
                        <?= $this->Paginator->prev('<button title="Previous page" type="button"><i class="fa fa-angle-left"></i></button>', ['escape' => false]);?>
                    <input type="number" onchange="hpAdmin.sendToPageNumber(this.value)" min="1" type="text" max="<?= $this->Paginator->total()?>" value="<?= $this->Paginator->current()?>">
                    <span>of <?= $this->Paginator->total();?></span>
                        <?= $this->Paginator->next('<button title="Next page" type="button"><i class="fa fa-angle-right"></i></button>', ['escape' => false]);?>
                        <?= $this->Paginator->last('<button title="Last page" type="button"><i class="fa fa-angle-double-right"></i></button>', ['escape' => false])?>
            </div>
        </div>
        <div class="category_details">
            <table>
                <tr>
                    <th>
                        <input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);">
                    </th>
                    <th>Name</th>
                    <th>Country Name</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($zones as $zone):?>
                <tr>                    
                    <td><?= $this->Form->checkbox('itemId[]', ['value' => $zone->id])?></td>
                    <td><?= $zone->name?></td>
                    <td><?= $zone->country->name?></td>
                    <td><a href="<?= $this->Url->build(['action' => 'edit', $zone->id])?>"><button type="button">Edit</button></a></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
        <?= $this->Form->end()?>
    </div>
</div>