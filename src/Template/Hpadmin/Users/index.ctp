<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="main_user">
    <div class="user_section">
        <h2>Users<span onclick="window.location.href = '<?= $this->Url->build(['action' => 'add'])?>'">Add New</span></h2>
    </div>
    <?= $this->Form->create(null, ['url' => ['action' => 'bulk_action']])?>
        <div class="user_bulk">
            <div class="bulk_user1">
                <p><a href="<?= $this->Url->build(['action' => 'index'])?>">All</a> | <a href="<?= $this->Paginator->generateUrl(['role' => 'adminiatrator'])?>">Administrators</a> | <a href="<?= $this->Paginator->generateUrl(['role' => 'customer'])?>">Customers</a></p>
            </div>
            <div class="bulk_user2">
                <?= $this->Form->text('search', ['value' => $search])?>
                <?= $this->Form->button('Search User', ['onclick' => 'return hpAdmin.searchUser(this)'])?>
            </div>
            <div class="bulk_user3">
                <?= $this->Form->select('action', ['none' => 'Bulk Action', 'delete' => 'Delete', 'disable_cod' => 'Disable Cod', 'enable_cod' => 'Enable Cod'])?>
                <?= $this->Form->button('Apply', ['class' => 'user_btn2'])?>
            </div>
            <div class="media_pagination">
                <span><?= $this->Paginator->params()['count']?> Items</span>
                    <?= $this->Paginator->first('<button type="button"><i class="fa fa-angle-double-left"></i></button>', ['escape' => false])?>
                    <?= $this->Paginator->prev('<button type="button"><i class="fa fa-angle-left"></i></button>', ['escape' => false]);?>
                <input type="number" onchange="hpAdmin.sendToPageNumber(this.value)" min="1" type="text" max="<?= $this->Paginator->total()?>" value="<?= $this->Paginator->current()?>">
                <span>of <?= $this->Paginator->total();?></span>
                    <?= $this->Paginator->next('<button type="button"><i class="fa fa-angle-right"></i></button>', ['escape' => false]);?>
                    <?= $this->Paginator->last('<button type="button"><i class="fa fa-angle-double-right"></i></button>', ['escape' => false])?>
            </div>
        </div>
        <div class="user_details">

            <table class="hptable">
                <thead>
                    <tr>
                        <td class="check">
                            <input type="checkbox" onclick="$('input[name*=\'id\']').prop('checked', this.checked);">
                        </td>
                        <th><?= $this->Paginator->sort('name')?></th>
                        <th><?= $this->Paginator->sort('phone')?></th>
                        <th><?= $this->Paginator->sort('email')?></th>
                        <th>COD Enabled</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th><?= $this->Paginator->sort('created')?></th>
                        <th>Last Login</th>
                        <th>Login Device</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user):?>
                    <tr>
                        <td><?= $this->Form->checkbox('id[]', ['value' => $user->id, 'hiddenField' => false, 'secure' => false])?></td>
                        <td><span class="dashicons dashicons-buddicons-buddypress-logo"></span> <?= $user->name?></td>
                        <td><?= $user->phone?></td>
                        <td><?= $user->email?></td>
                        <td><?= ucwords($user->cod_enable)?></td>
                        <td><?= ucwords($user->user_group)?></td>
                        <td><?= $user->activation_key === 'activated' ? 'Verified' : 'Unverified'?></td>
                        <td><?= date_format($user->created, 'D d M, Y:h:m:i A')?></td>
                        <td><?= $user->last_login?></td>
                        <td><?= $user->login_device?></td>
                        <td>
                            <a href="<?= $this->Url->build(['action' => 'edit', $user->id])?>">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="check">
                            <input type="checkbox" onclick="$('input[name*=\'id\']').prop('checked', this.checked);">
                        </td>
                        <th><?= $this->Paginator->sort('name')?></th>
                        <th><?= $this->Paginator->sort('phone')?></th>
                        <th><?= $this->Paginator->sort('email')?></th>
                        <th>COD Enabled</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th><?= $this->Paginator->sort('created')?></th>
                        <th>Last Login</th>
                        <th>Login Device</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?= $this->Form->end()?>
</div>
