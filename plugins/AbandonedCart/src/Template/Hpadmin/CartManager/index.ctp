<?php

$this->assign('css', $this->Html->css('admin/daterangepicker'));
    $this->assign('script', $this->Html->script('admin/moment.min') . $this->Html->script('admin/daterangepicker.min'));
?>
<div class="main_user">
    <div class="user_section">
        <h2>Customer Cart Details (<?= $this->Paginator->params()['count']?>) | <a href="<?= $this->Paginator->generateUrl(['action' => 'export'])?>"><strong>Export <i class="fa fa-download" aria-hidden="true"></i></strong></a></h2>
    </div>
    <div class="user_bulk product-controls">
        <div class="bulk_user3 product-options"><br/>
            <?= $this->Form->create(null, ['url' => ['action' => 'bulkAction'], 'onsubmit' => 'return hpAdmin.setItemIds(this)'])?>
            <?= $this->Form->select('action', ['delete' => 'Delete'], ['empty' => 'Bulk Actions'])?>
            <?= $this->Form->text('actionIds', ['style' => 'display:none'])?>
            <?= $this->Form->button('Apply', ['class' => 'user_btn2'])?>
            <?= $this->Form->end()?>
            <form method="get">
                <div id="reportrange" class="date-picker">
                    <i class="fa fa-calendar"></i>
                    <span></span>
                    <?php if(empty($this->request->getQuery())):?>
                    <i class="fa fa-caret-down"></i>
                    <?php else:?>
                    <a href="<?= $this->Url->build(['action' => 'index'])?>">
                        <i class="fa fa-times-circle"></i>
                    </a>
                    <?php endif;?>
                </div>
                <input type="hidden" name="start-date">
                <input type="hidden" name="end-date">
                <button>Filter</button>
            </form>
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

    <div class="user_details product_details">
        <table class="hptable">
            <thead>
                <tr>
                    <td class="check"><input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);"></td>
                    <th>CUSTOMER</th>
                    <th>EMAIL ADDRESS</th>
                    <th>CONTACT NUMBER</th>
                    <th>CREATED</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php if($carts->count() > 0): foreach ($carts as $cart):?>
                <tr>
                    <td class="check">
                        <input type="checkbox" name="itemId[]" value="<?= $cart->id?>">
                    </td>
                    <td>
                        <a href="<?= $this->Url->build(['action' => 'view', $cart->user_id])?>">
                            <?= $cart->user->name?>
                        </a>
                    </td>
                    <td><?= $cart->user->email?></td>
                    <td><?= $cart->user->phone?></td>
                    <td><?= date_format($cart->created, 'D d M Y h:m A')?></td>
                    <td>
                        <?= $this->Html->link('View order', ['action' => 'view', $cart->user_id])?>
                    </td>
                </tr>
                <?php endforeach; else:?>
                <tr>
                    <td colspan="4">
                        <h2 align="center">No cart found!</h2>
                    </td>
                </tr>
                <?php endif;?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="check"><input type="checkbox" onclick="$('input[name*=\'itemId\']').prop('checked', this.checked);"></td>
                    <th>CUSTOMER</th>
                    <th>EMAIL ADDRESS</th>
                    <th>CONTACT NUMBER</th>
                    <th>CREATED</th>
                    <th>ACTIONS</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?= $this->Html->scriptStart(['block' => true])?>
$(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('input[name=start-date]').val(start.format('YYYY-MM-D'));
        $('input[name=end-date]').val(end.format('YYYY-MM-D'));
    }
    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },

        autoApply: true,
    }, cb);

    cb(start, end);

});
<?= $this->Html->scriptEnd()?>
